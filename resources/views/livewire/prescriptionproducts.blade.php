<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Prescription') }}
    </h2>
</x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
             
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">


                    @if(session()->has('message'))
                    <div id="alert-1" class="flex w-40 p-4 mb-4 bg-blue-100 rounded-lg dark:bg-blue-200" role="alert" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
                        <svg class="flex-shrink-0 w-5 h-5 text-blue-700 dark:text-blue-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <div class="ml-3 text-sm font-medium text-blue-700 dark:text-blue-800">
                        {{ session('message') }}
                        </div>
                    
                      </div>
                    
                    @endif

                    {{-- @if($errors->any())

                    <div class="text-center w-4/8 m-auto">
                      @foreach($errors->all() as $error)
                      <li class="text-red-500 list-none">
                      {{ $error }}
                      </li>
                      @endforeach
                    </div>

                    @endif --}}


                      {{-- <form action="{{ route('orders.store') }}" method="POST"> --}}
                        <form wire:submit.prevent="save">
                                        {{-- @method('put') --}}
                                      
                                        @csrf

            <table class="mb-6  w-full" >
             <tr >
         <td>
        <x-jet-label for="prescriptionform.patient" value="{{ __('Patient Name') }}" />
           <x-jet-input id="prescriptionform.patient" wire:model="prescriptionform.patient" name="prescriptionform.patient" type="text" class=""   />
            <x-jet-input-error for="prescriptionform.patient" class="mt-2" />
                                               
      </td>
       <td>  <x-jet-label for="prescriptionform.age" value="{{ __('Age') }}" />
      <x-jet-input id="prescriptionform.age" name="prescriptionform.age" type="number" class=""  wire:model="prescriptionform.age"   />
        <x-jet-input-error for="prescriptionform.age" class="mt-2" />
       </td>
       <td > 
        <div>
        <x-jet-label for="prescriptionform.sex" value="{{ __('Gender') }}" />   
        <select wire:model ="prescriptionform.sex" name="prescriptionform.sex"   id="prescriptionform.sex" class=" mt-6 w-48 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                   
            <option > </option>
       
            <option value="Male"  >Male</option>
            <option value="Female"  >Female</option>
            <option value="Other"  >Other</option>
  
          </select>
          <x-jet-input-error for="prescriptionform.sex" class="mt-2" />
        </div>
            </td>
         <td>  <x-jet-label for="prescriptionform.prescription_date" value="{{ __('Date') }}" />
       <x-jet-input wire:model="prescriptionform.prescription_date" id="prescriptionform.prescription_date" name="prescriptionform.prescription_date" type="date" class="form-control"   />
         <x-jet-input-error for="prescriptionform.prescription_date" class="mt-2" />
          </td>
           <td>  <x-jet-label for="high_bp" value="{{ __('BP High') }}" />
          <x-jet-input wire:model="prescriptionform.high_bp" id="high_bp" name="prescriptionform.high_bp" type="text" class=""   />
         <x-jet-input-error for="prescriptionform.high_bp" class="mt-2" />
           </td>
           {{-- <td>  
            <x-jet-input id="user_id" wire:model.defer="prescriptionform.user_id" name="prescriptionform.user_id" value="{{ auth()->user()->id }}" type="text" class=""   />
        
             </td> --}}

           </tr>

        <tr>
           <td>
          <x-jet-label for="low_bp" value="{{ __('BP Low') }}" />
          <x-jet-input wire:model="prescriptionform.low_bp" id="low_bp" name="prescriptionform.low_bp" type="text" class=""   />
            <x-jet-input-error for="prescriptionform.low_bp" class="mt-2" />
                                               
               </td>
                 <td>  <x-jet-label for="temperature" value="{{ __('Temperature') }}" />
            <x-jet-input wire:model="prescriptionform.temperature" id="temperature" name="prescriptionform.temperature" type="text" class=""  />
              <x-jet-input-error for="prescriptionform.temperature" class="mt-2" />
             </td>
                <td>  <x-jet-label for="respiratory" value="{{ __('Respiratory') }}" />
               <x-jet-input wire:model="prescriptionform.respiratory" id="respiratory" name="prescriptionform.respiratory" type="text" class=""  />
             <x-jet-input-error for="prescriptionform.respiratory" class="mt-2" />
           </td>
          <td>  <x-jet-label for="heart_rate" value="{{ __('Heart Rate') }}" />
             <x-jet-input wire:model="prescriptionform.heart_rate" id="heart_rate" name="prescriptionform.heart_rate" type="text" class=""  />
              <x-jet-input-error for="prescriptionform.heart_rate" class="mt-2" />
          </td>
           <td>  <x-jet-label for="weight" value="{{ __('Weight') }}" />
              <x-jet-input wire:model="prescriptionform.weight" id="weight" name="prescriptionform.weight" type="text" class=""  />
           <x-jet-input-error for="prescriptionform.weight" class="mt-2" />
            </td>

             </tr>
             <tr>
                <td>
               <x-jet-label for="height" value="{{ __('Height') }}" />
               <x-jet-input wire:model="prescriptionform.height" id="height" name="prescriptionform.height" type="text" class=""   />
                 <x-jet-input-error for="prescriptionform.height" class="mt-2" />
                                                    
                    </td>
                      <td>  <x-jet-label for="bmi" value="{{ __('BMI') }}" />
                 <x-jet-input wire:model="prescriptionform.bmi" id="bmi" name="prescriptionform.bmi" type="text" class=""   />
                   <x-jet-input-error for="prescriptionform.bmi" class="mt-2" />
                  </td>
                     <td>  <x-jet-label for="diabetone" value="{{ __('Diabet') }}" />
                    <x-jet-input wire:model="prescriptionform.diabetone" id="prescriptionform.diabetone" name="prescriptionform.diabetone" type="text" class=""  />
                  <x-jet-input-error for="prescriptionform.diabetone" class="mt-2" />
                </td>
               <td>  <x-jet-label for="urine_output" value="{{ __('Urine Output') }}" />
                  <x-jet-input wire:model="prescriptionform.urine_output" id="prescriptionform.urine_output" name="prescriptionform.urine_output" type="text" class=""   />
                   <x-jet-input-error for="prescriptionform.urine_output" class="mt-2" />
               </td>
                <td>  <x-jet-label for="comment" value="{{ __('Comment and Instructions') }}" />
                   <x-jet-input wire:model="prescriptionform.comment" id="comment" name="prescriptionform.comment" type="text" class=""   />
                <x-jet-input-error for="prescriptionform.comment" class="mt-2" />
                 </td>
                
     
                  </tr>
             </table>          
                                       
                                        <span class="bg-blue-100 pb-2 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">Medicine List</span><br>
                                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        {{-- For barcode scanner --}}
                                          {{-- <tr>
                                                    <td scope="row" class="px-2 py-2">
                                                         
                                                      <x-jet-input for="product_code" type="text" class=" pt-2 w-40" name="product_code"
                                                      wire:model="product_code" id="product_code"  />
                                                      <x-jet-input-error for="product_code" class="mt-2" />
                                                  </td>

                                                  </tr> --}}
                                                    <tr>
                                                        <th scope="col" class="px-6 py-3">
                                                            Type
                                                        </th>
                                                        <th scope="col" class="px-6 py-3">
                                                            Item
                                                        </th>
                                                        {{-- <th scope="col" class="px-6 py-3">
                                                            Dose
                                                        </th> --}}
                                                        <th scope="col" class="px-6 py-3">
                                                          Dose Interval
                                                        </th>
                                                        <th scope="col" class="px-6 py-3">
                                                            Dose Duration
                                                          </th>
                                                          <th scope="col" class="px-6 py-3">
                                                            Timing
                                                          </th>
                                                          <th scope="col" class="px-6 py-3">
                                                           Scheme
                                                          </th>
                                                        <th scope="col" class="">
                                                         Delete 
                                                        </th>
                                                    </tr>


                                                </thead>
                                                <tbody>
                                                    @foreach ($orderProducts as $index => $orderProduct)
                                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                        <td scope="row" class="px-2 py-2  text-gray-900 dark:text-white whitespace-nowrap">
                                                        
                                                            {{-- <select   
                                                            wire:model="orderProducts.{{$index}}.type_id" class=" border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                            --}}
                                                            <select   
                                                            wire:model.lazy="orderProducts.{{$index}}.type_id" wire:change="setEmployeeQualifications($event.target.value, {{ $index }})" class=" border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                          
                                                                <option selected >Choose Type</option>
                                                                @foreach ($categories as $type)
                                                                <option value="{{ $type->id }}"  > {{ $type->name }}</option>
                                                                @endforeach
                                                              </select>
                                                              <x-jet-input-error for="orderProducts.{{$index}}.type_id" class="mt-2" />
                                                         {{-- {{ $selectedType }} --}}
                                                        </td>
                                                        <td scope="row" class="px-2 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                                          {{-- @if(!is_null($selectedType)) --}}

                                                            <select 
                                                            wire:model.lazy="orderProducts.{{$index}}.product_id"  class=" border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                            {{-- <select for="product" name="orderProducts[{{$index}}][product_id]"
                                                            wire:model="selectedProduct" id="product_id" class=" border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                           --}}
                                                                <option selected >Choose Item</option>
                                                                @foreach ($this->orderProducts[$index]['items']=> $product)
                                                                {{-- @foreach ($typeproducts as $product) --}}
                                                                {{-- @foreach ($products as $product) --}}
                                                                <option value="{{ $product->id }}"  >{{ $product->product_name."-".$product->dose }}</option>
                                                                @endforeach
                                                              </select>
                                                              <x-jet-input-error for="orderProducts.{{$index}}.product_id" class="mt-2" />
                                                              {{-- @endif --}}
                                                              {{-- {{ $selectedProduct }} --}}
                                                        </td>
                                                        {{-- <td scope="row" class="px-2 py-2">
                                                          @if(!is_null($product_dose))
                                                            <x-jet-input for="dose" type="text" class=" pt-2 w-24" name="product_dose"
                                                            wire:model="product_dose" id="product_dose" value=""  />
                                                            <x-jet-input-error for="orderProducts.{{$index}}.dose" class="mt-2" />
                                                            {{ $product_dose->dose }}
                                                          @endif
                                                        </td> --}}
                                                        
                                                        <td scope="row" class="px-2 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                                          
                                                            <select   
                                                            wire:model="orderProducts.{{$index}}.doseinterval_id" class=" border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                          
                                                                <option selected >Choose Interval</option>
                                                                @foreach ($intervals as $interval)
                                                                <option value="{{ $interval->id }}"  >{{ $interval->name }}</option>
                                                                @endforeach
                                                              </select>
                                                              <x-jet-input-error for="orderProducts.{{$index}}.doseinterval_id" class="mt-2" />
                                                        </td>
                                                        <td scope="row" class="px-2 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                                           
                                                            <select 
                                                            wire:model="orderProducts.{{$index}}.doseduration_id"  class=" border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                          
                                                                <option selected >Choose Duration</option>
                                                                @foreach ($durations as $duration)
                                                                <option value="{{ $duration->id }}"  >{{ $duration->name }}</option>
                                                                @endforeach
                                                              </select>
                                                              <x-jet-input-error for="orderProducts.{{$index}}.doseduration_id" class="mt-2" />
                                                        </td>
                                                        <td scope="row" class="px-2 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                                        
                                                            <select 
                                                            wire:model="orderProducts.{{$index}}.timing_id"  class=" border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                          
                                                                <option selected >Choose Timing</option>
                                                                @foreach ($timings as $timing)
                                                                <option value="{{ $timing->id }}"  >{{ $timing->name }}</option>
                                                                @endforeach
                                                              </select>
                                                              <x-jet-input-error for="orderProducts.{{$index}}.timing_id" class="mt-2" />
                                                        </td>
                                                        <td scope="row" class="px-2 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                                       
                                                            <select
                                                            wire:model="orderProducts.{{$index}}.scheme_id"  class=" border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                          
                                                                <option selected >Choose Scheme</option>
                                                                @foreach ($schemes as $scheme)
                                                                <option value="{{ $scheme->id }}"  >{{ $scheme->name }}</option>
                                                                @endforeach
                                                              </select>
                                                              <x-jet-input-error for="orderProducts.{{$index}}.scheme_id" class="mt-2" />
                                                        </td>
                                                        <td class="px-2 py-2 text-right">
                                                            <x-jet-danger-button wire:click.prevent="removeProduct({{$index}})" >
                                                                {{ __('X ') }}
                                                            </x-jet-danger-button>
                                                        </td>
                                                    </tr>
                                                  @endforeach
                                                </tbody>
                                            </table>
                                            <x-jet-button wire:click.prevent="addProduct" class="ml-2 mb-2 bg-blue-500 hover:bg-blue-700">
                                                {{ __('+ Add Item') }}
                                            </x-jet-button>
                                          
                                        </div>
                                
                                        <br />
                                        <div class="flex justify-between">
                                       <div></div>
                                            <div class="mr-4">
                                                <button type="submit"   class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">CREATE</button>
                                            </div>
                                        </div> <br/>
                                      
                                    </form>

                                
                    </div>
                


            </div>
        </div>
    </div>

    @push('script')

                                      
   @endpush
    
    
    
    
    
    



