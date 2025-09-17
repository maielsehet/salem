@extends('layout')

@section('content')
<h1>Add Product</h1>

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Name:</label>
    <input type="text" name="name"><br><br>

    <label>Type:</label>
    <input type="text" name="type"><br><br>

    <label>description</label>
    <input type="text" name="description"><br><br>

    <label>Price Before:</label><input type="number" step="0.01" name="price_before" value="{{ old('price_before', $product->price_before ?? '') }}">
>
    <label>Price After:</label>
    <input type="number" step="0.01" name="price_after" value="{{ old('price_after', $product->price_after ?? '') }}">

   <label>Colors:</label>
<div id="colors-wrapper">
    <input type="text" name="colors[]" placeholder="Enter color"><br>
</div>
<button type="button" onclick="addColor()">+ Add Color</button>

<script>
function addColor() {
    let wrapper = document.getElementById('colors-wrapper');
    let input = document.createElement('input');
    input.type = "text";
    input.name = "colors[]";
    input.placeholder = "Enter color";
    wrapper.appendChild(input);
    wrapper.appendChild(document.createElement('br'));
}
</script>
<br><br>


    <label>Images:</label>
<input type="file" name="images[]" multiple>


<br><br>
    <button type="submit">Save</button>
</form>
@endsection
