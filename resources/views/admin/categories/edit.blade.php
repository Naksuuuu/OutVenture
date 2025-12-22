@extends('layouts.admin')

@section('content')
    <div class="p-8 bg-gray-50 min-h-screen">
        <div class="max-w-xl bg-white rounded-3xl p-8 border border-gray-100 shadow-sm mx-auto">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center text-xl shadow-inner">
                    🌿
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Edit Category</h2>
                    <p class="text-gray-400 text-sm font-medium">Update category details and information</p>
                </div>
            </div>

            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Category Name</label>
                        <input type="text" name="name" value="{{ old('name', $category->name) }}"
                            class="w-full p-3.5 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-emerald-500 focus:bg-white outline-none transition font-medium text-gray-700"
                            placeholder="e.g. Mountain Gear">
                        @error('name')
                            <span class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Short Description</label>
                        <textarea name="description" rows="4"
                            class="w-full p-3.5 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-emerald-500 focus:bg-white outline-none transition font-medium text-gray-700"
                            placeholder="Describe what kind of products belong here...">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <span class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center gap-4 mt-10">
                    <button type="submit"
                        class="flex-1 bg-emerald-500 text-white py-4 rounded-2xl font-bold hover:bg-emerald-600 transition shadow-lg shadow-emerald-100">
                        Update Category
                    </button>
                    <a href="{{ route('categories.index') }}"
                        class="px-8 py-4 text-gray-400 font-bold hover:text-gray-600 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
