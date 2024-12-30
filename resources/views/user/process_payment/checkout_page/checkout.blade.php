@extends('frontend-dashboard.user-dashboard.dashboard')
@section('title', 'check out')

@section('main-principal')
    <div class="m-8">
        <h1 class="text-2xl text-center font-mono capitalize dark:text-white">check out</h1>
        <hr class="w-full lg:mb-6 md:mt-2 md:mb-4 mb-6" />

        <div class="grid xl:grid-cols-2 gap-6">
            <div class="xl:w-2/3 p-4 bg-white shadow-xs transform hover:-translate-y-1 border-1 
              border-solid  dark:bg-purple-600">
               <!-- section 1-->
               <h1 class="text-2xl text-center font-bold capitalize">paiement</h1>
               <hr class="w-full lg:mt-2 md:mt-2 md:mb-2 my-2" />

                <div class="flex justify-between items-center">
                    <div class="info">
                        <div class="capitalize font-light">nom  
                            <span class="text-lg text-purple-700">:</span>
                        </div>
                        <div class="capitalize font-light">Qty  
                            <span class="text-lg text-purple-700">:</span>
                        </div>
                        <div class="capitalize font-light">prix 
                            <span class="text-lg text-purple-700">:</span>
                        </div>
                        <div class="capitalize font-light">Frais 
                            <span class="text-lg text-purple-700">:</span>
                        </div> 
                    </div> 
                    
                    <div>
                       <div class="font-thin">{{ $freefirecard->nom }}</div>
                       <div class="font-thin">{{ $freefirecard->quantite_diamons}} diamants</div>
                       <div class="font-thin">{{ $freefirecard->prix }} HTG</div>
                       <div class="font-thin">0 HTG</div>
                    </div>
                </div>

                <!-- section 2 -->
                <hr class="w-full lg:mt-2 md:mt-2 md:mb-2 my-2" />
                <div class="flex justify-between mr-8 items-center">
                    <div class="info">
                        <div class="capitalize font-medium">total  
                            <span class="text-lg text-purple-700">:</span>
                        </div>
                    </div> 
                    
                    <div>
                       <div class="font-medium">{{ $freefirecard->prix }} HTG</div>
                    </div>
                </div>

                <!-- section 3 -->
                <hr class="w-full lg:mt-2 md:mt-2 md:mb-2 my-2" />
                <div class="w-full h-48 flex items-center">
                    <img src="{{ $freefirecard->imageUrl() }}" alt="{{ $freefirecard->nom }}" class="object-cover">
                </div>
            </div>

            <div class="p-4 bg-white shadow-xs transform hover:-translate-y-1 border-1 
              border-solid  dark:bg-purple-600">
               <!-- section rigth 1-->
               <h1 class="text-2xl text-center font-bold capitalize">info player</h1>
               <hr class="w-full lg:mt-2 md:mt-2 md:mb-2 my-2" />
               <!-- Form choose method payment -->
                <form action="{{ route('process', $freefirecard) }}" method="get">
                    @csrf
                    <!-- ID player -->
                    <div>
                        @include('shared.input', ['class' => 'block w-full mt-1 text-sm dark:border-white dark:bg-0 
                        focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-black dark:focus:shadow-outline-gray',
                        'name' => 'id player', 'label' => 'block text-lg uppercase font-bold', 'type' => 'number'])  
                        <x-input-error :messages="$errors->get('id_player')" class="mt-2" />
                    </div>

                    <!-- Choose Methode payment -->
                    <h1 class="text-lg text-left font-light mt-3">Choose a payment methode</h1>
                    <hr class="w-full lg:mt-4 md:mt-4 md:mb-4 my-4" />
                    <div class="method-payment w-full space-y-4">
                        <!-- Radio moncash -->
                        <div class="flex items-center justify-between pr-6  hover:border-purple-700 bg-white shadow-xs border-2 border-solid h-16">
                            @include('shared.radio', ['class' => 'text-purple-600 form-radio focus:border-purple-400 focus:outline-none 
                            focus:shadow-outline-purple dark:focus:shadow-outline-gray',
                            'name' => 'methode_de_paiement', 'label' => 'inline-flex items-center ml-6 text-gray-600 dark:text-gray-400', 'type' => 'radio', 
                            'value' => 'moncash', 'id' => 'formRadioDefault1', 'span' => 'moncash'])  
                            <img src="{{ asset('../assets/img/paiement/MC_button_fr.png') }}"  class="w-24" alt="">
                        </div>
                        <x-input-error :messages="$errors->get('methode_de_paiement')" class="mt-2" />
                        <!-- Radio natcash -->
                        <div class="flex items-center justify-between  hover:border-purple-700 bg-white shadow-xs  border-2 border-dotted h-16">
                            @include('shared.radio', ['class' => 'text-purple-600 form-radio focus:border-purple-400 focus:outline-none 
                            focus:shadow-outline-purple dark:focus:shadow-outline-gray',
                            'name' => 'methode_de_paiement', 'label' => 'inline-flex items-center ml-6 text-gray-600 dark:text-gray-400', 'type' => 'radio',
                            'value' => 'natcash', 'id' => 'formRadioDefault2', 'span' => 'natcash'])  
                            <img src="{{ asset('../assets/img/paiement/natcash_logo.png') }}"  class="w-32 rounded-lg" alt="">
                        </div>
                        <x-input-error :messages="$errors->get('methode_de_paiement')" class="mt-2" />

                        <div class="flex justify-end">
                            <button type="submit"
                                class="block px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150
                                 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none
                                  focus:shadow-outline-purple dark:bg-white dark:text-black">
                                process
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection