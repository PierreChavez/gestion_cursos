<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Grade') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-form :action="route('grades.store')" method="POST"
                            :fields="[
                                ['name' => 'course_module_id', 'label' => 'Course Module', 'type' => 'select', 'icon' => 'book', 'required' => true, 'options' => $courseModules->pluck('title', 'id')->toArray()],
                                ['name' => 'student_id', 'label' => 'Student', 'type' => 'select', 'icon' => 'user', 'required' => true, 'options' => $students->pluck('name', 'id')->toArray()],
                                ['name' => 'grade', 'label' => 'Grade', 'type' => 'number', 'icon' => 'star', 'required' => true, 'min' => 0, 'max' => 100],
                                ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'icon' => 'info']
                            ]">
                        Add
                    </x-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
