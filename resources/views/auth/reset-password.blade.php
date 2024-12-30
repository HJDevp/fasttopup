@extends('shared.main-dashboard')
@section('title', 'reset-password')

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
                Reset Password
              </h1>
              <!-- Session Status -->
              <x-auth-session-status class="mb-4" :status="session('status')" />
              <!-- Formulaire de connection -->
                <form method="POST" action="{{ route('password.store') }}">
                    @csrf
                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

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

                    <label class="block mt-4 text-sm">
                      <span class="text-gray-700 dark:text-gray-400">Comfirm Password</span>
                      <input
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="***************"
                        type="password" name="password_confirmation"
                      />
                      <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </label>

      
                    <!-- You should use a button here, as the anchor is only used for the example  -->
      

                    <p class="mt-1">
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit"
                              class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                              Reset Password
                            </button>
                        </div>
                    </p>
                </form>    
              <!-- Fin Formulaire de connection -->
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
