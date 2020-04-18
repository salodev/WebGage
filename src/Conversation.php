<?php

namespace WebGage;

class Conversation extends GameObject {
			
	public function addMessage(string $text, array $options = []): SceneLink {
		$top    = 0;
		$height = 0;
		
		try {
			$last   = $this->getChildObjects()->getLastObject();
			$top    = $last->top/1;
			$height = $last->height/1;
		} catch (\Exception $e) {
			
		}
		
		return $this->createLink(array_merge([
			'height' => 30,
		],
			$options, 
		[
			'left'     => 15,
			'right'    => 15,
			'top'      => $top + $height + 15,
			'text'     => $text,
			'color'    => '#fff',
			'fontSize' => '22',
		]));
	}
	
}
