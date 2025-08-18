<?php $__env->startSection('title', 'Referral Ditemukan'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-blue-50 to-purple-50 py-12">
    <div class="bg-white rounded-xl shadow-lg p-8 w-full max-w-md text-center">
        <h1 class="text-2xl font-bold text-green-700 mb-4">Referral Ditemukan!</h1>
        <div class="mb-6">
            <div class="text-lg font-semibold text-gray-900"><?php echo e($user->name); ?></div>
            <div class="text-gray-600 mb-2"><?php echo e($user->email); ?></div>
            <?php if($user->phone): ?>
                <div class="text-gray-600 mb-2"><?php echo e($user->phone); ?></div>
            <?php endif; ?>
            <?php if($user->whatsapp): ?>
                <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $user->whatsapp)); ?>" target="_blank" class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors mb-2">
                    <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                </a>
            <?php endif; ?>
        </div>
        <div class="mb-4 text-gray-500">Bukan yang anda cari? Cari disini:</div>
        <form method="POST" action="<?php echo e(route('search.referral')); ?>" class="flex flex-col items-center gap-2">
            <?php echo csrf_field(); ?>
            <input type="text" name="referral_code" placeholder="Masukkan kode referral lain..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Cari Referral</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\manus\v3\iteracare-website\resources\views/referral/found.blade.php ENDPATH**/ ?>