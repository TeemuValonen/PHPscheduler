<!doctype html>
<?php
  session_start();

  if ($_SESSION["loginAttempt"] > 0) {
    echo "<script>alert('Incorrect email or password')</script>";
    $_SESSION["loginAttempt"] = 0;
  }
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">
    <link rel="stylesheet" href="tyyli-index.css">

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="bg">

    </div>
    <div class="container">
      <div class="jumbotron">
        <h1>Online scheduler</h1>
      </div>

      <div class="row">

        <div class="col-lg-6 col-12">
          <!-- tässä login-collapsen avaava nappi -->
          <a href="#login-lomake" class="btn btn-success btn-block  btn-lg" id="login-nappi"
             data-toggle="collapse" style="margin-bottom: 30px;">Log in</a>
          <div id="login-lomake"class="container collapse">

          <!-- tämän form-tagin sisällä on kirjautumislomake -->
          <form action="login.php" method="post">

            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label> <!-- sähköpostiosoitteen syöttö kirjautuessa -->
              <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                     aria-describedby="emailHelp" placeholder="Enter email">
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Password</label><!-- salasanan syöttö kirjautuessa -->
              <input type="password" class="form-control"
                     name="password" id="exampleInputPassword1" placeholder="Password">
            </div>

            <button type="submit" class="btn btn-success" style="margin-bottom: 15px">Submit</button>
            <br>
            <button type="button" class="btn btn-danger"
            data-toggle="collapse" data-target="#forgot">Forgot password?</button>

            <div id="forgot" class="collapse">
              <p>  <br>Yeah, well we're all just kind of winging it here <br>
                   with this stuff, so maybe you should be less of <br>
                   an addlepated twat next time and not forget it!<br>

            </div>
          </form>

        </div>
      </div>

        <div class="col-lg-6 col-12">
          <!-- tässä signup-collapsen avaava nappi -->
          <a href="#signup-lomake" class="btn btn-primary btn-block btn-lg"
             data-toggle="collapse" style="margin-bottom: 30px;">Sign up</a>
          <div id="signup-lomake"class="container collapse">

          <!-- tämän form-tagin sisällä on rekisteröitymislomake -->
          <form action="add_user.php" method="post">

            <div class="form-group">
              <label>First name</label> <!-- etunimen syöttö rekisteröityessä -->
              <input type="text" name="sign_fname" class="form-control"  placeholder="First name">
            </div>

            <div class="form-group">
              <label>Last name</label> <!-- sukunimen syöttö rekisteröityessä -->
              <input type="text" name="sign_lname" class="form-control"  placeholder="Last name">
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Email</label> <!-- sähköpostiosoitteen syöttö rekisteröityessä -->
              <input type="email" name="sign_email"
                     class="form-control" id="exampleInputemail2" placeholder="Email">
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Password</label> <!-- salasanan syöttö rekisteröityessä -->
              <input type="password" name="sign_password"
                     class="form-control" id="exampleInputPassword1" placeholder="Password">
              <small id="emailHelp" class="form-text text-muted">Passwords are hashed with SHA512 so no one can see them, not even us!</small>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
          </form>

        </div>
      </div>
    </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>
  </body>
</html>
