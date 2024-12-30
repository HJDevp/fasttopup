@extends('frontend-dashboard.admin.dashboard')

@section('main-principal')
   
<div class="px-4 mx-8 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form action="{{ route($avatar->exists ? 'admin.avatar.update' : 'admin.avatar.store', $avatar) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method($avatar->exists ? 'put' : 'post')
        <!-- Nom -->
        <div>
            @include('shared.input', ['class' => 'block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 
            focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray',
            'name' => 'nom', 'label' => 'block text-sm', 'value' => $avatar->nom])  
            <x-input-error :messages="$errors->get('nom')" class="mt-2" />
        </div>
      <!-- Image-->
        @if ($avatar->exists)
            <div class="block w-full h-30 w-30 my-2 py-4 bg-gray-300 border border-purple-600 border-solid">
               <img src="{{ $avatar->avatarUrl()}}" alt="{{ $avatar->nom }}" class="h-64 w-full object-cover">
            </div>
        @endif

        <div class="flex items-center gap-3">
            @include('shared.input', ['class' => 'block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 
            focus:border-purple-400 focus:outline-none relative rounded-tr-full rounded-br-full focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray',
            'name' => 'chemin_avatar', 'label' => 'block text-sm', 'type' => 'file', 'value' => $avatar->chemin_avatar]) 
        </div>
        <x-input-error :messages="$errors->get('chemin_avatar')" class="mt-2" />
        <!-- Button -->
        <div>
            <button type="submit"
                class="block px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                @if($avatar->exists)
                  Modifier
                @else
                 Creer
                @endif
            </button>
        </div>
    </form>
    

</div>
@endsection    