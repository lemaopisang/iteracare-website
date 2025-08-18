@extends('layouts.app')

@section('title', 'Page Not Found - Prife Indonesia')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-purple-50 flex items-center justify-center">
    <div class="max-w-md mx-auto text-center px-4">
        <div class="mb-8">
            <div class="w-32 h-32 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-search text-6xl text-blue-600"></i>
            </div>
            <h1 class="text-6xl font-bold text-gray-900 mb-4">404</h1>
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Page Not Found</h2>
            <p class="text-gray-600 mb-8">
                Sorry, the page you are looking for doesn't exist or has been moved.
            </p>
        </div>

        <div class="space-y-4">
            <a href="{{ route('home') }}"
               class="inline-block bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-purple-700 transition-all duration-200 transform hover:scale-105">
                <i class="fas fa-home mr-2"></i>Back to Home
            </a>

            <div class="flex justify-center space-x-4 text-sm">
                <a href="{{ route('testimonials') }}" class="text-blue-600 hover:text-blue-700">Testimonials</a>
                <span class="text-gray-400">|</span>
                <a href="{{ route('contact') }}" class="text-blue-600 hover:text-blue-700">Contact</a>
            </div>
        </div>
    </div>
</div>
@endsection

