@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Products</h1>
                <div class="row">
                    @foreach($products as $product)
                        <div class="card col-md-3">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->product_name }}</h5>
                                <p class="card-text">${{ $product->price." ".$product->currency }}</p>
                                <a href="/products/{{ $product->_id }}" class="btn btn-primary">View</a>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-md-12">
                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group mx-auto" role="group" aria-label="First group">
                                @php
                                    $cpage = request('pg') == 0 ? 1 : request('pg');

                                @endphp
                                <a href="/products?pg={{ $cpage - 1 }}" class="btn btn-secondary {{ $cpage == 1 ? 'disabled' : '' }}">&lt</button>
                                @for ($i = 1; $i <= ceil($productCount/12); $i++)
                                <a href="/products?pg={{$i}}" class="btn btn-secondary {{ $cpage == $i ? 'disabled' : '' }}">{{$i}}</a>
                                @endfor
                                <a href="/products?pg={{ $cpage + 1 }}" class="btn btn-secondary {{ $cpage == ceil($productCount/12) ? 'disabled' : '' }}">&gt</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
