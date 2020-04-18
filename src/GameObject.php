<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace WebGage;

use Webos\VisualObject;
use Webos\StringChar;
use Webos\Visual\Controls\Image;

/**
 * Description of GameObject
 *
 * @author salomon
 */
abstract class GameObject extends VisualObject {
	
	public $hasImage = true;
	
	public function preInitialize(): void {
		if ($this->hasImage) {
			$this->backgroundImage = \Webos\Webos::GetUrl() . 'images/' . str_replace('\\', '/', get_class($this)) . '.png';
		}
	}
	
	public function setupBackgroundImage(string $path): self {
		$this->setFilePath($path);
		$baseUrl = \Webos\Webos::GetUrl();
		$url     = $baseUrl . $this->getMediaContentForSrc();
		$this->backgroundImage = $url;
		return $this;
	}
	
	public function getMainImage(): string {
		return PATH_CLASS . implode('/', array_slice(explode('\\', get_class($this)), 1)) . '.png';
	}
	
	/**
	 * 
	 * @param $eventListener
	 * @return $this
	 */
	public function onClick(callable $eventListener, array $contextData = []): self {
		$this->bind('click', $eventListener, true, $contextData);
		return $this;
	}
	
	/**
	 * receive click event from the web.
	 */
	public function action_click(): void {
		$this->triggerEvent('click');
	}
	
	public function createImage(array $options = []): Image {
		return $this->createObject(Image::class, $options);
	}
	
	public function createLink(array $options = []): SceneLink {
		return $this->createObject(SceneLink::class, $options);
	}
	
	public function createBackLink(array $options = []): SceneLink {
		$options = array_merge([
			'bottom' => 0,
			'right'	 => 0,
			'height' => 84,
			'width'	 => 130,
		], $options);
		$link = $this->createObject(BackLink::class, $options);
		$link->onClick(function() {
			if ($this instanceof Scene) {
				$parentScene = $this;
			} else {
				$parentScene  = $this->getParent();
			}
			$parentScene->goToScene(get_class($parentScene->getComingFrom()), [], false);
		});
		return $link;
	}
	
	public function createConversation(array $options = []): Conversation {
		return $this->createObject(Conversation::class, array_merge([
			'top'    => 0,
			'width'  => 420,
			'right'  => 0,
			'bottom' => 90,
		], $options));
	}
	
	/**
	 * Emtpy rendereing..
	 * @return string
	 */
	public function render(): string {
		
		if ($this->visible === false) {
			return '';
		}
		
		$directiveClick = $this->hasListenerFor('click') ? 'webos click' : '';
		
		$html = new StringChar(
			'<div id="__id__" class="__class__" '.$directiveClick.' __style__>' . ($this->text??'') . $this->_childObjects->render() . '</div>'
		);
		
		$html->replace('__style__', $this->getInLineStyle());
			
		$html->replaces([
			'__id__'      => $this->getObjectID(),
			'__class__'   => $this->getClassNameForRender(),
		]);

		return $html;
	}
	
	public function canUseWith(self $gameObject): bool {
		return false;
	}
	
	public function useWith(self $gameObject): void {
		
	}
}
