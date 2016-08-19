<?php

class localidadesTest extends WebTestCase
{
	public $fixtures=array(
		'localidades'=>'localidades',
	);

	public function testShow()
	{
		$this->open('?r=localidades/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=localidades/create');
	}

	public function testUpdate()
	{
		$this->open('?r=localidades/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=localidades/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=localidades/index');
	}

	public function testAdmin()
	{
		$this->open('?r=localidades/admin');
	}
}
