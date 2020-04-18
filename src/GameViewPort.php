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
class GameViewPort extends GameObject {
	
	public function preInitialize(): void {
		parent::preInitialize();		
		$this->top = 0;
		$this->left = 0;
		$this->right = 0;
		$this->bottom = 0;		
	}
	
	public function goToScene(string $className, array $params = []) {
		$rs = $this->getObjectsByClassName($className);
		if ($rs->count()<1) {
			$scene = $this->createObject($className, $params);
		}
		if ($rs->count() == 1) {
			$scene = $rs->item(0);
		}
		if ($rs->count()>1) {
			throw new \Exception("Hay mas de una escena '{$className}'");
		}
		if ($this->activeScene instanceof Scene) {
			if (!$scene->hasComingFrom()) {
				$scene->setComingFrom($this->activeScene);
			}
		}
		$this->activeScene = $scene;
		$this->modified();
		return $this;
	}
	
	public function render(): string {
		$render = '<div id="'.$this->getObjectID().'" style="width:1100px;height:600px;top:0;left:0;position:absolute;display:block;background:#000;">';
		if ($this->activeScene) {
			$render .= $this->activeScene->render();
		}
		
		$render .= '</div>';
		return $render;
	}
}
