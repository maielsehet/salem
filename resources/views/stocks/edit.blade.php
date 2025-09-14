<!DOCTYPE html>
<html>
<head>
    <title>Edit Stock</title>
</head>
<body>
    <h1>Edit Stock #{{ $stock->id }}</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('stocks.update', $stock->id) }}">
        @csrf
        @method('PUT')

        <label>Warehouse:</label>
        <select name="warehouse_id" required>
            @foreach($warehouses as $warehouse)
                <option value="{{ $warehouse->id }}" {{ $stock->warehouse_id == $warehouse->id ? 'selected' : '' }}>
                    {{ $warehouse->name }}
                </option>
            @endforeach
        </select><br><br>

        <label>Product:</label>
        <select name="product_id" required>
            @foreach($products as $product)
                <option value="{{ $product->id }}" {{ $stock->product_id == $product->id ? 'selected' : '' }}>
                    {{ $product->name }}
                </option>
            @endforeach
        </select><br><br>

        <label>Storage Date:</label>
        <input type="date" name="storage_date" value="{{ $stock->storage_date }}" required><br><br>

        <label>Meters Quantity:</label>
        <input type="number" step="0.01" name="meters_quantity" value="{{ $stock->meters_quantity }}"><br><br>

        <label>Rolls Quantity:</label>
        <input type="number" name="rolls_quantity" value="{{ $stock->rolls_quantity }}"><br><br>

        <label>Price:</label>
        <input type="number" step="0.01" name="price" value="{{ $stock->price }}"><br><br>

        <button type="submit">Update</button>
    </form>

    <br>
    <a href="{{ route('stocks.index') }}">← Back to Stock List</a>
</body>
</html>