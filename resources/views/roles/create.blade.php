@extends('layouts.app')

@section('meta-title')
    Create a Role
@endsection

@section('header')
    Create a Role
@endsection

@section('content')
    <div class="flex flex-col mb-1 bg-white rounded p-6">
        <form action="{{ route('roles.store') }}" method="post">
            @csrf
            <x-form.input
                label="Choose a role name"
                name="name"
                type="text"
                placeholder="Role's name"
                value="{{ old('name') }}"
                required
            />
            <x-form.input
                label="Choose an associate slug"
                name="slug"
                type="text"
                placeholder="Role's slug"
                value="{{ old('slug') }}"
                helper="No space or special caracters please, use dash instead."
                required
            />
            {{-- {{ dd($permissions) }} --}}
            <x-form.select
                label="You can choose some permissions already created"
                name="permissions[]"
                helper="You can add permissions later."
                multiple>
                @foreach ($permissions as $item)
                    <option value="{{ $item->id }}" {{ old('permissions') ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </x-form.select>
            <x-form.button>Create</x-form.button>
        </form>
    </div>
@endsection

