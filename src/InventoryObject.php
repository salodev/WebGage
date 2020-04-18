<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace WebGage;

/**
 * Description of InventoryObject
 *
 * @author salomon
 */
class InventoryObject extends GameObject {
	//put your code here
	
	public function preInitialize(): void {
		parent::preInitialize();
		$this->onClick(function() {
			if (!($this->getParent() instanceof GameInventory)) {
				$this->getParentApp()->takeObject($this);
			}
		});
	}
}
