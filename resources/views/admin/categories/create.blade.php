@extends('layouts.admin')

@section('content')
<div class="container-fluid p-5">
    <h2 class="fw-bold mb-5">Add Categories</h2>
    <div class="col-md-8">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <input type="text" name="description" class="form-control">
            </div>
            <div class="mb-4">
                <label class="form-label">Date</label>
                <input type="date" name="date" class="form-control">
            </div>
            <div class="d-flex justify-content-end gap-3 mt-5">
                <a href="{{ route('categories.index') }}" class="btn px-4 fw-bold" style="background-color: #FF0000; color: white;">Batalkan</a>
                <button type="submit" class="btn px-4 fw-bold" style="background-color: #39FF14; color: white;">Tambahkan</button>
            </div>
        </form>
    </div>
</div>
@endsection