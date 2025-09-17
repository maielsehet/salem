<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Offer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .page-title {
            font-weight: bold;
            color: #343a40;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .card {
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
            background: #fff;
        }
        .btn-success {
            background-color: #198754;
            border: none;
        }
        .btn-success:hover {
            background-color: #157347;
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }
        footer {
            margin-top: 40px;
            padding: 15px;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
            border-top: 1px solid #dee2e6;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h1 class="page-title">➕ Add New Offer</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card mt-3">
        <form action="{{ route('offers.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Discount Value</label>
                <input type="number" name="discount_value" class="form-control" value="{{ old('discount_value') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Start At</label>
                <input type="datetime-local" name="start_at" class="form-control" value="{{ old('start_at') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">End At</label>
                <input type="datetime-local" name="end_at" class="form-control" value="{{ old('end_at') }}" required>
            </div>

            <button type="submit" class="btn btn-success">💾 Save</button>
            <a href="{{ route('offers.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<footer>
    &copy; 2025 Branch Management System. All rights reserved.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
