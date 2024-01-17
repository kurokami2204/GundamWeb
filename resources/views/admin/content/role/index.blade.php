@extends('admin.app')

@section('title')
<title>Role</title>
@endsection

@section('content')
<div class="flex-1 h-full overflow-x-hidden overflow-y-auto ">
    @include('admin.components.header')
    <main>
        <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
            <h1 class="text-2xl font-semibold">Role</h1>
        </div>
        <!-- Content -->
        <div>
            <div class="mt-2 mb-10">
                <div class="overflow-x-auto flex flex-col">
                    @can('create role')
                        <div class="flex flex-row-reverse">
                            <div class="m-6">
                                <a href="{{ route('admin.role.add') }}"
                                    class="font-bold py-2 px-4 border-2 rounded-lg text-black focus:outline-none focus:shadow-outline hover:bg-white"
                                    type="button">
                                    Thêm chức vụ
                                </a>
                            </div>
                        </div>
                    @endcan
                    <div class=" w-11/12  mx-auto mx-8 bg-green-700  table-auto">
                        @if(session()->has('success'))

                            <div class="bg-green-300 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                                <div class="flex">
                                <div class="py-1"><i class=" fas fa-check-circle fill-current h-6 w-6 text-green-700 mr-4"> </i></div>

                                <div>

                                    <p class="text-lg">{{ session()->get('success') }}</p>
                                </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class=" w-11/12  mx-auto mx-8 bg-red-700  table-auto">
                        @if(session()->has('failed'))

                            <div class="bg-red-300 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md" role="alert">
                                <div class="flex">
                                <div class="py-1"><i class=" fas fa-check-circle fill-current h-6 w-6 text-red-700 mr-4"> </i></div>

                                <div>

                                    <p class="text-lg">{{ session()->get('failed') }}</p>
                                </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div>
                        <div class=" w-11/12  mx-auto mx-8  table-fixed pb-5">
                            {{ $roles->links() }}
                        </div>
                        <table class=" w-11/12  mx-auto mx-8  table-fixed">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 text-center">Chức vụ</th>
                                    <th class="py-3 text-center" colspan="4">Quyền hạn</th>
                                    <th class="py-3 text-center">Ngày cập nhật</th>

                                </tr>
                            </thead>
                            <tbody class="text-sm font-light">
                                @foreach($roles as $role)
                                    <tr class="border-b border-gray-200">
                                        <td class="py-3 text-center">
                                            <div class="text-center">
                                                <span class="font-medium text-center">{{$role->name}}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 text-center" colspan="4">
                                            <div class="flex items-center">
                                                @if(auth()->user()->can('change role permission'))
                                                    <span class="font-medium flex flex-wrap">
                                                        @foreach ($role->permissions as $permission)
                                                            <a href="{{ route('admin.role.removePermission', ['id_role' => $role->id, 'id_permission' => $permission->id]) }}" class="tag m-1">
                                                                <i class="fa-solid fa-shield pr-0.5"></i> {{ ucfirst($permission->name) }}
                                                                <span class="tag-close">×</span>
                                                            </a>
                                                        @endforeach
                                                        <div class="tag m-1" onclick="openModal( {{ $role->id }} )">
                                                            Thêm mới
                                                            <span class="tag-close">+</span>
                                                        </div>
                                                    </span>

                                                    @include('admin.components.role-add-permission-modal')
                                                @else
                                                    <span class="font-medium grid grid-cols-3 gap-3 items-center justify-center">
                                                        @foreach ($role->permissions as $permission)
                                                            <div class="border border-orange-600 rounded-3xl bg-orange-600 px-2 py-2 cursor-default hover:bg-white hover:text-orange-600">
                                                                <i class="fa-solid fa-shield pr-0.5"></i> {{ ucfirst($permission->name) }}
                                                            </div>
                                                        @endforeach
                                                    </span>
                                                @endif

                                            </div>
                                        </td>
                                        <td class="py-3 text-center">
                                            <div class="text-center">
                                                <span class="font-medium">{{$role->updated_at}}</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <script src="{{ asset('js/backend/manager/modal.js') }}"></script>
                    </div>
            </div>
        </div>
    </main>
    @include('admin.components.footer')
</div>
@include('admin.components.panel')
@endsection
