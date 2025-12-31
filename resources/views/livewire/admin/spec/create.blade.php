<x-ui.modal.form wire:model="isOpen" title="Tambah Spesifikasi"
    subtitle="Varian: {{ $variant->color->nama_warna ?? 'Tanpa Warna' }}" submit-action="save" submit-label="Simpan"
    submit-variant="create" wire-key="spec-create-{{ $variant->id }}">

    <x-slot:trigger>
        <x-ui.button variant="create-ghost" icon="plus" label="Tambah Spesifikasi" />
    </x-slot:trigger>

    <div>
        <x-ui.form.label label="Ukuran" />
        <x-ui.form.select model="id_size_value">
            <option value="">Pilih ukuran</option>
            @foreach ($sizes as $size)
                <option value="{{ $size->id }}">{{ $size->label_size }}</option>
            @endforeach
        </x-ui.form.select>
    </div>

    <div>
        <x-ui.form.label label="Kode SKU" />
        <x-ui.form.input type="text" model="sku" maxlength="100" placeholder="SKU unik" />
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <x-ui.form.label label="Harga" />
            <x-ui.form.input type="number" model="harga" min="0" step="100" placeholder="Harga" />
        </div>
        <div>
            <x-ui.form.label label="Stok" />
            <x-ui.form.input type="number" model="stok" min="0" step="1" />
        </div>
    </div>
</x-ui.modal.form>