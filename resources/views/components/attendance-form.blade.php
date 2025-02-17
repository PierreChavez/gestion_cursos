@props(['enrollment', 'date'])

<form action="{{ route('attendances.store') }}" method="POST" class="inline-flex items-center space-x-2">
    @csrf
    <input type="hidden" name="enrollment_id" value="{{ $enrollment->id }}">
    <input type="hidden" name="date" value="{{ $date }}">
    <input type="hidden" name="course_id" value="{{ $enrollment->course_id }}">
    <input type="hidden" name="return_url" value="{{ url()->full() }}">
    <select name="status" required class="form-select block w-full sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md">
        <option value="present">Present</option>
        <option value="late">Late</option>
        <option value="absent">Absent</option>
        <option value="early_leave">Early Leave</option>
    </select>
    <input type="text" name="comments" placeholder="Comments" class="form-input block w-full sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md">
    <button type="submit" class="btn btn-primary inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-600 disabled:opacity-25 transition">
        <i class="fas fa-check mr-2"></i> Save
    </button>
</form>
