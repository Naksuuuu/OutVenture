@props(['class' => ''])

<div class="overflow-x-auto">
  <table {{ $attributes->merge(['class' => 'w-full text-left border-collapse ' . $class]) }}>
    {{ $slot }}
  </table>
</div>