@props(['model' => null])


<div class="relative group">
    <select @if ($model) wire:model="{{ $model }}" @endif {{ $attributes->merge(['class' => 'w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-black-500/20 focus:bg-white transition-all duration-300 font-medium']) }}>

        {{ $slot }}

    </select>

    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none  ">
        <x-lucide-chevron-down
            class="w-4 h-4 text-slate-400 group-focus-within:rotate-180 transition-all duration-200" />
    </div>

</div>
<x-ui.form.error-input :model="$model" />