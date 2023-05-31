<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contact;
use App\Models\Doseinterval;
use App\Http\Livewire\Field;
use Illuminate\Http\Request;

class Contacts extends Component
{

    public $contacts, $intervals, $name, $phone, $contact_id, $x, $form;
    public $updateMode = false;
    public $inputs = [];
    public $i = 1;

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs, $i);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function render()
    {
        $this->intervals = Doseinterval::all();
        $this->contacts = Contact::all();
        return view('livewire.contacts');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    private function resetInputFields()
    {
        $this->name = '';
        $this->phone = '';
    }

    protected $rules = [


        'name.0' => 'required',
        'phone.0' => 'required',

        'name.*' => 'required',
        'phone.*' => 'required',


    ];

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store()
    {



        $validatedDate = $this->validate(
            [
                'name.0' => 'required',
                'phone.0' => 'required',

                'form.name.*' => 'required',
                'form.phone.*' => 'required',
            ],
            [
                'name.0.required' => 'name field is required',
                'phone.0.required' => 'phone field is required',
                'form.name.*.required' => 'name field is required',
                'form.phone.*.required' => 'phone field is required',
            ]
        );

        foreach ($this->name as $key => $value) {
            Contact::create(['name' => $this->name[$key], 'phone' => $this->phone[$key]]);
        }

        $this->inputs = [];

        $this->resetInputFields();

        session()->flash('message', 'Contact Has Been Created Successfully.');
    }
}
