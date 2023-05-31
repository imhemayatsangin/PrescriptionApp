<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Scheme;
use Livewire\WithPagination;

class Schemes extends Component
{
    use WithPagination;
    public $active;
    public $search;
    public $sortBy = 'id';
    public $sortAsc = true;
    public $typeconfimationmodal = false;
    public $addingtypemodal = false;
    public $scheme;



    protected $queryString = [
        'active' => ['except' => false],
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true]

    ];

    protected $rules = [
        'scheme.name' => 'required|string|min:2',
        'scheme.pashto_name' => 'string|min:2',
        'scheme.description' => 'required|string|min:4',
        'scheme.status' => 'boolean'


    ];



    public function render()
    {
        $schemes = Scheme::where('user_id', auth()->user()->id)
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

        return view('livewire.schemes', [
            'schemes' => $schemes
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


    public function deleteType(Scheme $scheme)
    {

        $scheme->delete();
        $this->typeconfimationmodal = false;
        session()->flash('message', 'Scheme deleted successfully');
    }

    public function addtypemodal()
    {
        $this->reset(['scheme']);
        $this->addingtypemodal = true;
    }

    public function typeEditModal(Scheme $scheme)
    {
        $this->scheme = $scheme;

        $this->addingtypemodal = true;
    }

    public function addType()
    {
        $this->validate();



        if (isset($this->scheme->id)) {
            $this->scheme->save();
            session()->flash('message', 'Scheme saved successfully');
        } else {


            auth()->user()->schemes()->create([

                'name' => $this->scheme['name'],
                'pashto_name' => $this->scheme['pashto_name'] ?? null,
                'description' => $this->scheme['description'],
                'status' => $this->scheme['status'] ?? 0
            ]);
            session()->flash('message', 'Scheme added successfully');
        }

        $this->addingtypemodal = false;
    }
}
