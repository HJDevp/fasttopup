@extends('frontend-dashboard.user-dashboard.dashboard')
@section('title', 'natcash payment')

@section('main-principal')
    <div class="flex items-center justify-center m-8">
        <div class="xl:w-2/5 p-4 bg-white shadow-xs transform hover:-translate-y-1 border-1 
           border-solid  dark:bg-transparent overflow-y-scroll rounded-lg">
            <!-- section 1-->
            <h1 class="text-2xl text-center dark:text-gray-200 font-bold capitalize">Formulaire de paiement</h1>
            <hr class="w-full lg:mt-2 md:mt-2 md:mb-2 my-2" />

            <!-- banner natcash -->
            <div class="flex flex-col items-center justify-center space-y-2">
              <h3 class="text-2xl font-light"><span class="text-purple-700">Fast</span> <span class="dark:text-white text-black">Top-Up</span></h3>  
              <img src="{{ asset('../assets/img/paiement/natcash_logo.png') }}"  class="w-32" alt="">
            </div>

            <!-- section 2 -->
            <hr class="w-full lg:mt-2 md:mt-2 md:mb-2 my-2" />
            <div class="total">
               <span class="text-green-400 text-lg capitalize mr-2">total : </span > 
               <span class="text-green-400 text-base">{{ $freefirecard->prix }} HTG</span>
            </div>

            <!-- section 3 -->
            <div>
                <form action="{{ route('controlTransaction', $freefirecard) }}" method="post"
                 enctype="multipart/form-data">
                 @csrf
                    <!-- Nom -->
                    <div>
                        @include('shared.input', ['class' => 'block w-full mt-1 text-sm dark:border-gray-600 dark:bg-transparent
                        focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray',
                        'name' => 'nom', 'label' => 'block text-sm', 'placeholder' => 'nom du compte natcash'])  
                        <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                    </div>

                    <!-- Prenom -->
                    <div>
                        @include('shared.input', ['class' => 'block w-full mt-1 text-sm dark:border-gray-600 dark:bg-transparent
                        focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray',
                        'name' => 'prenom', 'label' => 'block text-sm', 'placeholder' => 'prenom du compte natcash'])  
                        <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                    </div>

                    <!-- Numero de telephone -->
                    <div>
                        @include('shared.input', ['class' => 'block w-full mt-1 text-sm dark:border-gray-600 dark:bg-transparent
                        focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray',
                        'name' => 'telephone', 'label' => 'block text-sm', 'placeholder' => 'numero natcash', 'type' => 'number'])  
                        <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                    </div>

                    <!-- montant -->
                    <div>
                        <input type="hidden" name="montant" value="{{ $freefirecard->prix }}">  
                        <x-input-error :messages="$errors->get('montant')" class="mt-2" />
                    </div>

                    <!-- capture du paiement -->
                    <div class="flex items-center gap-3">
                      @include('shared.input', ['class' => 'block w-full mt-1 text-sm dark:border-gray-600 dark:bg-transparent
                      focus:border-purple-400 focus:outline-none relative rounded-tr-full rounded-br-full focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray',
                      'name' => 'capture_du_paiement', 'label' => 'block text-sm', 'type' => 'file']) 
                    </div>
                    <x-input-error :messages="$errors->get('capture_du_paiement')" class="mt-2" />

                    <div>
                        <!-- info player -->
                        <input type="hidden" name="methode_de_paiement" value="{{ $processrequest->methode_de_paiement }}">
                        <input type="hidden" name="player_id" value="{{ $processrequest->id_player }}">
                        <input type="hidden" name="user_id" value="{{ $processrequest->user()->id }}">
                        <input type="hidden" name="free_fire_card_id" value="{{ $freefirecard->id }}">
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit"
                            class="block px-10 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150
                             bg-purple-600 border border-transparent rounded-full active:bg-purple-700 hover:bg-purple-700 focus:outline-none
                              focus:shadow-outline-purple dark:bg-white dark:text-black">
                            pay
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection    