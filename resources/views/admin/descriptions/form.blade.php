@extends('frontend-dashboard.admin.dashboard')

@section('main-principal')
   
<div class="px-4 mx-8 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form action="{{ route($description->exists ? 'admin.description.update' : 'admin.description.store', $description) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method($description->exists ? 'put' : 'post')
        <!-- Nom de la description -->
        <div>
            @include('shared.input', ['class' => 'block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 
            focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray',
            'name' => 'nom', 'label' => 'block text-sm', 'value' => $description->nom])  
            <x-input-error :messages="$errors->get('nom')" class="mt-2" />
        </div>

        <!-- Description -->
        <div>
            @include('shared.input', ['class' => 'block  w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 
            focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray',
            'name' => 'description', 'label' => 'block text-sm', 'type' => 'textarea', 'value' => $description->description])
            <x-input-error :messages="$errors->get('description')" class="mt-2" />  
        </div>
      
        <!-- Button -->
        <div>
            <button type="submit"
                class="block px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                @if($description->exists)
                  Modifier
                @else
                 Creer
                @endif
            </button>
        </div>
    </form>
</div>
@endsection    