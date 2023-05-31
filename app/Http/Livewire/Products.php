<?php

namespace App\Http\Livewire;

use App\Models\Type;
use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;
    public $active;
    public $search;
    public $sortBy = 'id';
    public $sortAsc = true;
    public $typeconfimationmodal = false;
    public $addingtypemodal = false;
    public $product;


    protected $queryString = [
        'active' => ['except' => false],
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true]

    ];

    protected $rules = [
        'product.brand_id' => 'required',
        'product.type_id' => 'required',
        'product.product_name' => 'required|string|min:2',
        'product.dose' => 'required|string|min:4',
        'product.package' => 'string',
        'product.status' => 'boolean'


    ];

    public function render()
    {
        $brands = Brand::all()->where('status', 1);
        $types = Type::all()->where('status', 1);

        $products = Product::where('user_id', auth()->user()->id)
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('product_name', 'like', '%' . $this->search . '%');
                    // ->orWhere('brand', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->active, function ($query) {
                // return $query->where('status', 1);
                return $query->active();
            })
            ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
            ->paginate(10);

        return view('livewire.products', [
            'products' => $products,
            'brands' => $brands,
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


    public function deleteType(Product $product)
    {

        $product->delete();
        $this->typeconfimationmodal = false;
        session()->flash('message', 'product deleted successfully');
    }

    public function addtypemodal()
    {
        $this->reset(['product']);
        $this->addingtypemodal = true;
    }

    public function typeEditModal(Product $product)
    {
        $this->product = $product;

        $this->addingtypemodal = true;
    }

    public function addType()
    {
        $this->validate();

        if (isset($this->product->id)) {
            $this->product->save();
            session()->flash('message', 'product saved successfully');
        } else {


            auth()->user()->products()->create([
                'brand_id' => $this->product['brand_id'],
                'type_id' => $this->product['type_id'],
                'product_name' => $this->product['product_name'],
                'dose' => $this->product['dose'],
                'package' => $this->product['package'],
                'status' => $this->product['status'] ?? 0
            ]);
            session()->flash('message', 'product added successfully');
        }

        $this->addingtypemodal = false;
    }
}
