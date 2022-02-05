<?php

/**
 * Holds the data contained within the <PageSchema> XML tag.
 */
class PSSchema {
	private $mCategoryName = "";
	private $mPageXML = null;
	/** @var array Stores the template objects */
	private $mTemplates = [];
	/** @var array Stores the template and page section objects */
	private $mFormItemsList = [];
	private $mIsPSDefined = true;

	function __construct( $categoryName ) {
		$this->mCategoryName = $categoryName;
		$title = Title::newFromText( $categoryName, NS_CATEGORY );
		$dbr = wfGetDB( DB_REPLICA );
		$row = $dbr->selectRow( 'page_props',
			[
				'pp_page',
				'pp_propname',
				'pp_value'
			],
			[
				'pp_page' => $title->getArticleID(),
				'pp_propname' => 'PageSchema'
			]
		);
		if ( !$row ) {
			$this->mIsPSDefined = false;
			return;
		}
		$pageXMLstr = $row->pp_value;

		// Parse the string - if the parsing fails, just exit
		// without displaying an error message; the parsing error
		// messages aren't that helpful anyway.
		$this->mPageXML = simplexml_load_string( $pageXMLstr, 'SimpleXMLElement', LIBXML_NOERROR );
		if ( $this->mPageXML == null ) {
			$this->mIsPSDefined = false;
			return;
		}

		// Index for template objects
		$templateCount = 0;
		$pageSectionCount = 0;
		$inherited_templates = [];
		foreach ( $this->mPageXML->children() as $tag => $child ) {
			if ( $tag == 'InheritsFrom ' ) {
				$schema_to_inherit = (string)$child->attributes()->schema;
				if ( $schema_to_inherit != null ) {
					$inheritedSchemaObj = new PSSchema( $schema_to_inherit );
					$inherited_templates = $inheritedSchemaObj->getTemplates();
				}
			}
			if ( $tag == 'Template' ) {
				$ignore = (string)$child->attributes()->ignore;
				if ( count( $child->children() ) > 0 ) {
					$templateObj = new PSTemplate( $child );
					$this->mFormItemsList[] = [ 'type' => $tag,
						'number' => $templateCount,
						'item' => $templateObj ];
						$this->mTemplates[$templateCount] = $templateObj;
					$templateCount++;
				} elseif ( $ignore != "true" ) {
					// Code to add templates from inherited templates
					$temp_name = (string)$child->attributes()->name;
					foreach ( $inherited_templates as $inherited_template ) {
						if ( $inherited_template['type'] == $tag &&
						$temp_name == $inherited_template['item']->getName() ) {
							$this->mFormItemsList[] = [ 'type' => $tag,
								'number' => $templateCount,
								'item' => $inherited_template ];
								$this->mTemplates[$templateCount] = $inherited_template;
							$templateCount++;
						}
					}
				}
			} elseif ( $tag == 'Section' ) {
				$pageSectionObj = new PSPageSection( $child );
				$this->mFormItemsList[] = [ 'type' => $tag,
					'number' => $pageSectionCount,
					'item' => $pageSectionObj ];
				$pageSectionCount++;
			}
		}
	}

	/**
	 * Generates all pages selected by the user, based on the Page Schemas XML.
	 */
	public function generateAllPages( $selectedPageList ) {
		global $wgPageSchemasHandlerClasses;
		foreach ( $wgPageSchemasHandlerClasses as $psHandlerClass ) {
			call_user_func( [ $psHandlerClass, 'generatePages' ], $this, $selectedPageList );
		}
	}

	public function getCategoryName() {
		return $this->mCategoryName;
	}

	public function getXML() {
		return $this->mPageXML;
	}

	public function isPSDefined() {
		return $this->mIsPSDefined;
	}

	/**
	 * Returns an array of PSTemplate objects.
	 */
	public function getTemplates() {
		return $this->mTemplates;
	}

	/**
	 * Returns an array of template and page section objects.
	 */
	public function getFormItemsList() {
		return $this->mFormItemsList;
	}

	public function getObject( $objectName ) {
		global $wgPageSchemasHandlerClasses;
		foreach ( $wgPageSchemasHandlerClasses as $psHandlerClass ) {
			$object = call_user_func( [ $psHandlerClass, 'createPageSchemasObject' ], $objectName, $this->mPageXML );
			if ( $object !== null ) {
				return $object;
			}
		}
		return null;
	}
}
