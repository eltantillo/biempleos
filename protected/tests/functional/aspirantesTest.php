<?php

class aspirantesTest extends WebTestCase
{
	public $fixtures=array(
		'aspirantes'=>'aspirantes',
	);

	public function testShow()
	{
		$this->open('?r=aspirantes/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=aspirantes/create');
	}

	public function testUpdate()
	{
		$this->open('?r=aspirantes/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=aspirantes/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=aspirantes/index');
	}

	public function testAdmin()
	{
		$this->open('?r=aspirantes/admin');
	}
}
