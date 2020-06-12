@extends('layouts.app')

@section('meta-title')
    Edit a Permission : {{ $permission->name }}
@endsection

@section('header')
    Edit a Permission : {{ $permission->name }}
@endsection

@section('content')
    <x-modal title="Are you sure ?">
        <p>Are you sure you want to delete this permission?</p>
        <div class="mt-5 flex justify-end">
            <x-form.button classDiv="none" class="bg-gray-200 text-gray-700 hover:bg-gray-300" @click="isDialogOpen = false">Cancel</x-form.button>
            <x-form.form-button action="{{ route('permissions.destroy', $permission) }}" method="DELETE" class="bg-red-500 text-white hover:bg-red-600">
                Delete this permission
            </x-form.form-button>
        </div>
    </x-modal>

    <div class="flex flex-col mb-1 bg-white rounded p-6 relative">
        <x-form.button classDiv="absolute right-0 top-0 mt-2" class="text-red-500 hover:text-red-600 hover:bg-gray-200" @click="isDialogOpen = true;">
            <span class="text-lg mdi mdi-delete-outline"></span>
        </x-form.button>
        <form action="{{ route('permissions.update', $permission) }}" method="post">
            @csrf
            @method('PATCH')
            <x-form.input
                label="Choose a permission name"
                name="name"
                type="text"
                placeholder="Permission's name"
                value="{{ old('name') ?? $permission->name }}"
                required
            />

            <x-form.input
                label="Choose an associate slug"
                name="slug"
                type="text"
                placeholder="Permission's slug"
                value="{{ old('slug') ?? $permission->slug }}"
                helper="No space or special caracters please, use dash instead."
                required
            />

            <x-form.select
                label="You can choose some roles already created"
                name="roles[]"
                helper="Ctrl + click on item if you want unselect one."
                multiple>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{ $permission->hasRole($role->id) ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </x-form.select>

            <p class="mt-1 text-blue-400 text-sm font-semibold flex items-center">
                <span class="mdi mdi-information-outline text-xl mr-2"></span>
                Admin role is added by default.
            </p>

            <x-form.button>Edit</x-form.button>
        </form>
    </div>
@endsection

