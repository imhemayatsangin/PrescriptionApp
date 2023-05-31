<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Doseduration;
use Livewire\WithPagination;

class Dosedurations extends Component
{
    use WithPagination;
    public $active;
    public $search;
    public $sortBy = 'id';
    public $sortAsc = true;
    public $typeconfimationmodal = false;
    public $addingtypemodal = false;
    public $doseduration;


    protected $queryString = [
        'active' => ['except' => false],
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true]

    ];

    protected $rules = [
        'doseduration.name' => 'required|string|min:2',
        'doseduration.pashto_name' => 'required|string|min:2',
        'doseduration.description' => 'required|string|min:4',
        'doseduration.status' => 'boolean'


    ];



    public function render()
    {
        $dosedurations = Doseduration::where('user_id', auth()->user()->id)
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

        return view('livewire.dosedurations', [
            'dosedurations' => $dosedurations
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


    public function deleteType(Doseduration $doseduration)
    {

        $doseduration->delete();
        $this->typeconfimationmodal = false;
        session()->flash('message', 'Dose duration deleted successfully');
    }

    public function addtypemodal()
    {
        $this->reset(['doseduration']);
        $this->addingtypemodal = true;
    }

    public function typeEditModal(Doseduration $doseduration)
    {
        $this->doseduration = $doseduration;

        $this->addingtypemodal = true;
    }

    public function addType()
    {
        $this->validate();

        if (isset($this->doseduration->id)) {
            $this->doseduration->save();
            session()->flash('message', 'Dose duration saved successfully');
        } else {


            auth()->user()->dosedurations()->create([

                'name' => $this->doseduration['name'],
                'pashto_name' => $this->doseduration['pashto_name'],
                'description' => $this->doseduration['description'],
                'status' => $this->doseduration['status'] ?? 0
            ]);
            session()->flash('message', 'Dose duration added successfully');
        }

        $this->addingtypemodal = false;
    }
}
