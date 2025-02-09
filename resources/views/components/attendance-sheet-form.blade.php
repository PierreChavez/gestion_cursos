@props(['courses'])

<form action="{{ route('attendances.sheet') }}" method="POST" class="flex items-center space-x-4">
    @csrf
    <div class="flex flex-col">
        <select name="course_id" id="course_id" required
                class="form-select block w-full mt-1 sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md">
            @foreach ($courses as $course)
                <option value="{{ $course->id }}">{{ $course->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="flex flex-col">
        <input type="date" name="date" id="date" required
               class="form-input block w-full mt-1 sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md">
    </div>
    <button type="submit"
            class="btn btn-primary inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-600 disabled:opacity-25 transition">
        <i class="fas fa-file-alt mr-2"></i> Generate Attendance Sheet
    </button>
</form>
