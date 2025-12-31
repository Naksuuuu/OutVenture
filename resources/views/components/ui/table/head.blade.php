@props(['class' => ''])

<thead {{ $attributes->merge(['class' => 'bg-slate-50/50 border-b border-slate-100 ' . $class]) }}>
  {{ $slot }}
</thead>