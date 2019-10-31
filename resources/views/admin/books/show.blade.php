@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                    <div class="card-header">
                     {{ $book->title }}
                    </div>
                    <div class="card-body">
                        
                            <table id="table-books" class="table table-hover">
                                <tbody>
                                        <tr>
                                            <td>Title</td>
                                            <td>{{ $book->title}}</td>
                                        </tr>
                                        <tr>
                                            <td>Author</td>
                                            <td>{{ $book->author }}</td>
                                        </tr>
                                        <tr>
                                            <td>Publisher</td>
                                            <td>{{ $book->publisher }}</td>
                                        </tr>
                                        <tr>
                                            <td>Year</td>
                                            <td>{{ $book->year }}</td>
                                        </tr>
                                        <tr>
                                            <td>Price</td>
                                            <td>{{ $book->price }}</td>
                                        </tr>
                                    </tbody>
                            </table>
                            <a href="{{ route('admin.books.index', $book->id) }}" class="btn btn-default">Back</a>
                            <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-warning">Edit</a>
                            <form style="display:inline-block" method="POST" action="{{ route('admin.books.destroy', $book->id) }}">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="token" value="{{ csrf_token() }}">
                                <button type="submit" class="form-control btn btn-danger">Delete</button>
                            </form>
                        
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection