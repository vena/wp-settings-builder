<?php
// Basic text field

namespace vena\WordpressSettingsBuilder\FieldTypes;

class Text {
	use Generic;

	public function __construct( $options ) {
		$this->traitConstructor( $options );
	}
}
