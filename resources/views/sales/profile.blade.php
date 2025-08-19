@extends("layouts.app")

@section("title", "Edit Profil Sales - Prife Indonesia")

@section("content")
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Edit Profil</h1>
            <p class="text-gray-600 mb-6">Perbarui informasi pribadi dan kontak Anda.</p>

            @if (session("success"))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session("success") }}</span>
            </div>
            @endif

            <form method="POST" action="{{ route(" sales.profile.update") }}">
                @csrf
                @method("PUT")

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name (read-only)</label>
                        <input type="text" name="name" id="name" value="{{ $user->name }}"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 cursor-not-allowed"
                            readonly>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ old(" email", $user->email) }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3
                        focus:ring-blue-500 focus:border-blue-500">
                        @error("email")
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ old(" phone", $user->phone) }}" class="mt-1
                        block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500
                        focus:border-blue-500">
                        @error("phone")
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">WhatsApp</label>
                        <input type="url" name="whatsapp" id="whatsapp" value="{{ old('whatsapp', $user->whatsapp) }}"
                            placeholder="http://wa.me/+62xxxxxxxxxxx"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500">
                        @error("whatsapp")
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Referral Code (Editable)</label>
                        <input type="text" name="referral_code" id="referral_code"
                            value="{{ old('referral_code', $user->referral_code) }}"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500">
                        @error('referral_code')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Bio</label>
                        <textarea name="bio" id="bio" rows="3"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500">{{ old("bio", $user->bio) }}</textarea>
                        @error("bio")
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="instagram" class="block text-sm font-medium text-gray-700">Instagram URL</label>
                        <input type="url" name="instagram" id="instagram" value="{{ old(" instagram", $user->instagram)
                        }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3
                        focus:ring-blue-500 focus:border-blue-500">
                        @error("instagram")
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="facebook" class="block text-sm font-medium text-gray-700">Facebook URL</label>
                        <input type="url" name="facebook" id="facebook" value="{{ old(" facebook", $user->facebook) }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3
                        focus:ring-blue-500 focus:border-blue-500">
                        @error("facebook")
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
