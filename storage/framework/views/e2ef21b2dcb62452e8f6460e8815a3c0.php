<?php $__env->startSection('title', 'Sales Area Login'); ?>
<?php $__env->startSection('content'); ?>
<div class="max-w-lg mx-auto mt-16 bg-white rounded-xl shadow-lg p-8">
    <h2 class="text-2xl font-bold mb-4 text-center">Sales Area Access</h2>
    <p class="mb-6 text-gray-600 text-center">Log in to access the Sales Area.</p>
    <div class="grid grid-cols-1 gap-8">
        <div>
            <?php echo $__env->make('auth.login-form', ['hideReferral' => true], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\manus\v3\iteracare-website\resources\views/sales/guest.blade.php ENDPATH**/ ?>