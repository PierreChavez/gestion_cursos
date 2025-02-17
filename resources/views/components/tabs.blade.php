<div x-data="{ activeTab: new URLSearchParams(window.location.search).get('tab') || '{{ $activeTab ?? 'details' }}' }" x-init="$watch('activeTab', value => {
    const url = new URL(window.location);
    url.searchParams.set('tab', value);
    window.history.pushState({}, '', url);
})">
    <ul class="flex border-b">
        {{ $tabs }}
    </ul>
    <div class="tab-content">
        {{ $slot }}
    </div>
</div>
