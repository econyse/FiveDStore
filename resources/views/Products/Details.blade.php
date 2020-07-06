@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card col-md-12">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->product_name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">${{ $product->price." ".$product->currency }}</h6>
                    <p class="card-text">{{ $product->description }}</p>
                </div>
                <div class="card-footer">
                    <p>Rating: </p>
                    <input type="radio" name="rating" id="rating">
                    <input type="radio" name="rating" id="rating">
                    <input type="radio" name="rating" id="rating">
                    <input type="radio" name="rating" id="rating">
                    <input type="radio" name="rating" id="rating">
                </div>
            </div>

            <div class="col-md-12">
                <h1>Add Comment</h1>
                <form action="/products/comment" method="POST">
                    @csrf
                    <input type="hidden" name="productid" id="productid" value="{{ $product->_id }}">
                    <div class="form-group">
                        <label for="userid">User id</label>
                        <input type="text" class="form-control" name="userid" id="userid">
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <textarea name="comment" id="comment" cols="30" rows="4" class="form-control"></textarea>
                    </div>
                    <button class="btn btn-success" type="submit">Add comment</button>
                </form>
            </div>

            <div class="col-md-12">
                <h3>User comments</h3>
                @if (count($product->comments) == 0 || $product->comments == null || empty($product->comments))
                    <h5 class="text-muted">No comments yet.</h5>
                @else 
                    @foreach ($product->comments as $comment)
                        <div class="card col-md-12">
                            <div class="card-body">
                                <h5 class="card-title">{{ $comment->user_id }}</h5>
                                <p class="card-text">{{ $comment->comment }}</p>
                                <h6 class="card-subtitle mb-2 text-muted">Date published: {{ $comment->date }} UTC</h6>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

        </div>
    </div>
@endsection
