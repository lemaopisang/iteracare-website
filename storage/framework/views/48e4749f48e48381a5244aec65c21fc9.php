<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Admin Panel'); ?> - <?php echo e(config('app.name', 'Iteracare')); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <?php if(auth()->user()->role === 'admin'): ?>
                                <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-xl font-bold text-blue-600">
                                    Iteracare Admin
                                </a>
                            <?php elseif(auth()->user()->role === 'sales'): ?>
                                <a href="<?php echo e(route('sales.dashboard')); ?>" class="text-xl font-bold text-green-600">
                                    Iteracare Sales
                                </a>
                            <?php else: ?>
                                <a href="<?php echo e(route('home')); ?>" class="text-xl font-bold text-gray-600">
                                    Iteracare
                                </a>
                            <?php endif; ?>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <?php if(auth()->user()->role === 'admin'): ?>
                                <a href="<?php echo e(route('admin.dashboard')); ?>"
                                   class="inline-flex items-center px-1 pt-1 border-b-2 <?php echo e(request()->routeIs('admin.dashboard') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'); ?> text-sm font-medium">
                                    Dashboard
                                </a>
                                <a href="<?php echo e(route('admin.users.index')); ?>"
                                   class="inline-flex items-center px-1 pt-1 border-b-2 <?php echo e(request()->routeIs('admin.users.*') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'); ?> text-sm font-medium">
                                    Users
                                </a>
                                <a href="<?php echo e(route('admin.testimonials.index')); ?>"
                                   class="inline-flex items-center px-1 pt-1 border-b-2 <?php echo e(request()->routeIs('admin.testimonials.*') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'); ?> text-sm font-medium">
                                    Testimonials
                                </a>
                            <?php elseif(auth()->user()->role === 'sales'): ?>
                                <a href="<?php echo e(route('sales.dashboard')); ?>"
                                   class="inline-flex items-center px-1 pt-1 border-b-2 <?php echo e(request()->routeIs('sales.dashboard') ? 'border-green-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'); ?> text-sm font-medium">
                                    Dashboard
                                </a>
                                <a href="<?php echo e(route('sales.testimonials')); ?>"
                                   class="inline-flex items-center px-1 pt-1 border-b-2 <?php echo e(request()->routeIs('sales.testimonials*') ? 'border-green-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'); ?> text-sm font-medium">
                                    Testimoni
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- User Menu -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <div class="ml-3 relative">
                            <div class="flex items-center space-x-4">
                                <span class="text-sm text-gray-700"><?php echo e(auth()->user()->name); ?></span>
                                <a href="<?php echo e(route('home')); ?>" class="text-sm text-blue-600 hover:text-blue-800">
                                    View Site
                                </a>
                                <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="text-sm text-red-600 hover:text-red-800">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Flash Messages -->
                <?php if(session('success')): ?>
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline"><?php echo e(session('success')); ?></span>
                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline"><?php echo e(session('error')); ?></span>
                    </div>
                <?php endif; ?>

                <?php if($errors->any()): ?>
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <ul class="list-disc list-inside">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </main>
    </div>
</body>
</html>

<?php /**PATH C:\laragon\www\manus\v3\iteracare-website\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>