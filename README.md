
<!DOCTYPE html>
<html>
<head>
  <title>Log In</title>
  <link rel="stylesheet" href="styles.css">
  <script defer src="login.js"></script>
</head>
<body>

<div class="navbar">
  <a href="index.html">Login</a>
  <a href="signup.html">Sign Up</a>
</div>

<div class="container">
  <h1>Log In</h1>

  <input id="email" type="email" placeholder="Email">
  <input id="password" type="password" placeholder="Password">

<div class="remember-wrapper">
  <label>
    <input type="checkbox" id="remember">
    <span>Keep me signed in</span>
  </label>
</div>

  <button onclick="attemptLogin()">Log In</button>
</div>

</body>
</html>
