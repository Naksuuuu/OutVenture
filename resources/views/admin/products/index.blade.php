@extends('layouts.admin')

@section('content')
<div class="container-fluid p-4">
    <h2 class="fw-bold mb-4">Products</h2>

    <div class="row mb-3">
        <div class="col-md-9">
            <input type="text" class="form-control" placeholder="Search" style="border-radius: 5px;">
        </div>
        <div class="col-md-3">
            <a href="{{ route('products.create') }}" class="btn w-100 fw-bold" style="background-color: #39FF14; color: white;">Add Product</a>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
        <table class="table align-middle mb-0">
            <thead style="background-color: #D9D9D9;">
                <tr>
                    <th class="py-3 px-4">Photo</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td class="px-4"><img src="{{ asset('storage/'.$product->photo) }}" width="50" style="border-radius: 5px;"></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>${{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm px-4 fw-bold" style="background-color: #39FF14; color: white; border-radius: 20px; font-size: 11px;">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm px-4 fw-bold" style="background-color: #FF0000; color: white; border-radius: 20px; font-size: 11px;">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection