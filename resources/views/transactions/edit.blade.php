<!DOCTYPE html>
<html>
<head>
    <title>تعديل عملية</title>
</head>
<body>
    <h1>تعديل عملية</h1>
    <form action="{{ route('transactions.update', $transaction) }}" method="POST">
        @csrf
        @method('PUT')

        <label>نوع العملية:</label>
        <select name="type">
            <option value="in" @if($transaction->type == 'in') selected @endif>شراء</option>
            <option value="out" @if($transaction->type == 'out') selected @endif>بيع</option>
        </select><br><br>

        <h3>المنتجات:</h3>
        @foreach ($products as $product)
            @php
                $item = $transaction->items->where('product_id', $product->id)->first();
            @endphp
            <div>
                <strong>{{ $product->name }}</strong><br>
                الكمية: <input type="number" name="products[{{ $product->id }}][quantity]" value="{{ $item->quantity ?? 0 }}"><br>
                السعر: <input type="number" name="products[{{ $product->id }}][price]" value="{{ $item->price ?? 0 }}"><br><br>
            </div>
        @endforeach

        <button type="submit">تحديث</button>
    </form>
</body>
</html>
