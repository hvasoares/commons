<?php
namespace hvasoares\commons;
class JsonPersistentArray implements \ArrayAccess{
	public function __construct($fileLocation){
		$this->file = $fileLocation;
	}
	public function offsetExists($key){
		$json = $this->loadFile();
		return isset($json[$key]);
	}	
	public function offsetGet($key){
		$json = $this->loadFile();
		return $json[$key];
	}
	public function offsetUnset($key){
		$json = $this->loadFile();
		unset($json[$key]);
		$this->flushFile($json);
	}
	public function offsetSet($key,$value){
		$json = $this->loadFile();
		$json[$key] = $value;
		$this->flushFile($json);
	}
	private function loadFile(){
		if(file_exists($this->file))
			return json_decode(
				file_get_contents($this->file),true
			);
		return array();
	}
	private function flushFile($jsonArray){
		$f =fopen($this->file,"w");
		fwrite($f,json_encode($jsonArray));
		fclose($f);
	}
}
?>
