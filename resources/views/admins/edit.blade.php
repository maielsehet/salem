<!DOCTYPE html>
<html>
<head>
    <title>Edit Admin</title>
</head>
<body>
    <h1>Edit Admin</h1>

    @if($errors->any())
        <ul style="color: red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('admins.update', $admin->id) }}">
        @csrf
        @method('PUT')

        <label>Name:</label>
        <input type="text" name="name" value="{{ $admin->name }}" required><br><br>

        <label>Email:</label>
        <input type="email" name="email" value="{{ $admin->email }}" required><br><br>

        <label>New Password (leave blank to keep current):</label>
        <input type="password" name="password"><br><br>

        <label>Type:</label>
        <input type="text" name="type" value="{{ $admin->type }}" required><br><br>

        <button type="submit">Update</button>
    </form>

    <br>
    <a href="{{ route('admins.index') }}">← Back to Admin List</a>
</body>
</html>