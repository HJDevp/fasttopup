@extends('frontend-dashboard.admin.dashboard')

@section('main-principal')
   
<div class="px-4 mx-8 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form action="{{ route($faqs->exists ? 'admin.faqs.update' : 'admin.faqs.store', $faqs) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method($faqs->exists ? 'put' : 'post')
        <!-- Categorie -->
        <div>
            @include('shared.input', ['class' => 'block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 
            focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray',
            'name' => 'categorie', 'label' => 'block text-sm', 'value' => $faqs->categorie])  
            <x-input-error :messages="$errors->get('categorie')" class="mt-2" />
        </div>
        <!-- Question -->
        <div>
            @include('shared.input', ['class' => 'block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 
            focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray',
            'name' => 'question', 'label' => 'block text-sm', 'value' => $faqs->question])  
            <x-input-error :messages="$errors->get('question')" class="mt-2" />
        </div>
        <!-- Reponse -->
        <div>
            @include('shared.input', ['class' => 'block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 
            focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray',
            'name' => 'reponse', 'label' => 'block text-sm', 'type' => 'textarea', 'value' => $faqs->reponse])  
            <x-input-error :messages="$errors->get('reponse')" class="mt-2" />
        </div>

        <!-- Button -->
        <div>
            <button type="submit"
                class="block px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                @if($faqs->exists)
                  Modifier
                @else
                 Creer
                @endif
            </button>
        </div>
    </form>
    

</div>
@endsection    