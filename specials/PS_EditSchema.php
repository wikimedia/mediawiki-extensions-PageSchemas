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
	jQuery('.isListCheckbox').click(function() {
			if (jQuery(this).is(":checked"))
			{				
				alert("checked");
				jQuery(this).siblings('.delimiterInput').css('display', '');
			}else{
				alert("unchecked");
				jQuery(this).siblings('.delimiterInput').css('display', 'none');
			}  
	});

});

</script>

END;
		$wgOut->addScript( $jsText );
	}
   function execute( $category ) {
		global $wgRequest, $wgOut;
		global $wgSkin;
        $this->setHeaders();		
		$text_1 = '<p>This category does not exist yet. Create this category and its page schema: </p>';
		$text_2 = '<p>This category exists, but does not have a page schema. Create schema:" </p>';
		$save_page = $wgRequest->getCheck( 'wpSave' );		
		if ($save_page) {
			//Generate the Xml from the Form elements
			$Xmltext  = "";
			$s_name = $wgRequest->getText('s_name');
			$Xmltext .= '<PageSchema name="'.$s_name.'">';
			$ps_add_xml = $wgRequest->getText('ps_add_xml');
			$Xmltext .= $ps_add_xml;			
			foreach ( $wgRequest->getValues() as $var => $val ) {			
				if(substr($var,0,7) == 't_name_'){
					$Xmltext .= '<Template name="'.$val.'">';
				}else if(substr($var,0,7) == 'f_name_'){
					$Xmltext .= '<Field name="'.$val.'">';
				}else if(substr($var,0,8) == 'f_label_'){
					$Xmltext .= '<Label>'.$val.'</Label>';
				}else if(substr($var,0,10) == 'f_add_xml_'){
					$Xmltext .= $val;
					$Xmltext .= '</Field>';
				}else if(substr($var,0,10) == 't_add_xml_'){
					$Xmltext .= $val;
					$Xmltext .= '</Template>';
				}
			}
			$Xmltext .= '</PageSchema>';			
		}
		else{
		   if ( $category != "" ) {

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
			//Create form here
				self::addJavascript();
				$text = "";
				$text .= '<p>This category does not exist yet. Create this category and its page schema: </p>';
				$text .= '	<form id="createPageSchemaForm" action="" method="post">' . "\n";
				$text .= '<p>Name of schema: <input type="text" name="s_name"/> </p> ';
				$text .= '<p>Additional XML:
				<textarea rows=4 style="width: 100%" name="ps_add_xml"></textarea> 
				</p> ';
				$text .= '<div id="templatesList">';
				$text .= '<div class="templateBox" >';
				$text .= '<fieldset style="background: #ddd;"><legend>Template</legend> ';
				$text .= '<p>Name: <input type="text"  name="t_name_1"/></p> ';
				$text .= '<p><input type="checkbox" name="is_multiple_1"/>  Allow multiple instances of this template</p> ';
				$text .= '<div id="fieldsList_1">';
				$text .= '<div class="fieldBox" >';
				$text .= '<fieldset style="background: #bbb;"><legend>Field</legend> 
				<p>Field name: <input size="15" name="f_name_1">
				Display label: <input size="15" name="f_label_1">
				</p> 
				<p><input type="checkbox" name="f_is_list_1" class="isListCheckbox" /> 				
				This field can hold a list of values
				</p> 
				<div class="delimiterInput"  style="display: none" ><p>Delimiter for values (default is ","): <input type="text" name="f_delimiter_1" /> </p></div>
				<p>Additional XML:
				<textarea rows=4 style="width: 100%" name="f_add_xml_1"></textarea> 
				</p> 
				<input type="button" value="Remove field" class="deleteField" /> </div>
					
</div>	
			</fieldset> ';
			$add_field_button = Xml::element( 'input',
			array(
				'type' => 'button',
				'value' => 'Add Field',
				'onclick' => "createTemplateAddField(1)"
			)
		);
		$text .= Xml::tags( 'p', null, $add_field_button ) . "\n";
			$text .= '<hr /> 
			<p>Additional XML:
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
				 $text .= '<div class="templateBox" id="starterTemplate" style="display: none">
<fieldset style="background: #ddd;">
<legend>Template</legend> 
<p>Name: <input type="text"  name="t_name_starter"/></p> 
<p><input type="checkbox" name="is_multiple_starter"/>  Allow multiple instances of this template</p> 
<div id="fieldsList_starter">
</div>
	<p><input type="button" value="Add Field" onclick="createTemplateAddField(starter)" /></p>

<hr /> 
	<p>Additional XML:
	<textarea rows=4 style="width: 100%" name="t_add_xml_starter"></textarea> 
	</p> 
	<p><input type="button" value="Remove template" class="deleteTemplate" /></p> 
	</fieldset>
	</div>	
		<hr /> ';
		$text .= '<div class="fieldBox" id="starterField" style="display: none">
				<fieldset style="background: #bbb;"><legend>Field</legend> 
				<input size="15" name="f_name_starter">
				Display label: <input size="15" name="f_label_starter">
				</p>
			<p><input type="checkbox" name="f_is_list_starter" /> This field can hold a list of values, separated by commas
	&#160;&#160;
	<p>Delimiter for values (default is ","): <input type="text" name="f_delimiter_starter" /> </p>
	<p>Additional XML:
				<textarea rows=4 style="width: 100%" name="f_add_xml_starter"></textarea> 
				</p> 
				<input type="button" value="Remove field" class="deleteField" />
</p>
</fieldset>
</div>';
				$wgOut->addHTML( $text );
			}else{
			  if( ($row[1] == 'PageSchema') && ($row[2] != null )){
				
			  }else{
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
	}
}
