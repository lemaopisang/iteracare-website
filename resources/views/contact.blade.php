@extends('layouts.app')

@section('title', 'Kontak Kami - Prife Indonesia')
@section('description', 'Hubungi Prife Indonesia untuk pertanyaan seputar produk teknologi Terahertz dan solusi kesehatan.')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-purple-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Kontak Kami</h1>
            <p class="text-xl text-gray-600">Ada kendala? Hubungi tim kami melalui email resmi di bawah ini.</p>
        </div>
        <div class="flex justify-center">
            <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-lg">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Email Resmi</h2>
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-envelope text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Email</h3>
                        <p class="text-gray-600">info@prifeindonesia.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

