<?php

namespace WebGage;

class DialogGlobe extends GameObject {
	
	public function getInitialAttributes(): array {
		return [
			'backgroundColor'	 => '#FFFFFF',
			'border'			 => 'solid 2px #000000',
			'borderRadius'		 => 18,
			'padding'			 => 13,
			'fontSize'			 => 20,
			'top'				 => 20,
			'left'				 => 30,
			'right'				 => 30,
			'height'			 => 100,
		];
	}
}
