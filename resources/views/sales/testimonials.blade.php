@extends("layouts.app")

@section("title", "Testimoni Saya - Area Sales")

@section("content")
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-purple-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Testimoni Saya</h1>
                    <p class="text-gray-600 mt-2">Kelola testimoni yang telah Anda kirimkan</p>
                </div>
                <a href="{{ route("sales.dashboard") }}"
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Area Sales
                </a>
            </div>
        </div>

        <!-- Add New Testimonial Form -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">
                <i class="fas fa-plus-circle text-blue-600 mr-2"></i>
                Tambah Testimoni Baru
            </h2>

            @if(session("success"))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session("success") }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('sales.testimonials.store') }}" class="space-y-6" enctype="multipart/form-data">
                @csrf

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Sales <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="customer_name" id="customer_name"
                               value="{{ old('customer_name', Auth::user()->name) }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error("customer_name")
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">
                            Rating <span class="text-red-500">*</span>
                        </label>
                        <select name="rating" id="rating" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Pilih Rating</option>
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ old("rating") == $i ? "selected" : "" }}>
                                    {{ $i }} Bintang
                                </option>
                            @endfor
                        </select>
                        @error("rating")
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul Video/Testimoni <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                        Isi Testimoni <span class="text-red-500">*</span>
                    </label>
                    <textarea name="content" id="content" rows="4" required
                              placeholder="Ceritakan pengalaman pelanggan dengan produk iTeraCare..."
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old("content") }}</textarea>
                    @error("content")
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="video_url" class="block text-sm font-medium text-gray-700 mb-2">
                        URL Video (Opsional)
                    </label>
                    <input type="url" name="video_url" id="video_url"
                           value="{{ old("video_url") }}"
                           placeholder="https://youtube.com/watch?v=... atau https://vimeo.com/..."
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <p class="mt-1 text-sm text-gray-500">
                        <i class="fas fa-info-circle mr-1"></i>
                        Masukkan link YouTube atau Vimeo untuk testimoni video
                    </p>
                    @error("video_url")
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="video_file" class="block text-sm font-medium text-gray-700 mb-2">
                        Upload Video (MP4/WebM/Ogg, max 50MB)
                    </label>
                    <input type="file" name="video_file" id="video_file" accept="video/mp4,video/webm,video/ogg"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('video_file')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Kirim Testimoni
                    </button>
                </div>
            </form>
        </div>

        <!-- My Testimonials -->
        <div class="bg-white rounded-lg shadow-md">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">
                    <i class="fas fa-list text-blue-600 mr-2"></i>
                    Testimoni Saya ({{ $testimonials->total() }})
                </h2>
            </div>

            @if($testimonials->count() > 0)
                <div class="divide-y divide-gray-200">
                    @foreach($testimonials as $testimonial)
                        <div class="p-6">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center mb-2">
                                        <h3 class="text-lg font-medium text-gray-900">{{ $testimonial->customer_name }}</h3>
                                        <div class="ml-4 flex items-center">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $testimonial->rating ? "text-yellow-400" : "text-gray-300" }} text-sm"></i>
                                            @endfor
                                            <span class="ml-2 text-sm text-gray-600">({{ $testimonial->rating }}/5)</span>
                                        </div>
                                    </div>

                                    <p class="text-gray-700 mb-3">{{ $testimonial->content }}</p>

                                    @if($testimonial->video_file)
                                        <div class="mb-3">
                                            <video controls preload="metadata" class="w-full max-w-4xl rounded shadow aspect-video" style="min-height:360px;max-height:600px;">
                                                <source src="{{ asset('storage/' . $testimonial->video_file) }}" type="video/mp4">
                                                <source src="{{ asset('storage/' . $testimonial->video_file) }}" type="video/webm">
                                                <source src="{{ asset('storage/' . $testimonial->video_file) }}" type="video/ogg">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    @elseif($testimonial->video_url)
                                        @php
                                            $videoId = '';
                                            $embedUrl = '';
                                            if (strpos($testimonial->video_url, 'youtube.com') !== false || strpos($testimonial->video_url, 'youtu.be') !== false) {
                                                preg_match('/(?:youtube\\.com\\/(?:[^\\/]+\\/.+\\/|(?:v|e(?:mbed)?)\\/|.*[?&]v=)|youtu\\.be\\/)([^"&?\\/\\s]{11})/', $testimonial->video_url, $matches);
                                                $videoId = $matches[1] ?? '';
                                                $thumbnailUrl = "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg";
                                                $embedUrl = "https://www.youtube.com/embed/{$videoId}";
                                            } elseif (strpos($testimonial->video_url, 'vimeo.com') !== false) {
                                                preg_match('/vimeo\\.com\\/(\\d+)/', $testimonial->video_url, $matches);
                                                $videoId = $matches[1] ?? '';
                                                $thumbnailUrl = "https://vumbnail.com/{$videoId}.jpg";
                                                $embedUrl = "https://player.vimeo.com/video/{$videoId}";
                                            } else {
                                                $thumbnailUrl = '/prifeindonesia_images/prife_logo.png';
                                            }
                                        @endphp
                                        <div class="mb-3" x-data="{ showVideo: false }">
                                            <div x-show="!showVideo" class="relative cursor-pointer" @click="showVideo = true">
                                                <img src="{{ $thumbnailUrl }}" alt="Video Thumbnail" class="w-full h-full object-cover">
                                                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30">
                                                    <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                                                        <i class="fas fa-play text-white text-xl ml-1"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div x-show="showVideo" x-transition>
                                                @if($embedUrl)
                                                    <iframe src="{{ $embedUrl }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                                        <a href="{{ $testimonial->video_url }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                            <i class="fas fa-external-link-alt mr-2"></i>Buka Video
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                    <div class="flex items-center text-sm text-gray-500">
                                        <i class="fas fa-calendar mr-1"></i>
                                        Dikirim: {{ $testimonial->created_at->format("d M Y, H:i") }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($testimonials->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $testimonials->links() }}
                    </div>
                @endif
            @else
                <div class="p-12 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-comments text-gray-400 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Testimoni</h3>
                    <p class="text-gray-500">Mulai tambahkan testimoni pertama Anda menggunakan form di atas.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

