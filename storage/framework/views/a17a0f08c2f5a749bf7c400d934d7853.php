<?php $__env->startSection('title', 'Server Error - Prife Indonesia'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br from-red-50 to-orange-50 flex items-center justify-center">
    <div class="max-w-md mx-auto text-center px-4">
        <div class="mb-8">
            <div class="w-32 h-32 bg-gradient-to-br from-red-100 to-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-exclamation-triangle text-6xl text-red-600"></i>
            </div>
            <h1 class="text-6xl font-bold text-gray-900 mb-4">500</h1>
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Server Error</h2>
            <p class="text-gray-600 mb-8">
                Something went wrong on our end. We're working to fix this issue.
            </p>
        </div>
        
        <div class="space-y-4">
            <a href="<?php echo e(route('home')); ?>" 
               class="inline-block bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-purple-700 transition-all duration-200 transform hover:scale-105">
                <i class="fas fa-home mr-2"></i>Back to Home
            </a>
            
            <p class="text-sm text-gray-500">
                If the problem persists, please <a href="<?php echo e(route('contact')); ?>" class="text-blue-600 hover:text-blue-700">contact us</a>.
            </p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\manus\v3\iteracare-website\resources\views/errors/500.blade.php ENDPATH**/ ?>