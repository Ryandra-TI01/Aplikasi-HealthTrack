<div class="p-4 w-1/2 mx-auto">
    <h1 class="text-2xl font-bold mb-4">{{ $healthType->name }}</h1>

    <div x-data="{ showModal: false }"
    @record-added.window="showModal = false"
    x-on:edit-record.window="showModal = true"
>
   <x-button @click="showModal = true">
       Tambah Data {{ $healthType->name }}
   </x-button>

   <!-- Modal -->
   <div x-show="showModal" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
       <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg">
           <livewire:health-record.modal-form :healthType="$healthType" />
           <div class="mt-4 text-right">
               <button @click="showModal = false" class="text-sm text-red-600 hover:underline">
                   Tutup
               </button>
           </div>
       </div>
   </div>
</div>


    {{-- Component Toast --}}
    <livewire:ui.toast />

    
    {{-- component chart --}}
    @if ($healthType->value_type === 'decimal')
    <livewire:health-chart :healthTypeId="$healthType->id" />
    @endif
        
    {{-- component filter --}}
    <livewire:health-record.filter />

    {{-- component table --}}
    <livewire:health-record.table :healthTypeId="$healthType->id" />



</div>
