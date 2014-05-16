<?php

$movieName = $_GET["movie"];
$filenameSRT = "./assets/subtitles/" . $movieName . ".srt";

function getMovieFilename($movie) {
  $files = scandir("./assets/");
  foreach ($files as $file) {
    if (strpos($file, $movie) !== false) {
      return "./assets/" . $file;
    }
  }

  return null;
}

if (file_exists($filenameSRT)) {
  echo file_get_contents($filenameSRT);
  die();
}

$filenameVideo = getMovieFilename($movieName);
if ($filenameVideo == null) die();

$output = shell_exec(
  "export LANG=\"en\"; ".
  "/usr/local/bin/getsub -l eng -t srt -s hi $filenameVideo ".
  "&& mv ./assets/*.srt ./assets/subtitles/ 2>&1");
// echo $output;

if (file_exists($filenameSRT)) {
  echo file_get_contents($filenameSRT);
  die();
}

