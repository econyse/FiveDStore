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
                <div id="StarRating" class="card-footer">
                    <p>Rating: </p>
                    <span class="fa-2x text-warning">
                        <i class="far fa-star" onclick="setStarRating(2);" onmouseleave="starRating(document.getElementById('ratingval').value)" onmouseenter="starRating(2)"></i>
                    </span>
                    <span class="fa-2x text-warning">
                        <i class="far fa-star" onclick="setStarRating(4);" onmouseleave="starRating(document.getElementById('ratingval').value)" onmouseenter="starRating(4)"></i>
                    </span>
                    <span class="fa-2x text-warning">
                        <i class="far fa-star" onclick="setStarRating(6);" onmouseleave="starRating(document.getElementById('ratingval').value)" onmouseenter="starRating(6)"></i>
                    </span>
                    <span class="fa-2x text-warning">
                        <i class="far fa-star" onclick="setStarRating(8);" onmouseleave="starRating(document.getElementById('ratingval').value)" onmouseenter="starRating(8)"></i>
                    </span>
                    <span class="fa-2x text-warning">
                        <i class="far fa-star" onclick="setStarRating(10);" onmouseleave="starRating(document.getElementById('ratingval').value)" onmouseenter="starRating(10)"></i>
                    </span>
                    @php
                        $rating = (array)$product->rating;
                        if (count($rating) == 0)
                            $avg = 0;
                        else
                            $avg = array_sum($rating) / count($rating);
                    @endphp
                    <input type="number" hidden name="ratingval" id="ratingval" min="0" max="10" value="{{ round($avg) }}">
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
    <script>
        
        function starRating(rating) {
            var elStars = document.getElementById("StarRating").getElementsByTagName("i");
            for (i = 0; i < elStars.length; i++) {
                elStars[i].setAttribute("class", "far fa-star")
            }
            for (i = 1; i <= Math.ceil(rating / 2); i++) {
                let elStar = elStars[i-1];
                if (i == Math.ceil(rating / 2) && rating % 2 == 1) {
                    elStar.setAttribute("class", "fas fa-star-half-alt");
                } else {
                    elStar.setAttribute("class", "fas fa-star");
                }
            }
        }
        function setStarRating(rating) {
            const prodID = "{{ $product->_id}}"
            var formData = {
                id: prodID,
                rating: rating
            };
            axios.post("/api/rating", formData)
                .then(function (response) {
                    document.getElementById("ratingval").value = response.data.avg;
                    starRating(repsonse.data.avg);
                })
                .catch(function (error) {
                    console.log("error: " + error);
                });
        }
        (function () {
            starRating(document.getElementById("ratingval"));
        })();
    </script>

@endsection
