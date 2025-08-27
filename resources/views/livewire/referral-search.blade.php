<div>
    <div class="bg-gradient-to-r from-blue-50 to-purple-50 py-16" id="referral-section">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h3 class="text-3xl font-bold text-gray-900 mb-4">Cari Sales Representative Anda</h3>
                <p class="text-lg text-gray-600">Masukkan nama atau kode referral sales untuk mendapatkan kontak
                    WhatsApp mereka</p>
            </div>
            <div class="bg-white rounded-2xl shadow-xl p-8 backdrop-blur-sm border border-blue-100">
                <div class="flex flex-col sm:flex-row gap-4 mb-6">
                    <div class="flex-1 relative">
                        <input type="text" wire:model.live.debounce.300ms="search"
                            placeholder="Masukkan nama atau kode referral (misal: Sarah Johnson)"
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-lg text-black"
                            wire:keydown.enter="searchReferral">
                        @if($isLoading)
                        <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                            <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-blue-600"></div>
                        </div>
                        @endif
                    </div>
                    <button wire:click="searchReferral"
                        class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-200 transform hover:scale-105 font-medium"
                        wire:loading.attr="disabled">
                        <i class="fas fa-search mr-2"></i>Cari
                    </button>
                    @if($search)
                    <button wire:click="clearSearch"
                        class="px-4 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-all duration-200">
                        <i class="fas fa-times"></i>
                    </button>
                    @endif
                </div>
                <div wire:loading.remove>
                    @if($showResult && $foundUser)
                    <div
                        class="bg-gradient-to-r from-green-50 to-blue-50 border border-green-200 rounded-xl p-6 animate-fade-in">
                        <div class="flex items-start space-x-6">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white text-2xl font-bold">
                                    {{ substr($foundUser->name, 0, 1) }}
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-2xl font-bold text-gray-900 mb-2">{{ $foundUser->name }}</h4>
                                @if($foundUser->bio)
                                <p class="text-gray-600 mb-4">{{ $foundUser->bio }}</p>
                                @endif
                                <div class="flex flex-wrap gap-3">
                                    @if($foundUser->whatsapp)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $foundUser->whatsapp) }}"
                                        target="_blank"
                                        class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-200 transform hover:scale-105">
                                        <i class="fab fa-whatsapp mr-2"></i>WhatsApp
                                    </a>
                                    @endif
                                    <a href="mailto:{{ $foundUser->email }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-800 rounded-lg">
                                        <i class="fas fa-envelope mr-2"></i>{{ $foundUser->email }}
                                    </a>
                                    <span
                                        class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-800 rounded-lg">
                                        <i class="fas fa-phone mr-2"></i>{{ $foundUser->phone }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @elseif($errorMessage)
                    <div class="bg-red-100 border border-red-200 text-red-700 rounded-lg p-4 mt-4 animate-fade-in">
                        <i class="fas fa-exclamation-circle mr-2"></i>{{ $errorMessage }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
