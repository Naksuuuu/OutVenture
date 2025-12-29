@props([
    'id' => null,
    'label' => '',
    'icon' => 'trash',
    'size' => 'size-4',
])


<button type="button" @click="$dispatch('open-delete-modal', { id: {{ $id ?? 'null' }}})"
    {{ $attributes->merge(['class' => 'p-2 hover:text-red-600 hover:bg-red-200 rounded-lg transition-colors']) }}>
    <x-dynamic-component :component="'lucide-' . $icon" :class="$size" />


    @if (isset($label))
        <span>{{ $label }}</span>
    @endif
</button>
