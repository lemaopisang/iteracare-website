<?php $__env->startSection('title', 'Testimoni - Prife Indonesia'); ?>
<?php $__env->startSection('description', 'Baca testimoni dari pelanggan kami yang telah merasakan manfaat teknologi Terahertz Prife Indonesia.'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-purple-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Testimoni Pelanggan</h1>
            <p class="text-xl text-gray-600">Dengarkan dari pelanggan kami yang telah merasakan kekuatan transformatif teknologi Terahertz</p>
        </div>

        <?php
            $testimonials = \App\Models\Testimonial::orderBy('created_at', 'desc')->paginate(12);
        ?>

        <?php if($testimonials->count() > 0): ?>
        <!-- Testimonials Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-shadow duration-300">
                <!-- Video Section -->
                <?php if($testimonial->video_file): ?>
                <div class="aspect-video bg-black rounded-lg mb-6 overflow-hidden flex items-center justify-center">
                    <video controls preload="metadata" class="w-full h-full max-h-96 rounded-lg" style="object-fit:cover;">
                        <source src="<?php echo e(asset('storage/' . $testimonial->video_file)); ?>" type="video/mp4">
                        <source src="<?php echo e(asset('storage/' . $testimonial->video_file)); ?>" type="video/webm">
                        <source src="<?php echo e(asset('storage/' . $testimonial->video_file)); ?>" type="video/ogg">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <?php elseif($testimonial->video_url): ?>
                <div class="aspect-video bg-gray-100 rounded-lg mb-6 relative overflow-hidden">
                    <?php
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
                    ?>
                    <div x-data="{ showVideo: false }">
                        <div x-show="!showVideo" class="relative cursor-pointer" @click="showVideo = true">
                            <img src="<?php echo e($thumbnailUrl); ?>" alt="Video Thumbnail" class="w-full h-full object-cover">
                            <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30">
                                <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                                    <i class="fas fa-play text-white text-xl ml-1"></i>
                                </div>
                            </div>
                        </div>
                        <div x-show="showVideo" x-transition>
                            <?php if($embedUrl): ?>
                                <iframe src="<?php echo e($embedUrl); ?>" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                    <a href="<?php echo e($testimonial->video_url); ?>" target="_blank" class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-external-link-alt mr-2"></i>Buka Video
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Title -->
                <?php if($testimonial->title): ?>
                <h2 class="text-xl font-bold text-gray-900 mb-2"><?php echo e($testimonial->title); ?></h2>
                <?php endif; ?>

                <!-- Customer Info -->
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-blue-600"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="font-semibold text-gray-900"><?php echo e($testimonial->customer_name); ?></h3>
                        <?php if($testimonial->author): ?>
                            <p class="text-sm text-gray-600">Melalui: <?php echo e($testimonial->author); ?></p>
                        <?php elseif($testimonial->user): ?>
                            <p class="text-sm text-gray-600">Melalui: <?php echo e($testimonial->user->name); ?></p>
                        <?php endif; ?>
                        <?php if($testimonial->user && $testimonial->user->whatsapp): ?>
                            <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $testimonial->user->whatsapp)); ?>" target="_blank" class="inline-flex items-center mt-1 px-3 py-1 bg-green-500 text-white text-xs rounded hover:bg-green-600">
                                <i class="fab fa-whatsapp mr-1"></i> WhatsApp
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Rating -->
                <div class="flex mb-4">
                    <?php for($i = 1; $i <= 5; $i++): ?>
                        <i class="fas fa-star <?php echo e($i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300'); ?>"></i>
                    <?php endfor; ?>
                    <span class="ml-2 text-sm text-gray-600">(<?php echo e($testimonial->rating); ?>/5)</span>
                </div>

                <!-- Content -->
                <p class="text-gray-700 leading-relaxed mb-4">
                    <?php echo e($testimonial->content); ?>

                </p>

                <!-- Tags -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <?php if($testimonial->video_url): ?>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <i class="fas fa-video mr-1"></i>Video
                            </span>
                        <?php endif; ?>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-1"></i>Terverifikasi
                        </span>
                    </div>
                    <span class="text-xs text-gray-500"><?php echo e($testimonial->created_at->format('d M Y')); ?></span>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- Pagination -->
        <?php if($testimonials->hasPages()): ?>
            <div class="flex justify-center">
                <?php echo e($testimonials->links()); ?>

            </div>
        <?php endif; ?>

        <?php else: ?>
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-comments text-gray-400 text-4xl"></i>
            </div>
            <h3 class="text-2xl font-semibold text-gray-700 mb-4">Belum Ada Testimoni</h3>
            <p class="text-gray-500 mb-8">Testimoni akan ditampilkan di sini setelah disetujui admin.</p>
        </div>
        <?php endif; ?>

        <!-- Call to Action -->
        <div class="mt-16 text-center">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl p-8 text-white">
                <h2 class="text-3xl font-bold mb-4">Siap Merasakan Manfaatnya?</h2>
                <p class="text-xl mb-8">Bergabunglah dengan ribuan pelanggan yang telah mengubah kesehatan mereka dengan teknologi Terahertz.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="<?php echo e(route('home')); ?>"
                       class="bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-800 transition-colors duration-200">
                        <i class="fas fa-envelope mr-2"></i>Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\manus\v3\iteracare-website\resources\views/testimonials.blade.php ENDPATH**/ ?>