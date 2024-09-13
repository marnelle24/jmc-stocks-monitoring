<div>
    <x-modal wire:model="isOpen">
        <div class="header">
            <div class="border-b-2 border-sky-700 bg-sky-600">
                <h2 class="text-lg p-4 font-bold text-white drop-shadow capitalize">
                    {{$uname}} | User Role & Permissions
                </h2>
            </div>
        </div>

        <div class="content p-8">
            <div class="flex justify-between">
                <p class="my-2 text-xl font-bold">Roles and Permissions of {!!$uname!!}</p>
                @can('Create Role')
                    <button wire:click="isAddNewRole" type="button" class="text-xs underline hover:-translate-y-1 duration-300 drop-shadow">
                        {{ !$isCreateNewRole ? 'Create New Role' : 'Show Existing User Role' }}
                    </button>
                @endcan
            </div>
            <br />
            <div class="flex gap-1">
                @if ($isCreateNewRole)
                <form wire:submit="addNewRole" class="w-full">
                    <div class="flex gap-1">
                        <x-input type="text" wire:model="newRole" class="placeholder:text-sm w-full" placeholder="New Role" />
                        <x-button type="submit">Add</x-button>
                    </div>
                    @error('newRole')
                        <p class="m-0 py-1 text-xs text-red-600">New role must not be empty</p>
                    @enderror
                </form>

                @else
                    <select wire:model.live.debounce.500ms="selectedRole" class="w-full capitalize focus:ring-0 focus:ring-gray-500 active:ring-gray-500">
                        @foreach ($allRoles as $key => $role)
                            <option value="{{$role->id}}" {{$role->id === $selectedRole ? 'selected' : ''}}>{{$role->name}}</option>
                        @endforeach
                    </select>
                    @can('Change Role')
                        <button 
                            wire:click="changeUserRole"
                            type="button" 
                            class="shadow uppercase bg-green-600 flex-inline w-[130px] hover:bg-green-700 transform duration-300 text-white p-1 text-xs">
                            Change Role
                        </button>
                    @endcan
                @endif
            </div>
            <br />
            <br />
            @can('Add Permission')
                <div class="mb-3">
                    <form wire:submit="addNewPermission" class="w-full">
                        <div class="flex gap-1">
                            <x-input 
                                type="search"
                                wire:model="newPermission"
                                class="placeholder:text-sm w-1/2"
                                placeholder="Add New Permission and Press Enter" 
                            />
                            <x-button type="submit" class="rounded-none">Add Permission</x-button>
                        </div>
                        @error('newPermission')
                            <p class="m-0 py-1 text-xs text-red-600">New permission must not be empty</p>
                        @enderror
                    </form>
                </div>
            @endcan
            <div class="border-b border-x">
                @foreach ($allPermissions as $permission )
                    <p class="border-t p-3 capitalize flex gap-3">
                        @if (in_array($permission['name'], $role_permissions))
                            <button {{ Auth::user()->can('Remove Permission') ? '' : 'disabled' }} wire:click="assignPermissionToRole({{$permission}})">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-green-600 w-5 h-5 hover:-translate-y-1 transform duration-300">
                                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        @else
                            <button {{ Auth::user()->can('Add Permission') ? '' : 'disabled' }} wire:click="assignPermissionToRole({{$permission}})">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hover:-translate-y-1 transform duration-300">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </button>
                        @endif
                        <span>
                            {!!$permission->name!!}
                        </span>
                    </p>
                @endforeach
            </div>
        </div>
    </x-modal>
</div>
