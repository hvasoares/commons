<?php
namespace switch5\commom\Command;

require_once 'command.php';
class QueueProcessorCommand implements Command{
	public function __construct($strategy){
		$this->s = $strategy ;
	}

	public function setRegistry($value){
		$this->r = $value;
	}

	public function doCommand(){
		$reg = $this->r;
		$workQ = $this->s->queueName()."_work";
		$this->pushToWork($reg,$workQ);
		$this->doWork($reg,$workQ);
	}	

	private function pushToWork($reg,$queue){
		for($i=0; $i<$reg('load'); $i++)
			$reg('redisConnection')->rpoplpush(
				$this->s->queueName(),
				$queue
			);
	}

	private function doWork($reg,$workq){
		$rc= $reg("redisConnection");
		for($cmd=$rc->lpop($workq);$cmd;
		$cmd=$rc->lpop($workq))
			$this->s->process(
				$rc,
				json_decode($cmd,true)
			);
	}
}?>
