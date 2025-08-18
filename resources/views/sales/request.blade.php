@extends('layouts.app')

@section('title', 'Request Sales Access')
@section('content')
<div class="max-w-lg mx-auto mt-16 bg-white rounded-xl shadow-lg p-8 text-center">
    <h2 class="text-2xl font-bold mb-4">Request to Become a Sales User</h2>
    <p class="mb-6 text-gray-600">You must be approved as a sales user to access the Sales Area. Submit your request below and an admin will review it.</p>
    @if(session('status'))
        <div class="mb-4 text-green-600 font-semibold">{{ session('status') }}</div>
    @endif
    <form method="POST" action="{{ route('sales.area.request') }}">
        @csrf
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition-all duration-200">
            Request Sales Access
        </button>
    </form>
</div>
@endsection
