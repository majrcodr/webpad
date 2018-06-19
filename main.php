<?php

//session_start();

if (!isset($_GET['d'])) {

$dir = file_get_contents('directoryRoot.conf');

if (isset($_GET['dir'])) {
   $sub = "ls -d ";
   exec($sub . $dir . "/*/", $array);
} else {
   $sub = "ls ";
   exec($sub . $dir, $array);
}

//exec("cd " . $dir']); <-- Does this do anything

//var_dump($array);

foreach ($array as $array) {
   $array = str_replace($dir . "/", "", $array);
   echo "<a href='/?d=" . $array . "'>" . $array . "</a><br>";
}

} else {
   if (!isset($_GET['f'])) {
   $dir = file_get_contents('directoryRoot.conf');
   $temp = $dir . "/";

   exec("ls " . $temp . $_GET['d'], $array);
   //var_dump($array);
   //var_dump($_SERVER);
   //$uri = substr($_SERVER['REQUEST_URI'], 0, strlen($_SERVER['REQUEST_URI']) - 1);
   $uri = $_SERVER['REQUEST_URI'];
   //echo $uri . "<br><br>";
   $cururl = $_SERVER['REMOTE_ADDR'] . $_SERVER['SCRIPT_NAME'] . $uri;
   //echo $cururl . "<br><br><br>";
   foreach ($array as $array) {
   //$array[$i] = str_replace($dir'] . "/", "", $array[$i]);
   echo "<a href='" . "http://" .$cururl ."&f=" . $array . "'>" . $array . "</a><br>";
}
   echo "<br><br><br>" . '<a href="' . $_SERVER['HTTP_REFERER'] . '"><button>Go back</button></a>';
} else {
   $contents = nl2br(file_get_contents($_GET['f']));
   //$contents = htmlspecialchars($contents);
   //$contents = htmlentities($contents);
   $contents = highlight_string($contents, true);
   $contents = nl2br($contents);
   echo '<div id="contents" contenteditable="true">' . $contents .'</div><br><br><br>';
   echo '<button onclick="saveFile()" id="saveBtn">Save</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
   echo '<a href="' . $_SERVER['HTTP_REFERER'] . '"><button>Go back</button></a>';
   echo "<p id='dir'>" . $_GET['d'] . "</p>";
   echo "<p id='file'>" . $_GET['f'] . "</p>";
}
}

?>