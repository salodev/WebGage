<?php
/**
 * 
 * Web Graphic Adventure Game Engine by @salojc2006
 * Started in december 2019
 * 
 * Check it from https://github.com/salojc2006/WebGage
 * 
 * This is the base appliction behind the magic is hidden.
 * Just extending it your core is ready.
 * 
 * You may desire change the name, provider and revsion, so overwite the
 * getName(), getProvider() and getVersion() methods.
 * 
 */

namespace WebGage;

use Webos\Application;
use WebGage\Windows\Main;

abstract class App extends Application {
	
	private $_inventory = null;
	
	public function getName(): string {
		return 'Graphic Adventure Game Engine made with WebGAGE';
	}

	public function getProvider(): string {
		return 'salojc2006';
	}

	public function getVersion(): string {
		return '0.0.0';
	}
	
	abstract public function getMainSceneClass(): string;

	public function main(array $data = []) {
		$mainWindow     = $this->openWindow(Main::class);
		$mainSceneClass = $this->getMainSceneClass();
		$mainWindow->viewPort->goToScene($mainSceneClass);
	}
	
	public function setInventoryObject(GameObject $object): self {
		$this->_inventory = $object;
		return $this;
	}
	
	public function getInventoryObject(): GameObject {
		return $this->_inventory;
	}

	/**
	 * Application handles takeObject action, because it has access to all
	 * object model.
	 */
	public function takeObject(GameObject $object) {
		$object->getParent()->removeChild($object);
		$this->_inventory->addObject($object);
		$object->index();
		$object->getChildObjects()->index();
	}
	
	/**
	 * Useful to ask for invetory object class.
	 */
	public function hasObjectByClass(string $objectClass): bool {
		return $this->_inventory->getObjectsByClassName($objectClass)->length()>0;
	}
}