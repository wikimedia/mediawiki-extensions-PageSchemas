<?php
/**
 * Classes for PageSchemas extension
 *
 * @file
 * @ingroup Extensions
 */

class PageSchemas {

	public static function getCategoriesWithPSDefined(){
		$cat_titles = array();
		$dbr = wfGetDB( DB_SLAVE );
		//get the result set, query : select page_props
		$res = $dbr->select( 'page_props',
			array(
				'pp_page',
				'pp_propname',
				'pp_value'
			),
			array(
				'pp_propname' => 'PageSchema'
			)
		);
		while ( $row = $dbr->fetchRow( $res ) ) {
			if( $row[2] != null ){
				$page_id_cat = $row[0];
				if( Title::newFromId($page_id_cat)->getNamespace() == NS_CATEGORY){
					$cat_text = Title::newFromId($page_id_cat)->getText();
					$cat_titles[] = $cat_text;
				}
			}
		}
		$dbr->freeResult( $res );
		return $cat_titles;
	}

	/**
	 * Includes the necessary Javascript and CSS files for the form
	 * to display and work correctly.
	 *
	 * Accepts an optional Parser instance, or uses $wgOut if omitted.
	 */
	public static function addJavascriptAndCSS( $parser = null ) {
		global $wgOut;

		if ( !$parser ) {
			$wgOut->addMeta( 'robots', 'noindex,nofollow' );
		}

		// Handling depends on whether or not this page is embedded
		// in another page.
		if ( !is_null( $parser ) ) {
			$output = $parser->getOutput();
		} else {
			global $wgOut;
			$output = $wgOut;
		}
		$output->addModules( 'ext.pageschemas.main' );
	}

	public static function titleString( $title ) {
		$namespace = $title->getNsText();
		if ( $namespace != '' ) {
			$namespace .= ':';
		}
		if ( MWNamespace::isCapitalized( $title->getNamespace() ) ) {
			global $wgContLang;
			return $namespace . $wgContLang->ucfirst( $title->getText() );
		} else {
			return $namespace . $title->getText();
		}
	}

	public static function validateXML( $xml, &$error_msg ) {
		$xmlDTD =<<<END
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE PageSchema [
<!ELEMENT PageSchema (Template*)>
<!ELEMENT PageSchema (semanticforms_Form*)>
<!ATTLIST PageSchema name CDATA #REQUIRED>
<!ELEMENT Template (Field*)>
<!ATTLIST Template name CDATA #REQUIRED>
<!ATTLIST semanticforms_Form name CDATA #REQUIRED>
<!ATTLIST Field name CDATA #REQUIRED>
]>

END;
		// <? - this little tag is here to restore syntax highlighting in vi

		// We are using the SimpleXML library to do the XML validation
		// for now - this may change later.
		// Hide parsing warnings.
		libxml_use_internal_errors(true);
		$xml_success = simplexml_load_string($xmlDTD.$xml);
		$errors = libxml_get_errors();
		$error_msg = $errors[0]->message;
		return $xml_success;
	}

	static function tableRowHTML( $css_class, $data_type, $value = null, $bgColor = null ) {
		$data_type = htmlspecialchars( $data_type );
		if ( !is_null( $bgColor ) ) {
			// We don't actually use the passed-in background color, except as an indicator
			// that this is a header row for extension data, and thus should have special
			// display.
			// In the future, the background color may get used, though.
			$data_type =  HTML::element( 'span', array( 'style' => "color: #993333;" ), $data_type );
		}
		if ( $value == '' ) {
			$content = $data_type;
		} else {
			$content = "$data_type: " . HTML::element( 'span', array( 'class' => 'rowValue' ), $value );
		}
		$cellAttrs = array( 'colspan' => 2, 'class' => $css_class );
		$cell = HTML::rawElement( 'td', $cellAttrs, $content );
		//$cell = "<td colspan=2><span style=\"background: white; min-width; 20px;\">.</span><span style=\"background: $bgColor;\">$content</span></td>";
		$text = HTML::rawElement( 'tr', array( 'style' => 'border: 1px black solid; margin: 10px;' ), $cell );
		$text .= "\n";
		return $text;
	}

	static function attrRowHTML( $cssClass, $fieldName, $value ) {
		$fieldNameAttrs = array( 'class' => $cssClass, 'style' => 'font-weight: normal;' );
		$fieldNameCell = HTML::rawElement( 'td', $fieldNameAttrs, $fieldName );
		$valueCell = HTML::element( 'td', array( 'class' => 'msg', 'style' => 'font-weight: bold;' ), $value );
		$text = HTML::rawElement( 'tr', null, $fieldNameCell . "\n" . $valueCell );
		$text .= "\n";
		return $text;
	}

	static function displaySchema($schema_xml) {
		global $wgTitle;

		if ( $wgTitle->getNamespace() == NS_CATEGORY ) {
			//$text = Html::element( 'p', null, wfMsg( 'ps-schema-description' ) ) . "\n";
			$text = "<table class=\"pageSchema mw-collapsible mw-collapsed\">\n";
			$name = $schema_xml->attributes()->name;
			$text .= self::tableRowHTML( 'pageSchemaHeader', 'Page schema' );
			$displayInfoFromExtensions = array();
			wfRunHooks( 'PageSchemasGetSchemaDisplayInfo', array( $schema_xml, &$displayInfoFromExtensions ) );
			foreach( $displayInfoFromExtensions as $displayInfo ) {
				list( $label, $elementName, $bgColor, $values ) = $displayInfo;
				$text .= self::tableRowHTML( 'schemaExtensionRow', $label, $elementName, $bgColor );
				foreach ( $values as $fieldName => $value ) {
					$text .= self::attrRowHTML( 'schemaAttrRow', $fieldName, $value );
				}
			}
			foreach ( $schema_xml->children() as $tag => $child ) {
				if ( $tag == 'Template') {
					$text .= self::displayTemplate($child);
				}
			}
			$text .= "</table>\n";
		} else {
			$text = "";
		}
		return $text;
	}

	static function displayTemplate ( $templateXML ) {
		$name = $templateXML->attributes()->name;
		$text = self::tableRowHTML( 'templateRow', 'Template', $name );
		$multiple = $templateXML->attributes()->multiple;
		if ( $multiple == 'multiple' ) {
			$text .= self::attrRowHTML( 'schemaAttrRow', 'multiple', null );
		}
		$displayInfoFromExtensions = array();
		wfRunHooks( 'PageSchemasGetTemplateDisplayInfo', array( $templateXML, &$displayInfoFromExtensions ) );
		foreach( $displayInfoFromExtensions as $displayInfo ) {
			list( $label, $elementName, $bgColor, $values ) = $displayInfo;
			$text .= self::tableRowHTML( 'fieldExtensionRow', $label, $elementName, $bgColor );
			foreach ( $values as $fieldName => $value ) {
				$text .= self::attrRowHTML( 'fieldAttrRow', $fieldName, $value );
			}
		}
		foreach ( $templateXML->children() as $child ) {
			$text .= self::displayField( $child );
		}
		return $text;
	}

	static function displayField ( $fieldXML ) {
		$name = $fieldXML->attributes()->name;
		$text = self::tableRowHTML( 'fieldRow', 'Field', $name );

		if( ((string) $fieldXML->attributes()->list) == "list" ) {
			$text .= self::attrRowHTML( 'fieldAttrRow', 'List', null );
		}
		foreach ( $fieldXML->children() as $tag => $child ) {
			if ( $tag == 'Label' ) {
				$text .= self::attrRowHTML( 'fieldAttrRow', 'Label', $child );
			}
		}

		// Let extensions that store data within the Page Schemas XML each
		// handle displaying their data, by adding to this array.
		$displayInfoFromExtensions = array();
		wfRunHooks( 'PageSchemasGetFieldDisplayInfo', array( $fieldXML, &$displayInfoFromExtensions ) );
		foreach( $displayInfoFromExtensions as $displayInfo ) {
			list( $label, $elementName, $bgColor, $values ) = $displayInfo;
			$text .= self::tableRowHTML( 'fieldExtensionRow', $label, $elementName, $bgColor );
			foreach ( $values as $fieldName => $value ) {
				$text .= self::attrRowHTML( 'fieldAttrRow', $fieldName, $value );
			}
		}
		return $text;
	}
}

/**
 * Holds the data contained within the <PageSchema> XML tag.
 */
class PSSchema {
	public $categoryName = "";
	public $pageID = 0;
	public $pageXML = null;
	public $pageXMLstr = "";
	/* Stores the template objects */
	public $PSTemplates = array();
	public $isPSDefined = true;
	public $pp_value = "";

	function __construct ( $category_name ) {
		$this->categoryName = $category_name;
		$title = Title::newFromText( $category_name, NS_CATEGORY );
		$this->pageID = $title->getArticleID();
		$dbr = wfGetDB( DB_SLAVE );
		$res = $dbr->select( 'page_props',
			array(
				'pp_page',
				'pp_propname',
				'pp_value'
			),
			array(
				'pp_page' => $this->pageID,
				'pp_propname' => 'PageSchema'
			)
		);
		// first row of the result set
		$row = $dbr->fetchRow( $res );
		if ( $row == null) {
			$this->isPSDefined = false;
		} else {
			// retrieve the third attribute, which is pp_value
			$pageXMLstr = $row[2];
			$this->pageXML = simplexml_load_string ( $pageXMLstr );
			/* index for template objects */
			$i = 0;
			$inherited_templates = array();
			foreach ( $this->pageXML->children() as $tag => $child ) {
				if ( $tag == 'InheritsFrom ' ) {
					$schema_to_inherit = (string) $child->attributes()->schema;
					if( $schema_to_inherit !=null ){
						$inheritedSchemaObj = new PSSchema( $schema_to_inherit );
						$inherited_templates = $inheritedSchemaObj->getTemplates();
					}
				}
				if ( $tag == 'Template' ) {
					$ignore = (string) $child->attributes()->ignore;
					if ( count($child->children()) > 0 ) {
						$templateObj = new PSTemplate($child);
						$this->PSTemplates[$i++]= $templateObj;
					} elseif ( $ignore != "true" ) {
						// Code to add templates from inherited templates
						$temp_name = (string) $child->attributes()->name;
						foreach( $inherited_templates as $inherited_template ) {
							if( $temp_name == $inherited_template->getName() ){
								$this->PSTemplates[$i++] = $inherited_template;
							}
						}
					}
				}
			}
		}
	}

	/* function to generate all pages based on the XML contained in the page */
	function generateAllPages ( $toGenPageList ) {
		wfRunHooks( 'PageSchemasGeneratePages', array( $this, $toGenPageList ));
	}

	/*return an array of PSTemplate Objects */
	function isPSDefined () {
		return $this->isPSDefined;
	}

	/*return an array of PSTemplate Objects */
	function getTemplates () {
		return $this->PSTemplates;
	}

	function getObject( $objectName ) {
		$object = array();
		wfRunHooks( 'PageSchemasGetObject', array( $objectName, $this->pageXML, &$object ) );
		return $object;
	}

	function getCategoryName() {
		return $this->categoryName;
	}
}

class PSTemplate {
	/* Stores the field objects */
	public $PSFields = array();
	public $templateName ="";
	public $templateXML = null;
	public $multiple_allowed = false;

	function __construct( $template_xml ) {
		$this->templateXML = $template_xml;
		$this->templateName = (string) $template_xml->attributes()->name;
		if( ((string) $template_xml->attributes()->multiple) == "multiple" ) {
			$this->multiple_allowed = true;
		}
		/*index for template objects */
	 	$i = 0 ;
		$inherited_fields = array();
		foreach ($template_xml->children() as $child) {
			if ( $child->getName() == 'InheritsFrom' ) {
				$schema_to_inherit = (string) $child->attributes()->schema;
				$template_to_inherit = (string) $child->attributes()->template;
				if( $schema_to_inherit !=null && $template_to_inherit != null ) {
					$inheritedSchemaObj = new PSSchema( $schema_to_inherit );
					$inherited_templates = $inheritedSchemaObj->getTemplates();
					foreach( $inherited_templates as $inherited_template ) {
						if( $template_to_inherit == $inherited_template->getName() ){
							$inherited_fields = $inherited_template->getFields();
						}
					}
				}
			} elseif ( $child->getName() == "Field" ) {
				$ignore = (string) $child->attributes()->ignore;
				if ( count($child->children()) > 0 ) { //@TODO :Can be dealt more efficiently
					$fieldObj = new PSTemplateField($child);
					$this->PSFields[$i++]= $fieldObj;
				} elseif ( $ignore != "true" ) {
					// Code to add fields from inherited templates
					$field_name = (string) $child->attributes()->name;
					foreach( $inherited_fields as $inherited_field ) {
						if( $field_name == $inherited_field->getName() ){
							$this->PSFields[$i++]= $inherited_field;
						}
					}
				}
			}
		}
	}

	function getName() {
		return $this->templateName;
	}

	function isMultiple() {
		return $this->multiple_allowed;
	}

	function getObject( $objectName ) {
		$object = array();
		wfRunHooks( 'PageSchemasGetObject', array( $objectName, $this->templateXML, &$object ) );
		return $object;
	}

	function getFields() {
		return $this->PSFields;
	}
}

class PSTemplateField {
	public $fieldName ="";
	public $fieldXML = null;
	public $fieldLabel = "";
	private $isList = false;
	private $delimiter = null;

	function __construct( $field_xml ) {
		$this->fieldXML = $field_xml;
		$this->fieldName = (string)$this->fieldXML->attributes()->name;
		if( ((string)$this->fieldXML->attributes()->list) == "list") {
			$this->isList = true;
		}
		if( ((string)$this->fieldXML->attributes()->delimiter) != null || ((string)$this->fieldXML->attributes()->delimiter) != '' ){
			$this->delimiter = (string)$this->fieldXML->attributes()->delimiter;
		}
		foreach ($this->fieldXML->children() as $tag => $child ) {
			if ( $tag == 'Label' ) {
				$this->fieldLabel = (string)$child;
			}
		}
	}

	public function getDelimiter(){
		return $this->delimiter;
	}

	function getName(){
		return $this->fieldName;
	}

	function getLabel(){
		return $this->fieldLabel;
	}

	public function isList(){
		return $this->isList;
	}

	function getObject( $objectName ) {
		$object = array();
		wfRunHooks( 'PageSchemasGetObject', array( $objectName, $this->fieldXML, &$object ) );
		return $object;
	}
}
