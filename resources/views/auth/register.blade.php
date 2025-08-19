<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-2xl font-bold text-gray-900">Request Registration</h2>
        <p class="text-sm text-gray-600 mt-2">Submit your registration request for admin approval</p>
    </div>

    <form method="POST" action="#" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Full Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="phone" :value="__('Phone Number')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" required />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="requested_role" :value="__('Requested Role')" />
            <select id="requested_role" name="requested_role" required
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="">Select a role</option>
                <option value="sales" {{ old('requested_role')=='sales' ? 'selected' : '' }}>Sales Representative
                </option>
                <option value="customer" {{ old('requested_role')=='customer' ? 'selected' : '' }}>Customer</option>
            </select>
            <x-input-error :messages="$errors->get('requested_role')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="bio" :value="__('Tell us about yourself')" />
            <textarea id="bio" name="bio" rows="3"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                placeholder="Please tell us about your background and why you'd like to join Prife Indonesia...">{{ old('bio') }}</textarea>
            <x-input-error :messages="$errors->get('bio')" class="mt-2" />
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-input-label for="instagram" :value="__('Instagram (Optional)')" />
                <x-text-input id="instagram" class="block mt-1 w-full" type="text" name="instagram"
                    :value="old('instagram')" placeholder="@username" />
            </div>
            <div>
                <x-input-label for="facebook" :value="__('Facebook (Optional)')" />
                <x-text-input id="facebook" class="block mt-1 w-full" type="text" name="facebook"
                    :value="old('facebook')" placeholder="Profile URL" />
            </div>
        </div>

        <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                <div class="text-sm text-blue-800">
                    <p class="font-semibold mb-1">Registration Process</p>
                    <p>Your registration request will be reviewed by our admin team. You will receive an email
                        notification once your account has been approved and activated.</p>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already have an account?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Submit Registration Request') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
