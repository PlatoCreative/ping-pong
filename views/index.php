<?php
$text = $_GET['rfid'];
$var_str = var_export($text, true);
$var = "<?php\n\n\$$text = $var_str;\n\n?>";
file_put_contents('filename.php', $var);

echo '<br />';

@include 'filename.php';
echo $text;

?>