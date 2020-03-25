<?php
namespace interfaces;

Interface RegisterInterface {
	public function save();
	public function getActiveData(int $id);
}
