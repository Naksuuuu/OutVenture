@extends('layouts.admin')

@section('content')
<div class="container-fluid p-5">
    <h2 class="fw-bold mb-5">Edit Categories</h2>
    <div class="col-md-8">
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $category->name }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <input type="text" name="description" class="form-control" value="{{ $category->description }}">
            </div>
            <div class="d-flex justify-content-end gap-3 mt-5">
                <a href="{{ route('categories.index') }}" class="btn px-4 fw-bold" style="background-color: #FF0000; color: white;">Batalkan</a>
                <button type="submit" class="btn px-4 fw-bold" style="background-color: #39FF14; color: white;">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection