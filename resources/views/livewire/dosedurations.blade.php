<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dose Duration') }}
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
    
    
        <div class="mt-8 text-2xl flex justify-between">
    <div > </div>
    <div class="mr-2">
    
        <x-jet-button wire:click="addtypemodal" class="bg-blue-500 hover:bg-blue-700">
            {{ __('Add Dose Duration') }}
        </x-jet-button>
    
    </div>
    
        </div>
    
       <div class="p-4 flex justify-between">
           <label for="table-search" class="sr-only">Search</label>
           <div class="relative mt-1">
               <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                   <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
               </div>
               <input type="search" wire:model='search' id="table-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
             
           </div>
                    <div clas='pr-10 '>
    
                        <input type='checkbox' wire:model='active' class='mr-2 leading-tight'>Active only
    
                        </div>
       </div>
      
       <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
           <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
               <tr>
                   <th scope="col" class="p-4">
                       <div class="flex items-center">
                           <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                           <label for="checkbox-all-search" class="sr-only">checkbox</label>
                       </div>
                   </th>
                   <th scope="col" class="px-6 py-3">
                    <button class="font-semibold text-base " wire:click="sortBy('name')">  Dose Duration Name</button>
        @if($sortBy=='name')
    
                        @if($sortAsc)
                        <span class="w-2 h-2 ml-2 ">
    
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
    
                        @endif
    
                    @if(!$sortAsc)
                    <span class="w-4 h-4 ml-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
    
                    </span>
                    @endif
        @endif
    
    
                   </th>
                   <th scope="col" class="px-6 py-3">
                    <button class="font-semibold text-base " wire:click="sortBy('pashto_name')">  Pashto Name</button>
                   </th>
                   <th scope="col" class="px-6 py-3">
                    <button class="font-semibold text-base " wire:click="sortBy('description')">  Description</button>
                   </th>
                   <th scope="col" class="px-6 py-3">
                    <button class="font-semibold text-base " wire:click="sortBy('status')">  Status</button>
                   </th>
                   <th scope="col" class="px-6 py-3">
                    <button class="font-semibold text-base " wire:click="sortBy('user_id')">  User</button>
                   </th>
                   <th scope="col" class="px-6 py-3">
                       Action
                   </th>
               </tr>
           </thead>
           <tbody>
    
    
    
             @foreach ($dosedurations as $doseduration )
                
    
             <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-4 p-4">
                    <div class="flex items-center">
                        <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                    </div>
                </td>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
               {{ $doseduration->name }}
                </th>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                    {{ $doseduration->pashto_name }}
                     </th>
                <td class="px-6 py-4">
                   {{ $doseduration->description }}
                </td>
                <td class="px-6 py-4">
                   {{ $doseduration->status? 'Active':'Not-Active'  }}
                </td>
                <td class="px-6 py-4">
                   {{ $doseduration->user->name }}
                </td>
                <td class="px-6 py-4 text-right">
                    <x-jet-button wire:click="typeEditModal({{ $doseduration->id }})" class="bg-orange-500 hover:bg-orange-700">
                        {{ __('Edit') }}
                    </x-jet-button>
                    
                    <x-jet-danger-button wire:click="typedeletemodal({{ $doseduration->id }})" wire:loading.attr="disabled">
                        {{ __('Delete ') }}
                    </x-jet-danger-button>
    
                </td>
            </tr>
    
             @endforeach
    
           
           </tbody>
       </table>
    
    
    
       <div class="mt-4">{{ $dosedurations->links() }} </div>
    
    
    
           <!-- Delete Type Confirmation Modal -->
           <x-jet-dialog-modal wire:model="typeconfimationmodal">
            <x-slot name="title">
                {{ __('Delete Dose Duration') }}
            </x-slot>
    
            <x-slot name="content">
                {{ __('Are you sure you want to delete this dose duration? ') }}
    
            </x-slot>
    
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('typeconfimationmodal',false)" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>
    
                <x-jet-danger-button class="ml-3" wire:click="deleteType({{ $typeconfimationmodal }})" wire:loading.attr="disabled">
                    {{ __('Delete Dose Duration') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
    
              <!-- Adding Type  Modal -->
              <x-jet-dialog-modal wire:model="addingtypemodal">
    
                
                <x-slot name="title">
                    {{ isset($this->doseduration->id)? 'Edit Dose Duration':'Add Dose Duration'}}
                </x-slot>
        
                <x-slot name="content">
            
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="doseduration.name" autocomplete="name" />
                        <x-jet-input-error for="doseduration.name" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="pashto_name" value="{{ __('Pashto Name') }}" />
                        <x-jet-input id="pashto_name" type="text" class="mt-1 block w-full" wire:model.defer="doseduration.pashto_name" autocomplete="name" />
                        <x-jet-input-error for="doseduration.pashto_name" class="mt-2" />
                    </div>
    
                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <x-jet-label for="description" value="{{ __('Description') }}" />
                        <x-jet-input id="description" type="text" class="mt-1 block w-full" wire:model.defer="doseduration.description"  />
                        <x-jet-input-error for="doseduration.description" class="mt-2" />
                    </div>
    
                    <div class="col-span-6 sm:col-span-4 mt-4">
                       
                        <x-jet-input id="status" type="checkbox" class="form-checkbox" wire:model.defer="doseduration.status"  />
                        <span class="ml-2 text-sm text-gray-600 ">Active</span>
                     
                    </div>
    
                
        
                </x-slot>
        
                <x-slot name="footer">
                    <x-jet-secondary-button wire:click="$set('addingtypemodal',false)" wire:loading.attr="disabled">
                        {{ __('Cancel') }}
                    </x-jet-secondary-button>
        
                    <x-jet-button class="ml-3 bg-blue-500 hover:bg-blue-700" wire:click="addType()" wire:loading.attr="disabled">
                        {{ __('Save Dose Duration') }}
                    </x-jet-button>
                </x-slot>
            </x-jet-dialog-modal>
    </div>
    
    
    
    
    
    
    
    
    
    