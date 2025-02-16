@props(['id', 'active' => false])

<div x-show="activeTab === '{{ $id }}'" class="p-4">
    {{ $slot }}
</div>
