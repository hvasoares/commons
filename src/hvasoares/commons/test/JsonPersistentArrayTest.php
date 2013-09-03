<?php
namespace hvasoares\commons;
require_once 'JsonPersistentArray.php';
class JsonPersitentArrayTest extends \PHPUnit_Framework_Testcase{
	public function testShouldPersistTheValuesAsJson(){
		$inst = new JsonPersistentArray("/tmp/persists.json");
		$this->assertFalse(isset($inst['someValue']));

		$inst['someValue'] = 'newValue';

		$this->assertTrue(
			file_exists("/tmp/persists.json")
		);

		$this->assertEquals("newValue",$inst["someValue"]);

		unset($inst['someValue']);
		$this->assertFalse(isset($inst['someValue']));

	}

	public function tearDown(){
		if(file_exists("/tmp/persists.json"))
			unlink("/tmp/persists.json");
	}
}
?>
