<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Course') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-form :action="route('courses.update', $course)" method="PUT" :fields="[
                                    ['name' => 'name', 'label' => 'Name', 'type' => 'text', 'icon' => 'book', 'required' => true, 'value' => $course->name],
                                    ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'icon' => 'info', 'required' => true, 'value' => $course->description],
                                    ['name' => 'modality', 'label' => 'Modality', 'type' => 'select', 'icon' => 'chalkboard-teacher', 'required' => true, 'value' => $course->modality, 'options' => ['presencial' => 'Presencial', 'online' => 'Online']],
                                    ['name' => 'start_date', 'label' => 'Start Date', 'type' => 'date', 'icon' => 'calendar-alt', 'required' => true, 'value' => $course->start_date],
                                    ['name' => 'end_date', 'label' => 'End Date', 'type' => 'date', 'icon' => 'calendar-alt', 'required' => true, 'value' => $course->end_date],
                                    ['name' => 'teacher_id', 'label' => 'Teacher', 'type' => 'select', 'icon' => 'user', 'required' => true, 'value' => $course->teacher_id, 'options' => $teachers->pluck('name', 'id')->toArray()]
                                ]">
                        Update
                    </x-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
