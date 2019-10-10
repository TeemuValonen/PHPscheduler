<?php

  session_start();
// remove all session variables

  if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600);
  }

  setcookie('userid', '', time() - 3600);
  setcookie('username', '', time() - 3600);
  setcookie('city', '', time() - 3600);

  // destroy the session
  session_destroy();

  header("Location: https://1701560.azurewebsites.net");
  die();
?>
