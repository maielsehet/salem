<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Offer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1>Edit Offer</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('offers.update', $offer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $offer->name) }}" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ old('description', $offer->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Discount Value</label>
            <input type="number" name="discount_value" class="form-control" value="{{ old('discount_value', $offer->discount_value) }}" required>
        </div>

        <div class="mb-3">
            <label>Start At</label>
            <input type="datetime-local" name="start_at" class="form-control" value="{{ old('start_at', \Carbon\Carbon::parse($offer->start_at)->format('Y-m-d\TH:i')) }}" required>
        </div>

        <div class="mb-3">
            <label>End At</label>
            <input type="datetime-local" name="end_at" class="form-control" value="{{ old('end_at', \Carbon\Carbon::parse($offer->end_at)->format('Y-m-d\TH:i')) }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('offers.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
