<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Enrollment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-form :action="route('enrollments.store')" method="POST"
                            :fields="[
                                ['name' => 'course_id', 'label' => 'Course', 'type' => 'select', 'icon' => 'book', 'required' => true, 'options' => $courses->pluck('name', 'id')->toArray()],
                                ['name' => 'student_id', 'label' => 'Student', 'type' => 'select', 'icon' => 'user', 'required' => true, 'options' => $students->pluck('name', 'id')->toArray()]
                            ]">
                        Create
                    </x-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
