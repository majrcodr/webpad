<?php

echo '<link rel="stylesheet" href="http://' . $_SERVER['REMOTE_ADDR'] . '/main.css" id="ss">';

function chooseford() {
   if (isset($_GET['d'])) {
   //A directory is chosen
   if (isset($_GET['f'])) {
      //A file has been chosen
      echo "Editing " . $_GET['f'];
   } else {
      $dir = substr($_GET['d'], 0, strlen($_GET['d']));
      echo "Choose from " . $dir;
   }
   } else {
      echo "Choose a directory or file.";
}
}

?>
<html>
<head>
<script src="http://bit.ly/jslazy"></script>
<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="http://<?php echo $_SERVER['REMOTE_ADDR']; ?>/main.js"></script>
<title><?php chooseford(); ?></title>
</head>
<body onkeydown="keyDown(event)" onclick="onClick(event)">
<center><h1 id="header">WebPad v0.01</h1></center>
<?php include('main.php'); ?>
</body>
</html>