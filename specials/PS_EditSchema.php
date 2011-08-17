<?php
/**
 * Displays an interface to let users create all pages based on xml
 *
 * @author Ankit Garg
 */

class EditSchema extends IncludableSpecialPage {
    function __construct() {
        parent::__construct( 'EditSchema' );
        wfLoadExtensionMessages('EditSchema');
    }
    public static function addJavascript() {
		global $wgOut;
		
		PageSchemas::addJavascriptAndCSS();

		// TODO - this should be in a JS file
		$template_name_error_str = wfMsg( 'sf_blank_error' );
		$jsText =<<<END
<script type="text/javascript">
var fieldNum = 1;
var templateNum = 1;
function createTemplateAddField(template_num) {
	fieldNum++;
	newField = jQuery('#starterField').clone().css('display', '').removeAttr('id');
	newHTML = newField.html().replace(/starter/g, fieldNum);
	newField.html(newHTML);
	newField.find(".deleteField").click( function() {
		// Remove the encompassing div for this instance.
		jQuery(this).closest(".fieldBox")
			.fadeOut('fast', function() { jQuery(this).remove(); });
	});
	jQuery('#fieldsList_'+template_num).append(newField);
	addjQueryToCheckbox();
}
function createAddTemplate() {
	templateNum++;
	newField = jQuery('#starterTemplate').clone().css('display', '').removeAttr('id');
	newHTML = newField.html().replace(/starter/g, templateNum);
	newField.html(newHTML);
	newField.find(".deleteTemplate").click( function() {
		// Remove the encompassing div for this instance.
		jQuery(this).closest(".templateBox")
			.fadeOut('fast', function() { jQuery(this).remove(); });
	});
	jQuery('#templatesList').append(newField);
}
function updateFieldNum(field_num){
	fieldNum = field_num;
}

function addjQueryToCheckbox(){
	jQuery('.isListCheckbox').click(function() {		
			if (jQuery(this).is(":checked"))
			{				
				jQuery(this).closest('.fieldBox').find('.delimiterInput').css('display', '');
			}else{				
				jQuery(this).closest('.fieldBox').find('.delimiterInput').css('display', 'none');
			}
	});
}
jQuery(document).ready(function() {
	jQuery(".deleteField").click( function() {
		// Remove the encompassing div for this instance.
		jQuery(this).closest(".fieldBox")
			.fadeOut('fast', function() { jQuery(this).remove(); });
	});
	jQuery(".deleteTemplate").click( function() {
		// Remove the encompassing div for this instance.
		jQuery(this).closest(".templateBox")
			.fadeOut('fast', function() { jQuery(this).remove(); });
	});
	addjQueryToCheckbox();
});

</script>

END;
		$wgOut->addScript( $jsText );
	}
   function execute( $category ) {
		global $wgRequest, $wgOut, $wgUser;
		global $wgSkin;
        $this->setHeaders();		
		$text_1 = '<p>'.wfMsg( 'ps-page-desc-cat-not-exist' ).'</p>';
		$text_2 = '<p>'.wfMsg( 'ps-page-desc-ps-not-exist' ).'</p>';
		$text_3 = '<p>'.wfMsg( 'ps-page-desc-edit-schema' ).'</p>';
		$text_4 = '';
		self::addJavascript();
		$pageSchemaObj = null;
		$text_extensions = array(); //This var. will save the html text returned by the extensions
		$js_extensions = array();
		wfRunHooks( 'getHtmlTextForFieldInputs', array( &$js_extensions, &$text_extensions ));
		$text = "";		
		$text .= '	<form id="createPageSchemaForm" action="" method="post">' . "\n";
		$text .= '<p>'.$schema_name_label.' <input type="text" name="s_name"/> </p> ';
		$text .= '<p>'.$add_xml_label.'
		<textarea rows=4 style="width: 100%" name="ps_add_xml"></textarea> 
		</p> ';		
		if($text_extensions['sf_form'] != null){
			$text_ex = preg_replace('/starter/', '1', $text_extensions['sf_form']);
			$text .= $text_ex;
		}
		$delimeter_label = wfMsg('ps-delimeter-label');
		$multiple_temp_label = wfMsg('ps-multiple-temp-label');
		$field_list_label = wfMsg('ps-field-list-label');
		$add_xml_label = wfMsg('ps-add-xml-label');
		$schema_name_label = wfMsg('ps-schema-name-label');
		$text .= '<div id="templatesList">';
		$text .= '<div class="templateBox" >';
		$text .= '<fieldset style="background: #ddd;"><legend>Template</legend> ';
		$text .= '<p>Name: <input type="text"  name="t_name_1"/></p> ';
		$text .= '<p><input type="checkbox" name="is_multiple_1"/> '.$multiple_temp_label.'</p> ';
		$text .= '<div id="fieldsList_1">';
		$text .= '<div class="fieldBox" >';
		$text .= '<fieldset style="background: #bbb;"><legend>Field</legend> 
		<p>Field name: <input size="15" name="f_name_1">
		Display label: <input size="15" name="f_label_1">
		</p> 
		<p><input type="checkbox" name="f_is_list_1" class="isListCheckbox" />'.
		$field_list_label.'
		</p> 
		<div class="delimiterInput"  style="display: none" ><p>'.$delimeter_label.' <input type="text" name="f_delimiter_1" /> </p></div>';
		if($text_extensions['smw'] != null){
			$text_ex = preg_replace('/starter/', '1', $text_extensions['smw']);
			$text .= $text_ex;
		}				
		if($text_extensions['sf'] != null){
			$text_ex = preg_replace('/starter/', '1', $text_extensions['sf']);
			$text .= $text_ex;
		}				
		if($text_extensions['sd'] != null){
			$text_ex = preg_replace('/starter/', '1', $text_extensions['sd']);
			$text .= $text_ex;
		}
		
		$text .= '<p>'.$add_xml_label.'
		<textarea rows=4 style="width: 100%" name="f_add_xml_1"></textarea> 
		</p> 
		<input type="button" value="Remove field" class="deleteField" /></fieldset>
		</div>			
		</div>	
		';
		$add_field_button = Xml::element( 'input',
		array(
			'type' => 'button',
			'value' => 'Add Field',
			'onclick' => "createTemplateAddField(1)"
		)
		);
		$text .= Xml::tags( 'p', null, $add_field_button ) . "\n";
			$text .= '<hr /> 
			<p>'.$add_xml_label.'
			<textarea rows=4 style="width: 100%" name="t_add_xml_1"></textarea> 
			</p> 
			<p><input type="button" value="Remove template" class="deleteTemplate" /></p> 
		</fieldset> </div></div>';
		    
		$add_template_button = Xml::element( 'input',
			array(
				'type' => 'button',
				'value' => 'Add Template',
				'onclick' => "createAddTemplate()"
			)
		);
		$text .= Xml::tags( 'p', null, $add_template_button ) . "\n";
		$text .= '		<hr /> 
		<div class="editButtons">
	<input type="submit" id="wpSave" name="wpSave" value="Save" />	
	</div>';
				$text .= '	</form>';
				 $starter_text = '<div class="templateBox" id="starterTemplate" style="display: none">
<fieldset style="background: #ddd;">
<legend>Template</legend> 
<p>Name: <input type="text"  name="t_name_starter"/></p> 
<p><input type="checkbox" name="is_multiple_starter"/>  Allow multiple instances of this template</p> 
<div id="fieldsList_starter">
</div>
	<p><input type="button" value="Add Field" onclick="createTemplateAddField(starter)" /></p>

<hr /> 
	<p>'.$add_xml_label.'
	<textarea rows=4 style="width: 100%" name="t_add_xml_starter"></textarea> 
	</p> 
	<p><input type="button" value="Remove template" class="deleteTemplate" /></p> 
	</fieldset>
	</div>	
		<hr /> ';
		$starter_text .= '<div class="fieldBox" id="starterField" style="display: none">
				<fieldset style="background: #bbb;"><legend>Field</legend> 
				<p>
				<input size="15" name="f_name_starter">
				Display label: <input size="15" name="f_label_starter">
				</p>
			<p><input type="checkbox" name="f_is_list_starter" class="isListCheckbox" /> This field can hold a list of values
	&#160;&#160;</p>
	<div class="delimiterInput"  style="display: none" ><p>Delimiter for values (default is ","): <input type="text" name="f_delimiter_starter" /> </p></div>';
	if($text_extensions['smw'] != null){
		$starter_text .= $text_extensions['smw'];
	}
	if($text_extensions['sf'] != null){
		$starter_text .= $text_extensions['sf'];
	}
	if($text_extensions['sd'] != null){
		$starter_text .= $text_extensions['sd'];
	}	
	$starter_text .= '<p>'.$add_xml_label.'
				<textarea rows=4 style="width: 100%" name="f_add_xml_starter"></textarea> 
				</p> 
				<input type="button" value="Remove field" class="deleteField" />
</fieldset>
</div>';
		$text .= $starter_text;
		$save_page = $wgRequest->getCheck( 'wpSave' );
		if ($save_page) {
			//Generate the Xml from the Form elements
			$Xmltext  = "";
			$s_name = $wgRequest->getText('s_name');
			$Xmltext .= '<PageSchema name="'.$s_name.'">';
			$ps_add_xml = $wgRequest->getText('ps_add_xml');
			$Xmltext .= $ps_add_xml;			
			$fieldName = "";
			$fieldNum= -1;
			$templateNum = -1;
			$xml_text_extensions = array(); //This var. will save the xml text returned by the extensions
			$js_extensions = array();
			wfRunHooks( 'getXmlTextForFieldInputs', array( $wgRequest, &$xml_text_extensions ));
			if( $xml_text_extensions['sf_form'] != null ){
				$Xmltext .= $xml_text_extensions['sf_form'];
			}
			$indexGlobalField = 0 ;  //this variable is use to index the array returned by extensions for XML.			
			foreach ( $wgRequest->getValues() as $var => $val ) {
				if(substr($var,0,7) == 't_name_'){
					$templateNum = substr($var,7,1);
					if($wgRequest->getCheck( 'is_multiple_'.$templateNum )){
						$Xmltext .= '<Template name="'.$val.'" multiple="multiple">';
					}else{
						$Xmltext .= '<Template name="'.$val.'">';
					}
				}else if(substr($var,0,7) == 'f_name_'){
					$fieldName = $val;
					$fieldNum = substr($var,7,1);
					if($wgRequest->getCheck( 'f_is_list_'.$fieldNum )){
						if( $wgRequest->getText('f_delimiter_'.$fieldNum) != ''){
							$delimeter = $wgRequest->getText('f_delimiter_'.$fieldNum);
							$Xmltext .= '<Field name="'.$fieldName.'" list="list" delimiter="'.$delimeter.'">';
						}else{
							$Xmltext .= '<Field name="'.$fieldName.'" list="list">';							
						}
					}else{
						$Xmltext .= '<Field name="'.$fieldName.'">';
					}
				}else if(substr($var,0,8) == 'f_label_'){
					$Xmltext .= '<Label>'.$val.'</Label>';
					//Get Xml parsed from extensions, 					
					if( $xml_text_extensions['smw'] != null ){
						$xml_ex_array = $xml_text_extensions['smw'];
						if($xml_ex_array[$indexGlobalField] != null){
							$Xmltext .= $xml_ex_array[$indexGlobalField] ;
						}						
					}
					if( $xml_text_extensions['sf'] != null ){
						$xml_ex_array = $xml_text_extensions['sf'];
						if($xml_ex_array[$indexGlobalField] != null){
							$Xmltext .= $xml_ex_array[$indexGlobalField] ;
						}						
					}
					if( $xml_text_extensions['sd'] != null ){
						$xml_ex_array = $xml_text_extensions['sd'];
						if($xml_ex_array[$indexGlobalField] != null){
							$Xmltext .= $xml_ex_array[$indexGlobalField] ;
						}
					}				
					$indexGlobalField++ ;
				}else if(substr($var,0,10) == 'f_add_xml_'){
					$Xmltext .= $val;
					$Xmltext .= '</Field>';
				}else if(substr($var,0,10) == 't_add_xml_'){
					$Xmltext .= $val;
					$Xmltext .= '</Template>';
				}
			}
			$Xmltext .= '</PageSchema>';			
			$pageSchemaObj = new PSSchema( $category );
			$categoryTitle = Title::newFromText( $category, NS_CATEGORY );
			$categoryArticle = new Article( $categoryTitle );
			$pageText = $categoryArticle->getContent();
			$title = Title::newFromText( $category, NS_CATEGORY );
			$jobs = array();
			$params = array();
			if( $pageSchemaObj->isPSDefined() ){
				//Do some preg-replace magic
				$tag = "PageSchema";
				$replaced_text = preg_replace('{<'.$tag.'[^>]*>([^@]*?)</'.$tag.'>'.'}', $Xmltext  , $pageText);
				$params['user_id'] = $wgUser->getId();
				$params['page_text'] = $replaced_text;
				$jobs[] = new PSCreatePageJob( $title, $params );
				Job::batchInsert( $jobs );
			}else{
				$params['user_id'] = $wgUser->getId();
				$params['page_text'] = $Xmltext.$pageText;
				$jobs[] = new PSCreatePageJob( $title, $params );
				Job::batchInsert( $jobs );
			}
		}
		else{		
		   if ( $category != "" ) {
			$pageSchemaObj = new PSSchema( $category );
			$title = Title::newFromText( $category, NS_CATEGORY );
			$pageId = $title->getArticleID();			
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
				)
			);
			//first row of the result set 
			$row = $dbr->fetchRow( $res );
			if( $row == null ){
				//Create form here, Cat doesnt exist, create new cat with this text
				$text_1 .= $text;
				$wgOut->addHTML( $text_1 );
			}else{
			  if( ($row[1] == 'PageSchema') && ($row[2] != null )){
				//Populate the form here with autocompleted values 
				$pageXmlstr = $row[2];
				
				$pageXml = simplexml_load_string ( $pageXmlstr );
				$ps_add_xml = "";
				$pageName = (string)$pageXml->attributes()->name;
				$text_4 .= 	'';
				$text_4 .= '<form id="editPageSchemaForm" action="" method="post">' . "\n";
				$text_4 .= '<p>'.$schema_name_label.' <input type="text" name="s_name" value="'.$pageName.'" /> </p> ';
				foreach ( $pageXml->children() as $template_xml ) {
					if ( ($template_xml->getName() != 'Template') && ($template_xml->getName() != 'Form') ){
						$ps_add_xml .= (string)$template_xml->asXML();
					}
				}			
				$text_4 .= '<p>'.$add_xml_label.'
				<textarea rows=4 style="width: 100%" name="ps_add_xml" >'.$ps_add_xml.'</textarea> 
				</p> ';
				
				$filled_html_text_extensions = array();
				wfRunHooks( 'getFilledHtmlTextForFieldInputs', array( $pageSchemaObj, &$filled_html_text_extensions ));
				if($filled_html_text_extensions['sf_form'] != null){
				$text_ex = preg_replace('/starter/', '1', $filled_html_text_extensions['sf_form']);
				$text_4 .= $text_ex;
				}
				$text_4 .= '<div id="templatesList">';				
				$template_num = 0;
				/*  index for template objects */								
				foreach ( $pageXml->children() as $tag => $template_xml ) {
					if ( $tag == 'Template' ){
						$template_add_xml = "";
						$template_num++;
						$field_count = 0;
						if( count($template_xml->children()) > 0 ){
							$templateName = (string) $template_xml->attributes()->name;
							$text_4 .= '<div class="templateBox" >';
							$text_4 .= '<fieldset style="background: #ddd;"><legend>Template</legend> ';				
							$text_4 .= '<p>Name: <input type="text"  name="t_name_'.$template_num.'" value="'.$templateName.'" /></p> ';
							if( ((string) $template_xml->attributes()->multiple) == "multiple" ) {												
								$text_4 .= '<p><input type="checkbox" checked name="is_multiple_'.$template_num.'"/>  Allow multiple instances of this template</p> ';
							}else{
								$text_4 .= '<p><input type="checkbox" name="is_multiple_'.$template_num.'"/>  Allow multiple instances of this template</p> ';
							}
							foreach ( $template_xml->children() as $field_xml ) {
								if ( $field_xml->getName() != 'Field' ){				
									$template_add_xml .= (string)$field_xml->asXML();
								}
							}							
							$text_4 .= '<div id="fieldsList_'.$template_num.'">';
							$list_values =  false;
							foreach ($template_xml->children() as $field_xml) {							
								if ( $field_xml->getName() == "Field" ){
									$fieldName = (string)$field_xml->attributes()->name;									
									$text_4 .= '<div class="fieldBox" >';
									$text_4 .= '<fieldset style="background: #bbb;"><legend>Field</legend> ';
									if( ((string)$field_xml->attributes()->list) == "list") {
										$list_values = true;
									}
									if( ((string)$field_xml->attributes()->delimiter) != null || ((string)$field_xml->attributes()->delimiter) != '' ){
										$delimiter = (string)$field_xml->attributes()->delimiter;
									}
									foreach ($field_xml->children() as $tag => $child ) {
										if ( $tag == 'Label' ) {
											$fieldLabel = (string)$child;
										}
									}									
								 	$text_4 .= '<p>Field name: <input size="15" name="f_name_'.$field_count.'" value="'.$fieldName.'" >';
		$text_4 .= 'Display label: <input size="15" name="f_label_'.$field_count.'" value="'.$fieldLabel.'" >
		</p> ';
									if($list_values){
										$text_4 .= '<p><input type="checkbox" name="f_is_list_'.$field_count.'" checked class="isListCheckbox" /> This field can hold a list of values</p> ';
										$text_4 .= '<div class="delimiterInput"  style="display:"  ><p>Delimiter for values (default is ","): <input type="text" name="f_delimiter_'.$field_count.'" value="'.$delimiter.'" /> </p></div>';
									}else{
										$text_4 .= '<p><input type="checkbox" name="f_is_list_'.$field_count.'" class="isListCheckbox" /> This field can hold a list of values</p> ';
										$text_4 .= '<div class="delimiterInput"  style="display: none" ><p>Delimiter for values (default is ","): <input type="text" name="f_delimiter_'.$field_count.'" /> </p></div>';
									}
									//Inserting HTML text from Extensions
							
							if( $filled_html_text_extensions['smw'] != null ){
								$text_ex_array = $filled_html_text_extensions['smw'];
								if( $text_ex_array[$field_count] != null ){
									$text_ex = preg_replace('/starter/', $field_count, $text_ex_array[$field_count]);
									$text_4 .= $text_ex;
								}
							}
							if( $filled_html_text_extensions['sf'] != null ){
								$text_ex_array = $filled_html_text_extensions['sf'];
								if( $text_ex_array[$field_count] != null ){
									$text_ex = preg_replace('/starter/', $field_count, $text_ex_array[$field_count]);
									$text_4 .= $text_ex;
								}
							}
							if( $filled_html_text_extensions['sd'] != null ){
								$text_ex_array = $filled_html_text_extensions['sd'];
								if( $text_ex_array[$field_count] != null ){
									$text_ex = preg_replace('/starter/', $field_count, $text_ex_array[$field_count]);
									$text_4 .= $text_ex;
								}
							}
							
							$text_4 .= '<p>'.$add_xml_label.'
		<textarea rows=4 style="width: 100%" name="f_add_xml_'.$field_count.'"></textarea> 
		</p> 
		<input type="button" value="Remove field" class="deleteField" /></fieldset>
		</div>	
		</div>	
		';	
						$field_count++;
						$text_4 .= '<script type="text/javascript">
						updateFieldNum('.$field_count.');
						</script>';						
								}						
							}
							$text_4 .= '</div>';
							$add_field_button = Xml::element( 'input',
							array(
								'type' => 'button',
								'value' => 'Add Field',
								'onclick' => "createTemplateAddField($template_num)"
							)
							);
							$text_4 .= Xml::tags( 'p', null, $add_field_button ) . "\n";
								$text_4 .= '<hr /> 
								<p>'.$add_xml_label.'
								<textarea rows=4 style="width: 100%" name="t_add_xml_'.$template_num.'">'.$template_add_xml.'</textarea> 
								</p> 
								<p><input type="button" value="Remove template" class="deleteTemplate" /></p> 
							</fieldset> </div>';	
												    
						}
					}	
			}
				$add_template_button = Xml::element( 'input',
								array(
									'type' => 'button',
									'value' => 'Add Template',
									'onclick' => "createAddTemplate()"
								)
							);
				$text_4 .= Xml::tags( 'p', null, $add_template_button ) . "\n";
				$text_4 .= '		<hr /> 
				<div class="editButtons">
				<input type="submit" id="wpSave" name="wpSave" value="Save" />	
				</div>';
				$text_4 .= '	</form>';
				$text_4 .= $starter_text;
				$wgOut->addHTML($text_4);
			  }else{
				$text_2 .= $text;
				$wgOut->addHTML($text_2);
			  }
			}
		}else {
			$cat_titles = array();
			$count_title = 0;
			$text = "";
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
						$generatePagesPage = SpecialPage::getTitleFor( 'EditSchema' );
						$url = $generatePagesPage ->getFullURL() . '/' . $cat_text;
						$text .= '<a href='.$url.'>'.$cat_text.'   </a> <br /> ';
					}
				}
			}
			$dbr->freeResult( $res );
			$wgOut->addHTML( $text );
		}
	  }
	  return true;
	}
}
