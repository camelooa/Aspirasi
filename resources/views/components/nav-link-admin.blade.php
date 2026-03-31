<a {{ $attributes->merge([
        'class' => 'group relative flex items-center gap-2 px-3.5 py-2 rounded-xl transition-all duration-200 font-bold text-[13px] tracking-tight border ' . ($active
            ? 'text-white shadow-sm border-black/[0.06]'
            : 'text-slate-500 border-transparent hover:border-black/[0.06] hover:text-slate-900 hover:bg-white/70'),
        'style' => $active ? 'background: var(--navy);' : '',
    ]) }}>
    @if(isset($icon))
        <svg class="w-[18px] h-[18px] flex-shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"></path>
        </svg>
    @endif
    <span>{{ $slot }}</span>

    @if($active)
        <span class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-1.5 h-1.5 rounded-full" style="background: var(--amber);"></span>
    @endif
</a>