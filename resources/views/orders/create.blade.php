<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            {{-- Here the create form comes in --}}
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
            
            
                     <form action="{{ route('orders.store') }}" method="POST">
                                    {{-- <form wire:submit.prevent="save"> --}}
                
                                                  
                    @csrf
            
                        <table class="mb-6  w-full" >
                         <tr >
                     <td>
                    <x-jet-label for="patient" value="{{ __('Patient Name') }}" />
                       <x-jet-input id="patient"  name="patient" type="text" class=""   />
                        <x-jet-input-error for="patient" class="mt-2" />
                                                           
                  </td>
                   <td>  <x-jet-label for="age" value="{{ __('Age') }}" />
                  <x-jet-input id="age" name="age" type="number" class=""    />
                    <x-jet-input-error for="age" class="mt-2" />
                   </td>
                   <td > 
                    <div>
                    <x-jet-label for="sex" value="{{ __('Gender') }}" />   
                    <select  name="sex"   id="sex" class=" mt-6 w-48 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                               
                        <option > </option>
                   
                        <option value="Male"  >Male</option>
                        <option value="Female"  >Female</option>
                        <option value="Other"  >Other</option>
              
                      </select>
                      <x-jet-input-error for="sex" class="mt-2" />
                    </div>
                        </td>
                     {{-- <td>  <x-jet-label for="prescription_date" value="{{ __('Date') }}" />
                   <x-jet-input id="prescription_date" name="prescription_date" type="date" class="form-control"   />
                     <x-jet-input-error for="prescription_date" class="mt-2" />
                      </td> --}}
                       <td>  <x-jet-label for="high_bp" value="{{ __('BP High') }}" />
                      <x-jet-input  id="high_bp" name="high_bp" type="text" class=""   />
                     <x-jet-input-error for="high_bp" class="mt-2" />
                       </td>
                       <td>
                        <x-jet-label for="low_bp" value="{{ __('BP Low') }}" />
                        <x-jet-input  id="low_bp" name="low_bp" type="text" class=""   />
                          <x-jet-input-error for="low_bp" class="mt-2" />
                                                             
                             </td>
                       {{-- <td>  
                        <x-jet-input id="user_id" wire:model.defer="prescriptionform.user_id" name="prescriptionform.user_id" value="{{ auth()->user()->id }}" type="text" class=""   />
                    
                         </td> --}}
            
                       </tr>
            
                    <tr>
                       
                             <td>  <x-jet-label for="temperature" value="{{ __('Temperature') }}" />
                        <x-jet-input  id="temperature" name="temperature" type="text" class=""  />
                          <x-jet-input-error for="temperature" class="mt-2" />
                         </td>
                            <td>  <x-jet-label for="respiratory" value="{{ __('Respiratory') }}" />
                           <x-jet-input  id="respiratory" name="respiratory" type="text" class=""  />
                         <x-jet-input-error for="respiratory" class="mt-2" />
                       </td>
                      <td>  <x-jet-label for="heart_rate" value="{{ __('Heart Rate') }}" />
                         <x-jet-input  name="heart_rate" type="text" class=""  />
                          <x-jet-input-error for="heart_rate" class="mt-2" />
                      </td>
                       <td>  <x-jet-label for="weight" value="{{ __('Weight') }}" />
                          <x-jet-input wire:model="weight" id="weight" name="weight" type="text" class=""  />
                       <x-jet-input-error for="weight" class="mt-2" />
                        </td>
                        <td>
                          <x-jet-label for="height" value="{{ __('Height') }}" />
                          <x-jet-input  id="height" name="height" type="text" class=""   />
                            <x-jet-input-error for="height" class="mt-2" />
                                                               
                               </td>
                         </tr>
                         <tr>
                       
                                  <td>  <x-jet-label for="bmi" value="{{ __('BMI') }}" />
                             <x-jet-input  id="bmi" name="bmi" type="text" class=""   />
                               <x-jet-input-error for="bmi" class="mt-2" />
                              </td>
                                 <td>  <x-jet-label for="diabetone" value="{{ __('Diabet') }}" />
                                <x-jet-input  id="diabetone" name="diabetone" type="text" class=""  />
                              <x-jet-input-error for="diabetone" class="mt-2" />
                            </td>
                           <td>  <x-jet-label for="urine_output" value="{{ __('Urine Output') }}" />
                              <x-jet-input  id="urine_output" name="urine_output" type="text" class=""   />
                               <x-jet-input-error for="urine_output" class="mt-2" />
                           </td>
                         
                            
                 
                              </tr>

                              <tr>
                            <td>
                                <!-- This is an example component -->
<div class="max-w-2xl mx-auto">

	<label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Comment and Instructions</label>
    <textarea id="message" name="comment" id="comment"  rows="4" class="block p-2.5 w-64 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your comment here"></textarea>

	
</div>

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
                                                                    <th scope="col" class="px-6 py-3">
                                                                        Dose
                                                                    </th>
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
                                                            <tbody id="product-tbody">
                                                
{{-- first row for product --}}

                                                            </tbody>
                                                        </table>
                                                        <div class="mr-4">
                                                            <button  type="button" id="add"  class="add text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">add</button>
                                                        </div>
                                                      
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
            
             
            


      
                
            
             {{-- end of create form --}}
            </div>
        </div>
    </div>
  
    <script>
   $(document).ready(function() {

    //adding product row dynamically
    var count = 0;

    $("#add").click(function(){
   
        count++;
  var html = '';
  html += '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">';
    
    html +='    <td scope="row" class="px-2 py-2  text-gray-900 dark:text-white whitespace-nowrap">'+                                                
'<select name="type_id[]" id="type_id" data-sub_category_id="'+count+'" class=" typeid border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">'+
  '<option selected >Choose Type</option>'+
    @foreach($types as $id => $name)
     '<option value="{{ $id }}" required> {{ $name }}</option>'+
      @endforeach
     '</select>'+ 
 '<x-jet-input-error for="" class="mt-2" /> </td>';  
 
 html += '<td><select name="product[]" id="product'+count+'" data-product_dose="'+count+'" style="width: 100%;"  class=" border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 select2 product"><option value="" ></option></select></td>';
 html += '<td><input type="text" style="color:red;" name="dose[]" id="dose'+count+'" placeholder="Dose" class="mb-6 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dose"  /></td>';

 html +='    <td scope="row" class="px-2 py-2  text-gray-900 dark:text-white whitespace-nowrap">'+                                                
'<select name="interval_id[]" id="interval_id"  class=" border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">'+
  '<option selected >Choose Interval</option>'+
    @foreach($intervals as $id => $name)
     '<option value="{{ $id }}" > {{ $name }}</option>'+
      @endforeach
     '</select>'+ 
 '<x-jet-input-error for="" class="mt-2" /> </td>';  

 
 html +='    <td scope="row" class="px-2 py-2  text-gray-900 dark:text-white whitespace-nowrap">'+                                                
'<select name="duration_id[]" id="duration_id" class=" border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">'+
  '<option selected >Choose Duration</option>'+
    @foreach($durations as $id => $name)
     '<option value="{{ $id }}" > {{ $name }}</option>'+
      @endforeach
     '</select>'+ 
 '<x-jet-input-error for="" class="mt-2" /> </td>';  

 html +='    <td scope="row" class="px-2 py-2  text-gray-900 dark:text-white whitespace-nowrap">'+                                                
'<select name="timing_id[]" id="timing_id" class=" border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">'+
  '<option selected >Choose Time</option>'+
    @foreach($timings as $id => $name)
     '<option value="{{ $id }}" > {{ $name }}</option>'+
      @endforeach
     '</select>'+ 
 '<x-jet-input-error for="" class="mt-2" /> </td>';  

 html +='    <td scope="row" class="px-2 py-2  text-gray-900 dark:text-white whitespace-nowrap">'+                                                
'<select name="scheme_id[]" id="scheme_id"  class=" border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">'+
  '<option selected >Choose Scheme</option>'+
    @foreach($schemes as $id => $name)
     '<option value="{{ $id }}" > {{ $name }}</option>'+
      @endforeach
     '</select>'+ 
 '<x-jet-input-error for="" class="mt-2" /> </td>';  



 html += '<td><button  type="button" id="remove" name="remove"  class="mb-6 remove inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition">X</button></td></tr>';


  $('#product-tbody').append(html);

    }); 
//end

//removing the product table row
    $(document).on('click', '.remove', function(){
  $(this).closest('tr').remove();
});
// end

// filling the product dropdown based on types
$(document).on('change', '.typeid', function(){
        var typeid = $(this).val();
        var product_row_id = $(this).data('sub_category_id');
        if(typeid){
        $.ajax({
            url: '/getProducts/'+ typeid,
            type: 'GET',
            traditional: true,
            async: true,
            dataType: 'json',
            success: function(data) {
              $('#product'+product_row_id).empty();
              $('#product'+product_row_id).append('<option value="">Please Select</option>');
                $.each(data,function(key,value){
                    $('#product'+product_row_id).append('<option value="'+key+'">'+value+'</option>');
                });
            }
        });
    } //end of if
    else{
      $('#product'+product_row_id).empty();
    }
      });
// end

      //geting product details
      $(document).on('change', '.product', function(){
        var product = $(this).val();
        var dose_row_id = $(this).data('product_dose');
        $.ajax({
            url: '/getDose/'+ product,
            type: 'GET',
            traditional: true,
            async: true,
            dataType: 'json',
            success: function(data1) {
              console.log(data1);
          
              $('#dose'+dose_row_id).val(data1[0].dose);
            
            }
        });

        // var product = $(this).val();
        // var quantity_row_id = $(this).data('price_id');
        // $.ajax({
        //     url: '/admin/getQuantity/'+ product,
        //     type: 'GET',
        //     traditional: true,
        //     async: true,
        //     dataType: 'json',
        //     success: function(data2) {
        //       console.log(data2);
          
        //       $('#available_quantity'+quantity_row_id).val(data2[0].quantity);
            
        //     }
        // });

      });
//end


//end of document function.
});



    </script>
</x-app-layout>
