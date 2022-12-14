@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">Favorite Books</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Book</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($favorites as $favorite)
                                @if(Auth::user()->id == $favorite->user_id)
                                <tr>
                               <td>{{$favorite->user_id}}</td>
                               <td>{{$favorite->book_id}}</td>
                                    <td>
                                        <form method="post" action="{{ route('favorites.destroy', $favorite->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger">Remove favorite</button>
                                        </form>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
