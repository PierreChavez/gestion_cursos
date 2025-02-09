<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Attendance Sheet for ') . $course->name . __(' on ') . $date }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-table :headers="['Student', 'Attendance Status', 'Comments']" :rows="$enrollments->map(function($enrollment) use ($date) {
                        $attendance = $enrollment->attendances->first();
                        return [
                            $enrollment->student->name,
                            $attendance ? $attendance->status : view('components.attendance-form', ['enrollment' => $enrollment, 'date' => $date])->render(),
                            $attendance ? $attendance->comments : ''
                        ];
                    })->toArray()"></x-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
