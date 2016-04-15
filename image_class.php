<?php
class Image {

	public $id;
	public $name;
	public $type;
	public $size;
	public $ext;

	public function __construct($id, $name, $type, $size, $ext) {
		$this->id = $id;
		$this->name = $name;
		$this->type = $type;
		$this->size = $size;
		$this->ext = $ext;
	}
}
?>
