<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-form :action="route('users.store')" method="POST"
                            :fields="[
                                      ['name' => 'name', 'label' => 'Name', 'type' => 'text', 'icon' => 'user', 'required' => true],
                                      ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'icon' => 'envelope', 'required' => true],
                                      ['name' => 'password', 'label' => 'Password', 'type' => 'password', 'icon' => 'lock', 'required' => true],
                                      ['name' => 'password_confirmation', 'label' => 'Confirm Password', 'type' => 'password', 'icon' => 'lock', 'required' => true],
                                      ['name' => 'role', 'label' => 'Role', 'type' => 'select', 'icon' => 'user-tag', 'required' => true, 'options' => ['admin' => 'Admin', 'teacher' => 'Teacher', 'student' => 'Student']]
                                  ]">
                        Create
                    </x-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
