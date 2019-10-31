@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                    <div class="card-header">
                        Books
                    <a href="{{ route('admin.books.create') }}" class="btn btn-primary float-right">Add</a>
                    </div>
                    <div class="card-body">
                        @if (count($books) === 0)
                            <p>No books available</p>
                        @else
                            <table id="table-books" class="table table-hover">
                                <thead>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Publisher</th>
                                    <th>Year</th>
                                    <th>ISBN</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($books as $book)
                                        <tr data-id="{{ $book->id }}">
                                            <td>{{ $book->title }}</td>
                                            <td>{{ $book->author }}</td>
                                            <td>{{ $book->publisher }}</td>
                                            <td>{{ $book->year }}</td>
                                            <td>{{ $book->isbn }}</td>
                                            <td>{{ $book->price }}</td>
                                            <td>
                                                <a href="{{ route('admin.books.show', $book->id) }}" class="btn btn-default">View</a>
                                                <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-warning">Edit</a>
                                            <form style="display:inline-block" method="POST" action="{{ route('admin.books.destroy', $book->id) }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit" class="form-control btn btn-danger">Delete</button>
                                            </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection