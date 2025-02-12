<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Resource') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-form :action="route('resources.update', $resource)" method="PUT" :fields="[
                                                ['name' => 'course_id', 'label' => 'Course', 'type' => 'select', 'options' => $courses->pluck('name', 'id'), 'value' => $resource->course_id, 'icon' => 'book', 'required' => true],
                                                ['name' => 'type', 'label' => 'Type', 'type' => 'text', 'value' => $resource->type, 'icon' => 'tag', 'required' => true],
                                                ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'value' => $resource->description, 'icon' => 'info'],
                                                ['name' => 'file', 'label' => 'File', 'type' => 'file', 'icon' => 'file-upload']
                                            ]">
                        {{ __('Update') }}
                    </x-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
