@extends('layouts.app')

@section('meta-title')
    Permissions
@endsection

@section('header')
    Permissions
@endsection

@section('content')

<div class="flex justify-end items-center mb-4">
    <a href="{{ route('permissions.create') }}" class="flex items-center p-2 rounded bg-blue-500 text-white hover:bg-blue-400">
        <span class="mdi mdi-plus mr-2"></span>
        Create Permission
    </a>
</div>

<x-modal title="Are you sure ?">
    <p>Are you sure you want to delete this permission?</p>
    <div class="mt-5 flex justify-end">
        <x-form.button classDiv="none" class="bg-gray-200 text-gray-700 hover:bg-gray-300" @click="isDialogOpen = false">Cancel</x-form.button>
        <x-form.form-button action="#" method="DELETE" class="bg-red-500 text-white hover:bg-red-600" x-ref="modalPermission">
            Delete this permission
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
                Slug
            </th>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
        </tr>
        </thead>
        <tbody class="bg-white">
        @forelse ($permissions as $permission)
            <tr>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    {{ $permission->id }}
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    {{ $permission->name }}
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <span
                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                    {{ $permission->slug }}
                </span>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium">
                    <a href="{{ route('permissions.edit', $permission) }}" class="bg-gray-200 p-2 rounded inline-flex text-blue-500 hover:text-indigo-900 mr-2">
                        <span class="text-lg mdi mdi-pencil-outline"></span>
                    </a>
                    <x-form.button class="bg-gray-200 text-red-600 hover:bg-gray-300" classDiv="inline-block" @click="isDialogOpen = true; $refs.modalPermission.action = '{{ route('permissions.destroy', $permission) }}'">
                        <span class="text-lg mdi mdi-delete-outline"></span>
                    </x-form.button>
                </td>
            </tr>
        @empty
            <tr>Nothing</tr>
        @endforelse
        </tbody>
    </table>
</div>

@endsection
