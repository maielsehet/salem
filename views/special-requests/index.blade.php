<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Special Requests</title>
<style>
table { width: 100%; border-collapse: collapse; }
th, td { padding: 12px; border: 1px solid #ccc; text-align: left; }
th { background-color: #f4f4f4; }
</style>
</head>
<body>
<h1>Special Requests</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Person Name</th>
            <th>Person Phone</th>
            <th>Note</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($requests as $req)
            <tr>
                <td>{{ $req->id }}</td>
                <td>{{ $req->person_name }}</td>
                <td>{{ $req->person_phone }}</td>
                <td>{{ $req->note }}</td>
                <td>{{ $req->created_at->format('M d, Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
