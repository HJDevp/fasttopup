<section class="w-full">
    @php
     use Illuminate\Support\Carbon;
    @endphp
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    
    
    <form method="post" action="{{ route('profile.update') }}" 
     class="grid xl:grid-cols-2 md:grid-cols-1 gap-8 items-start space-y-4">
        @csrf
        @method('patch')
       
        <div class="w-full space-y-4 bg-gray-50 rounded-lg shadow-md border
         border-gray-300 p-6 pb-12">
            <!-- Nom -->
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Nom</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="Jane Doe" name="nom" value="{{ old('nom', $user->nom) }}"
                />
                <x-input-error :messages="$errors->get('nom')" class="mt-2" />
            </label>
    
            <!-- Prenom-->
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Prenom</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="Jane Doe" name="prenom" value="{{ old('prenom', $user->prenom) }}"
                />
                <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
            </label>
    
            <!-- Numero Telephone -->
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Telephone</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="+509 33330000" name="numero_telephone" value="{{ old('numero_telephone', $user->numero_telephone) }}"
                />
                <x-input-error :messages="$errors->get('numero_telephone')" class="mt-2" />
            </label>
    
            <div>
                <!-- Email -->
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Email</span>
                    <input
                      class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                      placeholder="JaneDoe@gmail.com" name="email" value="{{ old('email', $user->email) }}"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </label>
    
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800">
                            {{ __('Your email address is unverified.') }}
    
                            <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>
    
                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif 
                
            </div>
        </div>

        <div class="relative avatar-box  bg-gray-50 rounded-lg shadow-md border
         border-gray-300 grid justify-center space-x-4 space-y-3">
            <div class="flex justify-center items-center ">
                <div class="absolute -translate-y-1/2 -translate-x-1/2 avatar xl:w-32 w-24 h-24 xl:h-32 rounded-full items-start
                 bg-purple-700 bg-transparent">
                    <a href="{{ $user->avatars?->avatarUrl() }}">
                        <img src="{{ $user->avatars?->avatarUrl() }}" alt="" 
                        class="object-fit rounded-full border-2 border-purple-600 cursor-pointer">
                    </a>
                </div>
            </div>
            
            <div class="info-avatar p-16 space-y-3">
                <hr class="w-full">
                <h3 class="text-sm capitalize">avatar name : {{ $user->avatars?->nom }}</h3>
                <h3 class="text-sm capitalize">date  : 
                 {{ Carbon::parse($user->avatars?->updated_at)->diffForHumans() }} 
                </h3>
                <!-- Avatars -->
                <div>
                    @include('shared.selectAvatars', ['class' => 'block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 
                    focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray',
                    'select_class' => 'block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select 
                    focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray',
                    'name' => 'avatars_id', 'label' => 'block text-sm', 'span' => 'All avatars'])
                    <x-input-error :messages="$errors->get('avatars_id')" class="mt-2" />
                </div>
            </div>
            
        </div>
        
        <div class="flex items-center gap-4">
            <button type="submit"
                class="block px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Save
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
