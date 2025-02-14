@props(['viewRoute' => null, 'editRoute' => null, 'deleteRoute' => null, 'item', 'return_url' => null])

@if(isset($viewRoute))
    <a href="{{ route($viewRoute, $item) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-600">
        <i class="fas fa-eye"></i> View
    </a>
@endif

@if(isset($editRoute))
    <a href="{{ route($editRoute, $item) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-600 ml-2">
        <i class="fas fa-edit"></i> Edit
    </a>
@endif

@if(isset($deleteRoute))
    <form action="{{ route($deleteRoute, $item) }}" method="POST" class="inline-block">
        @csrf
        @method('DELETE')
        @if($return_url)
        <input type="hidden" name="return_url" value="{{ $return_url }}">
        @endif
        <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-600 ml-2">
            <i class="fas fa-trash"></i> Delete
        </button>
    </form>
@endif
