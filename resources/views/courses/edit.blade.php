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

                    <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight mt-6">Resources</h3>

                    <div x-data>
                        <button type="button"
                                class="btn btn-primary inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition"
                                x-on:click="$dispatch('open-modal', 'resourceModal')">
                            <i class="fas fa-plus mr-2"></i> ADD RESOURCE
                        </button>
                    </div>

                    <x-modal name="resourceModal">
                        <x-form :action="route('resources.store')" method="POST" :fields="[
                        ['name' => 'return_url', 'type' => 'hidden', 'value' => url()->current()],
                        ['name' => 'course_id', 'type' => 'hidden', 'value' => $course->id],
                        ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'icon' => 'info'],
                        ['name' => 'type', 'label' => 'Type', 'type' => 'text', 'icon' => 'tag', 'required' => true],
                        ['name' => 'file', 'label' => 'File', 'type' => 'file', 'icon' => 'file-upload', 'required' => true]
                    ]">
                            Save
                        </x-form>
                    </x-modal>

                    <x-table
                        :headers="['Description', 'URL', 'Actions']"
                        :rows="$course->resources->map(function($resource) {
                          return [
                              $resource->description,
                              view('components.file-button', ['url' => $resource->url])->render(),
                              view('components.actions', [
                                  'editRoute' => 'resources.edit',
                                  'deleteRoute' => 'resources.destroy',
                                  'item' => $resource,
                                  'return_url' => url()->current()
                              ])->render()
                          ];
                      })->toArray()"></x-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
