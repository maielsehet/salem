<!DOCTYPE html>
<html>
<head>
    <title>تفاصيل العملية</title>
</head>
<body>
    <h1>تفاصيل العملية</h1>
    <p>النوع: {{ $transaction->type }}</p>
    <p>الإجمالي: {{ $transaction->total_amount }} جنيه</p>

    <h3>المنتجات:</h3>
    <ul>
        @foreach ($transaction->items as $item)
            <li>{{ $item->product->name }} - {{ $item->quantity }} × {{ $item->price }} = {{ $item->quantity * $item->price }}</li>
        @endforeach
    </ul>

    <a href="{{ route('transactions.index') }}">رجوع</a>
</body>
</html>
