@extends('layout')

@section('content')
    <h1>Product Details</h1>

    <p><strong>Name:</strong> {{ $product->name }}</p>
    <p><strong>Type:</strong> {{ $product->type }}</p>
    <p><strong>Description:</strong> {{ $product->description }}</p>
    <p><strong>Price Before:</strong> {{ $product->price_before }}</p>
    <p><strong>Price After:</strong> {{ $product->price_after }}</p>
    <p><strong>Colors:</strong> {{ is_array($product->colors) ? implode(', ', $product->colors) : $product->colors }}</p>

    @if($product->images)
        <p><strong>Images:</strong></p>
        @foreach((array) $product->images as $image)
            <img src="{{ asset('storage/'.$image) }}" width="150" alt="Product Image">
        @endforeach
    @endif

    <br>
    <a href="{{ route('products.index') }}">Back to Products</a>
@endsection
