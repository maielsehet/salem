@extends('layout')

@section('content')
<h1>Edit Product</h1>

<form action="{{ route('products.update', $product) }}" method="POST">
    @csrf @method('PUT')

    <label>Name:</label>
    <input type="text" name="name" value="{{ $product->name }}"><br><br>

    <label>Type:</label>
    <input type="text" name="type" value="{{ $product->type }}"><br><br>

    <label>description</label>
    <input type="number" name="description" value="{{ $product->description }}"><br><br>

    <label>colors</label>
    <input type="text" name="colors" value="{{ $product->colors }}"><br><br>

    <label>images</label>
    <input type="text" name="images" value="{{ $product->images }}"><br><br>


    <button type="submit">Update</button>
</form>
@endsection


