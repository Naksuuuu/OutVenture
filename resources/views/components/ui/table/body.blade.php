@props(['class' => ''])

<tbody {{ $attributes->merge(['class' => 'divide-y divide-slate-100 ' . $class]) }}>
  {{ $slot }}
</tbody>