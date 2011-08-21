<?php
/**
 * Classes for PageSchemas extension
 *
 * @file
 * @ingroup Extensions
 */

class PageSchemas {

	/* Functions */
	//Copied from SFUtils
	public static function loadJavascriptAndCSS( $parser = null ) {
		// Handling depends on whether or not this form is embedded
		// in another page.
		if ( !is_null( $parser ) ) {
			$output = $parser->getOutput();
		} else {
			global $wgOut;
			$output = $wgOut;
		}
		$output->addModules( 'jquery' );		
	}
	public static function getCategoriesWithPSDefined(){
		$cat_titles = array();		
		$dbr = wfGetDB( DB_SLAVE );
		//get the result set, query : slect page_props
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

		// MW 1.17 +
		if ( class_exists( 'ResourceLoader' ) ) {
			self::loadJavascriptAndCSS( $parser );
			return;
		}		
	}

	public static function titleString( $title ) {
		$namespace = $title->getNsText();
		if ( $namespace != '' ) {
			$namespace .= ':';
		}
		if ( self::isCapitalized( $title ) ) {
			global $wgContLang;
			return $namespace . $wgContLang->ucfirst( $title->getText() );
		} else {
			return $namespace . $title->getText();
		}
	}
	public static function isCapitalized( $title ) {
		// Method was added in MW 1.16.
		$realFunction = array( 'MWNamespace', 'isCapitalized' );
		if ( is_callable( $realFunction ) ) {
			return MWNamespace::isCapitalized( $title->getNamespace() );
		} else {
			global $wgCapitalLinks;
			return $wgCapitalLinks;
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
		// we are using the SimpleXML library to do the XML validation
		// for now - this may change later
		// hide parsing warnings
		libxml_use_internal_errors(true);
		$xml_success = simplexml_load_string($xmlDTD.$xml);
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
				if ( $tag == 'semanticforms_Form' ){				
					$text .= self::parseFormElem($child);
				}
				else if ($tag == 'Template') {
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
	static function parseFormElem( $form_xml ) {
		$name = $form_xml->attributes()->name;
		$text = self::tableRowHTML('param', 'Form', $name);
		foreach ($form_xml->children() as $key => $value ) {
			$text .= self::tableMessageRowHTML("paramAttrMsg", (string)$key, (string)$value );
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
	public $pageXml=null;
	public $pageXmlstr= "";
	public $pageName="";
    public $formName="";
	public  $formArray = array();
  /* Stores the templte objects */
	public $PSTemplates = array();
    public $isPSDefined = true;
	public $pp_value = "";
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
		if( $row == null){
			$this->isPSDefined = false;
		}else{
			//retrievimg the third attribute which is pp_value 		
			$pageXmlstr = $row[2];
			$this->pageXml = simplexml_load_string ( $pageXmlstr );
			$this->pageName = (string)$this->pageXml->attributes()->name;
			/*  index for template objects */
			$i = 0;
			$inherited_templates = null ;
			foreach ( $this->pageXml->children() as $tag => $child ) {
				if ( $tag == 'InheritsFrom ' ) {
					$schema_to_inherit = (string) $child->attributes()->schema;
					if( $schema_to_inherit !=null ){
						$inheritedSchemaObj = new PSSchema( $schema_to_inherit );
						$inherited_templates = $inheritedSchemaObj->getTemplates();					
					}
				}
				if ( $tag == 'Template' ) {
					$ignore = (string) $child->attributes()->ignore;
					if( count($child->children()) > 0 ){
						$templateObj =  new PSTemplate($child);					
						$this->PSTemplates[$i++]= $templateObj;
					}else if( $ignore != "true" ) {
						//Code  to Add Templates from Inherited templates
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
	/* function to generate all pages based on the Xml contained in the page */
	function generateAllPages ( $toGenPageList ) {
		wfRunHooks( 'PageSchemasGeneratePages', array( $this, $toGenPageList ));	
	}
	/*return an array of PSTemplate Objects */
	function getFormArray () {
		$obj = $this->getObject('semanticforms_Form');
		 return $obj['sf'];
	}
	/*return an array of PSTemplate Objects */
	function isPSDefined () {
		return $this->isPSDefined;  	
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
		$form_array = $this->getFormArray();
		return $form_array['name'];
	}
	function getObject( $objectName ) {
		$object = array();
		wfRunHooks( 'PageSchemasGetObject', array( $objectName, $this->pageXml, &$object ) );		
		return $object;
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
	public $multiple_allowed = false;
	private $label_name = null;
	function __construct( $template_xml ) {
		$this->templateXml = $template_xml;
		$this->templateName = (string) $template_xml->attributes()->name;
		if( ((string) $template_xml->attributes()->multiple) == "multiple" ) {
			$this->multiple_allowed = true;
		}
		/*index for template objects */
	 	$i = 0 ;
		$inherited_fields = null ;		
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
			}
			else if( $child->getName() == "Label" ) { //@TODO Label => sf:Label 
				$this->label_name = (string)$child;
			} else if ( $child->getName() == "Field" ){
				$ignore = (string) $child->attributes()->ignore;
			    if( count($child->children()) > 0 ){ //@TODO :Can be dealt more efficiently
					$fieldObj =  new PSTemplateField($child);
					$this->PSFields[$i++]= $fieldObj;
				}else if( $ignore != "true" ) {
					//Code  to Add Templates from Inherited templates
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
	function getName(){
	return $this->templateName;
	}
	function isMultiple(){
	return $this->multiple_allowed;
	}
	public function getLabel(){
	return $this->label_name;
	}	
	function getFields(){    
	return $this->PSFields;
	}
}

class PSTemplateField {
	
	public $fieldName ="";
	public $fieldXml= null;
    public $fieldLabel = "";
	private $list_values = false;
	private $delimiter=null;
	function __construct( $field_xml ) {
		$this->fieldXml = $field_xml; 
		$this->fieldName = (string)$this->fieldXml->attributes()->name;
		if( ((string)$this->fieldXml->attributes()->list) == "list") {
			$this->list_values = true;
		}
		if( ((string)$this->fieldXml->attributes()->delimiter) != null || ((string)$this->fieldXml->attributes()->delimiter) != '' ){
			$this->delimiter = (string)$this->fieldXml->attributes()->delimiter;
		}
		foreach ($this->fieldXml->children() as $tag => $child ) {
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
		return $this->list_values;
	}
	function getObject( $objectName ) {
		$object = array();
		wfRunHooks( 'PageSchemasGetObject', array( $objectName, $this->fieldXml, &$object ) );		
		return $object;
	}
}
