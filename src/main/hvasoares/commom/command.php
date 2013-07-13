<?php
namespace hvasoares\commons\Command;
interface Command{
	function setRegistry($value);
	function doCommand();
}

?>
