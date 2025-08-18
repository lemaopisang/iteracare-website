<section id="penjelasan" class="py-20 bg-gradient-to-br from-gray-50 to-blue-50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-center mb-12">Penjelasan</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            @foreach([
                ['img' => 'Terahertz.jpg', 'title' => 'Terahertz', 'desc' => 'Frekuensi Terahertz berada di antara gelombang mikro dan inframerah. Gelombang ini bergetar pada frekuensi yang sama dengan sel tubuh normal. Saat menembus jaringan tubuh, gelombang ini menyebabkan sel tidak sehat bergetar lebih cepat, meningkatkan suhunya, dan menghancurkannya.'],
                ['img' => 'Lymphatic.jpg', 'title' => 'Sistem Limfatik', 'desc' => 'Sistem limfatik adalah sistem sirkulasi sekunder yang mengalirkan limfa (getah bening) ke seluruh tubuh. Limfa berasal dari plasma darah dan mengandung sel darah putih. Sistem ini penting untuk kekebalan tubuh, memproduksi, menyimpan, dan menyebarkan sel darah putih untuk melawan kuman penyakit.'],
                ['img' => 'PEMF.jpg', 'title' => 'PEMF', 'desc' => 'Terapi Medan Elektro Magnet Berdenyut (PEMF) menggunakan teknologi untuk menstimulasi dan melatih sel guna mendukung kesehatan secara keseluruhan. Terapi ini mengirimkan energi magnetis ke dalam tubuh, bekerja dengan medan magnet alami tubuh untuk meningkatkan penyembuhan dan mempengaruhi metabolisme sel. Ini membantu proses pemulihan tubuh untuk meringankan rasa sakit kronis dan sepenuhnya aman.'],
                ['img' => 'on.jpg', 'title' => 'Ion', 'desc' => 'Ion adalah atom atau molekul dengan muatan listrik tidak nol. Kation bermuatan positif, sedangkan anion bermuatan negatif. Karena muatan yang berlawanan, kation dan anion saling tarik-menarik dan mudah membentuk senyawa ionik.'],
            ] as $item)
            <div class="flex flex-col items-center bg-white rounded-xl shadow-lg p-6">
                <img src="{{ asset('prifeindonesia_images/' . $item['img']) }}" alt="{{ $item['title'] }}" class="mb-4 rounded-xl w-40 h-40 object-cover">
                <h3 class="text-xl font-bold mb-2 text-center">{{ $item['title'] }}</h3>
                <p class="text-gray-700 text-center">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
