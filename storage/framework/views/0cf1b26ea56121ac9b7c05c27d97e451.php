<div class="bg-gradient-to-r from-gray-900 via-blue-900 to-purple-900 text-white">
    <!-- Referral Search Section -->
    <?php if(request()->route() && request()->route()->getName() !== 'penjelasan'): ?>
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('referral-search', ['referralCode' => session('referral_name')]);

$__html = app('livewire')->mount($__name, $__params, 'lw-3345017537-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    <?php endif; ?>

    <!-- Main Footer Content -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent mb-4">
                        Iteracare
                    </h3>
                    <p class="text-gray-300 mb-6 leading-relaxed">
                        Advanced Terahertz Technology for health and wellness. Experience the power of innovative frequency therapy for your well-being.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="<?php echo e(route('home')); ?>" class="text-gray-300 hover:text-white transition-colors duration-200">Home</a></li>
                        <li><a href="<?php echo e(route('testimonials')); ?>" class="text-gray-300 hover:text-white transition-colors duration-200">Testimonials</a></li>
                        <li><a href="<?php echo e(route('contact')); ?>" class="text-gray-300 hover:text-white transition-colors duration-200">Contact</a></li>
                        <li><a href="<?php echo e(route('penjelasan')); ?>" class="text-gray-300 hover:text-white transition-colors duration-200">Penjelasan</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
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

    <!-- Bottom Footer -->
    <div class="border-t border-gray-700 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">
                    © <?php echo e(date("Y")); ?> Iteracare. All rights reserved.
                </p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-200">Privacy Policy</a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-200">Terms of Service</a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-200">Cookie Policy</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\manus\v3\iteracare-website\resources\views/partials/footer.blade.php ENDPATH**/ ?>