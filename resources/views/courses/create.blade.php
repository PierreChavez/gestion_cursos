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
                    <h1>Create Course</h1>
                    <form action="{{ route('courses.store') }}" method="POST">
                        @csrf
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" required>
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" required></textarea>
                        <label for="duration">Duration:</label>
                        <input type="text" id="duration" name="duration" required>
                        <label for="modality">Modality:</label>
                        <select id="modality" name="modality" required>
                            <option value="presencial">Presencial</option>
                            <option value="online">Online</option>
                        </select>
                        <label for="teacher_id">Teacher:</label>
                        <select id="teacher_id" name="teacher_id" required>
                            @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
