<?php

class AspirantesTest extends WebTestCase
{
	public $fixtures=array(
		'Aspirantes'=>'Aspirantes',
	);

	public function testShow()
	{
		$this->open('?r=Aspirantes/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=Aspirantes/create');
	}

	public function testUpdate()
	{
		$this->open('?r=Aspirantes/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=Aspirantes/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=Aspirantes/index');
	}

	public function testAdmin()
	{
		$this->open('?r=Aspirantes/admin');
	}
}
