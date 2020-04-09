<?php

class PSTemplateField {
	private $mFieldName = "";
	private $mFieldXML = null;
	private $mFieldLabel = "";
	private $mIsList = false;
	private $mDelimiter = null;
	private $mDisplay = null;
	private $mNamespace = null;

	function __construct( $fieldXML ) {
		$this->mFieldXML = $fieldXML;
		$this->mFieldName = (string)$fieldXML->attributes()->name;
		if ( ( (string)$fieldXML->attributes()->list ) == "list" ) {
			$this->mIsList = true;
		}
		$this->mDelimiter = $fieldXML->attributes()->delimiter;
		$this->mDisplay = $fieldXML->attributes()->display;
		$this->mNamespace = $fieldXML->attributes()->namespace;
		foreach ( $fieldXML->children() as $tag => $child ) {
			if ( $tag == 'Label' ) {
				$this->mFieldLabel = $child;
			}
		}
	}

	public function getDelimiter() {
		return $this->mDelimiter;
	}

	public function getDisplay() {
		return $this->mDisplay;
	}

	public function getNamespace() {
		return $this->mNamespace;
	}

	public function getName() {
		return $this->mFieldName;
	}

	public function getLabel() {
		return $this->mFieldLabel;
	}

	public function isList() {
		return $this->mIsList;
	}

	public function getObject( $objectName ) {
		global $wgPageSchemasHandlerClasses;

		foreach ( $wgPageSchemasHandlerClasses as $psHandlerClass ) {
			$object = call_user_func( [ $psHandlerClass, 'createPageSchemasObject' ], $objectName, $this->mFieldXML );
			if ( $object !== null ) {
				return $object;
			}
		}
		return null;
	}
}
