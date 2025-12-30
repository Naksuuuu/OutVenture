<x-ui.modal.form wire:model="isOpen" title="Tambah Varian" submit-action="save" submit-label="Simpan Varian"
    submit-variant="create" wire-key="variant-create">

    <x-slot:trigger>
        <x-ui.button variant="create-ghost" label="Varian Warna" icon="plus" class=" w-full md:w-auto" />
    </x-slot:trigger>

    <div>
        <label class="block text-xs font-bold mb-2 uppercase tracking-wider text-slate-500">
            Warna
        </label>
        <select wire:model="id_color" required
            class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 font-bold text-sm transition-all @error('id_color') ring-2 ring-red-500/50 @enderror">
            <option value="">Pilih warna</option>
            @foreach ($colors as $color)
                <option value="{{ $color->id }}">{{ $color->nama_warna }}</option>
            @endforeach
        </select>
        @error('id_color')
            <span class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label class="block text-xs font-bold mb-2 uppercase tracking-wider text-slate-500">
            Gambar Varian
        </label>
        <input type="file" wire:model="image" accept="image/*"
            class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-2 text-slate-800 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 cursor-pointer @error('image') ring-2 ring-red-500/50 @enderror">
        @error('image')
            <span class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</span>
        @enderror
    </div>

    @if ($image)
        <div class="mt-2 p-2 bg-slate-50 rounded-2xl border border-dashed border-slate-300">
            <img src="{{ $image->temporaryUrl() }}" class="w-full h-44 object-cover rounded-xl shadow-sm" alt="Preview">
        </div>
    @endif
</x-ui.modal.form>