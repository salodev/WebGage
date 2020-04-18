<?php

namespace WebGage;

class DialogCover extends GameObject {
	
	public function initialize(array $params = []) {
		
		$this->top    = 0;
		$this->left   = 0;
		$this->right  = 0;
		$this->bottom = 0;
		$this->backgroundColor = 'rgba(0,0,0,0.5)'; // css hack
		
		$this->onClick(function() {
			$this->close();
		});
	}
	
	public function close() {
		if ($this->triggerEvent('close')) {
			$this->getParent()->removeChild($this);
		}
	}
	
	public function onClose(callable $function, bool $persistent = true, array $contextData = []): self {
		return $this->bind('close', $function, $persistent, $contextData);
	}
}
