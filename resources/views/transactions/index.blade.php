<!DOCTYPE html>
<html>
<head>
    <title>قائمة العمليات</title>
</head>
<body>
    <h1>كل العمليات</h1>
    <a href="{{ route('transactions.create') }}">إضافة عملية جديدة</a>
    <ul>
        @foreach ($transactions as $transaction)
            <li>
                {{ $transaction->type }} - {{ $transaction->total_amount }} جنيه
                <a href="{{ route('transactions.show', $transaction) }}">عرض</a>
                <a href="{{ route('transactions.edit', $transaction) }}">تعديل</a>
                <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">حذف</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
