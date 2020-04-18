<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace WebGage;

/**
 * Description of SceneLink
 *
 * @author salomon
 */
class SceneLink extends GameObject {
	
	public $hasImage = false;
	
	public function forScene(string $sceneClass, array $params = []): self {
		$this->onClick(function($context) {
			$this->getParent()->goToScene($context['sceneClass'], $context['params']);
		}, ['sceneClass' => $sceneClass, 'params' => $params]);
		return $this;
	}
}
