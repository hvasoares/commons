<?php
namespace switch5\commom\Command;
interface Command{
	function setRegistry($value);
	function doCommand();
}

?>
