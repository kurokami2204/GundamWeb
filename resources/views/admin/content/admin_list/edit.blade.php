@extends('admin.app')

@section('title')
<title>Admin accounts</title>
@endsection

@section('content')
<div class="flex-1 h-full overflow-x-hidden overflow-y-auto ">
    @include('admin.components.header')
    <main>
        <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
            <h1 class="text-2xl font-semibold">Admin accounts | Add</h1>
        </div>
        <!-- Content -->
        <div>
            <form class=" rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{route('admin.adminList.update', ['id' => $admin->id])}}" enctype="multipart/form-data" >
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2" >
                        Họ tên đầy đủ
                        <span class=" text-base">*</span>
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3
                                leading-tight focus:outline-none focus:shadow-outline text-dark"
                    id="name" name="name" type="text" placeholder="Nhập tên"
                    value="{{ $admin->name }}" required>
                </div>
                @error('name')
                <div style="color: red;">
                    {{$message}}
                </div>
                @enderror

                <div class="mb-6">
                    <label class="block  text-sm font-bold mb-2" >
                        Số điện thoại
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3
                                leading-tight focus:outline-none focus:shadow-outline text-dark"
                    id="phone_number" name="phone_number" type="number" minlength="10" maxlength="11"
                    value="{{ $admin->phone_number }}" placeholder="Nhập số điện thoại">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold mb-2" >
                        Tên đăng nhập
                        <span class=" text-base">*</span>
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3
                                leading-tight focus:outline-none focus:shadow-outline text-dark"
                            id="username" name="username" type="text" placeholder="Nhập tên đăng nhập"
                            value="{{ $admin->username }}" required>
                </div>
                @error('username')
                <div style="color: red;">
                    {{$message}}
                </div>
                @enderror

                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-6">
                        <label class="block  text-sm font-bold mb-3" >
                            Thay đổi mật khẩu
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3
                                    leading-tight focus:outline-none focus:shadow-outline text-dark"
                                id="password" name="password" type="password" placeholder="Nhập mật khẩu">
                    </div>
                    @error('password')
                    <div style="color: red;">
                        {{$message}}
                    </div>
                    @enderror

                    <div class="mb-6">
                        <label class="block  text-sm font-bold mb-3" >
                            Xác thực mật khẩu
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3
                                    leading-tight focus:outline-none focus:shadow-outline text-dark"
                                id="password_confirmation" name="password_confirmation" type="password" placeholder="Xác thực mật khẩu">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block  text-sm font-bold mb-2" >
                        Chức vụ
                        <span class=" text-base">*</span>
                    </label>
                    <select name="role" id="role" class="shadow appearance-none border rounded w-full py-2 px-3  leading-tight focus:outline-none focus:shadow-outline text-dark" required>
                        @foreach ($admin->getRoleNames() as $role)
                            <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                        @endforeach
                        <option value="">Chọn chức vụ</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="mt-3 mb-6">
                        <label class="block text-sm font-bold mb-3">
                            Avatar cũ
                        </label>
                        <div class="flex">
                            <img src="{{ asset('storage/admin_avatar') . '/' . $admin->username . '/' . $admin->linkImg }}" alt="">
                        </div>
                    </div>

                    <div class="mt-3 mb-6">
                        <label class="block text-sm font-bold mb-3">
                            Avatar mới
                        </label>
                        <div class="flex">
                            <div class="relative h-40 rounded-lg border-dashed border-2 border-black flex justify-center items-center hover:cursor-pointer">
                                <div class="absolute" id="ssn_front_container">
                                    <div class="flex flex-col items-center ">
                                        <i class="fas fa-cloud-upload-alt fa-3x text-gray-300"></i>
                                        <span class="block text-gray-400 font-normal">
                                            Attach you files here
                                        </span>
                                        <span class="block text-gray-400 font-normal">
                                            or
                                        </span>
                                        <span class="block text-blue-400 font-normal">
                                            Browse files
                                        </span>
                                    </div>
                                </div>
                                <input class="h-full w-full opacity-0" id="SSN_front" name="linkImg" type="file"
                                    onchange="ssn_front_select()">
                            </div>
                        </div>
                    </div>

                    <script src="{{ asset('js/ssnFrontPreview.js') }}"></script>
                </div>

                <div class="flex items-center justify-between">
                    <button class=" border-2 font-bold py-2 px-4 rounded-xl focus:outline-none focus:shadow-outline dark:hover:bg-primary-darker hover:bg-gray-300" type="submit">
                        Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </main>
    @include('admin.components.footer')
</div>
@include('admin.components.panel')
@endsection
