<div>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Create New Category</h1>

        <div class="bg-white rounded-lg shadow-md p-6">
            <form wire:submit.prevent="save">
                <div class="mb-4">
                    <label for="name_category" class="block text-sm font-medium text-gray-700">Category Name</label>
                    <input type="text" wire:model="name_category" id="name_category"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('name_category')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea wire:model="description" id="description" rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                    @error('description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                        Save Category
                    </button>
                    <a href="{{ route('admin.categories.index') }}"
                        class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
