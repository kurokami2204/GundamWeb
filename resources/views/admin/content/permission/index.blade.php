@extends('admin.app')

@section('title')
<title>Permission</title>
@endsection

@section('content')
<div class="flex-1 h-full overflow-x-hidden overflow-y-auto ">
    @include('admin.components.header')
    <main>
        <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
            <h1 class="text-2xl font-semibold">Permission</h1>
        </div>
        <!-- Content -->
        <div class=" h-screen">
            <div class="mt-2">
                <div class="overflow-x-auto flex flex-col">
                    @can('create permission')
                        <div class="flex flex-row-reverse">
                            <div class="m-6">
                                <a href="{{ route('admin.permission.add') }}"
                                    class="font-bold py-2 px-4 border-2 rounded-lg text-black focus:outline-none focus:shadow-outline hover:bg-white"
                                    type="button">
                                    Thêm quyền hạn
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
                            {{ $permissions->links() }}
                        </div>
                        <table class=" w-11/12  mx-auto mx-8  table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-center">Quyền hạn</th>
                                    <th class="py-3 px-6 text-center">Ngày tạo</th>
                                    <th class="py-3 px-6 text-center">Ngày cập nhật</th>
                                    {{-- <th class="py-3 px-6 text-center">Hành động</th> --}}
                                </tr>
                            </thead>
                            <tbody class="text-sm font-light">
                                @foreach($permissions as $permission)
                                <tr class="border-b border-gray-200 hover:bg-gray-100 hover:text-black">
                                    <td class="py-3 px-6 text-center">
                                        <div class="">
                                            <span class="font-medium">{{ ucfirst($permission->name) }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="">
                                            <span class="font-medium">{{$permission->created_at}}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="">
                                            <span class="font-medium">{{$permission->updated_at}}</span>
                                        </div>
                                    </td>
                                    {{-- <td class="py-3 px-6 text-left">
                                        <div class="flex item-center justify-center">

                                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <a href="" class="">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <a class="" href="" >
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td> --}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </main>
    @include('admin.components.footer')
</div>
@include('admin.components.panel')
@endsection
