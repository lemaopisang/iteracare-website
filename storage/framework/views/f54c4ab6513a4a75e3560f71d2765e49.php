<?php $__env->startSection("title", "Manajemen Testimoni"); ?>

<?php $__env->startSection("content"); ?>
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
            <a href="<?php echo e(route("admin.testimonials.create")); ?>"
               class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Tambah Testimoni Baru
            </a>
        </div>
    </div>

    <!-- Testimonials Table -->
    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <ul class="divide-y divide-gray-200">
            <?php $__empty_1 = true; $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li>
                    <div class="px-4 py-4 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <?php if($testimonial->video_url): ?>
                                    <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                                        <i class="fas fa-video text-red-600"></i>
                                    </div>
                                <?php else: ?>
                                    <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-quote-left text-gray-500"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="ml-4">
                                <div class="flex items-center">
                                    <div class="text-sm font-medium text-gray-900"><?php echo e($testimonial->customer_name); ?></div>
                                </div>
                                <div class="text-sm text-gray-500"><?php echo e(Str::limit($testimonial->content, 100)); ?></div>
                                <?php if($testimonial->video_url): ?>
                                    <div class="text-xs text-blue-600 font-mono">Video: <a href="<?php echo e($testimonial->video_url); ?>" target="_blank" class="hover:underline">Lihat Video</a></div>
                                <?php endif; ?>
                                <div class="text-xs text-gray-500">Rating: <?php echo e($testimonial->rating); ?>/5</div>
                                <?php if($testimonial->user): ?>
                                    <div class="text-xs text-gray-500">Oleh: <?php echo e($testimonial->user->name); ?> (<?php echo e(ucfirst($testimonial->user->role)); ?>)</div>
                                <?php else: ?>
                                    <div class="text-xs text-gray-500">Oleh: Pengguna Tidak Dikenal</div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <a href="<?php echo e(route("admin.testimonials.edit", $testimonial)); ?>"
                               class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                                Edit
                            </a>
                            <form method="POST" action="<?php echo e(route("admin.testimonials.destroy", $testimonial)); ?>" class="inline"
                                  onsubmit="return confirm("Apakah Anda yakin ingin menghapus testimoni ini?")">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field("DELETE"); ?>
                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="px-4 py-2">
                        <?php if($testimonial->video_file): ?>
                            <div class="mt-2">
                                <video controls preload="metadata" class="w-32 h-20 rounded shadow aspect-video">
                                    <source src="<?php echo e(asset('storage/' . $testimonial->video_file)); ?>" type="video/mp4">
                                    <source src="<?php echo e(asset('storage/' . $testimonial->video_file)); ?>" type="video/webm">
                                    <source src="<?php echo e(asset('storage/' . $testimonial->video_file)); ?>" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        <?php elseif($testimonial->video_url): ?>
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
                            <div class="mt-2" x-data="{ showVideo: false }">
                                <div x-show="!showVideo" class="relative cursor-pointer w-32 h-20" @click="showVideo = true">
                                    <img src="<?php echo e($thumbnailUrl); ?>" alt="Video Thumbnail" class="w-full h-full object-cover rounded">
                                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30">
                                        <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                                            <i class="fas fa-play text-white text-base ml-1"></i>
                                        </div>
                                    </div>
                                </div>
                                <div x-show="showVideo" x-transition>
                                    <?php if($embedUrl): ?>
                                        <iframe src="<?php echo e($embedUrl); ?>" class="w-32 h-20" frameborder="0" allowfullscreen></iframe>
                                    <?php else: ?>
                                        <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                            <a href="<?php echo e($testimonial->video_url); ?>" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                <i class="fas fa-external-link-alt mr-2"></i>Buka Video
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <li>
                    <div class="px-4 py-8 text-center">
                        <div class="text-sm text-gray-500">Tidak ada testimoni ditemukan.</div>
                        <div class="mt-2">
                            <a href="<?php echo e(route("admin.testimonials.create")); ?>"
                               class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                Buat testimoni pertama Anda
                            </a>
                        </div>
                    </div>
                </li>
            <?php endif; ?>
        </ul>
    </div>

    <!-- Pagination -->
    <?php if($testimonials->hasPages()): ?>
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            <?php echo e($testimonials->links()); ?>

        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make("admin.layouts.app", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\manus\v3\iteracare-website\resources\views/admin/testimonials/index.blade.php ENDPATH**/ ?>