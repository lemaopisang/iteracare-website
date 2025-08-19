<div class="bg-gradient-to-r from-gray-900 via-blue-900 to-purple-900 text-white">
    @if(request()->route() && request()->route()->getName() !== 'penjelasan')
    <div class="max-w-3xl mx-auto px-4 py-6">
        <form method="POST" action="{{ route('search.referral') }}" class="flex items-center gap-2">
            @csrf
            <input name="referral_code" type="text" value="{{ session('referral_name') ?? '' }}"
                placeholder="Masukkan nama atau kode referral"
                class="flex-1 px-4 py-2 rounded-lg border border-gray-300 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" />
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm">Hubungi Kami</button>
        </form>

        @if(session('referral_result'))
        <div class="max-w-3xl mx-auto px-4 py-4 mt-2">
            <div class="bg-green-50 border border-green-200 text-green-800 p-4 rounded-lg">
                <strong>{{ session('referral_result.name') }}</strong>
                <div class="text-sm">Phone: {{ session('referral_result.phone') ?? 'N/A' }}</div>
                <div class="text-sm">Email: {{ session('referral_result.email') ?? 'N/A' }}</div>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="max-w-3xl mx-auto px-4 py-4 mt-2">
            <div class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-lg">
                {{ session('error') }}
            </div>
        </div>
        @endif
    </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <h3
                        class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent mb-4">
                        Iteracare
                    </h3>
                    <p class="text-gray-300 mb-6 leading-relaxed">
                        Advanced Terahertz Technology for health and wellness. Experience the power of innovative
                        frequency therapy for your well-being.
                    </p>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}"
                                class="text-gray-300 hover:text-white transition-colors duration-200">Home</a></li>
                        <li><a href="{{ route('testimonials') }}"
                                class="text-gray-300 hover:text-white transition-colors duration-200">Testimonials</a>
                        </li>
                        <li><a href="{{ route('contact') }}"
                                class="text-gray-300 hover:text-white transition-colors duration-200">Contact</a></li>
                        <li><a href="{{ route('penjelasan') }}"
                                class="text-gray-300 hover:text-white transition-colors duration-200">Penjelasan</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact Info</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-blue-400"></i>
                            info@iteracare.com
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-3 text-blue-400"></i>
                            +62 811-776-230
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="border-t border-gray-700 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">
                    © {{ date("Y") }} Iteracare. All rights reserved.
                </p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-200">Privacy
                        Policy</a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-200">Terms of
                        Service</a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-200">Cookie
                        Policy</a>
                </div>
            </div>
        </div>
    </div>
</div>
