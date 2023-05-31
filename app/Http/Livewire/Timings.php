<?php

namespace App\Http\Livewire;

use App\Models\Timing;
use Livewire\Component;
use Livewire\WithPagination;

class Timings extends Component
{
    use WithPagination;
    public $active;
    public $search;
    public $sortBy = 'id';
    public $sortAsc = true;
    public $typeconfimationmodal = false;
    public $addingtypemodal = false;
    public $timing;


    protected $queryString = [
        'active' => ['except' => false],
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true]

    ];

    protected $rules = [
        'timing.name' => 'required|string|min:2',
        'timing.pashto_name' => 'required|string|min:2',
        'timing.description' => 'required|string|min:4',
        'timing.status' => 'boolean'


    ];



    public function render()
    {
        $timings = Timing::where('user_id', auth()->user()->id)
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

        return view('livewire.timings', [
            'timings' => $timings
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


    public function deleteType(Timing $timing)
    {

        $timing->delete();
        $this->typeconfimationmodal = false;
        session()->flash('message', 'Timing deleted successfully');
    }

    public function addtypemodal()
    {
        $this->reset(['timing']);
        $this->addingtypemodal = true;
    }

    public function typeEditModal(Timing $timing)
    {
        $this->timing = $timing;

        $this->addingtypemodal = true;
    }

    public function addType()
    {
        $this->validate();

        if (isset($this->timing->id)) {
            $this->timing->save();
            session()->flash('message', 'Timing saved successfully');
        } else {


            auth()->user()->timings()->create([

                'name' => $this->timing['name'],
                'pashto_name' => $this->timing['pashto_name'],
                'description' => $this->timing['description'],
                'status' => $this->timing['status'] ?? 0
            ]);
            session()->flash('message', 'Timing added successfully');
        }

        $this->addingtypemodal = false;
    }
}
