@extends('layouts.app')

@section('meta-title')
    Edit a Role : {{ $role->name }}
@endsection

@section('header')
    Edit a Role : {{ $role->name }}
@endsection

@section('content')
    @if ($role->slug !== 'admin')
        <x-modal title="Are you sure ?">
            <p>Are you sure you want to delete this role?</p>
            <div class="mt-5 flex justify-end">
                <x-form.button classDiv="none" class="bg-gray-200 text-gray-700 hover:bg-gray-300" @click="isDialogOpen = false">Cancel</x-form.button>
                <x-form.form-button action="{{ route('roles.destroy', $role) }}" method="DELETE" class="bg-red-500 text-white hover:bg-red-600">
                    Delete this role
                </x-form.form-button>
            </div>
        </x-modal>
    @endif

    <div class="flex flex-col mb-1 bg-white rounded p-6 relative">
        @if ($role->slug !== 'admin')
            <x-form.button classDiv="absolute right-0 top-0 mt-2" class="text-red-500 hover:text-red-600 hover:bg-gray-200" @click="isDialogOpen = true;">
                <span class="text-lg mdi mdi-delete-outline"></span>
            </x-form.button>
        @endif
        <form action="{{ route('roles.update', $role) }}" method="post">
            @csrf
            @method('PATCH')
            <x-form.input
                label="Choose a role name"
                name="name"
                type="text"
                placeholder="Role's name"
                value="{{ old('name') ?? $role->name }}"
                required
            />

            <x-form.input
                label="Choose an associate slug"
                name="slug"
                type="text"
                placeholder="Role's slug"
                value="{{ old('slug') ?? $role->slug }}"
                helper="No space or special caracters please, use dash instead."
                required
            />
            <x-form.select
                label="You can choose some permissions already created"
                name="permissions[]"
                helper="Ctrl + click on item if you want unselect one."
                multiple>
                @foreach ($permissions as $permission)
                    <option value="{{ $permission->id }}" {{ $role->hasPermission($permission->id) ? 'selected' : '' }}>{{ $permission->name }}</option>
                @endforeach
            </x-form.select>

            @if ($role->slug === 'admin')
                <p class="mb-1 text-red-400 text-sm font-semibold flex items-center">
                    <span class="mdi mdi-alert-circle text-xl mr-2"></span>
                    Admin role must have all permissions.
                </p>
            @endif

            <x-form.button>Edit</x-form.button>
        </form>
    </div>
@endsection

