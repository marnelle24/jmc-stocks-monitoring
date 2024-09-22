<div class="grid grid-cols-3 gap-4 p-4">
    <div class="col-span-2">
        <div class="w-full p-6">
            <form class="w-full flex flex-col gap-4" wire:submit.prevent="submit">
                <!-- Name Field -->
                <div class="flex w-full gap-4">
                    <div class="w-1/2">
                        <x-label class="capitalize"> Name </x-label>
                        <x-input wire:model="name" placeholder="Name" class="w-full" />
                        <x-input-error for="name" />
                    </div>
            
                    <!-- Username Field -->
                    <div class="w-1/2">
                        <x-label for="username">Username</x-label>
                        <x-input wire:model="username" placeholder="username" class="w-full" />
                        <x-input-error for="username" />                    
                    </div>
                </div>
        
                <!-- Email Field -->
                <div class="w-full">
                    <x-label for="email">Email</x-label>
                    <x-input wire:model="email" placeholder="email" class="w-full" />
                    <x-input-error for="email" />                    
                </div>
        
                <!-- Password Field -->
                <div class="w-full">
                    <x-label for="password">Password</x-label>
                    <x-input type="password" id="password" wire:model="password" placeholder="email" class="w-full" />
                    <x-input-error for="password" />  
                </div>
        
                <!-- Confirm Password Field -->
                <div class="w-full">
                    <x-label for="password_confirmation">Confirm Password</x-label>
                    <x-input type="password" id="password_confirmation" wire:model="password_confirmation" placeholder="Confirm Email" class="w-full" />
                    <x-input-error for="password_confirmation" />  
                </div>
        
                <!-- Submit Button -->
                <div class="w-full mt-6">
                    <x-button type="submit">Create User</x-button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-span-1 p-4">
        <p class="text-sm text-gray-700 mb-1">Select User Accessibility</p>
        <div class="flex flex-col gap-4 mt-4">
            @foreach ($roles as $role)
                <div>
                    <input type="checkbox" id="role_{{ $role }}" value="{{ $role }}" wire:model="selectedRoles">
                    <label for="role_{{ $role }}" class="capitalize">{{ $role }}</label>
                </div>
            @endforeach
        </div>
    </div>
</div>
