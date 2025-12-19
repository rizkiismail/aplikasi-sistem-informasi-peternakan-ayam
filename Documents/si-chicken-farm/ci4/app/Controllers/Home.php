<?php

namespace App\Controllers;

use App\Models\StokModel;

class Home extends BaseController
{
	protected $StokModel;
	public function __construct()
	{
		$this->StokModel = new StokModel();
	}
	public function index()
	{
		$data = [
			'title' => 'Home',
			'stokpakan' => $this->StokModel->hitungStokPakan(),
			'sisaayam' => $this->StokModel->hitungAyam()
		];
		return view('home/dashboard', $data);
	}
}
