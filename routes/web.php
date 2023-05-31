<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrescriptionController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/users/index', function () {
        return view('users.index');
    })->name('users.index');
    Route::get('/users/edit', function () {
        return view('users.edit');
    })->name('users.edit');

    Route::get('/users/destroy', function () {
        return view('users.destroy');
    })->name('users.destroy');
    Route::get('/pharmacy/types', function () {
        return view('pharmacy.types');
    })->name('types');
    Route::get('/pharmacy/brands', function () {
        return view('pharmacy.brands');
    })->name('brands');
    Route::get('/pharmacy/products', function () {
        return view('pharmacy.products');
    })->name('products');
    Route::get('/prescription/doseintervals', function () {
        return view('prescription.doseintervals');
    })->name('doseintervals');

    Route::get('/prescription/dosedurations', function () {
        return view('prescription.dosedurations');
    })->name('dosedurations');
    Route::get('/prescription/timings', function () {
        return view('prescription.timings');
    })->name('timings');
    Route::get('/prescription/schemes', function () {
        return view('prescription.schemes');
    })->name('schemes');


    // this one is for using livewire component

    // Route::get('/prescriptions', function () {
    //     return view('prescription.prescriptions');
    // })->name('prescriptions');


    // Route::get('/createprescriptions', function () {
    //     return view('prescription.createprescriptions');
    // })->name('createprescriptions');







    // this one is for using livewire component

    Route::get('/prescriptions-order', function () {
        return view('orders.index');
    })->name('prescriptions');

    Route::resource('orders', \App\Http\Controllers\PrescriptionController::class);

    Route::get('/createprescriptions', function () {
        return view('orders.create');
    })->name('createprescriptions');
    Route::get('/prescription-show/{id}',  [PrescriptionController::class, 'show'])->name("orders.show");
    Route::get('/prescription-edit/{id}',  [PrescriptionController::class, 'edit'])->name("orders.edit");
    Route::get('/prescription/printPrescription/{id}',  [PrescriptionController::class, 'PrintPrescription'])->name('prescription.invoice');
    Route::get('getProducts/{id}', [PrescriptionController::class, 'getProducts']);
    Route::get('getDose/{id}', [PrescriptionController::class, 'getDose']);

    Route::get('/contacts', function () {
        return view('tasks.contact');
    })->name('contacts');

    // Route::resource('prescriptions', PrescriptionController::class);

    // Route::post('/createprescription', [PrescriptionController::class, 'store'])->name('orders.store');



    // This is our new line
    Route::resource('tasks', \App\Http\Controllers\TaskController::class);
    Route::get('/tasks/{id}/edit', 'TaskController@edit')->name("tasks.edit");

    // Route::get('/editmodal/{id}', 'TaskController@editmodal');
    // Route::get('/tasks/{id}/editmodal', 'TaskController@editmodal');

    // Route::get('/getInvoice', 'OrdersController@getInvoice');
    // Route::get('/getOrdernewProducts/{id}/{orderid}', 'OrdersController@getOrdernewProducts');

    // Route::get('/orders/showInvoice/{id}', 'OrdersController@printInvoice')->name('orders.invoice');



});
