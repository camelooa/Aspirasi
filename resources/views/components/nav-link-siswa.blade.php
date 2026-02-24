<a {{ $attributes->merge(['class' => 'flex items-center gap-2 px-4 py-3 rounded-xl transition-all duration-300 font-bold text-sm ' . ($active ? 'bg-blue-600 text-white shadow-md' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-100')]) }}>
    @if(isset($icon))
    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"></path>
    </svg>
    @endif
    <span>{{ $slot }}</span>
</a>