<?php $__env->startSection("title", "Manajemen Pengguna"); ?>

<?php $__env->startSection("content"); ?>
<div class="space-y-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
                        <a href="<?php echo e(route('admin.users.create')); ?>" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md">Tambah User</a>
                    </div>
                </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                <ul class="divide-y divide-gray-200">
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li>
                            <div class="px-4 py-4 flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                            <span class="text-sm font-medium text-gray-700"><?php echo e(substr($user->name, 0, 2)); ?></span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900"><?php echo e($user->name); ?></div>
                                            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo e($user->role === "admin" ? "bg-red-100 text-red-800" : "bg-green-100 text-green-800"); ?>">
                                                <?php echo e(ucfirst($user->role)); ?>

                                            </span>
                                            <?php if(!$user->is_active): ?>
                                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                    Tidak Aktif
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="text-sm text-gray-500"><?php echo e($user->email); ?></div>
                                        <?php if($user->phone): ?>
                                            <div class="text-sm text-gray-500"><?php echo e($user->phone); ?></div>
                                        <?php endif; ?>
                                        <?php if($user->referral_code): ?>
                                            <div class="text-xs text-blue-600 font-mono">Referral: <?php echo e($user->referral_code); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <a href="<?php echo e(route('admin.users.edit', $user)); ?>"
                                       class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                                        Edit
                                    </a>
                                    <a href="<?php echo e(route('admin.users.duplicate', $user)); ?>"
                                       class="text-yellow-600 hover:text-yellow-900 text-sm font-medium">
                                        Duplikat
                                    </a>
                                    <form method="POST" action="<?php echo e(route('admin.users.destroy', $user)); ?>" class="inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <li>
                            <div class="px-4 py-8 text-center">
                                <div class="text-sm text-gray-500">Tidak ada pengguna ditemukan.</div>
                                <div class="mt-2">
                                    <a href="<?php echo e(route("admin.users.create")); ?>"
                                       class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                        Buat pengguna pertama Anda
                                    </a>
                                </div>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

            <?php if($users->hasPages()): ?>
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <?php echo e($users->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make("admin.layouts.app", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\manus\v3\iteracare-website\resources\views/admin/users/index.blade.php ENDPATH**/ ?>