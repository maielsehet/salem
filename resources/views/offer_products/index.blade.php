<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offer-Products List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1>Offer-Products</h1>
    <a href="{{ route('offer_products.create') }}" class="btn btn-primary mb-3">Add New Offer-Product</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Offer Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($offerProducts as $op)
            <tr>
                <td>{{ $op->id }}</td>
                <td>{{ $op->product->name ?? 'Deleted Product' }}</td>
                <td>{{ $op->offer->name ?? 'Deleted Offer' }}</td>
                <td>
                    <a href="{{ route('offer_products.edit', $op->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('offer_products.destroy', $op->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
