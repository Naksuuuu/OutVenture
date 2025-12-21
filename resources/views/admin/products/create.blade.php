@extends('layouts.admin')

@section('content')
<div class="container-fluid p-5">
    <h2 class="fw-bold mb-5">Add Products</h2>
    <div class="col-md-8">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Photo</label>
                <input type="file" name="photo" class="form-control" style="border: 1px solid #000;">
            </div>
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" style="border: 1px solid #000;">
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" name="price" class="form-control" style="border: 1px solid #000;">
            </div>
            <div class="mb-4">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-control" style="border: 1px solid #000;">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex justify-content-end gap-3 mt-5">
                <a href="{{ route('products.index') }}" class="btn fw-bold px-4 py-2" style="background-color: #FF0000; color: white; border-radius: 8px;">Batalkan</a>
                <button type="submit" class="btn fw-bold px-4 py-2" style="background-color: #39FF14; color: white; border-radius: 8px;">Tambahkan</button>
            </div>
        </form>
    </div>
</div>
@endsection