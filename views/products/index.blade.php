@extends('layout')

@section('content')
<h1>Products</h1>
<a href="{{ route('products.create') }}">Add Product</a>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Type</th>
        <th>Description</th>
        <th>Colors</th>
        <th>Images</th>
        <th>Price Before</th>
        <th>Price After</th>
        <th>Actions</th>
    </tr>
    @foreach($products as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->type }}</td>
        <td>{{ $product->description }}</td>

        {{-- Colors --}}
        <td>
            @if(is_array($product->colors))
                {{ implode(', ', $product->colors) }}
            @else
                {{ $product->colors }}
            @endif
        </td>

        {{-- Images --}}
        <td>
            @if(is_array($product->images))
                @foreach($product->images as $img)
                    <img src="{{ asset('storage/'.$img) }}" width="60" height="60" style="margin:3px; border:1px solid #ccc; border-radius:5px;">
                @endforeach
            @elseif($product->images)
                <img src="{{ asset('storage/'.$product->images) }}" width="60" height="60" style="margin:3px; border:1px solid #ccc; border-radius:5px;">
            @else
                No Images
            @endif
        </td>

        {{-- Prices --}}
        <td>{{ $product->price_before ?? '-' }}</td>
        <td>{{ $product->price_after ?? '-' }}</td>

        {{-- Actions --}}
        <td>
            <a href="{{ route('products.show', $product) }}">View</a> |
            <a href="{{ route('products.edit', $product) }}">Edit</a> |
            <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline">
                @csrf @method('DELETE')
                <button type="submit" onclick="return confirm('Delete this product?')">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
