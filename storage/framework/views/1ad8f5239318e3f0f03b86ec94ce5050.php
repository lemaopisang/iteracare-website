<?php $__env->startSection('title', 'Penjelasan'); ?>
<?php $__env->startSection('content'); ?>
<section id="penjelasan" class="py-20 bg-gradient-to-br from-gray-50 to-blue-50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-center mb-12">Penjelasan</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <!-- Terahertz -->
            <div class="flex flex-col items-center">
                <a href="#terahertz"><img src="<?php echo e(asset('prifeindonesia_images/Terahertz.jpg')); ?>" alt="Terahertz" class="mb-6 rounded-xl shadow-lg w-48 h-48 object-cover"></a>
                <h3 class="text-2xl font-bold mb-2"><a href="#terahertz" class="text-blue-700 hover:underline">Terahertz</a></h3>
                <p class="text-gray-700 text-center" id="terahertz">
                    Frekuensi Terahertz berada di antara gelombang mikro dan inframerah. Gelombang ini bergetar pada frekuensi yang sama dengan sel tubuh normal. Saat menembus jaringan tubuh, gelombang ini menyebabkan sel tidak sehat bergetar lebih cepat, meningkatkan suhunya, dan menghancurkannya.
                </p>
            </div>
            <!-- Sistem Limfatik -->
            <div class="flex flex-col items-center">
                <a href="#limfatik"><img src="<?php echo e(asset('prifeindonesia_images/Lymphatic.jpg')); ?>" alt="Sistem Limfatik" class="mb-6 rounded-xl shadow-lg w-48 h-48 object-cover"></a>
                <h3 class="text-2xl font-bold mb-2"><a href="#limfatik" class="text-blue-700 hover:underline">Sistem Limfatik</a></h3>
                <p class="text-gray-700 text-center" id="limfatik">
                    Sistem limfatik adalah sistem sirkulasi sekunder yang mengalirkan limfa (getah bening) ke seluruh tubuh. Limfa berasal dari plasma darah dan mengandung sel darah putih. Sistem ini penting untuk kekebalan tubuh, memproduksi, menyimpan, dan menyebarkan sel darah putih untuk melawan kuman penyakit.
                </p>
            </div>
            <!-- PEMF -->
            <div class="flex flex-col items-center">
                <a href="#pemf"><img src="<?php echo e(asset('prifeindonesia_images/PEMF.jpg')); ?>" alt="PEMF" class="mb-6 rounded-xl shadow-lg w-48 h-48 object-cover"></a>
                <h3 class="text-2xl font-bold mb-2"><a href="#pemf" class="text-blue-700 hover:underline">Pulsed Electro-Magnetic Field (PEMF)</a></h3>
                <p class="text-gray-700 text-center" id="pemf">
                    Terapi Medan Elektro Magnet Berdenyut (PEMF) menggunakan teknologi untuk menstimulasi dan melatih sel guna mendukung kesehatan secara keseluruhan. Terapi ini mengirimkan energi magnetis ke dalam tubuh, bekerja dengan medan magnet alami tubuh untuk meningkatkan penyembuhan dan mempengaruhi metabolisme sel. Ini membantu proses pemulihan tubuh untuk meringankan rasa sakit kronis dan sepenuhnya aman.
                </p>
            </div>
            <!-- Ion -->
            <div class="flex flex-col items-center">
                <a href="#ion"><img src="<?php echo e(asset('prifeindonesia_images/Ion.jpg')); ?>" alt="Ion" class="mb-6 rounded-xl shadow-lg w-48 h-48 object-cover"></a>
                <h3 class="text-2xl font-bold mb-2"><a href="#ion" class="text-blue-700 hover:underline">Ion</a></h3>
                <p class="text-gray-700 text-center" id="ion">
                    Ion adalah atom atau molekul dengan muatan listrik tidak nol. Kation bermuatan positif, sedangkan anion bermuatan negatif. Karena muatan yang berlawanan, kation dan anion saling tarik-menarik dan mudah membentuk senyawa ionik.
                </p>
            </div>
            <!-- Placeholder for more explanations -->
            <div class="flex flex-col items-center opacity-0"><div class="w-48 h-48"></div></div>
            <div class="flex flex-col items-center opacity-0"><div class="w-48 h-48"></div></div>
            <div class="flex flex-col items-center opacity-0"><div class="w-48 h-48"></div></div>
            <div class="flex flex-col items-center opacity-0"><div class="w-48 h-48"></div></div>
            <div class="flex flex-col items-center opacity-0"><div class="w-48 h-48"></div></div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\manus\v3\iteracare-website\resources\views/penjelasan.blade.php ENDPATH**/ ?>