<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Course Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-form :fields="[
                                ['name' => 'name', 'label' => 'Name', 'type' => 'text', 'icon' => 'book', 'value' => $course->name],
                                ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'icon' => 'info', 'value' => $course->description],
                                ['name' => 'modality', 'label' => 'Modality', 'type' => 'select', 'icon' => 'chalkboard-teacher', 'value' => $course->modality, 'options' => ['presencial' => 'Presencial', 'online' => 'Online']],
                                ['name' => 'start_date', 'label' => 'Start Date', 'type' => 'date', 'icon' => 'calendar-alt', 'value' => $course->start_date],
                                ['name' => 'end_date', 'label' => 'End Date', 'type' => 'date', 'icon' => 'calendar-alt', 'value' => $course->end_date],
                                ['name' => 'teacher_id', 'label' => 'Teacher', 'type' => 'text', 'icon' => 'user', 'value' => $course->teacher->name]
                            ]" :readonly="true"></x-form>

                    <a href="{{ route('courses.edit', $course) }}"
                       class="btn btn-primary inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition mt-4">
                        <i class="fas fa-edit mr-2"></i> Edit
                    </a>

                    <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight mt-6">Resources</h3>

                    <x-table
                        :headers="['Description', 'URL']"
                        :rows="$course->resources->map(function($resource) {
                          return [
                              $resource->description,
                              view('components.file-button', ['url' => $resource->url])->render()
                          ];
                      })->toArray()"></x-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
