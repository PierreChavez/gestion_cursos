<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Resource') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-form :action="route('resources.store')" :fields="[
                                ['name' => 'course_id', 'label' => 'Course', 'type' => 'select', 'options' => $courses->pluck('name', 'id'), 'icon' => 'book', 'required' => true],
                                ['name' => 'type', 'label' => 'Type', 'type' => 'text', 'icon' => 'tag', 'required' => true],
                                ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'icon' => 'info'],
                                ['name' => 'file', 'label' => 'File', 'type' => 'file', 'icon' => 'file-upload', 'required' => true]
                            ]">
                        {{ __('Create') }}
                    </x-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
