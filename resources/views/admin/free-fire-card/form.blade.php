@extends('frontend-dashboard.admin.dashboard')

@section('main-principal')
   <div class="px-4 mx-8 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
      <!-- Session Status -->
      <x-auth-session-status class="mb-4" :status="session('status')" />
      <form action="{{ route($freeFireCard->exists ? 'admin.freefire.update' : 'admin.freefire.store', $freeFireCard) }}" 
        method="post" enctype="multipart/form-data">
        @csrf
        @method($freeFireCard->exists ? 'put' : 'post')
        <!-- Nom -->
        <div>
            @include('shared.input', ['class' => 'block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 
            focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray',
            'name' => 'nom', 'label' => 'block text-sm', 'value' => $freeFireCard->nom])  
            <x-input-error :messages="$errors->get('nom')" class="mt-2" />
        </div>

        <!-- Quantite_diamons -->
        <div>
            @include('shared.input', ['class' => 'block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 
            focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray',
            'name' => 'quantite_diamons','label' => 'block text-sm', 'type' => 'number', 'value' => $freeFireCard->quantite_diamons])  
            <x-input-error :messages="$errors->get('quantite_diamons')" class="mt-2" />
        </div>

        <!-- Prix -->
        <div>
            @include('shared.input', ['class' => 'block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 
            focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray',
            'name' => 'prix', 'label' => 'block text-sm', 'type' => 'number', 'value' => $freeFireCard->prix])  
            <x-input-error :messages="$errors->get('prix')" class="mt-2" />
        </div>

        <!-- Descriptions -->
        <div>
            @include('shared.selectDescriptions', ['class' => 'block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 
            focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray',
            'select_class' => 'block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select 
            focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray',
            'name' => 'descriptions_id', 'label' => 'block text-sm'])  
            <x-input-error :messages="$errors->get('descriptions_id')" class="mt-2" />
        </div>


      <!-- Image-->
        @if ($freeFireCard->exists)
            <div class="block h-30 w-30 my-2 py-4 bg-gray-300 border border-purple-600 border-solid">
               <img src="{{ $freeFireCard->imageUrl()}}" alt="{{ $freeFireCard->nom }}" class="h-48 w-full object-contain">
            </div>
        @endif

        <div class="flex items-center gap-3">
            @include('shared.input', ['class' => 'block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 
            focus:border-purple-400 focus:outline-none relative rounded-tr-full rounded-br-full focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray',
            'name' => 'chemin_image', 'label' => 'block text-sm', 'type' => 'file', 'value' => $freeFireCard->chemin_image]) 
        </div>
        <x-input-error :messages="$errors->get('chemin_image')" class="mt-2" />

        <!-- Button -->
        <div>
            <button type="submit"
                class="block px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                @if($freeFireCard->exists)
                  Modifier
                @else
                 Creer
                @endif
            </button>
        </div>
      </form>
    
   </div>
@endsection