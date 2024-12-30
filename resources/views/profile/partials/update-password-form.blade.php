<section class="w-full">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <!-- Currrent password -->
        <label class="block mt-4 text-sm">
          <span class="text-gray-700 dark:text-gray-400">Mot de passe</span>
          <input
            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
            placeholder="***************" 
            type="password" name="current_password" value="{{ old('password', substr($user->password, 0, 19)) }}"
          />
          <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </label>

        <!-- New password -->
        <label class="block mt-4 text-sm">
          <span class="text-gray-700 dark:text-gray-400">Nouveau mot de passe</span>
          <input
            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
            placeholder="***************"
            type="password" name="password"
          />
          <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </label>

        <!-- Password confirmation -->
        <label class="block mt-4 text-sm">
          <span class="text-gray-700 dark:text-gray-400">Confirmer le mot de passe</span>
          <input
            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
            placeholder="***************"
            type="password" name="password_confirmation"
          />
          <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </label>


        <div class="flex items-center gap-4">
            <button type="submit"
                class="block px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Save
            </button>

            @if (session('status') === 'password-updated')
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
