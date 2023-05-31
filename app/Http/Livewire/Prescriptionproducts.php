<?php

namespace App\Http\Livewire;

use App\Models\Type;
use App\Models\Scheme;
use App\Models\Timing;
use App\Models\Product;
use Livewire\Component;
use App\Models\Doseduration;
use App\Models\Doseinterval;
use App\Models\Prescription;
use Illuminate\Database\Eloquent\Collection;

class Prescriptionproducts extends Component
{

    public $orderProducts = [];
    public $product_code, $products = [];
    public $types = [];
    public $durations = [];
    public $Doseinterval = [];
    public $Timing = [];
    public $Scheme = [];
    public $prescriptionform;


    public $categories;
    public $items;

    // public $selectedType = null;

    // public $typeproducts = null;
    // public $selectedProduct = null;
    // public $product_dose;

    // public $diabetone, $low_bp, $high_bp, $urine_output, $respiratory, $heart_rate, $comment, $temperature, $bmi, $height, $weight, $user_id;


    protected $rules = [

        'prescriptionform.sex' => 'required',
        'prescriptionform.patient' => 'required',
        'prescriptionform.age' => 'required',
        'prescriptionform.prescription_date' => 'required',
        // 'prescriptionform.diabetone' => 'min:1',
        // 'prescriptionform.low_bp' => 'min:1',
        // 'prescriptionform.high_bp' => 'min:1',
        // 'prescriptionform.urine_output' => 'min:1',
        // 'prescriptionform.respiratory' => 'min:1',
        // 'prescriptionform.heart_rate' => 'min:1',
        // 'prescriptionform.comment' => 'min:1',
        // 'prescriptionform.temperature' => 'min:1',
        // 'prescriptionform.bmi' => 'min:1',
        // 'prescriptionform.height' => 'min:1',
        // 'prescriptionform.weight' => 'min:1',
        // 'prescriptionform.user_id' => 'required',
        'orderProducts.*.type_id' => 'required',
        'orderProducts.*.product_id' => 'required',
        // 'orderProducts.*.dose' => 'required',
        'orderProducts.*.doseinterval_id' => 'required',
        'orderProducts.*.doseduration_id' => 'required',
        'orderProducts.*.timing_id' => 'required',
        'orderProducts.*.scheme_id' => 'required',

    ];

    // public function updatedselectedType($type_id)
    // {

    //     $this->typeproducts = Product::where('id', $type_id)->get();
    // }



    // public function updatedselectedProduct($prod_id)
    // {

    //     $this->product_dose = Product::where('id', $prod_id)->first('dose');
    // }

    // public function updated($key, $value)
    // {
    //     //
    //     if (in_array($key, ['product_dose'])) {

    //         $this->product_dose = $this->product_dose;
    //     }
    // }


    public function updated($propertyName)
    {


        $this->validateOnly($propertyName);
    }

    public function mount()
    {


        $this->categories = Type::all();
        $this->items = collect();


        // $this->types = Type::all();
        // $this->products = Product::all();
        $this->durations = Doseduration::all();
        $this->intervals = Doseinterval::all();
        $this->timings = Timing::all();
        $this->schemes = Scheme::all();
        $this->orderProducts = [
            ['type_id' => null, 'product_id' => null, 'items' => null, 'dose' => null, 'doseinterval_id' => null, 'doseduration_id' => null, 'timing_id' => null, 'scheme_id' => null]
        ];
    }
    public function addProduct()
    {

        $this->orderProducts[] = ['type_id' => null, 'product_id' => null, 'items' => null, 'dose' => null,  'doseinterval_id' => null, 'doseduration_id' => null, 'timing_id' => null, 'scheme_id' => null];
    }

    public function removeProduct($index)
    {
        unset($this->orderProducts[$index]);
        $this->orderProducts = array_values($this->orderProducts);
    }



    public function setEmployeeQualifications($type_id, $key)
    {


        if (!is_null($type_id)) {
            $this->orderProducts[$key]['items'] = Product::where('id', $type_id)->get();
        }
    }

    public function save()
    {
        $this->validate();

        // $validatedDate = $this->validate(
        //     [
        //         'prescriptionform.sex' => 'required',
        //         'prescriptionform.patient' => 'required',
        //         'prescriptionform.age' => 'required',
        //         'prescriptionform.prescription_date' => 'required',


        //         'orderProducts.*.type_id' => 'required',
        //         'orderProducts.*.product_id' => 'required',

        //         'orderProducts.*.doseinterval_id' => 'required',
        //         'orderProducts.*.doseduration_id' => 'required',
        //         'orderProducts.*.timing_id' => 'required',
        //         'orderProducts.*.scheme_id' => 'required',
        //     ],
        //     [



        //         'prescriptionform.sex.required' => 'Gender is required',
        //         'prescriptionform.patient.required' => 'Patient name  is required',
        //         'prescriptionform.age.required' => 'Age is required',
        //         'prescriptionform.prescription_date.required' => 'Date field is required',


        //         'orderProducts.*.type_id.required' => 'Type is required',
        //         'orderProducts.*.product_id.required' => 'Product is required',
        //         'orderProducts.*.doseinterval_id.required' => 'Interval is required',
        //         'orderProducts.*.doseduration_id.required' => 'Duration is required',
        //         'orderProducts.*.timing_id.required' => 'Time is required',
        //         'orderProducts.*.scheme_id.required' => 'Scheme is required',

        //     ]
        // );

        $prescription = Prescription::create([


            'patient' => $this->prescriptionform['patient'],
            'age' => $this->prescriptionform['age'],
            'sex' => $this->prescriptionform['sex'],
            'prescription_date' => $this->prescriptionform['prescription_date'],
            'diabetone' => $this->prescriptionform['diabetone'] ?? null,

            // 'diabettwo' => $request->diabettwo,
            'low_bp' => $this->prescriptionform['low_bp'] ?? null,
            'high_bp' => $this->prescriptionform['high_bp'] ?? null,
            'urine_output' => $this->prescriptionform['urine_output'] ?? null,
            'respiratory' => $this->prescriptionform['respiratory'] ?? null,
            'heart_rate' => $this->prescriptionform['heart_rate'] ?? null,
            'comment' => $this->prescriptionform['comment'] ?? null,
            // 'instruction' => $request->instruction,
            'temperature' => $this->prescriptionform['temperature'] ?? null,
            'bmi' => $this->prescriptionform['bmi'] ?? null,
            'height' => $this->prescriptionform['height'] ?? null,
            'weight' => $this->prescriptionform['weight'] ?? null,
            //'clinical_record' => $request->clinical_record,

            'user_id' => auth()->user()->id,


        ]);
        foreach ($this->orderProducts as $orderProduct) {
            // $Product->save();
            $prescription->products()->attach(
                $orderProduct['product_id'],

                [
                    'type_id' => $orderProduct['type_id'],
                    // 'dose' => $orderProduct['dose'],
                    'doseinterval_id' => $orderProduct['doseinterval_id'],
                    'doseduration_id' => $orderProduct['doseduration_id'],
                    'timing_id' => $orderProduct['timing_id'],
                    'timing_id' => $orderProduct['timing_id'],
                    'scheme_id' => $orderProduct['scheme_id'],
                ],
            );
        }
        session()->flash('message', 'Prescription created successfully');
        $this->reset(['orderProducts']);
        $this->reset(['prescriptionform']);
    }

    public function render()
    {
        return view('livewire.prescriptionproducts');
    }
}
