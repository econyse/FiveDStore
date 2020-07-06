@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Product Details</h1>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->product_name }}</h5>
                        <p class="card-text"><b>Description: </b>{{ $product->description }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Category: </b>{{ $product->category_id }}</li>
                        <li class="list-group-item"><b>Price: </b>${{ $product->price." ".$product->currency }}</li>
                    </ul>
                    <div class="card-body">
                        <a href="/admin/products/edit/{{ $product->_id }}" class="card-link">Edit</a>
                        <a href="/admin/products/delete/{{ $product->_id }}" class="card-link">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
