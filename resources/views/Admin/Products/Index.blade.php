@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Products</h1>
                <a class="text-right" href="/admin/products/create">Create New Product</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Price</th>
                            <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <th scope="row">{{ $loop->index + 1}}</th>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product["description"] }}</td>
                                <td>${{ $product->price." ".$product->currency }}</td>
                                <td>
                                    <a href="/admin/products/{{ $product->_id }}">Details</a> |
                                    <a href="/admin/products/edit/{{ $product->_id }}">Edit</a> |
                                    <a href="/admin/products/delete/{{ $product->_id }}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection