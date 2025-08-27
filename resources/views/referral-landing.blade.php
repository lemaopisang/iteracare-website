@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-purple-50">
    <div class="bg-white/90 rounded-2xl shadow-xl p-10 max-w-lg w-full text-center">
        <h2 class="text-3xl font-bold text-blue-700 mb-4">Sales Representative</h2>
        <div class="mb-6">
            <div class="text-2xl font-semibold text-gray-900 mb-2">{{ $user->name }}</div>
            <div class="text-gray-700 mb-1"><i class="fas fa-phone mr-2"></i>{{ $user->phone }}</div>
            <div class="text-gray-700 mb-1"><i class="fas fa-envelope mr-2"></i>{{ $user->email }}</div>
        </div>
        <div class="flex items-center justify-center gap-4">
            @if($user->whatsapp)
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $user->whatsapp ?? $user->phone) }}" target="_blank"
                class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-200 text-lg font-semibold">
                <i class="fab fa-whatsapp mr-2"></i>Hubungi via WhatsApp
            </a>
            @endif
            <a href="mailto:{{ $user->email ?? 'info@iteracare.com' }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200 text-lg font-semibold">
                <i class="fas fa-envelope mr-2"></i>Kirim Email
            </a>
        </div>
    </div>
</div>
@endsection
