<?php

class vacantesTest extends WebTestCase
{
	public $fixtures=array(
		'vacantes'=>'vacantes',
	);

	public function testShow()
	{
		$this->open('?r=vacantes/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=vacantes/create');
	}

	public function testUpdate()
	{
		$this->open('?r=vacantes/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=vacantes/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=vacantes/index');
	}

	public function testAdmin()
	{
		$this->open('?r=vacantes/admin');
	}
}
