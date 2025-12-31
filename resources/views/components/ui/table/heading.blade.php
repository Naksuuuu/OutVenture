@props(['sortable' => null, 'direction' => null, 'class' => ''])

<th {{ $attributes->merge(['class' => 'px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest ' . $class]) }}>
  {{ $slot }}
</th>