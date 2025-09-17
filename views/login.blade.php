<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Salem Alta Moda - Admin Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600;700&family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="icon" type="image/png" href="Pokecut_1757341097439 (1).png">
  <style>
    :root {
      --gold: #C6A972;
      --black: #000000;
      --white: #FFFFFF;
      --gray: #8A8A8A;
      --gray-light: #F5F5F5;
      --error: #D9534F;
    }
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Montserrat', sans-serif;
      background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('background.jpg') no-repeat center center/cover;
      min-height: 100vh; display: flex; justify-content: center; align-items: center;
    }
    .login-box {
      background-color: var(--white);
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      width: 100%; max-width: 420px;
      padding: 3rem 2.5rem;
      text-align: center;
      animation: fadeIn 0.7s ease;
    }
    .login-logo h2 {
      font-family: 'Cormorant Garamond', serif;
      font-size: 2.2rem; color: var(--black);
      margin-bottom: 0.3rem;
    }
    .login-logo p { color: var(--gray); font-size: 0.95rem; }
    .divider {
      width: 80px; height: 3px; background-color: var(--gold);
      margin: 1.5rem auto 2rem; border-radius: 2px;
    }
    .form-group { margin-bottom: 1.5rem; text-align: left; }
    .form-group label {
      display: block; margin-bottom: 0.6rem;
      font-weight: 500; color: var(--black); font-size: 0.95rem;
    }
    .input-with-icon { position: relative; }
    .input-with-icon i {
      position: absolute; left: 15px; top: 50%; transform: translateY(-50%);
      color: var(--gray); font-size: 1rem;
    }
    .input-with-icon input {
      width: 100%; padding: 14px 15px 14px 45px;
      border: 1px solid #ddd; border-radius: 6px;
      font-family: 'Montserrat', sans-serif; font-size: 1rem;
      transition: all 0.3s;
    }
    .input-with-icon input:focus {
      outline: none; border-color: var(--gold);
      box-shadow: 0 0 0 3px rgba(198, 169, 114, 0.2);
    }
    .btn {
      display: block; width: 100%; padding: 14px;
      background-color: var(--black); color: var(--white);
      border: none; border-radius: 6px;
      font-family: 'Montserrat', sans-serif; font-size: 1rem;
      font-weight: 500; cursor: pointer;
      transition: all 0.3s; text-transform: uppercase; letter-spacing: 1px;
      margin-top: 1rem;
    }
    .btn:hover { background-color: var(--gold); color: var(--black); }
    .error-message {
      color: var(--error); font-size: 0.9rem;
      margin-top: 0.8rem; text-align: center;
    }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
    @media (max-width: 480px) {
      .login-box { padding: 2rem 1.5rem; }
      .login-logo h2 { font-size: 1.8rem; }
    }
  </style>
</head>
<body>
  <div class="login-box">
    <div class="login-logo">
      <h2>Admin Portal</h2>
      <p>Salem Fabrics Management System</p>
      <div class="divider"></div>
    </div>

    @if(session('error'))
      <div class="error-message">{{ session('error') }}</div>
    @endif

    <form action="{{ route('login') }}" method="POST">
      @csrf

      <div class="form-group">
        <label for="email">Email Address</label>
        <div class="input-with-icon">
          <i class="fas fa-envelope"></i>
          <input type="email" id="email" name="email" required placeholder="Enter admin email" value="{{ old('email') }}">
        </div>
        @error('email')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <div class="input-with-icon">
          <i class="fas fa-lock"></i>
          <input type="password" id="password" name="password" required placeholder="Enter password">
        </div>
        @error('password')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group" style="margin-top:10px; text-align:left;">
        <input type="checkbox" id="remember" name="remember">
        <label for="remember">Remember Me</label>
      </div>

      <button type="submit" class="btn">Sign In</button>
    </form>
  </div>
</body>
</html>
