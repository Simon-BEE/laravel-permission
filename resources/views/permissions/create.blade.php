@extends('layouts.app')

@section('meta-title')
    Create a Permission
@endsection

@section('header')
    Create a Permission
@endsection

@section('content')
    <div class="flex flex-col mb-1 bg-white rounded p-6">
        <form action="{{ route('permissions.store') }}" method="post">
            @csrf
            <x-form.input
                label="Choose a permission name"
                name="name"
                type="text"
                placeholder="Permission's name"
                value="{{ old('name') }}"
                required
            />

            <x-form.input
                label="Choose an associate slug"
                name="slug"
                type="text"
                placeholder="Permission's slug"
                value="{{ old('slug') }}"
                helper="No space or special caracters please, use dash instead."
                required
            />

            <x-form.select
                label="You can choose some roles already created"
                name="roles[]"
                helper="Ctrl + click on item if you want unselect one."
                multiple>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{ old('roles') ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </x-form.select>

            <p class="mt-1 text-blue-400 text-sm font-semibold flex items-center">
                <span class="mdi mdi-information-outline text-xl mr-2"></span>
                Admin role is added by default.
            </p>

            <x-form.button>Create</x-form.button>
        </form>
    </div>
@endsection

