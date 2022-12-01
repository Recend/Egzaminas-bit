@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Categories edit</div>

                    <div class="card-body">
                        <form method="post" action="{{ route('categories.update', $category->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Category name</label>
                                <input class="form-control" type="text" name="name" value="{{ $category->name }}">
                                <button class="btn btn-outline-success mt-3">Update category</button>
                                <a class="btn btn-outline-primary float-end mt-3" href="{{route('categories.index')}}">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
