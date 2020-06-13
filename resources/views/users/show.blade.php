@extends('layouts.app')

@section('meta-title')
    User: {{ $user->name }}
@endsection

@section('header')
    User: {{ $user->name }}
@endsection

@section('content')
    <div class="flex flex-col mb-1 bg-white rounded p-6">
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

