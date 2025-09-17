<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Branch - Branch Management System</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    /* Use same styles as index.html */
    :root { --primary:#000; --secondary:#fff; --accent:#D4AF37; --light:#F5F5F5; --gray:#888; --shadow:0 4px 12px rgba(0,0,0,0.15); }
    body { background:var(--light); font-family:'Segoe UI',sans-serif; }
    header { background:var(--primary); color:var(--secondary); padding:1rem; }
    .logo { font-size:1.5rem; font-weight:700; display:flex; align-items:center; }
    .logo i { margin-right:10px; color:var(--accent); }
    .container { max-width:800px; margin:20px auto; padding:20px; }
    .page-title { font-size:2rem; margin-bottom:20px; border-left:5px solid var(--accent); padding-left:15px; }
    .card { background:var(--secondary); padding:25px; border-radius:8px; box-shadow:var(--shadow); }
    .form-group { margin-bottom:20px; }
    label { font-weight:600; display:block; margin-bottom:8px; }
    .form-control { width:100%; padding:12px; border:1px solid #ccc; border-radius:4px; }
    .actions-container { display:flex; gap:15px; justify-content:flex-end; }
    .btn { padding:10px 20px; border:none; border-radius:4px; cursor:pointer; text-decoration:none; font-weight:500; }
    .btn { background:var(--primary); color:var(--secondary); }
    .btn-accent { background:var(--accent); color:var(--primary); }
    footer { background:var(--primary); color:var(--secondary); text-align:center; padding:15px; margin-top:40px; }
  </style>
</head>
<body>
  <header>
    <div class="logo"><i class="fas fa-building"></i> BranchManager</div>
  </header>

  <div class="container">
    <h1 class="page-title"><i class="fas fa-edit"></i> Edit Branch</h1>
    <div class="card">
      <form id="edit-form">
        <div class="form-group">
          <label for="branch-name">Branch Name</label>
          <input type="text" id="branch-name" class="form-control" value="Downtown Branch" required>
        </div>
        <div class="form-group">
          <label for="branch-location">Location</label>
          <input type="text" id="branch-location" class="form-control" value="123 Main Street, City Center">
        </div>
        <div class="form-group">
          <label for="branch-phone">Phone Number</label>
          <input type="text" id="branch-phone" class="form-control" value="(555) 123-4567">
        </div>
        <div class="actions-container">
          <a href="index.html" class="btn"><i class="fas fa-times"></i> Cancel</a>
          <button type="submit" class="btn btn-accent"><i class="fas fa-check"></i> Update Branch</button>
        </div>
      </form>
    </div>
  </div>

  <footer>
    <p>&copy; 2023 Branch Management System. All rights reserved.</p>
  </footer>

  <script>
    document.getElementById("edit-form").addEventListener("submit", function(e) {
      e.preventDefault();
      alert("Branch updated successfully!");
      window.location.href = "index.html";
    });
  </script>
</body>
</html>
