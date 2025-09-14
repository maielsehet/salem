<!DOCTYPE html>
<html>
<head>
    <title>Stock List</title>
</head>
<body>
    <h1>Stock List</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('stocks.create') }}">+ Add New Stock</a>
    <br><br>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Warehouse</th>
                <th>Product</th>
                <th>Storage Date</th>
                <th>Meters</th>
                <th>Rolls</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($stocks as $stock)
                <tr>
                    <td>{{ $stock->id }}</td>
                    <td>{{ $stock->warehouse->name }}</td>
                    <td>{{ $stock->product->name }}</td>
                    <td>{{ $stock->storage_date }}</td>
                    <td>{{ $stock->meters_quantity }}</td>
                    <td>{{ $stock->rolls_quantity }}</td>
                    <td>{{ $stock->price }}</td>
                    <td>
                        <a href="{{ route('stocks.edit', $stock->id) }}">Edit</a> |
                        <form method="POST" action="{{ route('stocks.destroy', $stock->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Delete this stock?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">No stock records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>