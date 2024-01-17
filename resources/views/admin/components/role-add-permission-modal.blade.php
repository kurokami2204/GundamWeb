<div id="modal-overlay-{{ $role->id }}" class="hidden modal-overlay z-50">
    <div id="modal-container-{{ $role->id }}" class="hidden modal-container mx-auto mt-20">
        <form class="w-full flex-col px-10 text-black" method="POST" action="{{ route('admin.role.updatePermissions', ['id_role' => $role->id]) }}">
            @csrf
            <div class="w-full pt-5 font-bold text-center">
                Thêm quyền hạn
            </div>
            <div class="w-full mt-5">
                @foreach ($all_permissions as $permission)
                    <div class="flex">
                        <input type="checkbox" name="add_permission[]" id="add_permission" value="{{ $permission->id }}"
                            @foreach ($role->permissions as $role_permission)
                                @if ($permission->name == $role_permission->name)
                                    checked="true"
                                @endif
                            @endforeach
                        >
                        <div class="pl-3">{{  ucfirst($permission->name) }}</div>
                    </div>
                @endforeach
            </div>
            <button class="bg-gray-700 text-white tex-4xl py-2 text-center font-medium mt-4 rounded-lg px-5 hover:bg-gray-400 hover:text-black"> Cập nhật </button>
        </form>
        <button class="close-btn" onclick="closeModal( {{ $role->id }} )"><i class="fas fa-times"></i></button>
    </div>
</div>
