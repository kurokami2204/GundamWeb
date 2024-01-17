@extends('admin.app')

@section('title')
<title>Admin accounts</title>
@endsection

@section('content')
<div class="flex-1 h-full overflow-x-hidden overflow-y-auto ">
    @include('admin.components.header')
    <main>
        <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
            <h1 class="text-2xl font-semibold">Admin accounts</h1>
        </div>
        <!-- Content -->
        <div class=" h-screen">
            <div class="mt-2">
                <div class="overflow-x-auto flex flex-col">
                    @can('create admin/staff')
                        <div class="flex flex-row-reverse">
                            <div class="m-6">
                                <a href="{{ route('admin.adminList.add') }}"
                                    class="font-bold py-2 px-4 border-2 rounded-lg text-black hover:bg-white focus:outline-none focus:shadow-outline"
                                    type="button">
                                    Thêm tài khoản
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
                    <div>
                        <div class=" w-11/12  mx-auto mx-8  table-auto pb-5">
                            {{ $admins->links() }}
                        </div>
                        <table class=" w-11/12  mx-auto mx-8  table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">Tên</th>
                                    <th class="py-3 px-6 text-center">Tên đăng nhập</th>
                                    <th class="py-3 px-6 text-center">Số điện thoại</th>
                                    <th class="py-3 px-6 text-center">Chức vụ</th>
                                    <th class="py-3 px-6 text-center">Thời gian tạo</th>
                                    <th class="py-3 px-6 text-center">Thời gian sửa</th>
                                    @if(auth()->user()->can('edit admin/staff') || auth()->user()->can('delete admin/staff'))
                                        <th class="py-3 px-6 text-center">Hành động</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody class="text-sm font-light">
                                @foreach($admins as $admin)
                                <tr class="border-b border-gray-200 hover:bg-gray-100 hover:text-black">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <div class="flex items-center">
                                            <span class="font-medium">{{ $admin->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div>
                                            <span class="font-medium">{{ $admin->username }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div>
                                            <span class="font-medium">{{ $admin->phone_number }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div>
                                            @foreach ($admin->getRoleNames() as $role)
                                                <span class="font-medium">{{ $role }}</span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <span class="font-medium">
                                            {{ $admin->created_at }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <span class="font-medium">
                                            {{ $admin->updated_at }}
                                        </span>
                                    </td>
                                    @if(auth()->user()->can('edit admin/staff') || auth()->user()->can('delete admin/staff'))
                                        <td class="py-3 px-6 text-left">
                                            <div class="flex item-center justify-center">
                                                @if(auth()->user()->can('edit admin/staff'))
                                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                        <a href="{{ route('admin.adminList.edit', ['id' => $admin->id]) }}" class="">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                                @if (auth()->user()->can('delete admin/staff'))
                                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                        <a class="" href="{{ route('admin.adminList.delete', ['id' => $admin->id]) }}">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                    @endcan
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('admin.components.footer')
</div>
@include('admin.components.panel')
@endsection
