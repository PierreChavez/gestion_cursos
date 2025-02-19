<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Resources') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('resources.create') }}"
                       class="btn btn-primary inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">
                        <i class="fas fa-plus mr-2"></i> Create Resource
                    </a>
                    <x-table
                        :headers="['Type', 'URL', 'Description', 'Actions']"
                        :rows="$resources->map(function($resource) {
                          return [
                              $resource->type,
                              view('components.file-button', ['url' => $resource->url])->render(),
                              $resource->description,
                              view('components.actions', [
                                  'editRoute' => 'resources.edit',
                                  'deleteRoute' => 'resources.destroy',
                                  'item' => $resource
                              ])->render()
                          ];
                      })->toArray()"></x-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
