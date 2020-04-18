<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace WebGage;

/**
 * Description of Scene
 *
 * @author salomon
 */
abstract class Scene extends GameObject {
	
	public function getBgImage(): string {
		return '';
	}
	
	public function getFgImage(): string {
		return '';
	}
	
	public function preInitialize(): void {
		parent::preInitialize();
		$this->top = 0;
		$this->left = 0;
		$this->right = 0;
		$this->bottom = 0;
	}
	
	public function setComingFrom(Scene $scene): self {
		$this->comingFrom = $scene;
		return $this;
	}
	
	public function getComingFrom(): Scene {
		if (!$this->comingFrom) {
			throw new \Exception('No source scene specified');
		}
		return $this->comingFrom;
	}
	
	public function hasComingFrom(): bool {
		return $this->comingFrom instanceof self;
	}
	
	public function goToScene(string $className, array $params = [], bool $updateComingFrom = true) {
		$this->getParent()->goToScene($className, $params, $updateComingFrom);
	}
	
	public function addSceneLink(string $className, array $params = []) {
		$this->createObject(SceneLink::class, $params)->onClick(function($context) {
			$this->goToScene($context['className']);
		}, ['className'=>$className]);
	}
	
	public function tell($message, array $options = []): DialogCover {
		$dialogCover = $this->createObject(DialogCover::class);
		$dialogCover->createObject(DialogGlobe::class, array_merge($options, ['text' => $message]));
		
		return $dialogCover;
	}
	
	public function response($message, array $options = []): DialogCover {
		return $this->tell($message, array_merge([
			'top'    => null,
			'right'  => 430,
			'bottom' => 10,
			'left'   => 10,
		], $options));
	}
	
	public function take(GameObject $object) {
		$this->getParentApp()->takeObject($object);
	}
	
	public function has(string $className): bool {
		return $this->getParentApp()->hasObjectByClass($className);
	}
	
}
