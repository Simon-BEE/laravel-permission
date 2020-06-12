@extends('layouts.app')

@section('meta-title')
    Create a User
@endsection

@section('header')
    Create a User
@endsection

@section('content')
    <div class="flex flex-col mb-1 bg-white rounded p-6">
        <form action="{{ route('users.store') }}" method="post">
            @csrf
            <x-form.input
                label="Choose a username"
                name="name"
                type="text"
                placeholder="Username"
                value="{{ old('name') }}"
                required
            />

            <x-form.input
                label="Choose an email"
                name="email"
                type="email"
                placeholder="User's email"
                value="{{ old('email') }}"
                helper="Need to be valid."
                required
            />

            <div class="flex flex-col md:flex-row items-baseline justify-between">
                <div class="md:w-5/12">
                    <x-form.select
                        label="You can choose some roles already created"
                        name="roles[]"
                        helper="If fou choose Administrator, not need to add another role. Ctrl + click on item if you want unselect one."
                        required
                        multiple>
                        @foreach ($roles as $role)
                            <option value="{{ $role->slug }}" {{ old('roles') ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </x-form.select>
                </div>

                <div class="md:w-5/12">
                    <x-form.select
                        label="You can add some additionals permissions"
                        name="permissions[]"
                        helper="Permissions are automatically added via roles. But you can add others."
                        multiple>
                        @foreach ($permissions as $permission)
                            <option value="{{ $permission->slug }}" {{ old('permissions') ? 'selected' : '' }}>{{ $permission->name }}</option>
                        @endforeach
                    </x-form.select>
                </div>
            </div>

            <p class="mt-1 text-blue-400 text-sm font-semibold flex items-center">
                <span class="mdi mdi-key-variant text-xl mr-2"></span>
                Password will be generated automatically. A feature allows to send an email with it later.
            </p>

            <x-form.button>Create</x-form.button>
        </form>
    </div>
@endsection

