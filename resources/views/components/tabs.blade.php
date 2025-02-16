<div x-data="{ activeTab: '{{ $activeTab ?? 'details' }}' }">
    <ul class="flex border-b">
        {{ $tabs }}
    </ul>
    <div class="tab-content">
        {{ $slot }}
    </div>
</div>
