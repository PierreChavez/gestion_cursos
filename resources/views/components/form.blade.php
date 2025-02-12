@props(['action' => '', 'method' => 'POST', 'fields', 'readonly' => false])

<form action="{{ $action }}" method="POST" class="space-y-6" enctype="multipart/form-data">
    @csrf
    @if(in_array($method, ['PUT', 'PATCH', 'DELETE']))
    @method($method)
    @endif

    @foreach($fields as $field)
    <div class="form-group">
        <label for="{{ $field['name'] }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ $field['label'] }}
        </label>
        <div class="mt-1 relative rounded-md shadow-sm">
            @if($field['type'] === 'select')
            <select name="{{ $field['name'] }}" id="{{ $field['name'] }}"
                    class="form-select block w-full mt-1 sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md"
                    {{ $field['required'] ?? false ? 'required' : '' }} {{ $readonly ? 'disabled' : '' }}>
            @foreach($field['options'] as $value => $option)
            <option value="{{ $value }}" {{ isset($field[
            'value']) && $field['value'] == $value ? 'selected' : '' }}>
            {{ $option }}
            </option>
            @endforeach
            </select>
            @elseif($field['type'] === 'file')
            <input type="file" name="{{ $field['name'] }}" id="{{ $field['name'] }}"
                   class="form-input block w-full sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md"
                   {{ $field['required'] ?? false ? 'required' : '' }} {{ $readonly ? 'disabled' : '' }}>
            @else
            <input type="{{ $field['type'] }}" name="{{ $field['name'] }}" id="{{ $field['name'] }}"
                   value="{{ $field['value'] ?? '' }}"
                   class="form-input block w-full sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md"
                   {{ $field['required'] ?? false ? 'required' : '' }} {{ $readonly ? 'readonly' : '' }}>
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <i class="fas fa-{{ $field['icon'] }} text-gray-400"></i>
            </div>
            @endif
        </div>
    </div>
    @endforeach

    @if(!$readonly)
    <button type="submit"
            class="btn btn-primary inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">
        <i class="fas fa-save mr-2"></i> {{ $slot }}
    </button>
    @endif
</form>
