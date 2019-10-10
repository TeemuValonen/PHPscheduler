<?php
 date_default_timezone_set("Europe/Helsinki");
  error_reporting(E_ALL);
  ini_set('error_reporting', E_ALL);

  ini_set('error_log', 'script_errors.log');  // change here
  ini_set('log_errors', 'On');
  session_start();



  if (!(isset($_COOKIE[session_name()])) or !(isset($_SESSION["username"]))) {
    header("Location: https://1701560.azurewebsites.net");
  }


  $connectstr_dbhost = '';
  $connectstr_dbname = 'localdb';
  $connectstr_dbusername = '';
  $connectstr_dbpassword = '';

  foreach ($_SERVER as $key => $value) {
  if (strpos($key, "MYSQLCONNSTR_localdb") !== 0) {
  continue;
  }

  $connectstr_dbhost = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
  $connectstr_dbusername = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
  $connectstr_dbpassword = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
  }


  $conn = mysqli_connect($connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpassword,$connectstr_dbname);
  $sql2 = "SELECT * FROM calendaritem WHERE userID='{$_SESSION['userID']}' ORDER BY eventDate, startTime, endTime";

  $result = $conn->query($sql2);

  $ddate = date();
  $date = new DateTime($ddate);
  $viikko = $date->format("m");

  $rivit = array();

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

      $rivit[] = $row;

    }
  } else {
    echo "Tapahtumia ei löytynyt";
  }


  $arrlength = count($rivit);


  function getSeasonalEvents($month) {
  try {
    for($x = 0; $x < $GLOBALS['arrlength']; $x++) {
      $ddate = $GLOBALS['rivit'][$x]["eventDate"];
      $date = new DateTime($ddate);
      $kuukausi = $date->format("m");

      if ($kuukausi == $month) {
        $pvm = date("d.m.Y", strtotime($GLOBALS['rivit'][$x]["eventDate"]));
        echo $pvm . " - "  . $GLOBALS['rivit'][$x]["description"];
        echo "<br>";
      }
    }


  } catch (Exception $e) {
    echo $e->getMessage();
  }
  }
?>


<!doctype html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
            crossorigin="anonymous">
      <link rel="stylesheet" href="tyyli-fullYear.css">

      <title>Full calendar</title>

    </head>


<body>
  <script>

  function vuodenAika(season) {
    var cards= document.getElementsByClassName("seasonCard");

    for(var i=0;i<cards.length;i++) {
      cards[i].style.display = "none";
    }

    document.getElementById('goBack').style.display = "inline";

    if (season == 'talvi') {
      document.body.style.backgroundImage = "url(talvi-iso.jpg)";
      document.getElementById('talviContent').style.display = "block";
    } else if (season == 'kevat') {
      document.body.style.backgroundImage = "url(kevat-iso.jpg)";
      document.getElementById('kevatContent').style.display = "block";
    } else if (season == 'kesa') {
      document.body.style.backgroundImage = "url(kesa-iso.jpg)";
      document.getElementById('kesaContent').style.display = "block";
    } else if (season == 'syksy') {
      document.body.style.backgroundImage = "url(syksy-iso.jpg)";
      document.getElementById('syksyContent').style.display = "block";
    }
  }

  function takaisin() {
    var cards= document.getElementsByClassName('seasonCard');

    for(var i=0;i<cards.length;i++) {
        cards[i].style.display = "initial";
    }
    document.getElementById('talviContent').style.display = "none";
    document.getElementById('kevatContent').style.display = "none";
    document.getElementById('syksyContent').style.display = "none";
    document.getElementById('kesaContent').style.display = "none";
    document.getElementById('goBack').style.display = "none";
    document.body.style.backgroundImage = "url(full-schedule-tausta.jpg)";
  }


  </script>

  <div class="container" style="background-color: rgba(255, 255, 255, 0.7);">

      <h1 id="otsikko">Your <?php echo date("Y",strtotime("Now")); ?></h1>
      <br>

  <div class="row">
    <div class="col-md-12">

      <button id="goBack"type="button" class="btn btn-primary" onclick="takaisin()"
              style="margin-right: 5px;margin-top:5px;">Return to seasons</button>

      <form action="profile.php" method="post">
        <button type="submit" class="btn btn-info"style="margin-top: 5px;">Back to profile</button>
      </form>

      <div class="d-flex justify-content-center flex-wrap">

      <div id="winterOpt" class="seasonCard rounded border border-info"
            onclick="vuodenAika('talvi')">
        <img src="talvi.jpg" class="rounded img-fluid calendarImg"
             alt="Winter">

        <h5> December</h5>
        <h5> January </h5>
        <h5> February</h5>

      </div>


      <div id="springOpt" class="seasonCard rounded border border-warning"
            onclick="vuodenAika('kevat')">
        <img src="kevat.jpg" class="rounded img-fluid calendarImg" alt="Spring">

        <h5> March</h5>
        <h5> April </h5>
        <h5> May </h5>

      </div>

      <div id="summerOpt" class="seasonCard rounded border border-success"
            onclick="vuodenAika('kesa')">
        <img src="kesa.jpg" class="rounded img-fluid calendarImg" alt="Summer">

        <h5> June </h5>
        <h5> July </h5>
        <h5> August </h5>

      </div>


      <div id="autumnOpt" class="seasonCard rounded border border-danger"
            onclick="vuodenAika('syksy')">
        <img src="syksy.jpg" class="rounded img-fluid calendarImg" alt="Autumn">

        <h5> September</h5>
        <h5> October </h5>
        <h5> November </h5>

      </div>


    </div>



    </div>


  </div>

  <div class="row" id="talviContent" style="display:none;">
    <div class="col-12">

  <div id="talviDiv">

    <ul class="nav nav-tabs talviOtsikot">
      <li class="nav-item">
        <a class="nav-link active talviNappi" data-toggle="tab" href="#january"><h4> January </h4></a>
      </li>
      <li class="nav-item">
        <a class="nav-link talviNappi" data-toggle="tab" href="#february"><h4>February</h4></a>
      </li>
      <li class="nav-item">
        <a class="nav-link talviNappi" data-toggle="tab" href="#december"><h4>December</h4></a>
      </li>
    </ul>

    <br>

      <div class="tab-content">
        <div class="tab-pane active" id="january">
          <h5>
            <?php $kuukaus = 1;

            getSeasonalEvents($kuukaus);
            ?>
          </h5>



        </div>
        <div class="tab-pane fade" id="february">
          <h5>
            <?php $kuukaus = 2;

            getSeasonalEvents($kuukaus);
            ?>
          </h5>

        </div>
        <div class="tab-pane fade" id="december">
          <h5>
            <?php $kuukaus = 12;

            getSeasonalEvents($kuukaus);
            ?>
          </h5>
        </div>
      </div>



  </div>


</div>
</div>
<div id="kevatContent" style="display:none;">
  <div id="kevatDiv">

    <ul class="nav nav-tabs kevatOtsikot">
      <li class="nav-item">
        <a class="nav-link active kevatNappi" data-toggle="tab" href="#march"><h4> March </h4></a>
      </li>
      <li class="nav-item">
        <a class="nav-link kevatNappi" data-toggle="tab" href="#april"><h4>April</h4></a>
      </li>
      <li class="nav-item">
        <a class="nav-link kevatNappi" data-toggle="tab" href="#may"><h4>May</h4></a>
      </li>
    </ul>

    <br>

      <div class="tab-content">
        <div class="tab-pane active" id="march">
          <h5>
            <?php $kuukaus = 3;

            getSeasonalEvents($kuukaus);
            ?>
          </h5>



        </div>
        <div class="tab-pane fade" id="april">
          <h5>
            <?php $kuukaus = 4;

            getSeasonalEvents($kuukaus);
            ?>
          </h5>

        </div>
        <div class="tab-pane fade" id="may">
          <h5>
            <?php $kuukaus = 5;

            getSeasonalEvents($kuukaus);
            ?>
          </h5>
        </div>
      </div>



  </div>
</div>

<div id="kesaContent" style="display:none;">
  <div id="kesaDiv">

    <ul class="nav nav-tabs kesaOtsikot">
      <li class="nav-item">
        <a class="nav-link active kesaNappi" data-toggle="tab" href="#june"><h4> June</h4></a>
      </li>
      <li class="nav-item">
        <a class="nav-link kesaNappi" data-toggle="tab" href="#july"><h4>July</h4></a>
      </li>
      <li class="nav-item">
        <a class="nav-link kesaNappi" data-toggle="tab" href="#august"><h4>August</h4></a>
      </li>
    </ul>

    <br>

      <div class="tab-content">
        <div class="tab-pane active" id="june">
          <h5>
            <?php $kuukaus = 6;

            getSeasonalEvents($kuukaus);
            ?>
          </h5>



        </div>
        <div class="tab-pane fade" id="july">
          <h5>
            <?php $kuukaus = 7;

            getSeasonalEvents($kuukaus);
            ?>
          </h5>

        </div>
        <div class="tab-pane fade" id="august">
          <h5>
            <?php $kuukaus = 8;

            getSeasonalEvents($kuukaus);
            ?>
          </h5>
        </div>
      </div>



  </div>
</div>

<div id="syksyContent" style="display:none;">
  <div id="syksyDiv">

    <ul class="nav nav-tabs syksyOtsikot">
      <li class="nav-item">
        <a class="nav-link active syksyNappi" data-toggle="tab" href="#september"><h4> September</h4></a>
      </li>
      <li class="nav-item">
        <a class="nav-link syksyNappi" data-toggle="tab" href="#october"><h4>October</h4></a>
      </li>
      <li class="nav-item">
        <a class="nav-link syksyNappi" data-toggle="tab" href="#november"><h4>November</h4></a>
      </li>
    </ul>

    <br>

      <div class="tab-content">
        <div class="tab-pane active" id="september">
          <h5>
            <?php $kuukaus = 9;

            getSeasonalEvents($kuukaus);
            ?>
          </h5>



        </div>
        <div class="tab-pane fade" id="october">
          <h5>
            <?php $kuukaus = 10;

            getSeasonalEvents($kuukaus);
            ?>
          </h5>

        </div>
        <div class="tab-pane fade" id="november">
          <h5>
            <?php $kuukaus = 11;

            getSeasonalEvents($kuukaus);
            ?>
          </h5>
        </div>
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
