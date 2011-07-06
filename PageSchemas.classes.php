<?php
/**
 * Classes for PageSchemas extension
 *
 * @file
 * @ingroup Extensions
 */

class PageSchemas {

	/* Functions */
	public static function validateXML( $xml, &$error_msg ) {
	
	
		$xmlDTD =<<<END
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE PageSchema [
<!ELEMENT PageSchema (Template*)>
<!ATTLIST PageSchema name CDATA #REQUIRED>
<!ELEMENT Template (Field*)>
<!ATTLIST Template name CDATA #REQUIRED>
<!ATTLIST Field name CDATA #REQUIRED>
]>

END;
		// we are using the SimpleXML library to do the XML validation
		// for now - this may change later
		// hide parsing warnings
		libxml_use_internal_errors(true);
		$xml_success = simplexml_load_string($xmlDTD . $xml);
		$errors = libxml_get_errors();
		$error_msg = $errors[0]->message;
		return $xml_success;
	}

	static function tableRowHTML($css_class, $data_type, $value = null) {
		$data_type = htmlspecialchars($data_type);
		if (is_null($value)) {
			$content = $data_type;
		} else {
			$content = "$data_type: " . HTML::element('span', array('class' => 'rowValue'), $value);
		}
		$cell = HTML::rawElement('td', array('colspan' => 2, 'class' => $css_class), $content);
		$text = HTML::rawElement('tr', null, $cell);
		$text .= "\n";
		return $text;
	}

	static function tableMessageRowHTML( $css_class, $name, $value ) {
		$cell1 = HTML::element('td', array('class' => $css_class), $name);
		$cell2 = HTML::element('td', array('class' => 'msg'), $value);
		$text = HTML::rawElement('tr', null, $cell1 . "\n" . $cell2);
		$text .= "\n";
		return $text;
	}

	static function parsePageSchemas($class_schema_xml) {
	
		global $wgTitle;		
		if($wgTitle->getNamespace() == NS_CATEGORY){
		$text = "<p>Schema description:</p>\n";
		$text .= "<table class=\"pageSchema\">\n";
		$name = $class_schema_xml->attributes()->name;
		$text .= self::tableRowHTML('paramGroup', 'PageSchema', $name);
			foreach ( $class_schema_xml->children() as $tag => $child ) {
				if ($tag == 'Template') {
					$text .= self::parseTemplate($child);
				} else{
					echo "Code to be added by other extension\n";
				}
			}
		$text .= "</table>\n";
		}else{
		$text = "";
		}			
		return $text;		
	}
	static function parseTemplate ( $template_xml ) {		
		$name = $template_xml->attributes()->name;
		$text = self::tableRowHTML('param', 'Template', $name);
		foreach ($template_xml->children() as $child) {
			$text .= self::parseField($child);
		}
		return $text;
	}		
	static function parseField ( $field_xml ) {
		$name = $field_xml->attributes()->name;
		$text = self::tableRowHTML('paramAttr', 'Field', $name);
		$text_object = array(); //different extensions will fill the html parsed text in this array via hooks
		wfRunHooks( 'PSParseFieldElements', array( $field_xml, &$text_object ) );		
		foreach( $text_object as $key => $value ) {
			$text .= $value;
		}
		return $text;
	}
}

/*class holds the PageScheme tag equivalent object */

class PSSchema {

	public  $categoryName="";
	public $pageId=0;
	public  $pageXml=null;
	public $pageXmlstr= "";
	public $pageName="";
    public $formName="";
  /* Stores the templte objects */
	public $PSTemplates = array();
  
	function __construct ( $category_name ) {			
		$this->categoryName = $category_name; 
		$title = Title::newFromText( $category_name, NS_CATEGORY );
		$this->pageId = $title->getArticleID(); 		
		$dbr = wfGetDB( DB_SLAVE );
		//get the result set, query : slect page_props
		$res = $dbr->select( 'page_props',
		array(
			'pp_page',
			'pp_propname',
			'pp_value'	
		),
		array(
			'pp_page' => $this->pageId,
			'pp_propname' => 'PageSchema'
		)
		);
		//first row of the result set 
		$row = $dbr->fetchRow( $res );
		//retrievimg the third attribute which is pp_value 
		$pageXmlstr = $row[2];
		$pageXml = simplexml_load_string ( $pageXmlstr );	
		$this->pageName = (string)$pageXml->attributes()->name;				
		/*  index for template objects */
	 	$i = 0 ;
		foreach ( $pageXml->children() as $tag => $child ) {
			if ( $tag == 'Template' ) {				
			    $templateObj =  new PSTemplate($child);
				$this->PSTemplates[$i++]= $templateObj;				
			}
			if ( $tag == 'FormName' ) {
				$this->formName = (string)$child;
			}
		}
	}
	/* function to generate all pages based on the Xml contained in the page */
	function generateAllPages () {
		wfRunHooks( 'PageSchemasGeneratePages', array( $this ));	
	}
	/*return an array of PSTemplate Objects */
	function getTemplates () {
		return $this->PSTemplates;  	
	}		
	 /*returns the name of the PageSchema object */
	function getName(){
		return $this->pageName;
    }
	function getFormName(){
		return $this->formName;
	}
	function getCategoryName(){		
		return $this->categoryName;
    }		
	
}
class PSTemplate { 
	/* Stores the field objects */
	public $PSFields = array(); 
	public $templateName ="";
	public $templateXml = null;
	function __construct( $template_xml ) {
		$this->templateXml = $template_xml; 
		$this->templateName = (string) $template_xml->attributes()->name;
		/*index for template objects */
	 	$i = 0 ;
		foreach ($template_xml->children() as $child) {			
		    $fieldObj =  new PSTemplateField($child);
			$this->PSFields[$i++]= $fieldObj;								
		}	
	}
	function getName(){
	return $this->templateName;
  }
	function getFields(){    
	return $this->PSFields;
	}   
}

class PSTemplateField {
	
	public $fieldName ="";
	public $fieldXml= null;
    public $fieldLabel = "";	
	function __construct( $field_xml ) {
		$this->fieldXml = $field_xml; 
		$this->fieldName = (string)$this->fieldXml->attributes()->name;
		foreach ($this->fieldXml->children() as $tag => $child ) {
			if ( $tag == 'Label' ) {
			$this->fieldLabel = (string)$child;
			}									
		}		
	}
	function getName(){
		return $this->fieldName;
	}
	function getLabel(){
		return $this->fieldLabel;
	}
	function getObject( $objectName ) {
		$object = array();
		wfRunHooks( 'PageSchemasGetObject', array( $objectName, $this->fieldXml, &$object ) );		
		return $object;
	}
}
