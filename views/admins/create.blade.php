<!DOCTYPE html>
<html>
<head>
    <title>Create Admin</title>
</head>
<body>
    <h1>Add New Admin</h1>

    @if($errors->any())
        <ul style="color: red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('admins.store') }}">
        @csrf

        <label>Name:</label>
        <input type="text" name="name" required><br><br>

        <label>Email:</label>
        <input type="email" name="email" required><br><br>

        <label>Password:</label>
        <input type="password" name="password" required><br><br>

        <label>Type:</label>
        <input type="text" name="type" required><br><br>

        <button type="submit">Save</button>
    </form>

    <br>
    <a href="{{ route('admins.index') }}">← Back to Admin List</a>
</body>
</html>