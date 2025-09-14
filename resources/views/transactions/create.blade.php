<!DOCTYPE html>
<html>
<head>
    <title>إضافة عملية جديدة</title>
</head>
<body>
    <h1>إضافة عملية جديدة</h1>
    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf
        <label>نوع العملية:</label>
        <select name="type">
            <option value="in">شراء</option>
            <option value="out">بيع</option>
        </select><br><br>

        <h3>المنتجات:</h3>
        @foreach ($products as $product)
            <div>
                <strong>{{ $product->name }}</strong><br>
                الكمية: <input type="number" name="products[{{ $product->id }}][quantity]" value="0"><br>
                السعر: <input type="number" name="products[{{ $product->id }}][price]" value="0"><br><br>
            </div>
        @endforeach

        <button type="submit">حفظ</button>
    </form>
</body>
</html>
