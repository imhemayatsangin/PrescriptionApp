<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Brands') }}
    </h2>
</x-slot>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">


    @if(session()->has('message'))
    <div id="alert-1" class="flex w-40 p-4 mb-4 bg-blue-100 rounded-lg dark:bg-blue-200" role="alert" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
        <svg class="flex-shrink-0 w-5 h-5 text-blue-700 dark:text-blue-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
        <div class="ml-3 text-sm font-medium text-blue-700 dark:text-blue-800">
        {{ session('message') }}
        </div>
    
      </div>
    
    @endif
    
{{-- contact form --}}


<div>

    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3"></th>
                <th scope="col" class="px-6 py-3">ID</th>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Phone</th>
            </tr>
        </thead>
        <tbody>
 
 
 
            @foreach($contacts as $key => $value)
             
 
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
             <td class="w-4 p-4">
                 <div class="flex items-center">
                     <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                     <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                 </div>
             </td>
             <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                {{ $value->id }}
             </td>
             <td class="px-6 py-4">
                {{ $value->name }}
             </td>
          
             <td class="px-6 py-4">
                {{ $value->phone }}
             </td>
           
         </tr>
 
          @endforeach
 
        
        </tbody>
    </table>


    {{-- <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
        </tr>
        @foreach($contacts as $key => $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->phone }}</td>
            </tr>
        @endforeach
    </table> --}}

    <form wire:submit.prevent="store">




        <span class="bg-blue-100 pb-2 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">Add Contact List</span><br>
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
                          Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                        Phone
                        </th>
                     
                    </thead>
                    <tbody>

                        <tr>
        <td scope="row" class="px-6 py-3">
            
            <x-jet-input for="name.0"  type="text" class=" pt-2 w-24 mb-6" 
            wire:model="name.0"  value=""  />
            <x-jet-input-error for="name.0" class="mt-2" />
                                                   
          </td>
           <td scope="row"  class="px-6 py-3">  
          <x-jet-input  type="number" class=""  wire:model="phone.0"   />
            <x-jet-input-error for="phone.0" class="mt-2" />
           </td>

           <td class="px-6 py-4 text-right">
            <x-jet-button wire:click.prevent="add({{$i}})" class="bg-orange-500 hover:bg-orange-700">
                {{ __('Add') }}
            </x-jet-button>
            
        </td>
                        </tr>
        @foreach($inputs as $key => $value)
        <tr>
            <td scope="row" class="px-2 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                                          
                <x-jet-input wire:key="name.{{ $value }}" for="name.{{ $value }}" id="name.{{ $value }}" name="name.{{ $value }}" type="text" class=" pt-2 w-24 mb-6" 
                wire:model="form.name.{{ $value }}"  value=""  />
                @error('name.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                    
            </td>
               <td>  
              <x-jet-input   type="number" class=""  wire:model="form.phone.{{ $value }}"   />
              <x-jet-input-error for="interval.{{ $value }}" class="mt-2" />
               </td>
    
               <td class="px-6 py-4 text-right">
               
                
                <x-jet-danger-button wire:click.prevent="remove({{$key}})" wire:loading.attr="disabled">
                    {{ __('Delete ') }}
                </x-jet-danger-button>
    
            </td>
         </tr>

        @endforeach
                    </tbody>

                </table>

       <div class="flex justify-between">
          <div></div>
          <div class="mr-4">
          <button type="submit"   class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">CREATE</button>
         </div>
       </div> <br/>
                                      
    </form>
</div>

    </div>
    
    
    
    
    
    
    
    
    
    