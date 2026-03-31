<a {{ $attributes->merge([
        'class' => 'group relative inline-flex items-center gap-2 px-4 py-2.5 rounded-full transition-colors duration-150 ease-out font-bold text-[13px] tracking-tight border ' . ($active
            ? 'text-slate-900 border-black/[0.06]'
            : 'text-slate-600 border-transparent hover:border-black/[0.06] hover:text-slate-900 hover:bg-black/[0.03]'),
        'style' => $active ? 'background: rgba(229,164,17,0.14);' : '',
    ]) }}>
    @if(isset($icon))
        <svg class="w-[18px] h-[18px] flex-shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"></path>
        </svg>
    @endif
    <span>{{ $slot }}</span>
</a>