<x-guest-layout>
    <div class="w-full max-w-xs mx-auto mt-3">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- NIK -->
                <div>
                    <x-input-label for="nik" :value="__('NIK')" />
                    <x-text-input id="nik" class="block mt-1 w-full" type="text" name="nik" required autofocus />
                    <x-input-error :messages="$errors->get('nik')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>


                <!-- Login Button -->
                <div class="mt-6">
                    <x-primary-button class="w-full justify-center">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>