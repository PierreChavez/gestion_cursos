@props(['url'])

<a href="{{ $url }}" target="_blank" class="btn btn-secondary inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-200 active:bg-gray-600 disabled:opacity-25 transition">
    <i class="fas fa-file-download mr-2"></i> {{ __('View/Download') }}
</a>
