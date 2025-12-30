<x-ui.modal.form wire:model="isOpen" title="Tambah Varian" submit-action="save" submit-label="Simpan Varian"
    submit-variant="create" wire-key="variant-create" maxWidth="max-w-3xl">

    <x-slot:trigger>
        <x-ui.button variant="create-ghost" label="Varian Warna" icon="plus" class=" w-full md:w-auto" />
    </x-slot:trigger>

    <div>
        <x-ui.form.label label="Warna" />
        <x-ui.form.select model="id_color">
            <option value="">Pilih warna</option>
            @foreach ($colors as $color)
                <option value="{{ $color->id }}">{{ $color->nama_warna }}</option>
            @endforeach
        </x-ui.form.select>

    </div>

    <x-ui.form.image-upload wire:model="image" :image="$image" label="Gambar Varian" class="w-full" />
</x-ui.modal.form>