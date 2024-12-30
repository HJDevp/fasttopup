@extends('frontend-dashboard.user-dashboard.dashboard')
@section('title', 'commandes')

@section('main-principal')
    <div class="mx-8 mb-6 space-y-4">
        
        <div class="w-full">
            <!-- Les commandes -->
            <div x-data="{ openTab: 1 }" class="p-0">
                <h1 class="text-2xl text-left font-light capitalize dark:text-white pb-4">Mes commandes</h1>
                <div class="xl:w-full">
                    <div class="xl:w-full mb-8 flex p-2 bg-white shadow-md hover:-translate-y-1 border-2
                       border-solid  dark:bg-gray-900">
                       <button x-on:click="openTab = 1" :class="{ 'bg-blue-500 text-white': openTab === 1 }" 
                       class="flex-1 text-sm xl:py-2 dark:text-gray-100 xl:px-4 xl:rounded-full focus:outline-none focus:shadow-outline-blue transition-all duration-300">En cours</button>
                       <button x-on:click="openTab = 2" :class="{ 'bg-green-500 text-white': openTab === 2 }" 
                       class="flex-1 text-sm xl:py-2 dark:text-gray-100 xl:px-4 xl:rounded-full focus:outline-none focus:shadow-outline-blue transition-all duration-300">Reussi</button>
                       <button x-on:click="openTab = 3" :class="{ 'bg-red-500 text-white': openTab === 3 }" 
                       class="flex-1 text-sm mr-2 xl:py-2 dark:text-gray-100 xl:px-4 xl:rounded-full focus:outline-none focus:shadow-outline-blue transition-all duration-300">Echoué</button>
                       <button x-on:click="openTab = 4" :class="{ 'bg-teal-400 text-white': openTab === 4 }" 
                       class="flex-1 text-sm xl:py-2 dark:text-gray-100 xl:px-4 xl:rounded-full focus:outline-none focus:shadow-outline-blue transition-all duration-300">Remboursé</button>
                    </div>
                    @foreach($orderItems as $orderItem)
                        <!-- starus des transactions -->
                        @if($orderItem->status === 'en cours')
                            <div class="w-full my-4">
                                <div x-show="openTab === 1" class="relative xl:flex items-center justify-between rounded-br-lg transition-all duration-300 bg-white p-4 shadow-md hover:-translate-y-1 border-2
                                    border-solid border-blue-600  dark:bg-gray-900">
                                    <div class="absolute text-center rounded-br-lg  bottom-0 right-0 w-40 h-auto bg-blue-600 dark:bg-white">
                                     <span class="text-base text-white dark:text-black px-1">{{ $orderItem->status }}</span>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <div class="w-32 h-20 flex items-center">
                                           <img src="{{ $orderItem->FreeFireCard->imageUrl() }}" alt="">
                                        </div>
        
                                        <div class="info-card">
                                           <h2 class="font-light text-sm capitalize dark:text-gray-300">Qty  : <span class="font-thin">{{ $orderItem->FreeFireCard->quantite_diamons }} diamants</span></h2>
                                           <h2 class="font-light text-sm capitalize dark:text-gray-300">Nom  : <span class="font-thin">{{ $orderItem->FreeFireCard->nom }}</span></h2>
                                           <h2 class="font-light text-sm capitalize dark:text-gray-300">Date  : <span class="font-thin">{{ $orderItem->updated_at }}</span></h2>
                                        </div>
                                    </div>
    
                                    <div class="pt-1">  
                                        <div class="prix">
                                            <h2 class="font-light text-sm dark:text-gray-300">Status : {{ $orderItem->status }}</h2> 
                                        </div>
                                    </div>
                                    
                                    <div class="prix">
                                       <h2 class="font-semi-bold font-thin text-sm dark:text-gray-300">Prix : {{ $orderItem->FreeFireCard->prix }} HTG</h2>
                                    </div>
                                </div>
                            </div>
                        @elseif($orderItem->status === 'reussi')
                            <div class="w-full my-4">
                                <div x-show="openTab === 2" class="relative xl:flex items-center justify-between rounded-br-lg  transition-all duration-300 bg-white p-4 shadow-md hover:-translate-y-1 border-2
                                    border-solid border-green-500  dark:bg-gray-900">
                                    <div class="absolute text-center rounded-br-lg  bottom-0 right-0 w-40 h-auto bg-green-500 dark:bg-white">
                                     <span class="text-base text-white dark:text-black px-1">{{ $orderItem->status }}</span>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <div class="w-32 h-20 flex items-center">
                                           <img src="{{ $orderItem->FreeFireCard->imageUrl() }}" alt="">
                                        </div>
        
                                        <div class="info-card">
                                           <h2 class="font-light text-sm capitalize dark:text-gray-300">Qty  : <span class="font-thin">{{ $orderItem->FreeFireCard->quantite_diamons }} diamants</span></h2>
                                           <h2 class="font-light text-sm capitalize dark:text-gray-300">Nom  : <span class="font-thin">{{ $orderItem->FreeFireCard->nom }}</span></h2>
                                           <h2 class="font-light text-sm capitalize dark:text-gray-300">Date  : <span class="font-thin">{{ $orderItem->updated_at }}</span></h2>
                                        </div>
                                    </div>
    
                                    <div class="pt-1">  
                                        <div class="prix">
                                            <h2 class="font-light text-sm dark:text-gray-300">Status : {{ $orderItem->status }}</h2> 
                                        </div>
                                    </div>
                                    
                                    <div class="prix">
                                       <h2 class="font-semi-bold font-thin text-sm dark:text-gray-300">Prix : {{ $orderItem->FreeFireCard->prix }} HTG</h2>
                                    </div>
                                </div>
                            </div>
                        @elseif($orderItem->status === 'échoué')
                            <div class="w-full my-4">
                                <div x-show="openTab === 3" class="relative xl:flex items-center justify-between rounded-br-lg  transition-all duration-300 bg-white p-4 shadow-md hover:-translate-y-1 border-2
                                    border-solid border-red-500  dark:bg-gray-900">
                                    <div class="absolute text-center rounded-br-lg  bottom-0 right-0 w-40 h-auto bg-red-500 dark:bg-white">
                                     <span class="text-base text-white dark:text-black px-1">{{ $orderItem->status }}</span>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <div class="w-32 h-20 flex items-center">
                                           <img src="{{ $orderItem->FreeFireCard->imageUrl() }}" alt="">
                                        </div>
        
                                        <div class="info-card">
                                           <h2 class="font-light text-sm capitalize dark:text-gray-300">Qty  : <span class="font-thin">{{ $orderItem->FreeFireCard->quantite_diamons }} diamants</span></h2>
                                           <h2 class="font-light text-sm capitalize dark:text-gray-300">Nom  : <span class="font-thin">{{ $orderItem->FreeFireCard->nom }}</span></h2>
                                           <h2 class="font-light text-sm capitalize dark:text-gray-300">Date  : <span class="font-thin">{{ $orderItem->updated_at }}</span></h2>
                                        </div>
                                    </div>
    
                                    <div class="pt-1">  
                                        <div class="prix">
                                            <h2 class="font-light text-sm dark:text-gray-300">Status : {{ $orderItem->status }}</h2> 
                                        </div>
                                    </div>
                                    
                                    <div class="prix">
                                       <h2 class="font-semi-bold font-thin text-sm dark:text-gray-300">Prix : {{ $orderItem->FreeFireCard->prix }} HTG</h2>
                                    </div>
                                </div>
                            </div>
                        @elseif($orderItem->status === 'remboursé')
                            <div class="w-full my-4">
                                <div x-show="openTab === 4" class="relative xl:flex items-center justify-between rounded-br-lg  transition-all duration-300 bg-white p-4 shadow-md hover:-translate-y-1 border-2
                                    border-solid border-teal-400 dark:bg-gray-900">
                                    <div class="absolute text-center rounded-br-lg  bottom-0 right-0 w-40 h-auto bg-teal-400 dark:bg-white">
                                     <span class="text-base text-white dark:text-black px-1">{{ $orderItem->status }}</span>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <div class="w-32 h-20 flex items-center">
                                           <img src="{{ $orderItem->FreeFireCard->imageUrl() }}" alt="">
                                        </div>
        
                                        <div class="info-card">
                                           <h2 class="font-light text-sm capitalize dark:text-gray-300">Qty  : <span class="font-thin">{{ $orderItem->FreeFireCard->quantite_diamons }} diamants</span></h2>
                                           <h2 class="font-light text-sm capitalize dark:text-gray-300">Nom  : <span class="font-thin">{{ $orderItem->FreeFireCard->nom }}</span></h2>
                                           <h2 class="font-light text-sm capitalize dark:text-gray-300">Date  : <span class="font-thin">{{ $orderItem->updated_at }}</span></h2>
                                        </div>
                                    </div>
    
                                    <div class="pt-1">  
                                        <div class="prix">
                                            <h2 class="font-light text-sm dark:text-gray-300">Status : {{ $orderItem->status }}</h2> 
                                        </div>
                                    </div>
                                    
                                    <div class="prix">
                                       <h2 class="font-semi-bold font-thin text-sm dark:text-gray-300">Prix : {{ $orderItem->FreeFireCard->prix }} HTG</h2>
                                    </div>
                                </div>
                            </div>
                        @endif
        
                    @endforeach
        
                </div>
                {{ $orderItems->links() }}
            </div>
        </div> 
        
    </div>
    <!-- alpine js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
@endsection    