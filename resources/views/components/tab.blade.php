@props(['id', 'title', 'active' => false])

<li class="-mb-px mr-1">
    <a :class="{ 'border-blue-500 text-blue-500': activeTab === '{{ $id }}', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== '{{ $id }}' }"
       class="inline-block py-2 px-4 border-b-2 font-semibold cursor-pointer"
       @click="activeTab = '{{ $id }}'">{{ $title }}</a>
</li>
