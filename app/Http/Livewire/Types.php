<?php

namespace App\Http\Livewire;

use App\Models\Type;
use Livewire\Component;
use Livewire\WithPagination;



class Types extends Component
{
    use WithPagination;
    public $active;
    public $search;
    public $sortBy = 'id';
    public $sortAsc = true;
    public $typeconfimationmodal = false;
    public $addingtypemodal = false;
    public $type;


    protected $queryString = [
        'active' => ['except' => false],
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true]

    ];

    protected $rules = [
        'type.name' => 'required|string|min:2',
        'type.description' => 'required|string|min:4',
        'type.status' => 'boolean'


    ];



    public function render()
    {
        $types = Type::where('user_id', auth()->user()->id)
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->active, function ($query) {
                // return $query->where('status', 1);
                return $query->active();
            })
            ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
            ->paginate(10);

        return view('livewire.types', [
            'types' => $types
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


    public function deleteType(Type $type)
    {

        $type->delete();
        $this->typeconfimationmodal = false;
        session()->flash('message', 'Type deleted successfully');
    }

    public function addtypemodal()
    {
        $this->reset(['type']);
        $this->addingtypemodal = true;
    }

    public function typeEditModal(Type $type)
    {
        $this->type = $type;

        $this->addingtypemodal = true;
    }

    public function addType()
    {
        $this->validate();

        if (isset($this->type->id)) {
            $this->type->save();
            session()->flash('message', 'Type saved successfully');
        } else {


            auth()->user()->types()->create([

                'name' => $this->type['name'],
                'description' => $this->type['description'],
                'status' => $this->type['status'] ?? 0
            ]);
            session()->flash('message', 'Type added successfully');
        }

        $this->addingtypemodal = false;
    }
}
