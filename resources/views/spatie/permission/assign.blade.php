@extends('layouts.test')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Assign Permission to Role</h1>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Whoops!</strong> There were some problems with your input.
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <form action="{{ route('permissions.assign') }}" method="POST" class="bg-light p-4 rounded shadow-sm">
        @csrf
        <div class="mb-3">
            <label for="role" class="form-label">Select Role</label>
            <select class="form-select" id="role" name="role_id" required>
                <option value="" disabled selected>Choose a role</option>
                @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="permission" class="form-label">Select Permission</label>
            <select class="form-select" id="permission" name="permission_id" required>
                <option value="" disabled selected>Choose a permission</option>
                @foreach ($permissions as $permission)
                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">Assign Permission</button>
    </form>
</div>
@endsection
