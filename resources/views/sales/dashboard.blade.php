@extends("layouts.app")

@section("title", "Area Sales - Prife Indonesia")

@section("content")
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Selamat Datang, {{ $user->name }}!</h1>
                        <p class="text-gray-600 mt-1">Area Sales Representative Prife Indonesia</p>
                    </div>
                    <div class="text-right">
                        <div class="text-sm text-gray-500">Kode Referral Anda</div>
                        <div class="text-2xl font-bold text-blue-600">{{ $user->referral_code ?: $user->id }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100">
                        <i class="fas fa-video text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Testimoni Video</p>
                        <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Testimonial::where('user_id',
                            $user->id)->whereNotNull('video_file')->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100">
                        <i class="fas fa-users text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Status Akun</p>
                        <p class="text-lg font-bold text-green-600">{{ $user->is_active ? 'Aktif' : 'Tidak Aktif' }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100">
                        <i class="fas fa-calendar text-purple-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Bergabung Sejak</p>
                        <p class="text-lg font-bold text-gray-900">{{ $user->created_at->format('M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        @if($recentTestimonials->count() > 0)
        <div class="bg-white rounded-lg shadow-sm">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-900">Testimoni Terbaru</h2>
                    <a href="{{ route('sales.testimonials') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                        Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @foreach($recentTestimonials as $testimonial)
                    <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-lg">
                        <div class="flex-shrink-0">
                            @if($testimonial->video_file)
                            <div class="w-16 h-16 bg-red-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-play text-red-600"></i>
                            </div>
                            @elseif($testimonial->video_url)
                            <div class="w-16 h-16 bg-red-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-play text-red-600"></i>
                            </div>
                            @else
                            <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-quote-left text-gray-500"></i>
                            </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <span data-author="{{ optional($testimonial->user)->name }}" style="display:none"></span>
                            <h4 class="font-semibold text-gray-900">{{ $testimonial->customer_name }}</h4>
                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($testimonial->content, 100) }}</p>
                            <div class="flex items-center mt-2 space-x-4">
                                <span class="text-xs text-gray-500">{{ $testimonial->created_at->diffForHumans()
                                    }}</span>
                            </div>
                            @if($testimonial->video_file)
                            <div class="mt-2">
                                <video controls preload="metadata" class="w-full max-w-xs rounded shadow aspect-video"
                                    style="min-height:120px;max-height:200px;">
                                    <source src="{{ asset('storage/' . $testimonial->video_file) }}" type="video/mp4">
                                    <source src="{{ asset('storage/' . $testimonial->video_file) }}" type="video/webm">
                                    <source src="{{ asset('storage/' . $testimonial->video_file) }}" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            @elseif($testimonial->video_url)
                            <div class="mt-2">
                                <a href="{{ $testimonial->video_url }}" target="_blank"
                                    class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm">
                                    <i class="fas fa-video mr-1"></i>
                                    Lihat Video Testimoni
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @else
        <div class="bg-white rounded-lg shadow-sm p-8 text-center">
            <div class="p-4 rounded-full bg-gray-100 inline-block mb-4">
                <i class="fas fa-video text-gray-400 text-3xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Testimoni</h3>
            <p class="text-gray-600 mb-4">Mulai upload testimoni video pertama Anda untuk membantu promosi produk.</p>
            <a href="{{ route('sales.testimonials') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-plus mr-2"></i> Upload Testimoni
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
