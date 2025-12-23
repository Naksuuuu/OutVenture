<div>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Create New Product</h1>

        <div class="bg-white rounded-lg shadow-md p-6">
            <form wire:submit.prevent="save">
                <div class="mb-4">
                    <label for="nama_product" class="block text-sm font-medium text-gray-700">Product Name</label>
                    <input type="text" wire:model="nama_product" id="nama_product"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('nama_product')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="id_category" class="block text-sm font-medium text-gray-700">Category</label>
                    <select wire:model="id_category" id="id_category"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name_category }}</option>
                        @endforeach
                    </select>
                    @error('id_category')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="brand" class="block text-sm font-medium text-gray-700">Brand</label>
                    <input type="text" wire:model="brand" id="brand"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('brand')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea wire:model="deskripsi" id="deskripsi" rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                    @error('deskripsi')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                        Save Product
                    </button>
                    <a href="{{ route('admin.products.index') }}"
                        class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
