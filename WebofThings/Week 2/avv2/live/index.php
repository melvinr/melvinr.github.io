<?php

//Post
$ldr = $_POST['ldr'];

$filename = 'ldr.txt';

$file_data = $ldr . "\n";
$file_data .= file_get_contents($filename);
file_put_contents($filename, $file_data);
//////////////////////////////////////
// FTP Variables for our server
//////////////////////////////////////
// Allows overwriting of existing files on the remote FTP server
$stream_options = array('ftp' => array('overwrite' => true));

// Creates a stream context resource with the defined options
$stream_context = stream_context_create($stream_options);

// WESLEY
$wesley = $_GET['wesley'];
// The path to the FTP file, including login arguments
$ftp_path_wesley = 'ftp://weslema175:kbjqu7e7@besem.nl/public_html/data/wesley.json';
if($wesley == "on") {
    // Opens the file for writing and truncates it to zero length
    if ($fh = fopen($ftp_path_wesley, 'w', 0, $stream_context)) {
        // Writes contents to the file
        fputs($fh, '{"wesley":"on"}');
        // Closes the file handle
        fclose($fh);
    }
    else { die('Could not open file.'); }
}
else if ($wesley == "off") {
    // Opens the file for writing and truncates it to zero length
    if ($fh = fopen($ftp_path_wesley, 'w', 0, $stream_context)) {
        // Writes contents to the file
        fputs($fh, '{"wesley":"off"}');

        // Closes the file handle
        fclose($fh);
    }
    else { die('Could not open file.'); }
}

// BART
$bart = $_GET['bart'];
// The path to the FTP file, including login arguments
$ftp_path_bart = 'ftp://weslema175:kbjqu7e7@besem.nl/public_html/data/bart.json';
if($bart == "on") {
    // Opens the file for writing and truncates it to zero length
    if ($fh = fopen($ftp_path_bart, 'w', 0, $stream_context)) {
        // Writes contents to the file
        fputs($fh, '{"bart":"on"}');
        // Closes the file handle
        fclose($fh);
    }
    else { die('Could not open file.'); }
}
else if ($bart == "off") {
    // Opens the file for writing and truncates it to zero length
    if ($fh = fopen($ftp_path_bart, 'w', 0, $stream_context)) {
        // Writes contents to the file
        fputs($fh, '{"bart":"off"}');

        // Closes the file handle
        fclose($fh);
    }
    else { die('Could not open file.'); }
}

// MELVIN
$melvin = $_GET['melvin'];
// The path to the FTP file, including login arguments
$ftp_path_melvin = 'ftp://weslema175:kbjqu7e7@besem.nl/public_html/data/melvin.json';
if($melvin == "on") {
    // Opens the file for writing and truncates it to zero length
    if ($fh = fopen($ftp_path_melvin, 'w', 0, $stream_context)) {
        // Writes contents to the file
        fputs($fh, '{"melvin":"on"}');
        // Closes the file handle
        fclose($fh);
    }
    else { die('Could not open file.'); }
}
else if ($melvin == "off") {
    // Opens the file for writing and truncates it to zero length
    if ($fh = fopen($ftp_path_melvin, 'w', 0, $stream_context)) {
        // Writes contents to the file
        fputs($fh, '{"melvin":"off"}');

        // Closes the file handle
        fclose($fh);
    }
    else { die('Could not open file.'); }
}

// FONS
$fons = $_GET['fons'];
// The path to the FTP file, including login arguments
$ftp_path_fons = 'ftp://weslema175:kbjqu7e7@besem.nl/public_html/data/fons.json';
if($fons == "on") {
    // Opens the file for writing and truncates it to zero length
    if ($fh = fopen($ftp_path_fons, 'w', 0, $stream_context)) {
        // Writes contents to the file
        fputs($fh, '{"fons":"on"}');
        // Closes the file handle
        fclose($fh);
    }
    else { die('Could not open file.'); }
}
else if ($fons == "off") {
    // Opens the file for writing and truncates it to zero length
    if ($fh = fopen($ftp_path_fons, 'w', 0, $stream_context)) {
        // Writes contents to the file
        fputs($fh, '{"fons":"off"}');

        // Closes the file handle
        fclose($fh);
    }
    else { die('Could not open file.'); }
}

?>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>LED for ESP8266</title>

    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/c3.min.css">
    <script src="js/d3.v3.min.js"></script>
    <script src="js/c3.min.js"></script>
    <script src="js/app.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

  </head>
  <body>
    <div class="container">
      <div class="row" style="margin-top: 20px;">

      <div class="row" style="margin-top: 20px;">
          <div class="col-md-3">
              <h1>Sensordata</h1>
                <div class="info">
                  <h2>Melvin</h2>
                    <div class="data-melvin">
                        <ul style="list-style: none; padding: 0; margin: 0;">
                        </ul>
                    </div>
                </div>
              <hr/>
          </div>
      </div>

      <div id="chart"></div>

        <div class="col-md-3">
          <h1>Bart</h1>
          <a href="?bart=on" class="btn btn-success btn-block btn-lg">Turn On</a>
          <br />
          <a href="?bart=off" class="led btn btn-danger btn-block btn-lg">Turn Off</a>
          <br />
          <div class="bart-status well" style="margin-top: 5px; text-align:center">
            <?php
              if($bart=="on") {
                echo("Turned LED on.");
              }
              else if ($bart=="off") {
                echo("Turned LED off.");
              }
              else {
                echo ("Do something.");
              }
            ?>
          </div>
        </div>

        <div class="col-md-3">
          <h1>Wesley</h1>
          <a href="?wesley=on" class="btn btn-success btn-block btn-lg">Turn On</a>
          <br />
          <a href="?wesley=off" class="led btn btn-danger btn-block btn-lg">Turn Off</a>
          <br />
          <div class="wesley-status well" style="margin-top: 5px; text-align:center">
            <?php
              if($wesley=="on") {
                echo("Turned LED on.");
              }
              else if ($wesley=="off") {
                echo("Turned LED off.");
              }
              else {
                echo ("Do something.");
              }
            ?>
          </div>
        </div>

        <div class="col-md-3">
          <h1>Fons</h1>
          <a href="?fons=on" class="btn btn-success btn-block btn-lg">Turn On</a>
          <br />
          <a href="?fons=off" class="led btn btn-danger btn-block btn-lg">Turn Off</a>
          <br />
          <div class="fons-status well" style="margin-top: 5px; text-align:center">
            <?php
              if($fons=="on") {
                echo("Turned LED on.");
              }
              else if ($fons=="off") {
                echo("Turned LED off.");
              }
              else {
                echo ("Do something.");
              }
            ?>
          </div>
        </div>

        <div class="col-md-3">
          <h1>Melvin</h1>
          <a href="?melvin=on" class="btn btn-success btn-block btn-lg">Turn On</a>
          <br />
          <a href="?melvin=off" class="led btn btn-danger btn-block btn-lg">Turn Off</a>
          <br />
          <div class="melvin-status well" style="margin-top: 5px; text-align:center">
            <?php
              if($melvin=="on") {
                echo("Turned LED on.");
              }
              else if ($melvin=="off") {
                echo("Turned LED off.");
              }
              else {
                echo ("Do something.");
              }
            ?>
          </div>
        </div>

      </div>
    </div>
  </body>
</html>
