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
                                            <td>{{ $book->publisher->name}}</td>
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
                            <a href="{{ route('user.books.index', $book->id) }}" class="btn btn-default">Back</a>
                            <br />
                            <h2>Reviews
                            <a href="{{ route('user.reviews.create', $book->id) }}" class="btn btn-primary">Add</a>
                            </h2>
                            <ul>
                                @if (count($reviews) == 0)
                                    <p>There are no reviews</p>
                                @else
                                    @foreach ($reviews as $review)
                                        <li>{{ $review->title }}</li>
                                    @endforeach
                                @endif
                            </ul>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection