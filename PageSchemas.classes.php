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
		$text = self::tableRowHTML('template_class', 'PageSchema', $name);
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
		$text = self::tableRowHTML('template_class', 'Template', $name);
		foreach ($template_xml->children() as $child) {
			$text .= self::parseField($child);
		}
		return $text;
	}		
	static function parseField ( $field_xml ) {
		$name = $field_xml->attributes()->name;
		$text = self::tableMessageRowHTML('paramDataField', $name, $field_xml);
		return $text;
	}
}

/*class holds the PageScheme tag equivalent object */

class PageSchema {

	public  $categoryName="";
	public $pageId=0;
	public  $pageXml=null;
	public $pageXmlstr= "";
	public $pageName="";
  
  /* Stores the templte objects */
	public $PSTemplates = array();
  
	function __construct ( $category_name ) {			
		$this->categoryName = $category_name; 
		$title = Title::newFromText( $category_name, NS_CATEGORY );
		$pageId = $title->getArticleID(); 
		$pageXmlstr =<<<END
		<ClassSchema name="City">
			<FormName>City</FormName>
			<Template name="City">
                <Field name="Population">
                    <Property name="Has population">
						<Type>Number</Type>
					</Property>
                    <FormInput>
                        <InputType>text</InputType>
                        <Size>20</Size>
                    </FormInput>
                    <Filter>
                        <Label>Population</Label>
                    </Filter>
                </Field>                
			</Template>        
		</ClassSchema>				
END;
		
		/*
		$dbr = wfGetDB( DB_SLAVE );
		//get the result set, query : slect page_props
		$res = $dbr->select( 'page_props',
		array(
			'pp_page',
			'pp_propname',
			'pp_value'	
		),
		array(
			'pp_page' => $pageId,
			'pp_propname' => 'PageSchema'
		)
		);
	
		//first row of the result set 
		$row = $dbr->fetchRow( $res );
 	
		//retrievimg the third attribute which is pp_value 
		$pageXml = $row[2];
		*/
		$pageXml = simplexml_load_string ( $pageXmlstr );		
		$pageName = $pageXml->attributes()->name;				
		/*  index for template objects */
	 	$i = 0 ;
		foreach ( $pageXml->children() as $tag => $child ) {
			if ( $tag == 'Template' ) {				
			    $templateObj =  new PSTemplate($child);
				$this->PSTemplates[$i++]= $templateObj;				
			}
		}
	
	}
  	
	/* function to generate all pages based on the Xml contained in the page */
	function generateAllPages () {	
	    //Get templates 
		$template_all = $this->getTemplates();		
		//For each template, Get Fields 
		foreach ( $template_all as $template ) {
			$field_all = $template->getFields();
			foreach( $field_all as $field ) { //for each Field, retrieve smw properties and fill $prop_name , $prop_type 		
				$prop_array = $field->getObject('Property');   //this returns an array with property values filled								
				wfRunHooks( 'PageSchemasGeneratePages', array( $prop_array['name'], $prop_array['Type'] ) );		
			}
		}						
	}
	
	/*return an array of PSTemplate Objects */
	function getTemplates () {				
		return $this->PSTemplates;  	
	}
		
	 /*returns the name of the PageSchema object */
	function getName(){		
		return $pageName;
    }
}
class PSTemplate { 
	/* Stores the field objects */
	public $PSFields = array(); 
	public $templateName ="";
	public $templateXml = null;
	function __construct( $template_xml ) {
		$templateXml = $template_xml; 
		$templateName = $templateXml->attributes()->name;
		/*index for template objects */
	 	$i = 0 ;
		foreach ($templateXml->children() as $child) {			
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
	
	function __construct( $field_xml ) {
		$this->fieldXml = $field_xml; 
		$this->fieldName = $this->fieldXml->attributes()->name;		
	}
	function getName(){
		return $this->fieldName;
	}
	function getObject( $objectName ) {
		$object = array();
		wfRunHooks( 'PageSchemasGetObject', array( $objectName, $this->fieldXml, &$object ) );		
		return $object;
	}
}
