<?php

namespace WebGage\Windows;

use Webos\Visual\Windows\Application as Window;
use WebGage\GameViewPort;
use WebGage\GameInventory;

class Main extends Window {
	
	/**
	 *
	 * @var WebGage\GameViewPort 
	 */
	public $viewPort;
	
	public function initialize(array $params = []): void {
		$this->title = 'Millonario - Prueba de juego';
		$this->viewPort = $this->createObject(GameViewPort::class, [
			'width' => 1100,
			'height' => 600,
		]);
		$this->inventory = $this->createObject(GameInventory::class, [
			'top' => 600,
			'left'   => 0,
			'width'  => 1100,
			'height' => 120,
			//'backgroundColor' => 'black',
		]);
		$this->getParentApp()->setInventoryObject($this->inventory);
	}
	
}