@props(['class' => ''])

<td {{ $attributes->merge(['class' => 'px-6 py-4 ' . $class]) }}>
  {{ $slot }}
</td>