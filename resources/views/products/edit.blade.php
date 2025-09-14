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
    <input type="text" name="description" value="{{ $product->description }}"><br><br>


    <label>Price Before:</label>
   <input type="number" step="0.01" name="price_before" 
       value="{{ old('price_before', $product->price_before ?? '') }}"> 

    <br><br>
    <label>Price After:</label>

   <input type="number" step="0.01" name="price_after" 
       value="{{ old('price_after', $product->price_after ?? '') }}"> 

    <label>colors</label>
    <input type="text" name="colors" value="{{ $product->colors }}"><br><br>

    <label>images</label>
    <input type="text" name="images" value="{{ $product->images }}"><br><br>


    <button type="submit">Update</button>
</form>
@endsection


