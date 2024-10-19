@extends('layouts.test')

@section('content')
<div class="container mx-auto my-10">
    <h1 class="text-3xl font-bold text-center mb-6">User Permissions</h1>

    <h3 class="text-xl font-semibold mb-4">User: {{ $user->name }}</h3>

    <div class="mb-6">
        <h4 class="text-lg font-semibold">Roles:</h4>
        <ul class="list-disc pl-5">
            @foreach ($roles as $role)
            <li class="text-gray-700">{{ $role }}</li>
            @endforeach
        </ul>
    </div>

    <div class="mb-6">
        <h4 class="text-lg font-semibold">Direct Permissions:</h4>
        <ul class="list-disc pl-5">
            @foreach ($directPermissions as $permission)
            <li class="text-gray-700">{{ $permission->name }}</li>
            @endforeach
        </ul>
    </div>

    <div class="mb-6">
        <h4 class="text-lg font-semibold">Permissions via Roles:</h4>
        <ul class="list-disc pl-5">
            @foreach ($permissionsViaRoles as $permission)
            <li class="text-gray-700">{{ $permission->name }}</li>
            @endforeach
        </ul>
    </div>

    <div class="mb-6">
        <h4 class="text-lg font-semibold">All Permissions:</h4>
        <ul class="list-disc pl-5">
            @foreach ($allPermissions as $permission)
            <li class="text-gray-700">{{ $permission->name }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
