@extends('shared.main-dashboard')
@section('title', 'login')

@section('main-user-dashboard')
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
      <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
        <div class="flex flex-col overflow-y-auto md:flex-row">
          <div class="h-32 md:h-auto md:w-1/2">
            <img
              aria-hidden="true"
              class="object-cover w-full h-full dark:hidden"
              src="{{ asset('../assets/img/img-3.jpg') }}"
              alt="Office"
            />
            <img
              aria-hidden="true"
              class="hidden object-cover w-full h-full dark:block"
              src="{{ asset('../assets/img/img-3.jpg') }}"
              alt="Office"
            />
          </div>
          <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full">
              <h1
                class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200"
              >
                Login
              </h1>
              <!-- Formulaire de connection -->
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" /></form>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <label class="block text-sm">
                      <span class="text-gray-700 dark:text-gray-400">Email</span>
                      <input
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="Jane Doe" name="email" value="{{ old('email') }}"
                      />
                      <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </label>

                    <label class="block mt-4 text-sm">
                      <span class="text-gray-700 dark:text-gray-400">Password</span>
                      <input
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="***************"
                        type="password" name="password"
                      />
                      <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </label>

                    <!-- Remember Me -->
                    <div class="flex mt-6 text-sm">
                      <label class="flex items-center dark:text-gray-400">
                        <input
                          type="checkbox" name="remember" id="remenber_me"
                          class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                        />
                        <span class="ml-2">
                          Remember me
                        </span>
                      </label>
                    </div>
      
                    <!-- You should use a button here, as the anchor is only used for the example  -->
                    <button type="submit"
                       class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Log in 
                    </button>
      
                    <hr class="my-8" />
      
                    <a href="{{ route('socialite.redirect', 'google') }}"
                      title="login with google"
                      class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
                    >
                    <svg class="w-4 h-4 mr-2"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                      <path d="M3.06364 7.50914C4.70909 4.24092 8.09084 2 12 2C14.6954 2 16.959 2.99095 
                       18.6909 4.60455L15.8227 7.47274C14.7864 6.48185 13.4681 5.97727 12 5.97727C9.39542 
                       5.97727 7.19084 7.73637 6.40455 10.1C6.2045 10.7 6.09086 11.3409 6.09086 12C6.09086 
                       12.6591 6.2045 13.3 6.40455 13.9C7.19084 16.2636 9.39542 18.0227 12 18.0227C13.3454 
                       18.0227 14.4909 17.6682 15.3864 17.0682C16.4454 16.3591 17.15 15.3 17.3818 
                       14.05H12V10.1818H21.4181C21.5364 10.8363 21.6 11.5182 21.6 12.2273C21.6 15.2727 20.5091 
                       17.8363 18.6181 19.5773C16.9636 21.1046 14.7 22 12 22C8.09084 22 4.70909 19.7591 3.06364 
                       16.4909C2.38638 15.1409 2 13.6136 2 12C2 10.3864 2.38638 8.85911 3.06364 7.50914Z">
                      </path>
                    </svg>
                      Google
                    </a>
                    <a href="{{ route('socialite.redirect', 'facebook') }}"
                      title="login with facebook"
                      class="flex items-center justify-center w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
                    >
                      <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                          <path d="M14 13.5H16.5L17.5 9.5H14V7.5C14 6.47062 14 5.5 16 5.5H17.5V2.1401C17.1743 2.09685 
                           15.943 2 14.6429 2C11.9284 2 10 3.65686 10 6.69971V9.5H7V13.5H10V22H14V13.5Z">
                          </path>
                      </svg>
                      Facebook
                    </a>
      
                    <p class="mt-4">
                        @if (Route::has('password.request'))
                            <a class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline" 
                             href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif    
                    </p>

                    <p class="mt-1">
                      <a
                        class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
                        href="{{ route('register') }}"
                      >
                        Create account
                      </a>
                    </p>
                </form>    
              <!-- Fin Formulaire de connection -->
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
