@extends('frontend-dashboard.user-dashboard.dashboard')
@section('title', 'transactions')

@section('main-principal')
    <div class="mx-8 mb-6 space-y-4">
        
        <div class="w-full">
            <!-- Les commandes -->
            <div x-data="{ openTab: 1 }" class="p-0">
                <h1 class="text-2xl text-left font-light capitalize dark:text-white pb-4">Mes Transactions</h1>
                <div class="search-by-date flex items-center justify-end pb-1">
                    <form action="{{ route('search-transaction-by-month') }}"  method="post"
                     class="flex items-center justify-between space-x-2"
                    >
                        @csrf
                        <div>
                         <x-input-error :messages="$errors->get('month_id')" class="mt-2" />
                         @include('shared.selectSearchTransactions', ['class' => 'block  w-full mt-1 text-sm dark:border-gray-600 
                         focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray',
                         'select_class' => 'block py-1 w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select 
                         focus:border-purple-400 rounded-full focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray',
                         'name' => 'month_id', 'label' => 'block text-sm'])
                        </div>

                        <button class="block  px-4 py-1 text-sm font-medium leading-5 text-center text-white 
                         transition-colors duration-150 bg-purple-600 border border-transparent rounded-full 
                         active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            search
                        </button>
                    </form>
                </div>

                <div class="xl:w-full">
                    <div class="xl:w-full mb-8 flex p-2 bg-white shadow-md hover:-translate-y-1 border-2
                       border-solid  dark:bg-gray-900">
                       <button x-on:click="openTab = 1" :class="{ 'bg-blue-500 text-white': openTab === 1 }" 
                       class="flex-1 text-sm xl:py-2 dark:text-gray-100 xl:px-4 xl:rounded-full focus:outline-none focus:shadow-outline-blue transition-all duration-300">En attente</button>
                       <button x-on:click="openTab = 2" :class="{ 'bg-green-500 text-white': openTab === 2 }" 
                       class="flex-1 text-sm xl:py-2 dark:text-gray-100 xl:px-4 xl:rounded-full focus:outline-none focus:shadow-outline-blue transition-all duration-300">Validé</button>
                       <button x-on:click="openTab = 3" :class="{ 'bg-red-500 text-white': openTab === 3 }" 
                       class="flex-1 text-sm mr-2 xl:py-2 dark:text-gray-100 xl:px-4 xl:rounded-full focus:outline-none focus:shadow-outline-blue transition-all duration-300">Echoué</button>
                       <!-- <button x-on:click="openTab = 4" :class="{ 'bg-teal-400 text-white': openTab === 4 }" 
                       class="flex-1 text-sm xl:py-2 dark:text-gray-100 xl:px-4 xl:rounded-full focus:outline-none focus:shadow-outline-blue transition-all duration-300">Remboursé</button> -->
                    </div>
                    @foreach($transactions as $transaction)
                        <!-- starus des transactions -->
                        @if($transaction->status === 'en attente')
                            <div class="w-full my-4">
                                <div x-show="openTab === 1" class="relative xl:flex items-center justify-between rounded-br-lg transition-all duration-300 bg-white p-4 shadow-md hover:-translate-y-1 border-2
                                    border-solid border-blue-600  dark:bg-gray-900">
                                    <div class="absolute text-center rounded-br-lg  bottom-0 right-0 w-32 h-auto bg-blue-600 dark:bg-white">
                                     <span class="text-base text-white dark:text-black px-1">{{ $transaction->status }}</span>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <div class="w-32 h-20 flex items-center">
                                            <a href="{{ $transaction->captureTransaction() }}">
                                                <img src="{{ $transaction->captureTransaction() }}" alt="">
                                            </a>
                                        </div>
        
                                        <div class="info-card">
                                           <h2 class="font-light text-sm capitalize dark:text-gray-300">Nom complet : <span class="font-thin">{{ $transaction->nom }} {{ $transaction->prenom }}</span></h2>
                                           <h2 class="font-light text-sm capitalize dark:text-gray-300">Telephone  : <span class="font-thin">{{ $transaction->telephone }}</span></h2>
                                           <h2 class="font-light text-sm capitalize dark:text-gray-300">Date  : <span class="font-thin">{{ $transaction->updated_at }}</span></h2>
                                        </div>
                                    </div>
    
                                    <div class="pt-1">  
                                        <div class="methode-payment">
                                            <h2 class="font-light text-sm dark:text-gray-300">Methode de paiement : {{ $transaction->methode_de_paiement }} </h2> 
                                        </div>
                                    </div>
                                    
                                    <div class="montant">
                                       <h2 class="font-semi-bold font-thin text-sm dark:text-gray-300">Montant : {{ $transaction->montant }} HTG</h2>
                                    </div>
                                </div>
                            </div>
                        @elseif($transaction->status === 'validé')
                            <div class="w-full my-4">
                                <div x-show="openTab === 2" class="relative xl:flex items-center justify-between rounded-br-lg  transition-all duration-300 bg-white p-4 shadow-md hover:-translate-y-1 border-2
                                    border-solid border-green-500  dark:bg-gray-900">
                                    <div class="absolute text-center rounded-br-lg  bottom-0 right-0 w-32 h-auto bg-green-500 dark:bg-white">
                                     <span class="text-base text-white dark:text-black px-1">{{ $transaction->status }}</span>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <div class="w-32 h-20 flex items-center">
                                            <a href="{{ $transaction->captureTransaction() }}">
                                                <img src="{{ $transaction->captureTransaction() }}" alt="">
                                            </a>
                                        </div>
        
                                        <div class="info-card">
                                           <h2 class="font-light text-sm capitalize dark:text-gray-300">Nom complet : <span class="font-thin">{{ $transaction->nom }} {{ $transaction->prenom }}</span></h2>
                                           <h2 class="font-light text-sm capitalize dark:text-gray-300">Telephone  : <span class="font-thin">{{ $transaction->telephone }}</span></h2>
                                           <h2 class="font-light text-sm capitalize dark:text-gray-300">Date  : <span class="font-thin">{{ $transaction->updated_at }}</span></h2>
                                        </div>
                                    </div>
    
                                    <div class="pt-1">  
                                        <div class="methode-payment">
                                            <h2 class="font-light text-sm dark:text-gray-300">Methode de paiement : {{ $transaction->methode_de_paiement }} </h2> 
                                        </div>
                                    </div>
                                    
                                    <div class="montant">
                                       <h2 class="font-semi-bold font-thin text-sm dark:text-gray-300">Montant : {{ $transaction->montant }} HTG</h2>
                                    </div>
                                </div>
                            </div>
                        @elseif($transaction->status === 'echoué')
                            <div class="w-full my-4">
                                <div x-show="openTab === 3" class="relative xl:flex items-center justify-between rounded-br-lg  transition-all duration-300 bg-white p-4 shadow-md hover:-translate-y-1 border-2
                                    border-solid border-red-500  dark:bg-gray-900">
                                    <div class="absolute text-center rounded-br-lg  bottom-0 right-0 w-32 h-auto bg-red-500 dark:bg-white">
                                     <span class="text-base text-white dark:text-black px-1">{{ $transaction->status }}</span>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <div class="w-32 h-20 flex items-center">
                                          <img src="{{ $transaction->captureTransaction() }}" alt="">
                                        </div>
        
                                        <div class="info-card">
                                           <h2 class="font-light text-sm capitalize dark:text-gray-300">Nom complet : <span class="font-thin">{{ $transaction->nom }} {{ $transaction->prenom }}</span></h2>
                                           <h2 class="font-light text-sm capitalize dark:text-gray-300">Telephone  : <span class="font-thin">{{ $transaction->telephone }}</span></h2>
                                           <h2 class="font-light text-sm capitalize dark:text-gray-300">Date  : <span class="font-thin">{{ $transaction->updated_at }}</span></h2>
                                        </div>
                                    </div>
    
                                    <div class="pt-1">  
                                        <div class="methode-payment">
                                            <h2 class="font-light text-sm dark:text-gray-300">Methode de paiement : {{ $transaction->methode_de_paiement }} </h2> 
                                        </div>
                                    </div>
                                    
                                    <div class="montant">
                                       <h2 class="font-semi-bold font-thin text-sm dark:text-gray-300">Montant : {{ $transaction->montant }} HTG</h2>
                                    </div>
                                </div>
                            </div>
                        <!-- @elseif($transaction->status === 'remboursé')
                            <div class="w-full my-4">
                                <div x-show="openTab === 4" class="relative xl:flex items-center justify-between rounded-br-lg  transition-all duration-300 bg-white p-4 shadow-md hover:-translate-y-1 border-2
                                    border-solid border-teal-400 dark:bg-gray-900">
                                    <div class="absolute text-center rounded-br-lg  bottom-0 right-0 w-40 h-auto bg-teal-400 dark:bg-white">
                                     <span class="text-base text-white dark:text-black px-1">{{ $transaction->status }}</span>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <div class="w-32 h-20 flex items-center">
                                           <img src="{{ $transaction->FreeFireCard->imageUrl() }}" alt="">
                                        </div>
        
                                        <div class="info-card">
                                           <h2 class="font-light text-sm capitalize dark:text-gray-300">Qty  : <span class="font-thin">{{ $transaction->FreeFireCard->quantite_diamons }} diamants</span></h2>
                                           <h2 class="font-light text-sm capitalize dark:text-gray-300">Nom  : <span class="font-thin">{{ $transaction->FreeFireCard->nom }}</span></h2>
                                           <h2 class="font-light text-sm capitalize dark:text-gray-300">Date  : <span class="font-thin">{{ $transaction->updated_at }}</span></h2>
                                        </div>
                                    </div>
    
                                    <div class="pt-1">  
                                        <div class="prix">
                                            <h2 class="font-light text-sm dark:text-gray-300">Status : {{ $transaction->status }}</h2> 
                                        </div>
                                    </div>
                                    
                                    <div class="prix">
                                       <h2 class="font-semi-bold font-thin text-sm dark:text-gray-300">Prix : {{ $transaction->FreeFireCard->prix }} HTG</h2>
                                    </div>
                                </div>
                            </div> -->
                        @endif
        
                    @endforeach
        
                </div>
                {{ $transactions->links() }}
            </div>
        </div> 
        
    </div>
    <!-- alpine js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
@endsection    