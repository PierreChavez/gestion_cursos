<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Course') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-form :action="route('courses.store')" method="POST"
                            :fields="[
                                                  ['name' => 'name', 'label' => 'Name', 'type' => 'text', 'icon' => 'book', 'required' => true],
                                                  ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'icon' => 'info', 'required' => true],
                                                  ['name' => 'duration', 'label' => 'Duration', 'type' => 'text', 'icon' => 'clock', 'required' => true],
                                                  ['name' => 'modality', 'label' => 'Modality', 'type' => 'select', 'icon' => 'chalkboard-teacher', 'required' => true, 'options' => ['presencial' => 'Presencial', 'online' => 'Online']],
                                                  ['name' => 'teacher_id', 'label' => 'Teacher', 'type' => 'select', 'icon' => 'user', 'required' => true, 'options' => $teachers->pluck('name', 'id')->toArray()]
                                              ]">
                        Create
                    </x-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
