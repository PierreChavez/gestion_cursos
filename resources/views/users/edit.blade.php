<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-form :action="route('users.update', $user)" method="PUT" :fields="[
                                                        ['name' => 'name', 'label' => 'Name', 'type' => 'text', 'icon' => 'user', 'required' => true, 'value' => $user->name],
                                                        ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'icon' => 'envelope', 'required' => true, 'value' => $user->email],
                                                        ['name' => 'role', 'label' => 'Role', 'type' => 'select', 'icon' => 'user-tag', 'required' => true, 'value' => $user->roles->pluck('name')->first(), 'options' => ['admin' => 'Admin', 'teacher' => 'Teacher', 'student' => 'Student']]
                                                    ]">
                        Update
                    </x-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
