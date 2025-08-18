@extends('layouts.app')

@section('title', 'Sales Area Login')
@section('content')
<div class="max-w-lg mx-auto mt-16 bg-white rounded-xl shadow-lg p-8">
    <h2 class="text-2xl font-bold mb-4 text-center">Sales Area Access</h2>
    <p class="mb-6 text-gray-600 text-center">Log in to access the Sales Area.</p>
    <div class="grid grid-cols-1 gap-8">
        <div>
            @include('auth.login-form', ['hideReferral' => true])
        </div>
    </div>
</div>
@endsection
