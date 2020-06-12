@extends('layouts.app')

@section('meta-title')
    Users
@endsection

@section('header')
    Users
@endsection

@section('content')

@role('admin')
    <div class="flex justify-end items-center mb-4">
        <a href="{{ route('users.create') }}" class="flex items-center p-2 rounded bg-orange-500 text-white hover:bg-orange-400">
            <span class="mdi mdi-plus mr-2"></span>
            Create User
        </a>
    </div>
@endrole

<x-modal title="Are you sure ?">
    <p>Are you sure you want to delete this user?</p>
    <div class="mt-5 flex justify-end">
        <x-form.button classDiv="none" class="bg-gray-200 text-gray-700 hover:bg-gray-300" @click="isDialogOpen = false">Cancel</x-form.button>
        <x-form.form-button action="#" method="DELETE" class="bg-red-500 text-white hover:bg-red-600" x-ref="modalUser">
            Delete this user
        </x-form.form-button>
    </div>
</x-modal>

<div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
    <table class="min-w-full">
        <thead class="bg-gray-100">
        <tr>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                style="text-align: start">
                ID
            </th>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                style="text-align: start">
                Name
            </th>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                style="text-align: start">
                Email
            </th>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                style="text-align: start">
                Roles
            </th>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
        </tr>
        </thead>
        <tbody class="bg-white">
        @forelse ($users as $user)
            <tr class="border-b border-gray-200">
                <td class="px-6 py-4 whitespace-no-wrap">
                    {{ $user->id }}
                </td>
                <td class="px-6 py-4 whitespace-no-wrap">
                    {{ $user->name }}
                </td>
                <td class="px-6 py-4 whitespace-no-wrap">
                    {{ $user->email }}
                </td>
                <td class="px-6 py-4 whitespace-no-wrap flex flex-wrap md:w-64">
                @foreach ($user->roles as $role)
                <span
                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                    {{ $role->name }}
                </span>
                @endforeach
                </td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium">
                    <a href="{{ route('users.show', $user) }}" class="bg-gray-200 p-2 rounded inline-flex text-green-400 hover:text-green-900 mr-2">
                        <span class="text-lg mdi mdi-eye"></span>
                    </a>
                    @can('update', $user)
                        <a href="{{ route('users.edit', $user) }}" class="bg-gray-200 p-2 rounded inline-flex text-orange-400 hover:text-orange-900 mr-2">
                            <span class="text-lg mdi mdi-pencil-outline"></span>
                        </a>
                        <x-form.button class="bg-gray-200 text-red-600 hover:bg-gray-300" classDiv="inline-block" @click="isDialogOpen = true; $refs.modalUser.action = '{{ route('users.destroy', $user) }}'">
                            <span class="text-lg mdi mdi-delete-outline"></span>
                        </x-form.button>
                    @endcan
                </td>
            </tr>
        @empty
            <tr>Nothing</tr>
        @endforelse
        </tbody>
    </table>
</div>

@endsection
