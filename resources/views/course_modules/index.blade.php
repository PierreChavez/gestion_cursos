<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Course Modules') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('course_modules.create') }}"
                       class="btn btn-primary inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">
                        <i class="fas fa-plus mr-2"></i> Create Module
                    </a>
                    <x-table
                        :headers="['Title', 'Type', 'Course', 'Actions']"
                        :rows="$modules->map(function($module) {
                          return [
                              $module->title,
                              $module->type,
                              $module->course->name,
                              view('components.actions', [
                                  'viewRoute' => 'course_modules.show',
                                  'editRoute' => 'course_modules.edit',
                                  'deleteRoute' => 'course_modules.destroy',
                                  'item' => $module
                              ])->render()
                          ];
                      })->toArray()"></x-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
