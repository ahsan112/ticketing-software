<x-app-layout>
    <x-container>
        <div>
            <x-split-grid>
                <x-slot name="left">
                    <x-heading>Personal Information</x-heading>
                    <p class="mt-1 text-sm text-gray-600">
                        This information will be displayed publicly so be careful what you share.
                    </p>
                </x-slot>
                <x-slot name="right">
                        <x-panel >
                            <form method="POST" action="{{ route('settings.update', $user) }}" >
                                @csrf
                                @method('PUT')
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <label for="first-name" class="block text-sm font-medium text-gray-700">Name</label>
                                        <input value="{{ $user->name }}" type="text" name="name" id="first-name" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>                        
                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="email-address" class="block text-sm font-medium text-gray-700">Email address</label>
                                        <input value="{{ $user->email }}" type="text" name="email" id="email-address" autocomplete="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                        
                                    
                                </div>
                                <div class="text-right">
                                    <x-button class="mt-8 justify-center w-fulls">update</x-button>                               
                                </div>
                            </form>
                        </x-panel>
                </x-slot>
            </x-split-grid>
            
            <x-split-grid class="mt-12">
                <x-slot name="left">
                    <x-heading>Password</x-heading>
                    <p class="mt-1 text-sm text-gray-600">
                        This information will be displayed publicly so be careful what you share.
                    </p>
                </x-slot>
                <x-slot name="right">
                    <x-panel >
                        <form method="POST" action="{{ route('settings.password', $user) }}">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-6 gap-6">                        
                                <div class="col-span-6 sm:col-span-6">
                                    <x-label>New Password</x-label>
                                    <x-input name="password" class="w-full mt-1" type="password"/>
                                </div>
                                <div class="col-span-6 sm:col-span-6">
                                    <x-label>Comfirm new Password</x-label>
                                    <x-input name="password_confirmation" class="w-full mt-1" type="password"/>
                                </div>
                            </div>
                            <div class="text-right">
                                <x-button class="mt-8 justify-center w-fulls">update</x-button>                               
                            </div>
                        </form>
                    </x-panel>
                </x-slot>
            </x-split-grid>

            @can('set-role')             
                <x-split-grid class="mt-12">
                    <x-slot name="left">
                        <x-heading>Role</x-heading>
                        <p class="mt-1 text-sm text-gray-600">
                            This information will be displayed publicly so be careful what you share.
                        </p>
                    </x-slot>
                    <x-slot name="right">
                            <x-panel >
                                <form method="POST" action="{{ route('users.role', $user) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="grid grid-cols-6 gap-6">                        
                                        <div class="col-span-6 sm:col-span-6">
                                            <x-label>Role</x-label>
                                           <x-role-select :selected="$user->role" />
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <x-button class="mt-8 justify-center w-fulls">update</x-button>                               
                                    </div>
                                </form>
                            </x-panel>
                    </x-slot>
                </x-split-grid>
            @endcan
        </div>
    </x-container>
</x-app-layout>