<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Attendance') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-form :action="route('attendances.store')" method="POST"
                            :fields="[
                                            ['name' => 'enrollment_id', 'label' => 'Enrollment', 'type' => 'select', 'icon' => 'book', 'required' => true, 'options' => $enrollments->mapWithKeys(function($enrollment) {
                                                return [$enrollment->id => $enrollment->student->name . ' - ' . $enrollment->course->name];
                                            })->toArray()],
                                            ['name' => 'date', 'label' => 'Date', 'type' => 'date', 'icon' => 'calendar', 'required' => true],
                                            ['name' => 'status', 'label' => 'Status', 'type' => 'select', 'icon' => 'status', 'required' => true, 'options' => ['present' => 'Present', 'late' => 'Late', 'absent' => 'Absent', 'early_leave' => 'Early Leave']],
                                            ['name' => 'comments', 'label' => 'Comments', 'type' => 'textarea', 'icon' => 'comments', 'required' => false]
                                        ]">
                        Create
                    </x-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
