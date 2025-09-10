<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offers List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1>Offers</h1>
    <a href="{{ route('offers.create') }}" class="btn btn-primary mb-3">Add New Offer</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Discount Value</th>
                <th>Start At</th>
                <th>End At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($offers as $offer)
            <tr>
                <td>{{ $offer->id }}</td>
                <td>{{ $offer->name }}</td>
                <td>{{ $offer->description }}</td>
                <td>{{ $offer->discount_value }}</td>
                <td>{{ $offer->start_at }}</td>
                <td>{{ $offer->end_at }}</td>
                <td>
                    <a href="{{ route('offers.edit', $offer->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('offers.destroy', $offer->id) }}" method="POST" style="display:inline-block;">
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
