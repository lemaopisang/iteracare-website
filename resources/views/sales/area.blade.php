@extends('layouts.app')

@section('title', 'Sales Area')
@section('content')
<div class="max-w-4xl mx-auto mt-16 bg-white rounded-xl shadow-md p-6 md:p-8">
    <h2 class="text-2xl md:text-3xl font-semibold mb-4">Welcome to the Sales Area</h2>
    <p class="text-gray-700 mb-4 leading-relaxed">You are logged in as a sales user. Here you can access exclusive resources and tools.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <div class="p-4 bg-gray-50 rounded-lg border border-gray-100">
            <h3 class="font-semibold text-lg mb-2">Quick Actions</h3>
            <ul class="space-y-2 text-sm text-gray-700">
                <li><a href="{{ route('sales.testimonials') }}" class="text-blue-600 hover:underline">Manage Testimonials</a></li>
                <li><a href="{{ route('sales.profile') }}" class="text-blue-600 hover:underline">Edit Profile</a></li>
            </ul>
        </div>

        <div class="p-4 bg-gray-50 rounded-lg border border-gray-100">
            <h3 class="font-semibold text-lg mb-2">Resources</h3>
            <p class="text-sm text-gray-700">Download product assets and guidelines for client outreach.</p>
        </div>
    </div>
</div>
@endsection
