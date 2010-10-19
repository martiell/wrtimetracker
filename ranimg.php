<?php
header("Content-type: image/gif");

$file_name = "images/ttuc".rand(1,3).".gif";
if (file_exists($file_name)) {
	print implode('', file($file_name));
}
?>