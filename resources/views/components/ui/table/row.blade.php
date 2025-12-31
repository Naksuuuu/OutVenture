@props(['class' => ''])

<tr {{ $attributes->merge(['class' => 'hover:bg-slate-50/50 transition-colors group ' . $class]) }}>
  {{ $slot }}
</tr>