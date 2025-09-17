<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Branches List - Branch Management System</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    /* ====== Styles (same as before) ====== */
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
    * { margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI',sans-serif; }
    body { background:var(--light); color:var(--primary); }
    .container { max-width:1200px; margin:0 auto; padding:20px; }
    header { background:var(--primary); color:var(--secondary); padding:1rem 0; box-shadow:var(--shadow); }
    .header-content { display:flex; justify-content:space-between; align-items:center; max-width:1200px; margin:0 auto; padding:0 20px; }
    .logo { font-size:1.8rem; font-weight:700; display:flex; align-items:center; }
    .logo i { margin-right:10px; color:var(--accent); }
    nav ul { display:flex; list-style:none; }
    nav ul li { margin-left:20px; }
    nav ul li a { color:var(--secondary); text-decoration:none; transition:var(--transition); padding:5px 10px; border-radius:4px; }
    nav ul li a:hover { background:rgba(255,255,255,0.1); }
    .page-title { margin:30px 0; font-size:2rem; border-left:5px solid var(--accent); padding-left:15px; display:flex; align-items:center; }
    .page-title i { margin-right:15px; color:var(--accent); }
    .card { background:var(--secondary); border-radius:8px; box-shadow:var(--shadow); padding:25px; margin-bottom:25px; }
    .btn { padding:10px 20px; border:none; border-radius:4px; cursor:pointer; text-decoration:none; font-weight:500; transition:var(--transition); }
    .btn:hover { transform:translateY(-2px); box-shadow:0 4px 8px rgba(0,0,0,0.2); }
    .btn-accent { background:var(--accent); color:var(--primary); }
    .btn-accent:hover { background:#C19B30; }
    .btn { background:var(--primary); color:var(--secondary); }
    .branch-list { list-style:none; }
    .branch-item { background:var(--secondary); border-radius:8px; padding:20px; margin-bottom:15px; display:flex; justify-content:space-between; align-items:center; box-shadow:var(--shadow); transition:var(--transition); }
    .branch-item:hover { transform:translateY(-3px); }
    .branch-info h3 { margin-bottom:5px; display:flex; align-items:center; }
    .branch-info h3 i { margin-right:10px; color:var(--accent); }
    .branch-info p { color:var(--gray); margin-bottom:3px; display:flex; align-items:center; }
    .branch-info p i { margin-right:8px; color:var(--accent); }
    .branch-actions { display:flex; gap:10px; }
    .notification { padding:15px; border-left:4px solid var(--accent); background:var(--secondary); margin-bottom:20px; display:flex; align-items:center; box-shadow:var(--shadow); }
    .notification i { margin-right:10px; color:var(--accent); }
    footer { background:var(--primary); color:var(--secondary); text-align:center; padding:20px 0; margin-top:50px; }
  </style>
</head>
<body>
  <header>
    <div class="header-content">
      <div class="logo"><i class="fas fa-building"></i> BranchManager</div>
      <nav>
        <ul>
          <li><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
          <li><a href="#"><i class="fas fa-users"></i> Staff</a></li>
          <li><a href="#"><i class="fas fa-chart-bar"></i> Reports</a></li>
          <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <div class="container">
    <h1 class="page-title"><i class="fas fa-list"></i> Branches List</h1>

    <div class="notification success">
      <i class="fas fa-check-circle"></i> Branch has been successfully updated.
    </div>

    <div class="card">
      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
        <h2>All Branches</h2>
        <a href="create.html" class="btn btn-accent"><i class="fas fa-plus"></i> Add Branch</a>
      </div>

      <ul class="branch-list">
        <li class="branch-item">
          <div class="branch-info">
            <h3><i class="fas fa-building"></i> Downtown Branch</h3>
            <p><i class="fas fa-map-marker-alt"></i> 123 Main Street, City Center</p>
            <p><i class="fas fa-phone"></i> (555) 123-4567</p>
          </div>
          <div class="branch-actions">
            <a href="edit.html" class="btn"><i class="fas fa-edit"></i> Edit</a>
            <button class="btn btn-accent delete-btn"><i class="fas fa-trash"></i> Delete</button>
          </div>
        </li>

        <li class="branch-item">
          <div class="branch-info">
            <h3><i class="fas fa-building"></i> Westside Branch</h3>
            <p><i class="fas fa-map-marker-alt"></i> 456 Oak Avenue, West District</p>
            <p><i class="fas fa-phone"></i> (555) 987-6543</p>
          </div>
          <div class="branch-actions">
            <a href="edit.html" class="btn"><i class="fas fa-edit"></i> Edit</a>
            <button class="btn btn-accent delete-btn"><i class="fas fa-trash"></i> Delete</button>
          </div>
        </li>
      </ul>
    </div>
  </div>

  <footer>
    <p>&copy; 2023 Branch Management System. All rights reserved.</p>
  </footer>

  <script>
    // Delete branch with confirmation
    document.querySelectorAll(".delete-btn").forEach(btn => {
      btn.addEventListener("click", function() {
        if(confirm("Are you sure you want to delete this branch?")) {
          this.closest(".branch-item").remove();
        }
      });
    });
  </script>
</body>
</html>
