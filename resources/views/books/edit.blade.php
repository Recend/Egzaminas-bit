@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Books create</div>

                    <div class="card-body">
                        <form method="post" action="{{ route('books.update', $book->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Book name</label>
                                <input class="form-control" type="text" name="name" value="{{$book->name}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Summary</label>
                                <input class="form-control" type="text" name="summary" value="{{$book->summary}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">ISBN</label>
                                <input class="form-control" type="number" name="ISBN" value="{{$book->ISBN}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Photo</label>
                                <input class="form-control" type="file" name="photo" value="{{$book->photo}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pages</label>
                                <input class="form-control" type="number" name="pages" value="{{$book->pages}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select name="category_id" class="form-select">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ isset($book)&&($category->id==$book->category_id)?'selected':"" }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-outline-success">Update book</button>
                            <a class=" btn btn-outline-primary float-end" href="{{ route('books.index') }}">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
