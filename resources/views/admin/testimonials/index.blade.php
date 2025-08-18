@extends("admin.layouts.app")

@section("title", "Manajemen Testimoni")

@section("content")
<div class="space-y-6">
    <!-- Page Header -->
    <div class="md:flex md:items-center md:justify-between">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Manajemen Testimoni
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Kelola semua testimoni pengguna dan sales representative.
            </p>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
            <a href="{{ route("admin.testimonials.create") }}"
               class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Tambah Testimoni Baru
            </a>
        </div>
    </div>

    <!-- Testimonials Table -->
    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <ul class="divide-y divide-gray-200">
            @forelse($testimonials as $testimonial)
                <li>
                    <div class="px-4 py-4 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                @if($testimonial->video_url)
                                    <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                                        <i class="fas fa-video text-red-600"></i>
                                    </div>
                                @else
                                    <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-quote-left text-gray-500"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-4">
                                <div class="flex items-center">
                                    <div class="text-sm font-medium text-gray-900">{{ $testimonial->customer_name }}</div>
                                </div>
                                <div class="text-sm text-gray-500">{{ Str::limit($testimonial->content, 100) }}</div>
                                @if($testimonial->video_url)
                                    <div class="text-xs text-blue-600 font-mono">Video: <a href="{{ $testimonial->video_url }}" target="_blank" class="hover:underline">Lihat Video</a></div>
                                @endif
                                <div class="text-xs text-gray-500">Rating: {{ $testimonial->rating }}/5</div>
                                @if($testimonial->user)
                                    <div class="text-xs text-gray-500">Oleh: {{ $testimonial->user->name }} ({{ ucfirst($testimonial->user->role) }})</div>
                                @else
                                    <div class="text-xs text-gray-500">Oleh: Pengguna Tidak Dikenal</div>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <a href="{{ route("admin.testimonials.edit", $testimonial) }}"
                               class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                                Edit
                            </a>
                            <form method="POST" action="{{ route("admin.testimonials.destroy", $testimonial) }}" class="inline"
                                  onsubmit="return confirm("Apakah Anda yakin ingin menghapus testimoni ini?")">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="px-4 py-2">
                        @if($testimonial->video_file)
                            <div class="mt-2">
                                <video controls preload="metadata" class="w-32 h-20 rounded shadow aspect-video">
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
                            <div class="mt-2" x-data="{ showVideo: false }">
                                <div x-show="!showVideo" class="relative cursor-pointer w-32 h-20" @click="showVideo = true">
                                    <img src="{{ $thumbnailUrl }}" alt="Video Thumbnail" class="w-full h-full object-cover rounded">
                                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30">
                                        <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                                            <i class="fas fa-play text-white text-base ml-1"></i>
                                        </div>
                                    </div>
                                </div>
                                <div x-show="showVideo" x-transition>
                                    @if($embedUrl)
                                        <iframe src="{{ $embedUrl }}" class="w-32 h-20" frameborder="0" allowfullscreen></iframe>
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
                    </div>
                </li>
            @empty
                <li>
                    <div class="px-4 py-8 text-center">
                        <div class="text-sm text-gray-500">Tidak ada testimoni ditemukan.</div>
                        <div class="mt-2">
                            <a href="{{ route("admin.testimonials.create") }}"
                               class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                Buat testimoni pertama Anda
                            </a>
                        </div>
                    </div>
                </li>
            @endforelse
        </ul>
    </div>

    <!-- Pagination -->
    @if($testimonials->hasPages())
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            {{ $testimonials->links() }}
        </div>
    @endif
</div>
@endsection


