<?php

namespace App\Http\Livewire;


use App\Models\Product;

use Livewire\Component;
use App\Models\Prescription;
use Livewire\WithPagination;

class Prescriptions extends Component
{


    use WithPagination;
    public $active;
    public $search;
    public $sortBy = 'id';
    public $sortAsc = true;
    public $typeconfimationmodal = false;
    public $addingtypemodal = false;
    public $prescription;


    protected $queryString = [
        'active' => ['except' => false],
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true]

    ];

    // protected $rules = [
    //     'presctiption.name' => 'required|string|min:2',
    //     'presctiption.pashto_name' => 'required|string|min:2',
    //     'presctiption.description' => 'required|string|min:4',
    //     'presctiption.status' => 'boolean'


    // ];




    public function render()
    {
        $prescriptions = Prescription::where('user_id', auth()->user()->id)
            ->orderBy("id", 'desc')
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('patient', 'like', '%' . $this->search . '%')
                        ->orWhere('sex', 'like', '%' . $this->search . '%')
                        ->orWhere('age', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->active, function ($query) {
                // return $query->where('status', 1);
                return $query->active();
            })

            ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
            ->paginate(10);

        return view('livewire.prescriptions', [
            'prescriptions' => $prescriptions
        ]);
    }
    public function updateActive()
    {
        $this->resetPage();
    }
    public function updateSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {

        if ($field == $this->sortBy) {
            $this->sortAsc = !$this->sortAsc;
        }

        $this->sortBy = $field;
    }



    public function typedeletemodal($id)
    {

        $this->typeconfimationmodal = $id;
    }


    public function deleteType(Prescription $prescription)
    {

        // $prescriptionid = $prescription->id;

        $prescription->delete();
        $this->typeconfimationmodal = false;
        session()->flash('message', 'prescription deleted successfully');
    }

    public function addtypemodal()
    {
        $this->reset(['prescription']);
        $this->addingtypemodal = true;
    }

    public function typeEditModal(Prescription $prescription)
    {
        $this->prescription = $prescription;

        $this->addingtypemodal = true;
    }

    public function addType()
    {
        $this->validate();

        if (isset($this->prescription->id)) {
            $this->prescription->save();
            session()->flash('message', 'prescription saved successfully');
        } else {


            auth()->user()->prescriptions()->create([

                'name' => $this->scheme['name'],
                'pashto_name' => $this->scheme['pashto_name'],
                'description' => $this->scheme['description'],
                'status' => $this->scheme['status'] ?? 0
            ]);
            session()->flash('message', 'prescription added successfully');
        }

        $this->addingtypemodal = false;
    }
}
