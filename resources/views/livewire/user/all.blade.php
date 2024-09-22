<div>

    <table class="w-full table-fixed">
        <thead>
            <tr>
                <td class="p-4 border-y border-gray-300 bg-gray-300/70 font-bold">Name</td>
                <td class="p-4 border-y border-gray-300 bg-gray-300/70 font-bold">Username</td>
                <td class="p-4 border-y border-gray-300 bg-gray-300/70 font-bold">Email</td>
                <td class="p-4 border-y border-gray-300 bg-gray-300/70 font-bold">Role</td>
                <td class="p-4 border-y border-gray-300 bg-gray-300/70 font-bold">&nbsp;</td>
            </tr>
        </thead>
        <tbody>
            @foreach ( $this->users as $user )
                <tr class="hover:bg-gray-100">
                    <td class="p-4 border-y border-gray-300">{{$user->name}}</td>
                    <td class="p-4 border-y border-gray-300">{{$user->username}}</td>
                    <td class="p-4 border-y border-gray-300">{{$user->email}}</td>
                    <td class="p-4 border-y border-gray-300">
                        @if (count($user->roles))
                            @foreach ($user->roles as $role)
                                <span
                                    class="{{ $role->name === 'admin' ? 'bg-green-600' : ($role->name === 'administrator' ? 'bg-red-600' : 'bg-yellow-600') }} text-md rounded-full px-2.5 m-0.5 py-1 drop-shadow text-sm capitalize text-white text-left">
                                    {{$role->name}}
                                </span>
                            @endforeach
                        @endif
                    </td>
                    <td class="p-4 border-y border-gray-300">
                        <div class="flex gap-1 justify-end">
                            <button wire:click="$dispatch('openRolePermissionModal', { 'user': {{$user}} } )" class="py-2 px-3 hover:-translate-y-0.5 transform duration-300 shadow-md text-xs bg-blue-600 hover:bg-blue-700 text-white">Role & Permissions</button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @livewire('user.role-and-permissions')
    <br />
    <div class="p-3">
        {{ $this->users->links('vendor.livewire.custom-pagination') }}
    </div>
</div>
