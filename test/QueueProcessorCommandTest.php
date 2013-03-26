<?php
require_once 'QueueProcessorCommand.php';
use switch5\commom\Command;
use \Mockery as m;

class QueueProcessorcommandTest extends PHPUnit_Framework_Testcase{
	public function testShouldProcessAQueue(){
		$strategy = m::mock('srategy');
		$instance = new Command\QueueProcessorCommand($strategy);

		$load = 2;
		$bd = array(
			'redisConnection' => m::mock('RedisMock'),
			'queue_name' => 'a_name',
			'load' => $load,
		);
		$instance->setRegistry(function($name) use($bd){
			return $bd[$name];
		});


		$strategy->shouldReceive('queueName')
			->andReturn("name")
			->times(3);

		$rc = $bd['redisConnection'];

		$rc->shouldReceive('rpoplpush')
			->with('name','name_work')
			->times($load);

		$rc->shouldReceive('lpop')
			->with('name_work')
			->andReturn(
				"{\"user_id\":0,\"ip\":\"ip0\"}",
				"{\"user_id\":1,\"ip\":\"ip1\"}",
				null
			);

		$strategy->shouldReceive('process')
			->with(
				$rc,
				array(
					'user_id' => 0,
					'ip'=> 'ip0'
			))
			->once();	
		$strategy->shouldReceive('process')
			->with(
				$rc,
				array(
				'user_id' => 1,
				'ip'=> 'ip1'
			))
			->once();	

		$instance->doCommand();
	}
}
?>
