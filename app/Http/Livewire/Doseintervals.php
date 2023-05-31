<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Doseinterval;
use Livewire\WithPagination;

class Doseintervals extends Component
{
    use WithPagination;
    public $active;
    public $search;
    public $sortBy = 'id';
    public $sortAsc = true;
    public $typeconfimationmodal = false;
    public $addingtypemodal = false;
    public $doseinterval;


    protected $queryString = [
        'active' => ['except' => false],
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true]

    ];

    protected $rules = [
        'doseinterval.name' => 'required|string|min:2',
        'doseinterval.pashto_name' => 'required|string|min:2',
        'doseinterval.description' => 'required|string|min:4',
        'doseinterval.status' => 'boolean'


    ];



    public function render()
    {
        $doseintervals = Doseinterval::where('user_id', auth()->user()->id)
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('pashto_name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->active, function ($query) {
                // return $query->where('status', 1);
                return $query->active();
            })
            ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
            ->paginate(10);

        return view('livewire.doseintervals', [
            'doseintervals' => $doseintervals
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


    public function deleteType(Doseinterval $doseinterval)
    {

        $doseinterval->delete();
        $this->typeconfimationmodal = false;
        session()->flash('message', 'Dose interval deleted successfully');
    }

    public function addtypemodal()
    {
        $this->reset(['doseinterval']);
        $this->addingtypemodal = true;
    }

    public function typeEditModal(Doseinterval $doseinterval)
    {
        $this->doseinterval = $doseinterval;

        $this->addingtypemodal = true;
    }

    public function addType()
    {
        $this->validate();

        if (isset($this->doseinterval->id)) {
            $this->doseinterval->save();
            session()->flash('message', 'Dose interval saved successfully');
        } else {


            auth()->user()->doseintervals()->create([

                'name' => $this->doseinterval['name'],
                'pashto_name' => $this->doseinterval['pashto_name'],
                'description' => $this->doseinterval['description'],
                'status' => $this->doseinterval['status'] ?? 0
            ]);
            session()->flash('message', 'Dose interval added successfully');
        }

        $this->addingtypemodal = false;
    }
}
