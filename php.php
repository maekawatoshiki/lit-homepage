<?php
$descriptorspec = array(
	0 => array("pipe", "r"), 
	1 => array("pipe", "w"), 
	2 => array("file", "/tmp/error-output.txt", "a") 
);

$process = proc_open("cd lit; ./lit", $descriptorspec, $pipes, NULL, NULL);

if(is_resource($process)) {
	$input = str_replace("\n", ";", $_POST["source"]);
	fwrite($pipes[0], $input);
	fclose($pipes[0]);

	$output = str_replace("\n", "<BR>", stream_get_contents($pipes[1]));
	print $output;
	fclose($pipes[1]);

	$return_value = proc_close($process);
}
?>

