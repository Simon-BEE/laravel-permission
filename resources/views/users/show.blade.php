@extends('layouts.app')

@section('meta-title')
    User: {{ $user->name }}
@endsection

@section('header')
    User: {{ $user->name }}
@endsection

@section('content')

    @if (!$user->hasRoles('admin'))
        @can('update', $user)
            <x-modal title="Are you sure ?">
                <p>Are you sure you want to delete this user?</p>
                <div class="mt-5 flex justify-end">
                    <x-form.button classDiv="none" class="bg-gray-200 text-gray-700 hover:bg-gray-300" @click="isDialogOpen = false">Cancel</x-form.button>
                    <x-form.form-button action="{{ route('users.destroy', $user) }}" method="DELETE" class="bg-red-500 text-white hover:bg-red-600">
                        Delete this user
                    </x-form.form-button>
                </div>
            </x-modal>
        @endcan
    @endif

    <div class="flex flex-col mb-1 bg-white rounded p-6 relative">
        @can('update', $user)
            <div class="absolute right-0 top-0 mt-2">
                <a href="{{ route('users.edit', $user) }}" class="p-2 rounded inline-flex text-orange-400 hover:bg-gray-200 mr-2">
                    <span class="text-lg mdi mdi-pencil-outline"></span>
                </a>
                @if (!$user->hasRoles('admin'))
                    <x-form.button class="text-red-600 hover:bg-gray-200" classDiv="inline-block" @click="isDialogOpen = true">
                        <span class="text-lg mdi mdi-delete-outline"></span>
                    </x-form.button>
                @endif
            </div>
        @endcan
        <div class="flex flex-col md:flex-row justify-around">
            <div class="img" style="width:300px;height:300px;">
                <img src="{{ asset('img/user_') . mt_rand(1,3) . '.jpg' }}" alt="User" class="w-full h-full object-cover rounded shadow-lg">
            </div>
            <div class="info text-right max-w-2xl">
                <div class="flex items-center justify-end">
                    <div class="">
                        <h2 class="text-xl font-semibold text-gray-700">{{ $user->name }}</h2>
                        <p class="-mt-2 text-xs text-gray-500">{{ $user->roles_string }}</p>
                    </div>
                    <div class="icon ml-3">
                        @if ($user->hasRoles('admin'))
                            <span class="mdi mdi-shield-check-outline text-4xl text-green-500"></span>
                        @elseif ($user->hasRoles('writer'))
                            <span class="mdi mdi-pencil-circle-outline text-4xl text-green-500"></span>
                        @elseif ($user->hasRoles('manager'))
                            <span class="mdi mdi-clipboard-check-outline text-4xl text-green-500"></span>
                        @elseif ($user->hasRoles('front-developer'))
                            <span class="mdi mdi-cellphone-link text-4xl text-green-500"></span>
                        @else
                            <span class="mdi mdi-folder-account-outline text-4xl text-green-500"></span>
                        @endif
                    </div>
                </div>
                <div class="mt-6 text-gray-600">
                    <div class="">
                        <p class="text-left">Permissions role:</p>
                        <ul>
                            @foreach ($user->getPermissionsThroughRole() as $roleName => $permissions)
                                <li class="text-sm text-gray-500 flex justify-between"><span class="text-gray-600 mr-2">{{ $roleName }} &rarr;</span> {{ $permissions }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @if ($user->permissions->isNotEmpty())
                        <div class="mt-2">
                            <p class="text-left">Additional permissions:</p>
                            <ul>
                                @foreach ($user->permissions as $permission)
                                    <li class="text-sm text-gray-500">&rarr; {{ $permission->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="mt-4 text-gray-600">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis ad quos recusandae architecto dignissimos iusto in culpa placeat? At impedit dolore ut deserunt soluta eveniet, laudantium omnis excepturi quos obcaecati est iste culpa nesciunt nulla quisquam pariatur ipsum veniam ratione natus eligendi in? Pariatur sit architecto expedita reiciendis iusto suscipit tempora, maiores alias quasi vitae accusantium eligendi modi perferendis cupiditate! Sunt recusandae eligendi amet sint dolorum laboriosam, ab quae magnam excepturi debitis nostrum nesciunt doloremque repudiandae nisi sapiente aliquid esse atque blanditiis quia obcaecati at quidem aliquam! Modi, accusantium eligendi eius, ea totam earum quas corrupti quam consectetur adipisci tenetur impedit consequuntur illo architecto blanditiis sunt tempora nihil facilis ipsum! Nihil amet ipsa, voluptas dicta similique quis excepturi hic necessitatibus quisquam recusandae iure tempore temporibus!
        </div>
    </div>
@endsection

