<?php
require_once 'command.php';
interface QueueStrategy{
	function queueName();
	function process($redisConnection,$cmdArray);
}
