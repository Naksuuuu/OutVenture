@extends('layouts.admin')

@section('content')
<div class="container-fluid p-4">
    <h2 class="fw-bold mb-4">Categories</h2>
    <div class="row mb-3">
        <div class="col-md-9">
            <input type="text" class="form-control" placeholder="Search">
        </div>
        <div class="col-md-3">
            <a href="{{ route('categories.create') }}" class="btn w-100 fw-bold" style="background-color: #39FF14; color: white;">Add Category</a>
        </div>
    </div>
    <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
        <table class="table align-middle mb-0">
            <thead style="background-color: #D9D9D9;">
                <tr>
                    <th class="py-3 px-4">Name</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $cat)
                <tr>
                    <td class="px-4 fs-5">{{ $cat->name }}</td>
                    <td class="text-muted">{{ $cat->description }}</td>
                    <td>{{ $cat->created_at->format('d-m-Y') }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('categories.edit', $cat->id) }}" class="btn btn-sm px-4 fw-bold" style="background-color: #39FF14; color: white; border-radius: 20px;">Edit</a>
                            <form action="{{ route('categories.destroy', $cat->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm px-4 fw-bold" style="background-color: #FF0000; color: white; border-radius: 20px;">Hapus</button>
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