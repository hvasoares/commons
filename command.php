<?php
namespace hvasoares\commom\Command;
interface Command{
	function setRegistry($value);
	function doCommand();
}

?>
