@extends('layouts.test')

@section('content')
<div class="container mx-auto my-10">
    <h1 class="text-3xl font-bold text-center mb-6">Sync Permissions to Role</h1>

    @if (session('success'))
    <div class="bg-green-500 text-white p-4 rounded-lg mb-4" role="alert">
        {{ session('success') }}
        <button type="button" class="float-right text-white hover:text-gray-200"
            onclick="this.parentElement.style.display='none'">
            &times;
        </button>
    </div>
    @endif

    @if ($errors->any())
    <div class="bg-red-500 text-white p-4 rounded-lg mb-4" role="alert">
        <strong>Whoops!</strong> There were some problems with your input.
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="float-right text-white hover:text-gray-200"
            onclick="this.parentElement.style.display='none'">
            &times;
        </button>
    </div>
    @endif

    <form action="{{ route('permissions.sync') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        <div class="mb-4">
            <label for="role" class="block text-gray-700 font-semibold mb-2">Select Role</label>
            <select
                class="form-select block w-full border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-300"
                id="role" name="role_id" required>
                <option value="" disabled selected>Choose a role</option>
                @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="permissions" class="block text-gray-700 font-semibold mb-2">Select Permissions</label>
            <select
                class="form-select block w-full border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-300"
                id="permissions" name="permissions[]" multiple required>
                @foreach ($permissions as $permission)
                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit"
            class="w-full bg-blue-500 text-black font-bold py-2 rounded-lg hover:bg-blue-600 transition duration-200">
            Sync Permissions
        </button>
    </form>
</div>
@endsection
