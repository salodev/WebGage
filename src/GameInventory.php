<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace WebGage;

/**
 * Description of GameViewPort
 *
 * @author salomon
 */
class GameInventory extends GameObject {
	
	public function addObject(GameObject $object): self {
		$object->top = 0;
		$object->left = 0;
		$objects = $this->getChildObjects();
		if ($objects->length()) {
			$last = $objects->getLastObject();
			$object->left = ($last->left/1) + ($last->width/1) + 5;
		}
		$objects->addObject($object);
		$object->setParentObject($this);
		$this->modified();
		return $this;
	}
}
