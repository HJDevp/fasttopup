@extends('shared.main-dashboard')
@section('title', 'verify-email')

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
                        <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                         {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                        </h1>

                        @if (session('status') == 'verification-link-sent')
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                            </div>
                        @endif

                        <!-- Formulaire de reinitialisation de mot de passe -->
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                        <form action="{{ route('verification.send' )}}" method="POST">
                            @csrf          
                           <!-- You should use a button here, as the anchor is only used for the example  -->
                            <button type="submit"
                             class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                             Resend Verification Email
                            </button>
                        </form>

                        <div class="mt-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-sm underline font-medium text-purple-600 dark:text-purple-400">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
@endsection