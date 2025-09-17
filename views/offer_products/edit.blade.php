<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Offer-Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1>Edit Offer-Product</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('offer_products.update', $offerProduct->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- اختيار المنتج -->
        <div class="mb-3">
            <label>Product</label>
            <select name="product_id" class="form-control" required>
                <option value="">-- Select Product --</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ $offerProduct->product_id == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- اختيار العرض -->
        <div class="mb-3">
            <label>Offer</label>
            <select name="offer_id" class="form-control" required>
                <option value="">-- Select Offer --</option>
                @foreach($offers as $offer)
                    <option value="{{ $offer->id }}" {{ $offerProduct->offer_id == $offer->id ? 'selected' : '' }}>
                        {{ $offer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- أزرار -->
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('offer_products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
