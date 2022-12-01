@extends('layouts.app')
@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">Books</div>
                    <div class="card-body">
                        @can('view')
                        <a class="btn btn-outline-primary float-end" href="{{ route('books.create') }}">{{ __('Add new book') }}</a>
                        @endcan
                            <hr>
                        <h5>{{ __('Book searh') }}</h5>
                        <form method="post" action="{{ route('books.find') }}">
                            @csrf
                            <div class="mb-3">
                                <label>{{ __('Search by name') }}</label>
                                <input name="name" type="text" value="@if(isset($findBook)){{ $findBook }} @endif" class="form-control">
                            </div>
                            <button class="btn btn-outline-success">{{ __('Search') }}</button>
                        </form>


                        <table class="table">
                            <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Summary</th>
                                <th>ISBN</th>
                                <th>Pages</th>
                                <th>Category</th>
                                @can('view')
                                <th>Action</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($books as $book)

                                <tr>
                                    <td><img src="{{ route('images.books',$book->photo)}}" style="width: 200px"></td>
                                    <td>{{ $book->name }}</td>
                                    <td>{{ $book->summary }}</td>
                                    <td>{{ $book->ISBN }}</td>
                                    <td>{{ $book->pages }}</td>
                                    <td>{{ $book->category->name }}</td>
                                    @can('view')
                                    <td><a class="btn btn-outline-success" href="{{ route('books.edit', $book->id) }}">{{ __('Edit') }}</a></td>
                                    <td>
                                        <form method="post" action="{{ route('books.destroy', $book->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger">{{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                    @endcan
                                    @can('user')
                                    @if ($orders->where('user_id', Auth::user()->id)->where('book_id',$book->id)->isEmpty() )
                                        <td>
                                            <form action="{{ route('book.order', $book->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="Reserved">
                                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                                <input type="hidden" name="book_id" value="{{$book->id}}">
                                                <button class="btn btn-outline-info">Reserve</button>
                                            </form>
                                    @else
                                        <td>
                                          <span class="alert alert-success">Reserved</span>
                                        </td>
                                        @endif

                                        @endcan
                                        @can('user')
                                            @if ($favorites->where('user_id', Auth::user()->id)->where('book_id',$book->id)->isEmpty() )
                                                <td>
                                                    <form action="{{ route('book.favorite', $book->id) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                                        <input type="hidden" name="book_id" value="{{$book->id}}">
                                                        <button class="btn btn-outline-warning">Favorite</button>
                                                    </form>
                                            @else
                                                <td>
                                                    <span class="alert alert-warning">Favorite!</span>
                                                </td>
                                                @endif

                                            @endcan
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
