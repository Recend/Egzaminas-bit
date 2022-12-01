@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Books create</div>

                    <div class="card-body">
                        <form method="post" action="{{ route('books.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Book name</label>
                                <input class="form-control" type="text" name="name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Summary</label>
                                <input class="form-control" type="text" name="summary">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">ISBN</label>
                                <input class="form-control" type="number" name="ISBN">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Photo</label>
                                <input class="form-control" type="file" name="photo">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pages</label>
                                <input class="form-control" type="number" name="pages">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select name="category_id" class="form-select">
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-outline-success">Add book</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
