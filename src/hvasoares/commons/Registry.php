<?php
namespace hvasoares\commons;
class Registry implements \ArrayAccess{
	public function __construct($parent=null){
		$this->db = array();
		$this->readOnly = false;
		$this->parent = $parent;
	}

	public function offsetExists($key){
		if(array_key_exists($key,$this->db))
			return true;
		elseif($this->parent)
			return $this->offsetExists($key);
		return false;
	}

	public function offsetGet($key){
		if(array_key_exists($key,$this->db))
			return $this->returnVal($key);
		elseif($this->parent)
			return $this->parent->offsetGet($key);
		throw new \Exception('Doesnt exists key '.$key);
	}

	public function offsetSet($key,$val){
		$this->db[$key] = $val;
	}

	public function offsetUnset($key){unset($this->db[$key]);}
	private function returnVal($key){
		$val = $this->db[$key];
		if($val instanceof \Closure)
			return $val($this);
		return $val;
	}
}
?>
