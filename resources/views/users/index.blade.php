@extends('layouts.app')

@section('meta-title')
    Users
@endsection

@section('header')
    Users
@endsection

@section('content')

<div class="flex justify-end items-center mb-4">
    <a href="#" class="flex items-center p-2 rounded bg-blue-500 text-white hover:bg-blue-400">
        <span class="mdi mdi-plus mr-2"></span>
        Create User
    </a>
</div>

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
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
        </tr>
        </thead>
        <tbody class="bg-white">
        @forelse ($users as $user)
            <tr>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    {{ $user->id }}
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    {{ $user->name }}
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <span
                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    {{ $user->email }}
                </span>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium">
                    <a href="#" class="bg-gray-200 p-2 rounded inline-flex text-indigo-600 hover:text-indigo-900 mr-2">
                        <span class="text-lg mdi mdi-pencil-outline"></span>
                    </a>
                    <a href="#" class="bg-gray-200 p-2 rounded inline-flex text-red-400 hover:text-red-600">
                        <span class="text-lg mdi mdi-delete-outline"></span>
                    </a>
                </td>
            </tr>
        @empty
            <tr>Nothing</tr>
        @endforelse
        </tbody>
    </table>
</div>

@endsection
