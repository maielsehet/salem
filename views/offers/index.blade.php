<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Offers List</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root {
      --primary: #000000;
      --secondary: #FFFFFF;
      --accent: #D4AF37;
      --light: #F5F5F5;
      --dark: #222222;
      --gray: #888888;
      --shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      --transition: all 0.3s ease;
    }
    body {
      background: var(--light);
      font-family: 'Segoe UI', sans-serif;
      color: var(--primary);
    }
    header {
      background: var(--primary);
      color: var(--secondary);
      padding: 1rem;
      box-shadow: var(--shadow);
    }
    .logo {
      font-size: 1.6rem;
      font-weight: bold;
      display: flex;
      align-items: center;
    }
    .logo i {
      margin-right: 10px;
      color: var(--accent);
    }
    .container {
      margin-top: 40px;
    }
    h1.page-title {
      font-size: 2rem;
      border-left: 5px solid var(--accent);
      padding-left: 15px;
      margin-bottom: 25px;
      display: flex;
      align-items: center;
    }
    h1.page-title i {
      margin-right: 12px;
      color: var(--accent);
    }
    .card {
      background: var(--secondary);
      border-radius: 10px;
      padding: 20px;
      box-shadow: var(--shadow);
    }
    .btn-primary {
      background: var(--accent);
      border: none;
      color: var(--primary);
      font-weight: 500;
      transition: var(--transition);
    }
    .btn-primary:hover {
      background: #C19B30;
      transform: translateY(-2px);
    }
    .btn-warning, .btn-danger {
      transition: var(--transition);
    }
    .btn-warning:hover, .btn-danger:hover {
      transform: translateY(-2px);
    }
    table {
      background: var(--secondary);
      border-radius: 8px;
      overflow: hidden;
      box-shadow: var(--shadow);
    }
    thead {
      background: var(--primary);
      color: var(--secondary);
    }
    th {
      vertical-align: middle !important;
    }
    td {
      vertical-align: middle !important;
    }
    footer {
      margin-top: 50px;
      background: var(--primary);
      color: var(--secondary);
      text-align: center;
      padding: 15px;
    }
  </style>
</head>
<body>
  <header>
    <div class="logo">
      <i class="fas fa-tags"></i> Offer Manager
    </div>
  </header>

  <div class="container">
    <h1 class="page-title"><i class="fas fa-list"></i> Offers List</h1>

    <div class="card mb-4">
      <a href="{{ route('offers.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Add New Offer
      </a>

      @if(session('success'))
        <div class="alert alert-success">
          <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
      @endif

      <table class="table table-bordered align-middle">
        <thead>
          <tr>
            <th>ID</th>
            <th><i class="fas fa-tag"></i> Name</th>
            <th><i class="fas fa-align-left"></i> Description</th>
            <th><i class="fas fa-percent"></i> Discount</th>
            <th><i class="fas fa-calendar-plus"></i> Start At</th>
            <th><i class="fas fa-calendar-minus"></i> End At</th>
            <th><i class="fas fa-cog"></i> Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($offers as $offer)
          <tr>
            <td>{{ $offer->id }}</td>
            <td>{{ $offer->name }}</td>
            <td>{{ $offer->description }}</td>
            <td>{{ $offer->discount_value }}</td>
            <td>{{ $offer->start_at }}</td>
            <td>{{ $offer->end_at }}</td>
            <td>
              <a href="{{ route('offers.edit', $offer->id) }}" class="btn btn-sm btn-warning">
                <i class="fas fa-edit"></i> Edit
              </a>
              <form action="{{ route('offers.destroy', $offer->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                  <i class="fas fa-trash"></i> Delete
                </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <footer>
    <p>&copy; 2025 Offer Management System. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
