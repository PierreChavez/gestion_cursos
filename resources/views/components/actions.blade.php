@props(['editRoute', 'deleteRoute', 'item'])

<a href="{{ route($editRoute, $item) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-600">
    <i class="fas fa-edit"></i> Edit
</a>
<form action="{{ route($deleteRoute, $item) }}" method="POST" class="inline-block">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-600 ml-2">
        <i class="fas fa-trash"></i> Delete
    </button>
</form>
