@extends('layouts.test')

@section('content')
<div class="container mx-auto my-2">
    <h1 class="text-3xl font-bold mb-4">Create Permission</h1>

    @if(session('success'))
    <div class="bg-green-500 text-black p-4 rounded mb-4">
        {{ session('success') }}
    </div>
    @elseif(session('error'))
    <div class="bg-red-500 text-red p-4 rounded mb-4">
        {{ session('error') }}
    </div>
    @endif

    <form action="{{ route('spatie.permissions.store') }}" method="POST"
        class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="name">
                Permission Name
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror"
                id="name" name="name" type="text" placeholder="Enter permission name" value="{{ old('name') }}"
                required>

            @error('name')
            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex items-center justify-between">
            <button
                class="bg-blue-500 hover:bg-blue-700 text-red font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="submit">
                Create Permission
            </button>
        </div>
    </form>
</div>
@endsection
