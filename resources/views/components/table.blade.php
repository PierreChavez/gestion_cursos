<!-- resources/views/components/table.blade.php -->
@props(['headers', 'rows'])

<table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 mt-3">
    <thead class="bg-gray-50 dark:bg-gray-800">
    <tr>
        @foreach($headers as $header)
        <th scope="col"
            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
            {{ $header }}
        </th>
        @endforeach
    </tr>
    </thead>
    <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
    @foreach($rows as $row)
    <tr>
        @foreach($row as $cell)
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
            {!! $cell !!}
        </td>
        @endforeach
    </tr>
    @endforeach
    </tbody>
</table>
