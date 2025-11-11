<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>    

<nav class="navBar">
  <div class="leftNav">
<ul> 
<li><a href="login.html">Home</a></li>
<li><a href="login.html">Shop Here</a></li>
</ul>
  </div>

  <h1> Urban 40 </h1>

<div class="rightNav">
  <ul>
<li><a href="login.html">Contact</a></li>
<li><a href="login.html">About</a></li>
  </ul>
</div>
</nav>


<div class="Wrapper">

<hr>
<form action="index.html" method="post" > 

<div class="userInput1">
  <img src="transgender_24dp_E3E3E3_FILL1_wght400_GRAD0_opsz24.svg" alt="Gender">
<select id="title"> 
  <option> Male </option>
  <option> Female </option>
  <option> Other </option>
</select>
</div>

<div class="userInput1">
  <img src="person_24dp_E3E3E3_FILL1_wght400_GRAD0_opsz24.svg" alt="First Name">
    <input required type="text" name="firstname" id="inputfirstname" placeholder="First Name" minlength="3" maxlength="50" >
</div>

<div class="userInput1">
  <img src="person_24dp_E3E3E3_FILL1_wght400_GRAD0_opsz24.svg" alt="Last Name">
    <input required type="text" name="lastname" id="inputlastname" placeholder="Last Name" minlength="3" maxlength="50" >
</div>

<div class="userInput1">
  <img src="mail_24dp_E3E3E3_FILL1_wght400_GRAD0_opsz24.svg" alt="Email">
    <input required type="email" name="email" id="inputemail" placeholder="Email" minlength="6" maxlength="50" >
</div>

<div class="userInput1">
  <img src="lock_24dp_E3E3E3_FILL1_wght400_GRAD0_opsz24.svg" alt="Lock">
    <input required type="password" name="password" id="inputpassword" placeholder="Password" minlength="8" maxlength="50">
</div>

<div class="userInput1">
  <img src="lock_24dp_E3E3E3_FILL1_wght400_GRAD0_opsz24.svg" alt="Lock">
    <input required type="password" name="confirmpassword" id="confirminputpassword" placeholder="Repeat Password" minlength="8" maxlength="50">
</div>

<div class="userInput1">
  <img src="calendar_month_24dp_E3E3E3_FILL1_wght400_GRAD0_opsz24.svg" alt="DOB">
    <input required type="date" name="dob" id="dob" placeholder="DOB">
</div>

<div class="userInput1">
  <img src="call_24dp_E3E3E3_FILL1_wght400_GRAD0_opsz24.svg" alt="Contact Phone">
    <input required type="tel" name="contactPhone" id="inputContactPhone" placeholder="07985 587469" pattern="[0-9]{5}[0-9]{6}">
</div>

<div class="userInput1">
  <img src="home_24dp_E3E3E3_FILL1_wght400_GRAD0_opsz24.svg" alt="Address">
    <input required type="text" name="adrress" id="inputAddress" placeholder="Address" minlenght="8" maxlength="30">
</div>


<button class="signupBtn" type="submit"> Sign Up </button>


<div class="checkbox-container">
  <input type="checkbox" id="terms" name="terms" required>
  <label aria-required="true" for="terms">I agree to the Terms & Conditions</label>
</div>

<p id="loginButton"> Already have an Account <a href="login.html" > LogIn </a></p>
</form>
</div>

<script> </script>
</body>
</html>
