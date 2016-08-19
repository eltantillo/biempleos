<?php

class empresasTest extends WebTestCase
{
	public $fixtures=array(
		'Empresas'=>'empresas',
	);

	public function testShow()
	{
		$this->open('?r=empresas/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=empresas/create');
	}

	public function testUpdate()
	{
		$this->open('?r=empresas/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=empresas/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=empresas/index');
	}

	public function testAdmin()
	{
		$this->open('?r=empresas/admin');
	}
}
