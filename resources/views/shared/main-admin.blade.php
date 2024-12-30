<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>FastTopUp | @yield('title')</title>
      <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
      />
      <link rel="stylesheet" href="{{ asset('../assets/css/tailwind.output.css') }}" />
      
      <!-- Remix-icons  -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css" 
      referrerpolicy="no-referrer" />

      <!-- Swiper Link -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
      
      <!-- Swiper Js -->
      <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


      <!-- Alpines Js -->
      <script
        src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
        defer
      ></script>

      <!-- Modal -->
      <script src="{{ asset('../assets/js/focus-trap.js') }}"></script>

      <!-- Reaveal -->
      <script src="{{ asset('../assets/js/scrollreveal.min.js') }}"></script>
      <!-- <script src="{{ asset('./assets/js/charts-lines.js')}}" defer></script>
      <script src="{{ asset('./assets/js/charts-pie.js')}}" defer></script> -->

      <!-- Alpines Js -->
      <!-- <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> -->
      <script src="{{ asset('../assets/js/init-alpine.js') }}"></script>
    </head>
    <body id='root'>
        <div>
          @yield('main-admin-dashboard')
        </div>
        <!-- Footer -->
        <div class="w-full another-section z-30 py-4 border border-white  bg-purple-700">
          
          <div class="link m-12 grid  xl:grid-cols-6 md:grid-cols-3 sm:grid-cols-2 space-y-4">

            <div class="flex items-start justify-center mr-10">
              <div class="logo  flex flex-col items-center pb-8">
                <a href="{{ route('home') }}" class="text-xl font-bold"> <img src="{{ asset('../assets/img/logo-fasttopup/logo-3/logo.png') }}" 
                alt="" class="rounded-full object-cover xl:w-full w-1/2"></a>
              </div>
            </div>

              <div class="about flex flex-col">
                <h2 class="text-xl pb-2 font-bold">About</h2>
                <ul class="space-y-3 text-white">
                 <li><a href="#" class="hover:underline">Story</a></li>
                 <li><a href="#" class="hover:underline">Creativity</a></li>
                 <li><a href="#" class="hover:underline">Founders</a></li>
                 <li><a href="#" class="hover:underline">Why Us</a></li>
                </ul>
              </div>

              <div class="products flex flex-col">
                <h2 class="text-xl font-bold pb-2">Products</h2>
                <ul class="space-y-3 text-white">
                 <li><a href="#" class="hover:underline">FreeFire cards</a></li>
                 <li><a href="#" class="hover:underline">Pubgmobile cards</a></li>
                 <li><a href="#" class="hover:underline">Netflix cards</a></li>
                 <li><a href="#" class="hover:underline">Steam cards</a></li>
                 <li><a href="#" class="hover:underline">Xbox Game Pass</a></li>
                 <li><a href="#" class="hover:underline">Google Pay cards</a></li>
                 <li><a href="#" class="hover:underline">Maestro cards</a></li>
                 <li><a href="#" class="hover:underline">Visa cards</a></li>
                </ul>
              </div>

              <div class="follow flex flex-col">
                <h2 class="text-xl font-bold pb-2">Follow</h2>
                <ul class="space-y-3 text-white">
                 <li><a href="#" class="hover:underline">Youtube</a></li>
                 <li><a href="#" class="hover:underline">Twitter</a></li>
                 <li><a href="#" class="hover:underline">Whatssap</a></li>
                 <li><a href="#" class="hover:underline">Facebook</a></li>
                 <li><a href="#" class="hover:underline">Instagram</a></li>
                </ul>
              </div>
              
              <div class="application flex flex-col">
                <h2 class="text-xl font-bold pb-2">Application</h2>
                <ul class="space-y-3 text-white">
                 <li><a href="#" class="hover:underline">Sign up</a></li>
                 <li><a href="#" class="hover:underline">Log in</a></li>
                 <li><a href="#" class="hover:underline">My Orders</a></li>
                 <li><a href="#" class="hover:underline">My Transactions</a></li>
                 <li><a href="#" class="hover:underline">Faqs</a></li>
                </ul>
              </div>

              <div class="support flex flex-col">
                <h2 class="text-xl font-bold pb-2">Support</h2>
                <ul class="space-y-3 text-white">
                  <li><a href="#" class="hover:underline">FAQ's</a></li>
                  <li><a href="Tel:+50934156013 | +50935147089" class="hover:underline">
                   +509 34156013 | <br>+509 35147089</a>
                  </li>
                  <li>
                    <a href="mailto:fasttopupsupport@gmail.com" class="hover:underline">fasttopupsupport@gmail.com</a>
                  </li>
                  <li>
                    <a href="mailto:fasttopupwebsite@gmail.com" class="hover:underline">fasttopupwebsite@gmail.com</a>
                  </li>
                </ul>
              </div>  
          </div>
            
          <div class="policy text-sm pb-4 text-center  space-x-2">
            <span><a class="hover:underline" href="">Privacy policy</a></span> <span class="text-center">|</span>
            <span><a class="hover:underline" href="">Responsible Disclosure Program policy</a></span><span class="text-center">|</span>
            <span><a class="hover:underline" href="">Terms and Conditions</a></span>
          </div>

          <hr class="text-white text-xl xl:py-8 py-4">
          <p class="text-white text-center text-xl">
            &copy;2024 Herveson Jeudy tout droit sont réservée
          </p>
        </div>

        <!-- Scrool up -->
        <a href="" class="fixed right-0 bottom-4 bg-gray-900 px-3 py-1  m-6
          md:px-4 md:py-2 rounded-md hover:-translate-y-1 duration-300 shadow-sm inline-block 
          text-lg z-50" id="scroll-up">
          <i class="ri-arrow-up-line text-gray-100"></i>
        </a>
    </body>
</html>