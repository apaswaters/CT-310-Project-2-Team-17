<?php
class Pet{
	public $id;
	public $image;
	public $weight;
	public $short;
	public $long;

	public function __construct($id, $img_id, $wht, $shrt, $lng) {
		$this->id = $id;
		$this->image = $img_id;
		$this->weight = $wht;
		$this->short = $shrt;
		$this->long = $lng;
	}

}
?>
