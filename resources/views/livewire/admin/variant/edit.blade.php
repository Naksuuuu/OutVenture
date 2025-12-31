<x-ui.modal.form wire:model="isOpen" title="Edit Varian"
  subtitle="Varian: {{ $variant->color->nama_warna ?? 'Tanpa Warna' }}" submit-action="save"
  submit-label="Simpan Perubahan" submit-variant="update" wire-key="variant-edit-{{ $variant->id }}">

  <x-slot:trigger>
    <x-ui.button variant="edit" size="md" icon="pencil" />
  </x-slot:trigger>

  <div>
    <label class="block text-xs font-bold mb-2 uppercase tracking-wider text-slate-500">
      Warna
    </label>
    <select wire:model="id_color"
      class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 font-bold text-sm transition-all @error('id_color') ring-2 ring-red-500/50 @enderror">
      <option value="">Pilih warna</option>
      @foreach ($colors as $color)
        @php
          $isUsed = in_array($color->id, $usedColorIds);
          // Warna milik sendiri tidak disabled
          $disabled = $isUsed && $color->id != $variant->id_color;
        @endphp
        <option value="{{ $color->id }}" @if($disabled) disabled @endif>
          {{ $color->nama_warna }} @if($disabled) (Sudah dipakai) @endif
        </option>
      @endforeach
    </select>
    @error('id_color')
      <span class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</span>
    @enderror
    @if ($variant->specs()->exists())
      <p class="text-[10px] text-amber-500 mt-2 font-medium">
        *Warna tidak dapat diubah karena varian ini memiliki stok spesifikasi.
      </p>
    @endif
  </div>

  <div>
    <label class="block text-xs font-bold mb-2 uppercase tracking-wider text-slate-500">
      Update Gambar
    </label>
    <input type="file" wire:model="image" accept="image/*"
      class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-2 text-slate-800 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 cursor-pointer @error('image') ring-2 ring-red-500/50 @enderror">
    @error('image')
      <span class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</span>
    @enderror
  </div>

  <div class="mt-2 p-2 bg-slate-50 rounded-2xl border border-dashed border-slate-300">
    @if ($image)
      <p class="text-[10px] font-bold text-indigo-500 mb-2 uppercase text-center">Preview Baru</p>
      <img src="{{ $image->temporaryUrl() }}" class="w-full h-44 object-cover rounded-xl shadow-sm" alt="Preview">
    @elseif($old_image)
      <p class="text-[10px] font-bold text-slate-400 mb-2 uppercase text-center">Gambar Saat Ini</p>
      <img src="{{ asset('storage/' . $old_image) }}" class="w-full h-44 object-cover rounded-xl shadow-sm"
        alt="Current Image">
    @else
      <x-ui.empty-state icon="image" title="Gambar Kosong" message="Belum ada gambar yang diunggah" class="h-44" />
    @endif
  </div>
</x-ui.modal.form>