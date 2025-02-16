<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Course Module') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-form :action="route('course_modules.store')" method="POST"
                            :fields="[
                                ['name' => 'course_id', 'label' => 'Course', 'type' => 'select', 'icon' => 'book', 'required' => true, 'options' => $courses->pluck('name', 'id')->toArray()],
                                ['name' => 'title', 'label' => 'Title', 'type' => 'text', 'icon' => 'book', 'required' => true],
                                ['name' => 'type', 'label' => 'Type', 'type' => 'select', 'icon' => 'tag', 'required' => true, 'options' => ['lesson' => 'Lesson', 'exam' => 'Exam']],
                                ['name' => 'content', 'label' => 'Content', 'type' => 'textarea', 'icon' => 'info'],
                                ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'icon' => 'info']
                            ]">
                        Create
                    </x-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
