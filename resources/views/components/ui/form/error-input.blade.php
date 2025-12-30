@props([
    'model' => 'model',
])

@error($model)
    <span class="text-red-600 text-xs mt-1 italic">{{ $message }}</span>
@enderror
