@extends('layouts.app')

@section('title', 'Kebijakan Cookie')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-blue-50 to-purple-50 py-12">
    <div class="bg-white rounded-xl shadow-lg p-8 w-full max-w-2xl text-left">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Kebijakan Cookie</h1>
        <p class="mb-4">Situs ini menggunakan cookie untuk meningkatkan pengalaman pengguna dan menganalisis penggunaan situs.</p>
        <h2 class="text-xl font-semibold mt-6 mb-2">1. Apa itu Cookie?</h2>
        <p class="mb-4">Cookie adalah file kecil yang disimpan di perangkat Anda saat mengunjungi situs web. Cookie membantu kami mengenali Anda dan menyesuaikan layanan kami.</p>
        <h2 class="text-xl font-semibold mt-6 mb-2">2. Jenis Cookie yang Kami Gunakan</h2>
        <ul class="list-disc pl-6 mb-4">
            <li>Cookie fungsional: untuk mengingat preferensi Anda.</li>
            <li>Cookie analitik: untuk menganalisis penggunaan situs dan meningkatkan layanan.</li>
            <li>Cookie pihak ketiga: misal, untuk integrasi media sosial atau iklan.</li>
        </ul>
        <h2 class="text-xl font-semibold mt-6 mb-2">3. Pengelolaan Cookie</h2>
        <p class="mb-4">Anda dapat mengatur browser Anda untuk menolak atau menghapus cookie. Namun, beberapa fitur situs mungkin tidak berfungsi dengan baik tanpa cookie.</p>
        <h2 class="text-xl font-semibold mt-6 mb-2">4. Perubahan Kebijakan</h2>
        <p class="mb-4">Kami dapat memperbarui kebijakan cookie ini dari waktu ke waktu. Perubahan akan diumumkan di halaman ini.</p>
        <h2 class="text-xl font-semibold mt-6 mb-2">5. Kontak</h2>
        <p>Jika Anda memiliki pertanyaan tentang kebijakan cookie ini, silakan hubungi kami melalui halaman kontak.</p>
    </div>
</div>
@endsection
