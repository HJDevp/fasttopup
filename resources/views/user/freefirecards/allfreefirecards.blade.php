@extends('frontend-dashboard.user-dashboard.dashboard')
@section('title', 'freefrire cards')

@section('main-principal')
    <div class="mx-8 mb-6 space-y-4">
        <h1 class="xl:text-base text-xs font-bold dark:text-purple-700">Toutes les cartes freefire</h1>
        <div class="banner_reveal bg-teal-200 p-4 rounded-tl-lg text-center rounded-br-lg">
            <p class="text-lg text-purple-700 leading-6 font-bold pb-3">
             Vous pouvez maintenant achter des cartes freefire en ligne via notre plateforme en un click
            </p>
             
            <span class="text-base text-gray-800 leading-6">
               Après l'achat votre carte est immédiatement envoyé par email vers vous
            </span>    
        </div>

        <!-- Toutes les cartes freefire -->
        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-2">
            <!-- Carte -->
            @foreach ($allfreefirecards as $freefirecard)
            <div class="freefirecards_reveal xl:flex  relative rounded-tl-lg rounded-bl-lg rounded-tr-lg p-6 border-4 border-dotted border-purple-300 xl:space-y-2 
             xl:space-x-4 space-y-4">

                <div class="absolute text-center rounded-tr-lg rounded-bl-lg top-0 right-0 w-40 h-auto bg-purple-600 dark:bg-white">
                    <span class="text-base text-white dark:text-black px-1"><span class="mx-2"><i class="ri-vip-diamond-fill"></i></span>{{ $freefirecard->quantite_diamons }} diamants</span>
                </div>

                <!-- <div class="xl:w-2/5 p-12 bg-white shadow-xs transform hover:-translate-y-1 border-1 border-solid 
                  dark:hover:bg-purple-700 hover:bg-purple-600  hover:bg-opacity-25
                   dark:bg-gray-800  rounded-tl-lg rounded-bl-lg"
                > -->
                <div class="xl:w-2/5">
                    <div class="image-card">
                     <img src="{{ $freefirecard->imageUrl() }}" alt="{{ $freefirecard->nom }}" 
                     class="w-full object-cover rounded-lg">
                    </div>
                </div>

                <div class="xl:w-3/5 text-base space-y-1">
                    <h4 class="text-base font-bold dark:text-white">Prix : <span class="text-purple-800">{{ $freefirecard->prix }} HTG</span></h4>
                    <h4 class="text-base font-bold dark:text-white">Quantite diamants : <span class="text-purple-800">{{ $freefirecard->quantite_diamons }}</span></h4>
                    <h4 class="text-base font-bold dark:text-white">Promotion : <span class="text-purple-800">{{ $freefirecard->promotion }}</span></h4>
                    <h4 class="text-base font-bold dark:text-white">Nom de la carte : <span class="text-purple-800">{{ $freefirecard->nom }}</span></h4>
                    
                    <div>
                        <div class="flex justify-end pt-4">
                            <a href="{{ route('checkout', $freefirecard) }}" class="flex items-center justify-between cursor-pointer px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                              Achter
                              <span class="ml-2" aria-hidden="true"><i class="ri-shopping-cart-line"></i></span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            @endforeach
        </div>
        <!-- Pagination -->
        {{ $allfreefirecards->links() }}

        <!-- Section -->
        <div class="xl:flex space-y-2 space-x-4">
           <!-- left -->
            <div class="xl:w-3/5 space-y-4 dark:text-white text-gray-800 ">
                <div class="p-3 space-y-3">
                    <h1 class="text-2xl font-bold">Les etapes pour achter des diamants freefire en ligne via notre application :</h1>
                    <ol class="list-decimal text-md font-light space-y-3 px-6 leading-5">
                       <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque, excepturi?</li>
                       <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque, excepturi?</li>
                       <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque, excepturi?</li>
                       <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque, excepturi?</li>
                    </ol>
                </div>
                
                <div class="p-3 space-y-3">
                    <h1 class="text-2xl font-bold">Comment recharger une carte freefire sur notre application sans carte de credit ?</h1>
                    <p class="leading-8">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime repudiandae reprehenderit voluptatem quisquam 
                        in unde earum excepturi nesciunt, sapiente mollitia, beatae, sint est consequatur corrupti ab ad aperiam hic.
                        Voluptates!
                    </p>
                </div>
            </div>

           <!-- rigth -->
            <div class="xl:w-2/5 space-y-4">
                <div class="p-3 border-2 border-solid border-cool-gray-100 space-y-2">
                    <h2 class="text-lg font-bold dark:text-purple-700"><span class="text-xl text-green-400 mr-2"><i class="ri-checkbox-circle-fill"></i></span>Livraison instantané</h2>
                    <p class="text-base  dark:text-white">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    </p>
                </div>

                <div class="p-3 border-2 border-solid border-cool-gray-100 space-y-2">
                    <h2 class="text-lg font-bold dark:text-purple-700"><span class="text-xl text-green-400 mr-2"><i class="ri-verified-badge-line"></i></span>Paiement securisé</h2>
                    <div class="flex gap-4 items-center">
                       <img src="{{ asset('../assets/img/paiement/MC_button_fr.png') }}"  class="w-24" alt="">
                       <img src="{{ asset('../assets/img/paiement/natcash_logo.png') }}"  class="w-24 rounded-lg" alt="">
                    </div>
                </div>   
                
                <!-- instructions -->
                <div class="title text-lg font-semibold">
                    <a href="" class="underline dark:text-cool-gray-100">
                     Comment telechager freefire sur android ?
                    </a>
                </div>
                <div class="bg-purple-400 shadow-md border h-40 border-gray-50">
                    <video src="">
                      
                    </video>
                </div>

                <div class="references text-lg font-semibold">
                    <a href="" class="underline dark:text-cool-gray-100">
                     Voir aussi comment telechager PUBG MOBILE sur android ?
                    </a>
                </div>
            </div>
        </div>


        <!-- Faqs-->
        <div class="lg:container lg:mx-auto lg:py-16 md:py-12 md:px-6 py-12 px-4" id="faqs">
            <h1 class="text-center dark:text-white lg:text-3xl text-2xl lg:leading-9 leading-7 text-gray-800 font-semibold">
                Foire aux questions freefire 
            </h1>
     
            <div class="w-full mx-auto">
                <!-- Question 1 -->
                @foreach ($faqs as $k => $v)
                    <hr class="w-full lg:mt-10 md:mt-12 md:mb-8 my-8" />
                    <div class="w-full md:px-6">
                        <div id="mainHeading" class="flex justify-between items-center w-full">
                            <div class="">
                                <p class="flex justify-center items-center dark:text-white font-medium text-base leading-6 md:leading-4 text-gray-800"><span class="lg:mr-6 mr-4 dark:text-white lg:text-2xl md:text-xl text-lg leading-6 md:leading-5 lg:leading-4 font-semibold text-gray-800">
                                Q{{$k+1}}.</span>{{ $v->question }}</p>
                            </div>
                            <button aria-label="toggler" class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800" data-menu>
                                <img class="transform dark:hidden " src="https://tuk-cdn.s3.amazonaws.com/can-uploader/faq-8-svg2.svg" alt="toggler">
                                <img class="transform dark:block hidden " src="https://tuk-cdn.s3.amazonaws.com/can-uploader/faq-8-svg2dark.svg" alt="toggler">
                            </button>
                        </div>
                        <div id="menu" class="hidden mt-6 w-full">
                            <p class="text-base leading-6 text-gray-600 dark:text-gray-300 font-normal">
                                {{ $v->reponse }}
                            </p>
                        </div>
                    </div>
                @endforeach
                <hr class="w-full lg:mt-10 my-8" />  
            </div>
        </div>
@endsection