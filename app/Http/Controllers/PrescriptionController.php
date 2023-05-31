<?php

namespace App\Http\Controllers;

use auth;
use Carbon\Carbon;
use App\Models\Type;
use App\Models\Scheme;
use App\Models\Timing;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\pdf;

use App\Models\Doseduration;
use App\Models\Doseinterval;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    //

    // public function create()
    // {
    //     return view('orders.create');
    // }


    public function create()
    {


        $types = Type::all()->pluck('name', 'id');
        // $types = Type::all()->pluck('name', 'id')->prepend('Select Type', '');

        // $manufactures = Manufacture::all();
        $products = Product::all()->pluck('product_name', 'id');
        $intervals = Doseinterval::all()->pluck('name', 'id');
        $durations = Doseduration::all()->pluck('name', 'id');
        $timings = Timing::all()->pluck('name', 'id');
        $schemes = Scheme::all()->pluck('name', 'id');

        return view('orders.create', compact('types', 'products', 'intervals', 'durations', 'timings', 'schemes'));
    }

    public function store(Request $request)
    {

        $request->validate([

            'sex' => 'required',
            'patient' => 'required',
            'age' => 'required',
            // 'prescription_date' => 'required',
            // 'type' => 'required',
            // 'product' => 'required',
            // 'dose' => 'required',
            // 'duration' => 'required',
            // 'interval' => 'required',
            // 'timing' => 'required',
            // 'scheme_id' => 'required',


        ]);
        $date = Carbon::now();
        $prescription = Prescription::create([
            'patient' => $request->patient,
            'age' => $request->age,
            'sex' => $request->sex,

            'prescription_date' => $date,
            'diabetone' => $request->diabetone,
            // 'diabettwo' => $request->diabettwo,
            'low_bp' => $request->low_bp,
            'high_bp' => $request->high_bp,
            'urine_output' => $request->urine_output,
            'respiratory' => $request->respiratory,
            'heart_rate' => $request->heart_rate,
            'comment' => $request->comment,
            // 'instruction' => $request->instruction,
            'temperature' => $request->temperature,
            'bmi' => $request->bmi,
            'height' => $request->height,
            'weight' => $request->weight,
            // 'clinical_record' => $request->clinical_record,
            'user_id' => auth()->user()->id,


        ]);

        // $prescription = Prescription::create($request->all());

        $types = $request->input('type_id', []);


        $products = $request->input('product', []);
        $dose = $request->input('dose', []);
        $intervals = $request->input('interval_id', []);
        $durations = $request->input('duration_id', []);
        $timings = $request->input('timing_id', []);
        $schemes = $request->input('scheme_id', []);

        // dd($types, $products, $dose, $intervals, $durations, $timings, $schemes);

        for ($product = 0; $product < count($products); $product++) {
            if ($products[$product] != '') {
                $prescription->products()->attach($products[$product], ['type_id' => $types[$product], 'dose' => $dose[$product], 'doseinterval_id' => $intervals[$product],  'doseduration_id' => $durations[$product], 'timing_id' => $timings[$product], 'scheme_id' => $schemes[$product]]);
            }
        }



        // foreach ($request->orderProducts as $product) {
        //     $prescription->products()->attach(
        //         $product['product_id'],

        //         [
        //             'type_id' => $product['type_id'],
        //             'dose' => $product['dose'],
        //             'doseinterval_id' => $product['doseinterval_id'],
        //             'doseduration_id' => $product['doseduration_id'],
        //             'timing_id' => $product['timing_id'],
        //             'timing_id' => $product['timing_id'],
        //             'scheme_id' => $product['scheme_id'],
        //         ],
        //     );
        // }
        if ($prescription->count()) {
            $id = $prescription->id;
            $data = Prescription::where('id', $id)->first();

            $results = Prescription::join('prescription_product', 'prescriptions.id', '=', 'prescription_product.prescription_id')
                ->leftJoin('types', 'types.id', '=', 'prescription_product.type_id')
                ->leftJoin('products', 'products.id', '=', 'prescription_product.product_id')
                ->leftJoin('doseintervals', 'doseintervals.id', '=', 'prescription_product.doseinterval_id')
                ->leftJoin('dosedurations', 'dosedurations.id', '=', 'prescription_product.doseduration_id')
                ->leftJoin('timings', 'timings.id', '=', 'prescription_product.timing_id')
                ->leftJoin('schemes', 'schemes.id', '=', 'prescription_product.scheme_id')
                ->where('prescriptions.id', $id)
                ->get(['products.product_name as product', 'types.name as type', 'products.dose', 'doseintervals.name as interval', 'dosedurations.name as duration', 'timings.name as time', 'schemes.name as scheme', 'schemes.pashto_name as pashtoscheme']);



            session()->flash('message', 'Prescription created successfully');
            return view('orders.show', compact('data', 'results'));
        }

        // return redirect()->route('prescriptions');
        // return redirect()->route('createprescriptions');



        // return redirect()->route('admin.orders.invoice',['id'=>$order->id]); 
        // return 'Prescription stored successfully!';
    }
    public function edit($id)
    {


        $data = Prescription::where('id', $id)->first();



        return view('orders.edit', compact('data'));
    }

    public function show($id)
    {
        // $data = Prescription::with('products')->where('id', $id)->first();
        $data = Prescription::where('id', $id)->first();

        $results = Prescription::join('prescription_product', 'prescriptions.id', '=', 'prescription_product.prescription_id')
            ->leftJoin('types', 'types.id', '=', 'prescription_product.type_id')
            ->leftJoin('products', 'products.id', '=', 'prescription_product.product_id')
            ->leftJoin('doseintervals', 'doseintervals.id', '=', 'prescription_product.doseinterval_id')
            ->leftJoin('dosedurations', 'dosedurations.id', '=', 'prescription_product.doseduration_id')
            ->leftJoin('timings', 'timings.id', '=', 'prescription_product.timing_id')
            ->leftJoin('schemes', 'schemes.id', '=', 'prescription_product.scheme_id')
            ->where('prescriptions.id', $id)
            ->get(['products.product_name as product', 'types.name as type', 'products.dose', 'doseintervals.name as interval', 'dosedurations.name as duration', 'timings.name as time', 'schemes.name as scheme', 'schemes.pashto_name as pashtoscheme']);


        return view('orders.show', compact('data', 'results'));
    }

    public function getProducts($id)
    {
        $products = Product::where("status", 1)
            ->where("type_id", $id)->pluck("product_name", "id");
        return json_encode($products);
    }
    public function getDose($id)
    {
        //when we want to get data based on product from 4 different tables then we use like this.
        // $productreportss = Product::where("id", $id)
        // ->with(['stock_transaction','stock','order'])->get();
        $productinfo = Product::where("id", $id)->get();
        return json_encode($productinfo);
    }

    public function PrintPrescription($id)
    {
        $prescriptions = Prescription::where('id', $id)->first();



        // $invoiceItems = [
        //     ['item' => 'Website Design', 'amount' => 50.50],
        //     ['item' => 'Hosting (3 months)', 'amount' => 80.50],
        //     ['item' => 'Domain (1 year)', 'amount' => 10.50]
        // ];
        // $invoiceData = [
        //     'invoice_id' => 123,
        //     'transaction_id' => 1234567,
        //     'payment_method' => 'Paypal',
        //     'creation_date' => date('M d, Y'),
        //     'total_amount' => 141.50
        // ];



        $data = [
            'title' => 'Prescription',
            'date' => date('m/d/Y'),
            'prescriptions' => $prescriptions,
        ];

        $pdf = PDF::loadView('orders.invoice', $data)->setOptions(['isRemoteEnabled', false,  'a4', 'portrait']);
        return $pdf->stream();
        // return $pdf->download('invoice.pdf');

        // $pdf = PDF::loadView('invoice', compact('invoiceItems', 'invoiceData'));
        // return $pdf->download('invoice.pdf');
        // $pdf = \PDF::loadView('admin.payments.invoice', compact('payment','totalpaid'));

        // return $pdf->stream($customername.'_'.$invoicenum.'Payslip.pdf');
        // return $pdf->stream();
    }
}
