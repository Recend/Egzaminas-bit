@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">Categories</div>
                    <div class="card-body">
                        @can('view')
                        <a class="btn btn-outline-primary float-end" href="{{ route('categories.create') }}">{{ __('Add new category') }}</a>
                        @endcan
                        <table class="table">
                            <thead>
                            <tr>
                            <th>Category name</th>
                                @can('view')
                            <th colspan="2">Action</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                @can('view')
                                <td><a class="btn btn btn-outline-success" href="{{ route('categories.edit', $category->id) }}">{{ __('Edit') }}</a></td>
                                <td><form method="post" action="{{ route('categories.destroy', $category->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger">{{ __('Delete')}} </button>
                                    </form>
                                </td>
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
