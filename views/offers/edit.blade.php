<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Offer</title>
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
      max-width: 700px;
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
      padding: 25px;
      box-shadow: var(--shadow);
    }
    .form-label {
      font-weight: 600;
      color: var(--dark);
    }
    .form-control:focus {
      border-color: var(--accent);
      box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
    }
    .btn-accent {
      background: var(--accent);
      border: none;
      color: var(--primary);
      font-weight: 500;
      transition: var(--transition);
    }
    .btn-accent:hover {
      background: #C19B30;
      transform: translateY(-2px);
    }
    .btn-secondary:hover {
      transform: translateY(-2px);
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
    <h1 class="page-title"><i class="fas fa-edit"></i> Edit Offer</h1>

    @if ($errors->any())
      <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle"></i> Please fix the following:
        <ul class="mt-2 mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="card">
      <form action="{{ route('offers.update', $offer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label class="form-label"><i class="fas fa-tag"></i> Name</label>
          <input type="text" name="name" class="form-control" value="{{ old('name', $offer->name) }}" required>
        </div>

        <div class="mb-3">
          <label class="form-label"><i class="fas fa-align-left"></i> Description</label>
          <textarea name="description" class="form-control">{{ old('description', $offer->description) }}</textarea>
        </div>

        <div class="mb-3">
          <label class="form-label"><i class="fas fa-percent"></i> Discount Value</label>
          <input type="number" name="discount_value" class="form-control" value="{{ old('discount_value', $offer->discount_value) }}" required>
        </div>

        <div class="mb-3">
          <label class="form-label"><i class="fas fa-calendar-plus"></i> Start At</label>
          <input type="datetime-local" name="start_at" class="form-control" 
            value="{{ old('start_at', \Carbon\Carbon::parse($offer->start_at)->format('Y-m-d\TH:i')) }}" required>
        </div>

        <div class="mb-3">
          <label class="form-label"><i class="fas fa-calendar-minus"></i> End At</label>
          <input type="datetime-local" name="end_at" class="form-control" 
            value="{{ old('end_at', \Carbon\Carbon::parse($offer->end_at)->format('Y-m-d\TH:i')) }}" required>
        </div>

        <div class="d-flex justify-content-end gap-3">
          <a href="{{ route('offers.index') }}" class="btn btn-secondary">
            <i class="fas fa-times"></i> Cancel
          </a>
          <button type="submit" class="btn btn-accent">
            <i class="fas fa-check"></i> Update Offer
          </button>
        </div>
      </form>
    </div>
  </div>

  <footer>
    <p>&copy; 2025 Offer Management System. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
