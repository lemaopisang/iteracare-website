<?php $__env->startSection("title", "Edit Pengguna"); ?>

<?php $__env->startSection("content"); ?>
<div class="space-y-6">
    <!-- Page Header -->
    <div class="md:flex md:items-center md:justify-between">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Edit Pengguna: <?php echo e($user->name); ?>

            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Perbarui informasi dan izin pengguna.
            </p>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
            <a href="<?php echo e(route("admin.users.index")); ?>"
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Kembali ke Pengguna
            </a>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="bg-white shadow sm:rounded-lg">
        <form method="POST" action="<?php echo e(route("admin.users.update", $user)); ?>" class="space-y-6 p-6">
            <?php echo csrf_field(); ?>
            <?php echo method_field("PUT"); ?>

            <!-- Basic Information -->
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Informasi Dasar</h3>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="<?php echo e(old("name", $user->name)); ?>" required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                        <input type="email" name="email" id="email" value="<?php echo e(old("email", $user->email)); ?>" required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi Baru</label>
                        <input type="password" name="password" id="password"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <p class="mt-1 text-sm text-gray-500">Biarkan kosong untuk mempertahankan kata sandi saat ini</p>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700">Peran</label>
                        <select name="role" id="role" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="">Pilih Peran</option>
                            <option value="admin" <?php echo e(old("role", $user->role) === "admin" ? "selected" : ""); ?>>Administrator</option>
                            <option value="sales" <?php echo e(old("role", $user->role) === "sales" ? "selected" : ""); ?>>Sales Representative</option>
                        </select>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input type="text" name="phone" id="phone" value="<?php echo e(old("phone", $user->phone)); ?>"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                </div>
            </div>

            <!-- Profile Information -->
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Informasi Profil</h3>
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                        <textarea name="bio" id="bio" rows="3"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"><?php echo e(old("bio", $user->bio)); ?></textarea>
                        <p class="mt-2 text-sm text-gray-500">Deskripsi singkat tentang pengguna (untuk sales representative).</p>
                    </div>
                </div>
            </div>

            <!-- Social Media -->
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Media Sosial & Kontak</h3>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                    <div>
                        <label for="instagram" class="block text-sm font-medium text-gray-700">URL Instagram</label>
                        <input type="text" name="instagram" id="instagram" value="<?php echo e(old("instagram", $user->instagram)); ?>"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="facebook" class="block text-sm font-medium text-gray-700">Profil Facebook</label>
                        <input type="text" name="facebook" id="facebook" value="<?php echo e(old("facebook", $user->facebook)); ?>"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="whatsapp" class="block text-sm font-medium text-gray-700">Link WhatsApp <span class="text-gray-400">(contoh: http://wa.me/+62xxxxxxxxxxx)</span></label>
                        <input type="url" name="whatsapp" id="whatsapp" value="<?php echo e(old('whatsapp', $user->whatsapp)); ?>"
                               placeholder="http://wa.me/+62xxxxxxxxxxx"
                               maxlength="255"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                </div>
            </div>

            <!-- Referral Code (Editable for admin) -->
            <div>
                <label for="referral_code" class="block text-sm font-medium text-gray-700">Kode Referral</label>
                <input type="text" name="referral_code" id="referral_code" value="<?php echo e(old('referral_code', $user->referral_code)); ?>"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                <p class="mt-1 text-sm text-gray-500">Kode referral dapat diubah oleh admin.</p>
            </div>

            <!-- Status -->
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Status</h3>
                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1" <?php echo e(old("is_active", $user->is_active) ? "checked" : ""); ?>

                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-900">
                        Pengguna Aktif
                    </label>
                </div>
                <p class="mt-2 text-sm text-gray-500">Pengguna yang tidak aktif tidak dapat masuk ke sistem.</p>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-3">
                <a href="<?php echo e(route("admin.users.index")); ?>"
                   class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Perbarui Pengguna
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make("admin.layouts.app", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\manus\v3\iteracare-website\resources\views/admin/users/edit.blade.php ENDPATH**/ ?>