<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Brand;

class Brands extends Component
{
    use WithPagination;
    public $active;
    public $search;
    public $sortBy = 'id';
    public $sortAsc = true;
    public $typeconfimationmodal = false;
    public $addingtypemodal = false;
    public $brand;


    protected $queryString = [
        'active' => ['except' => false],
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true]

    ];

    protected $rules = [
        'brand.name' => 'required|string|min:2',
        'brand.description' => 'required|string|min:4',
        'brand.status' => 'boolean'


    ];



    public function render()
    {
        $brands = Brand::where('user_id', auth()->user()->id)
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

        return view('livewire.brands', [
            'brands' => $brands
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


    public function deleteType(Brand $brand)
    {

        $brand->delete();
        $this->typeconfimationmodal = false;
        session()->flash('message', 'Brand deleted successfully');
    }

    public function addtypemodal()
    {
        $this->reset(['brand']);
        $this->addingtypemodal = true;
    }

    public function typeEditModal(Brand $brand)
    {
        $this->brand = $brand;

        $this->addingtypemodal = true;
    }

    public function addType()
    {
        $this->validate();

        if (isset($this->brand->id)) {
            $this->brand->save();
            session()->flash('message', 'brand saved successfully');
        } else {


            auth()->user()->brands()->create([

                'name' => $this->brand['name'],
                'description' => $this->brand['description'],
                'status' => $this->brand['status'] ?? 0
            ]);
            session()->flash('message', 'brand added successfully');
        }

        $this->addingtypemodal = false;
    }
}
