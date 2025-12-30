@props([
    'model' => null,
    'type' => 'text',
])



<input type="{{ $type }}" wire:model="{{ $model }}"
    class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300 font-medium">
<x-ui.form.error-input :model="$model" />
