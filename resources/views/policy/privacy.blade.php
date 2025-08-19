@extends('layouts.app')

@section('title', 'Kebijakan Privasi')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-blue-50 to-purple-50 py-12">
    <div class="bg-white rounded-xl shadow-lg p-8 w-full max-w-2xl text-left">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Kebijakan Privasi</h1>
        <p class="mb-4">Kami menghargai privasi Anda dan berkomitmen untuk melindungi data pribadi Anda. Halaman ini
            menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi Anda saat menggunakan situs
            ini.</p>
        <h2 class="text-xl font-semibold mt-6 mb-2">1. Informasi yang Kami Kumpulkan</h2>
        <ul class="list-disc pl-6 mb-4">
            <li>Informasi yang Anda berikan secara langsung (misal: nama, email, nomor telepon, dll).</li>
            <li>Data penggunaan situs secara otomatis (misal: alamat IP, browser, cookies, dll).</li>
        </ul>
        <h2 class="text-xl font-semibold mt-6 mb-2">2. Penggunaan Informasi</h2>
        <ul class="list-disc pl-6 mb-4">
            <li>Untuk menyediakan dan meningkatkan layanan kami.</li>
            <li>Untuk menghubungi Anda terkait layanan atau promosi.</li>
            <li>Untuk keamanan dan pencegahan penipuan.</li>
        </ul>
        <h2 class="text-xl font-semibold mt-6 mb-2">3. Perlindungan Data</h2>
        <p class="mb-4">Kami menerapkan langkah-langkah keamanan teknis dan organisasi untuk melindungi data Anda dari
            akses tidak sah, perubahan, pengungkapan, atau penghancuran.</p>
        <h2 class="text-xl font-semibold mt-6 mb-2">4. Hak Anda</h2>
        <ul class="list-disc pl-6 mb-4">
            <li>Anda dapat meminta akses, koreksi, atau penghapusan data pribadi Anda.</li>
            <li>Anda dapat menolak penggunaan data untuk tujuan pemasaran.</li>
        </ul>
        <h2 class="text-xl font-semibold mt-6 mb-2">5. Perubahan Kebijakan</h2>
        <p class="mb-4">Kami dapat memperbarui kebijakan ini dari waktu ke waktu. Perubahan akan diumumkan di halaman
            ini.</p>
        <h2 class="text-xl font-semibold mt-6 mb-2">6. Kontak</h2>
        <p>Jika Anda memiliki pertanyaan tentang kebijakan privasi ini, silakan hubungi kami melalui halaman kontak.</p>
    </div>
</div>
@endsection
