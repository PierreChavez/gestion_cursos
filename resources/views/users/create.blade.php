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
                    <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="form-group">
                            <label for="name"
                                   class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="text" name="name" id="name"
                                       class="form-input block w-full sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md"
                                       required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email"
                                   class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="email" name="email" id="email"
                                       class="form-input block w-full sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md"
                                       required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="password" name="password" id="password"
                                       class="form-input block w-full sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md"
                                       required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation"
                                   class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm
                                Password</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                       class="form-input block w-full sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md"
                                       required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role"
                                   class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
                            <select name="role" id="role"
                                    class="form-select block w-full mt-1 sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md"
                                    required>
                                <option value="admin">Admin</option>
                                <option value="teacher">Teacher</option>
                                <option value="student">Student</option>
                            </select>
                        </div>
                        <button type="submit"
                                class="btn btn-primary inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">
                            <i class="fas fa-save mr-2"></i> Create
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
