@props(['model' => null, 'rows' => 3])

<textarea wire:model="{{ $model }}" rows="{{ $rows }}"
    class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-black/20 focus:bg-white transition-all duration-300 font-medium"></textarea>
<x-ui.form.error-input :model="$model" />
