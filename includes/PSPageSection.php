<?php

class PSPageSection {

	private $mPageSectionXML = null;
	private $mSectionName = "";
	private $mSectionLevel = 2;

	function __construct( $pageSectionXML ) {
		$this->mPageSectionXML = $pageSectionXML;
		$this->mSectionName = (string)$pageSectionXML->attributes()->name;
		$this->mSectionLevel = (string)$pageSectionXML->attributes()->level;
	}

	public function getSectionName() {
		return $this->mSectionName;
	}

	public function getSectionLevel() {
		return $this->mSectionLevel;
	}

	public function getObject( $objectName ) {
		global $wgPageSchemasHandlerClasses;

		foreach ( $wgPageSchemasHandlerClasses as $psHandlerClass ) {
			$object = call_user_func( [ $psHandlerClass, 'createPageSchemasObject' ], $objectName,
				$this->mPageSectionXML );
			if ( $object !== null ) {
				return $object;
			}
		}
		return null;
	}
}
