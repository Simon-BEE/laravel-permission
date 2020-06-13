@extends('layouts.app')

@section('meta-title')
    Edit a User : {{ $user->name }}
@endsection

@section('header')
    Edit a User : {{ $user->name }}
@endsection

@section('content')

    @if (!$user->hasRoles('admin'))
    <x-modal title="Are you sure ?">
        <p>Are you sure you want to delete this user?</p>
        <div class="mt-5 flex justify-end">
            <x-form.button classDiv="none" class="bg-gray-200 text-gray-700 hover:bg-gray-300" @click="isDialogOpen = false">Cancel</x-form.button>
            <x-form.form-button action="{{ route('users.destroy', $user) }}" method="DELETE" class="bg-red-500 text-white hover:bg-red-600">
                Delete this user
            </x-form.form-button>
        </div>
    </x-modal>
    @endif

    <div class="flex flex-col mb-1 bg-white rounded p-6 relative">

        @if (!$user->hasRoles('admin'))
        <x-form.button classDiv="absolute right-0 top-0 mt-2" class="text-red-500 hover:text-red-600 hover:bg-gray-200" @click="isDialogOpen = true;">
            <span class="text-lg mdi mdi-delete-outline"></span>
        </x-form.button>
        @endif
        <form action="{{ route('users.update', $user) }}" method="post">
            @csrf
            @method('PATCH')
            <x-form.input
                label="Choose a username"
                name="name"
                type="text"
                placeholder="Username"
                value="{{ old('name') ?? $user->name }}"
                required
            />

            <x-form.input
                label="Choose an email"
                name="email"
                type="email"
                placeholder="User's email"
                value="{{ old('email') ?? $user->email }}"
                helper="Need to be valid."
                required
            />

            @role('admin')
                <div class="flex flex-col md:flex-row items-baseline justify-between">
                    <div class="md:w-5/12">
                        <x-form.select
                            label="You can choose some roles already created"
                            name="roles[]"
                            helper="If fou choose Administrator, not need to add another role. Ctrl + click on item if you want unselect one."
                            required
                            multiple>
                            @foreach ($roles as $role)
                                <option value="{{ $role->slug }}" {{ $user->hasRoles($role->slug) ? 'selected' : '' }}>{{ $role->name }}</option>
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
                                <option value="{{ $permission->slug }}" {{ $user->hasPermissionTo($permission->slug) ? 'selected' : '' }}>{{ $permission->name }}</option>
                            @endforeach
                        </x-form.select>
                    </div>
                </div>
            @endrole

            <x-form.button>Edit</x-form.button>
        </form>
    </div>
@endsection

