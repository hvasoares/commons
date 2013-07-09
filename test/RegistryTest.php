<?php
namespace hvasoares\commom;
require_once 'Registry.php';
class RegistryTest  extends \PHPUnit_Framework_Testcase{
	public function testShouldSetASingleObject(){
		$assert = $this;
		$inst = new Registry();

		$inst['key'] = 'val';
		$inst['key2'] = function($r) use($assert,$inst){
			$assert->assertEquals($r,$inst);
			return 'val2';
		};

		$this->assertEquals($inst['key'],'val');
		$this->assertEquals($inst['key2'],'val2');

	}
}
?>
