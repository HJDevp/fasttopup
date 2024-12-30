@extends('frontend-dashboard.user-dashboard.dashboard')
@section('title', 'home')

@section('main-principal')
    <div class="banner bg-purple-500 p-4 mx-8 m-1">
        <div class="flex justify-center gap-8 items-center">
            <span class="xl:text-lg text-xs text-white font-semibold">
             Obtenez 10% de reductions sur les cartes freefire dans la période de black Friday
            </span>
            <a href="{{ route('freefire.cards.home') }}"
             class="xl:w-auto w-full cursor-pointer xl:text-base text-xs py-1 xl:px-10 p-5 bg-gray-50
           border-gray-50 text-gray-700 rounded-full text-center">
             Get now
            </a>
        </div>
    </div>   

   <div class="xl:bg-cool-gray-50 xl:bg-gray-50 xl:border xl:border-cool-gray-400 xl:p-12 m-8">
        <div class="hero xl:flex  items-center justify-between space-y-8">
            <div class="flex-col left xl:w-1/2 space-y-4">
                <h2 class="text-3xl    font-bold text-purple-700">
                 Bienvenue sur <span> Fast </span> <span class="text-black dark:text-gray-300"> top up </span>  
                </h2>
              
                
                <p class="text-xl xl:block hidden font-semibold dark:text-gray-300 text-gray-700">
                 une plateforme en ligne dédiée <br /> 
                 à la vente de cartes prépayées  <br />
                 et de services (FreeFire, PUBG Mobile, <br />
                 Xbox Game Pass, Visa, Maestro, etc.).
                </p>

                <p class="xl:hidden block text-xl font-semibold dark:text-gray-300 text-gray-700">
                 une plateforme en ligne <br /> 
                 dédiée à la vente des
                 cartes prépayées et des cartes 
                 cadeaux <br /> pour jeux et services  
                 (FreeFire, PUBG Mobile,
                 Xbox Game Pass, Visa, Maestro, etc.).
                </p>
                
                

                <div class="button">
                    <button class="py-2 px-6 bg-purple-700 border-gray-50 text-white rounded-full">
                        Top up now
                    </button>
                </div>
            </div>
  
            <div class="right allcards_reveal grid xl:w-1/2 xl:grid-cols-3 grid-cols-3 gap-3">
                <div class="grid-1">
                 <img src="{{ asset('../assets/img/Side-menu/icons8-free-fire-gradient/icons8-free-fire-64.svg') }}" 
                 alt="freefire" class="object-fit">
                </div>
    
                <div class="grid-2">
                 <img src="{{ asset('../assets/img/Side-menu/icons8-pubg-gradient/icons8-pubg-64.png') }}" 
                 alt="pubg mobile" class="object-fit">
                </div>
    
                <div class="grid-3">
                 <img src="{{ asset('../assets/img/Side-menu/icons8-netflix-gradient (1)/icons8-netflix-64.svg') }}" 
                 alt="netflix" class="object-fit">
                </div>
    
                <div class="grid-4">
                 <img src="{{ asset('../assets/img/Side-menu/icons8-google-pay-gradient/icons8-google-pay-64.svg') }}" 
                 alt="Google Pay" class="object-fit">
                </div>

                <div class="grid-5">
                 <img src="{{ asset('../assets/img/Side-menu/icons8-xbox-gradient/icons8-xbox-64.svg') }}" 
                 alt="Xbox Game Pass" class="object-fit">
                </div>
                
                <div class="grid-6">
                 <img src="{{ asset('../assets/img/Side-menu/icons8-steam-gradient (1)/icons8-steam-64.svg') }}" 
                 alt="Steam" class="object-fit">
                </div>

                <div class="grid-7">
                 <img src="{{ asset('../assets/img/Side-menu/icons8-visa-gradient/icons8-visa-64.svg') }}" 
                 alt="Visa" class="object-fit">
                </div>

                <div class="grid-8">
                 <img src="{{ asset('../assets/img/Side-menu/icons8-maestro-card-gradient/icons8-maestro-card-64.svg') }}" 
                 alt="Maestro" class="object-fit">
                </div>

                <div class="grid-9">
                 <img src="{{ asset('../assets/img/Side-menu/icons8-playstation-gradient/icons8-playstation-64.svg') }}" 
                 alt="Playstation" class="object-fit">
                </div>

            </div>
        </div>
   </div>

   <div class="title text-xl text-gray-600 m-8 dark:text-cool-gray-200">Les cartes les plus populaires</div>

   <div class="bg-gray-50 dark:bg-transparent shadow-md border border-cool-gray-400 p-6 m-8">
       <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
           @foreach ($Allcardgames as $cardgame)
               <!-- Card-games -->
               <a href="@if ($cardgame->nom === 'freeFire card-game' ) 
                   {{ route('freefire.cards.home') }} 
                   @endif" title="{{ $cardgame->nom }}">
                   <div class=" flex relative items-center p-12 bg-white rounded-lg shadow-xs transform hover:-translate-y-1 border-1 border-solid dark:hover:bg-purple-700 hover:bg-purple-600  hover:bg-opacity-25 hover:border-purple-600 dark:bg-gray-800">
                       <div class="absolute text-center rounded-tr-lg rounded-bl-lg top-0 right-0 w-20 h-auto bg-purple-600 dark:bg-white">
                           <span class="text-base text-white dark:text-black">Achter</span>
                       </div>
                       <div class="image-card flex items-center justify-center">
                        <img src="{{ $cardgame->ImageUrl() }}" alt="{{ $cardgame->nom }}" class="object-cover">
                       </div>
                   </div>
               </a>   
           @endforeach
       </div>
   </div>

   <!-- <div class="title text-xl text-gray-600 m-8 dark:text-cool-gray-200">Les cartes promos</div>

    <div class="swiper grid xl:grid-cols-3 md:grid-cols-2 bg-gray-50 shadow-md p-8">
        
        <div class="relative card bg-gray-50 border-2 border-gray-700 p-12 space-y-4">
            
            <div class="absolute right-0 transform rotate-45 bg-purple-700 w-40 text-white text-center p-2">
                <p class="text-center">10% OFF</p>
            </div>


            <div class="w-full bg-gray-50 shadow-md">
               <img src="{{ asset('../assets/img/freefire-diamonds/10807863.jpg') }}" alt=""
                class="w-full object-cover"
               >  
            </div>

            <div class=".rigth_4px text-lg font-light space-y-2">
              <h3>price : 100 HTG</h3>
              <h3>Qty   : 100</h3>
              <h3>name  : freefire card</h3>
            </div>
        </div> -->

    </div> 
@endsection    

  