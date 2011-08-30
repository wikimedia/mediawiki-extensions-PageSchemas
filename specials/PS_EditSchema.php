<?php
/**
 * Displays an interface to let users create all pages based on xml
 *
 * @author Ankit Garg
 */

class PSEditSchema extends IncludableSpecialPage {
	function __construct() {
		parent::__construct( 'EditSchema' );
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

function updateFieldNum(field_num ) {
	fieldNum = field_num;
}

function addjQueryToCheckbox( ) {
	jQuery('.isListCheckbox').click(function() {
		if (jQuery(this).is(":checked")) {
			jQuery(this).closest('.fieldBox').find('.delimiterInput').css('display', '');
		} else {
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

	function blankFormHTML( $htmlFromExtensions ) {
		//$schema_name_label = wfMsg('ps-schema-name-label');
		$add_xml_label = wfMsg('ps-add-xml-label');

		$text = '	<form id="createPageSchemaForm" action="" method="post">' . "\n";
		//$text .= '<p>'.$schema_name_label.' <input type="text" name="s_name"/> </p> ';
		$text .= '<p>'.$add_xml_label.'
		<textarea rows=4 style="width: 100%" name="ps_add_xml"></textarea>
		</p> ';
		if ( $htmlFromExtensions['sf_form'] != null ) {
			$text_ex = preg_replace( '/starter/', '1', $htmlFromExtensions['sf_form'] );
			$text .= $text_ex;
		}

		$text .= '<div id="templatesList">';
		$text .= '<div class="templateBox" >';
		$text .= '</div></div>';

		$add_template_button = Xml::element( 'input',
			array(
				'type' => 'button',
				'value' => wfMsg( 'ps-add-template' ),
				'onclick' => "createAddTemplate()"
			)
		);
		$text .= Xml::tags( 'p', null, $add_template_button ) . "\n";
		$text .= '		<hr />
		<div class="editButtons">
	<input type="submit" id="wpSave" name="wpSave" value="Save" />
	</div>';
		$text .= '	</form>';

		return $text;
	}

	function starterFieldHTML( $htmlFromExtensions ) {
		$template_label = wfMsg( 'ps-template' );
		$delimiter_label = wfMsg( 'ps-delimiter-label' );
		$multiple_temp_label = wfMsg( 'ps-multiple-temp-label' );
		$add_xml_label = wfMsg('ps-add-xml-label');
		$field_list_label = wfMsg( 'ps-field-list-label' );

		$starter_text = <<<END
<div class="templateBox" id="starterTemplate" style="display: none">
	<fieldset style="background: #ddd;">
		<legend>$template_label</legend>
		<p>Name: <input type="text" name="t_name_starter"/></p>
		<p><input type="checkbox" name="is_multiple_starter"/>$multiple_temp_label</p>
		<div id="fieldsList_starter">
		</div>

END;
		$addFieldButton = Html::input( 'add-field', wfMsg( 'ps-add-field' ), 'button',
			array( 'onclick' => 'createTemplateAddField(starter)' )
		);
		$starter_text .= Html::rawElement( 'p', null, $addFieldButton );
		$starter_text .= <<<END
		<hr />
		<p>$add_xml_label
			<textarea rows=4 style="width: 100%" name="t_add_xml_starter"></textarea>
		</p>

END;
		$removeTemplateButton = Html::input( 'remove-template', wfMsg( 'ps-remove-template' ), 'button',
			array( 'class' => 'deleteTemplate' )
		);
		$starter_text .= Html::rawElement( 'p', null, $removeTemplateButton );
		$starter_text .= <<<END
	</fieldset>
</div>
<hr />

END;
		$field_label = wfMsg( 'ps-field' );
		$display_label = wfMsg( 'ps-displaylabel' );
		$starter_text .= <<<END
<div class="fieldBox" id="starterField" style="display: none">
	<fieldset style="background: #bbb;"><legend>$field_label</legend>
		<p>
			Field name: <input size="15" name="f_name_starter">
			$display_label <input size="15" name="f_label_starter">
		</p>
		<p><input type="checkbox" name="f_is_list_starter" class="isListCheckbox" /> $field_list_label
		&#160;&#160;</p>
		<p class="delimiterInput" style="display: none" >
			$delimiter_label <input type="text" name="f_delimiter_starter" />
		</p>

END;
		if ($htmlFromExtensions['smw'] != null ) {
			$starter_text .= $htmlFromExtensions['smw'];
		}
		if ($htmlFromExtensions['sf'] != null ) {
			$starter_text .= $htmlFromExtensions['sf'];
		}
		if ($htmlFromExtensions['sd'] != null ) {
			$starter_text .= $htmlFromExtensions['sd'];
		}
		$starter_text .= <<<END
		<p>$add_xml_label
			<textarea rows=4 style="width: 100%" name="f_add_xml_starter"></textarea>
		</p>

END;
		$removeFieldButton = Html::input( 'remove-field', wfMsg( 'ps-remove-field' ), 'button',
			array( 'class' => 'deleteField' )
		);
		$starter_text .= $removeFieldButton;
		$starter_text .= <<<END
	</fieldset>
</div>

END;
		return $starter_text;
	}

	function execute( $category ) {
		global $wgRequest, $wgOut, $wgUser;
		global $wgSkin;

		$this->setHeaders();
		$text_3 = '<p>'.wfMsg( 'ps-page-desc-edit-schema' ).'</p>';
		self::addJavascript();

		$htmlFromExtensions = array(); //This var. will save the html text returned by the extensions
		$js_extensions = array();
		wfRunHooks( 'getHtmlTextForFieldInputs', array( &$js_extensions, &$htmlFromExtensions ) );

		$save_page = $wgRequest->getCheck( 'wpSave' );
		if ( $save_page ) {
			//Generate the XML from the Form elements
			//$s_name = $wgRequest->getText('s_name');
			$XMLtext = '<PageSchema>';
			$ps_add_xml = $wgRequest->getText( 'ps_add_xml' );
			$XMLtext .= $ps_add_xml;
			$fieldName = "";
			$fieldNum = -1;
			$templateNum = -1;
			//This var. will save the xml text returned by the extensions
			$schemaXMLFromExtensions = array();
			$fieldXMLFromExtensions = array();
			wfRunHooks( 'PageSchemasGetSchemaXML', array( $wgRequest, &$schemaXMLFromExtensions ));
			wfRunHooks( 'PageSchemasGetFieldXML', array( $wgRequest, &$fieldXMLFromExtensions ));
			foreach ( $schemaXMLFromExtensions as $extensionName => $xml ) {
				if ( !empty( $xml ) ) {
					$XMLtext .= $xml;
				}
			}
			$indexGlobalField = 0 ; //this variable is use to index the array returned by extensions for XML.
			foreach ( $wgRequest->getValues() as $var => $val ) {
				if (substr($var,0,7) == 't_name_' ) {
					$templateNum = substr($var,7,1);
					if ($wgRequest->getCheck( 'is_multiple_'.$templateNum ) ) {
						$XMLtext .= '<Template name="'.$val.'" multiple="multiple">';
					} else {
						$XMLtext .= '<Template name="'.$val.'">';
					}
				} elseif (substr($var,0,7) == 'f_name_' ) {
					$fieldName = $val;
					$fieldNum = substr($var,7,1);
					if ($wgRequest->getCheck( 'f_is_list_'.$fieldNum ) ) {
						if ( $wgRequest->getText('f_delimiter_'.$fieldNum) != '' ) {
							$delimiter = $wgRequest->getText('f_delimiter_'.$fieldNum);
							$XMLtext .= '<Field name="'.$fieldName.'" list="list" delimiter="'.$delimiter.'">';
						} else {
							$XMLtext .= '<Field name="'.$fieldName.'" list="list">';
						}
					} else {
						$XMLtext .= '<Field name="'.$fieldName.'">';
					}
				} elseif ( substr( $var, 0, 8 ) == 'f_label_' ) {
					$XMLtext .= '<Label>'.$val.'</Label>';

					// Get XML created by extensions
					foreach ( $fieldXMLFromExtensions as $extensionName => $xmlPerField ) {
						if ( !empty( $xmlPerField[$indexGlobalField] ) ) {
							$XMLtext .= $xmlPerField[$indexGlobalField];
						}
					}
					$indexGlobalField++ ;
				} elseif ( substr( $var, 0, 10 ) == 'f_add_xml_' ) {
					$XMLtext .= $val;
					$XMLtext .= '</Field>';
				} elseif ( substr( $var, 0, 10 ) == 't_add_xml_' ) {
					$XMLtext .= $val;
					$XMLtext .= '</Template>';
				}
			}
			$XMLtext .= '</PageSchema>';
			$pageSchemaObj = new PSSchema( $category );
			$categoryTitle = Title::newFromText( $category, NS_CATEGORY );
			$categoryArticle = new Article( $categoryTitle );
			$pageText = $categoryArticle->getContent();
			$jobs = array();
			$params = array();
			if ( $pageSchemaObj->isPSDefined() ) {
				//Do some preg-replace magic
				$tag = "PageSchema";
				$replaced_text = preg_replace('{<'.$tag.'[^>]*>([^@]*?)</'.$tag.'>'.'}', $XMLtext, $pageText);
				$params['page_text'] = $replaced_text;
			} else {
				$params['page_text'] = $XMLtext . $pageText;
			}
			$params['user_id'] = $wgUser->getId();
			$jobs[] = new PSCreatePageJob( $categoryTitle, $params );
			Job::batchInsert( $jobs );
			return true;
		}

		if ( $category == "" ) {
			// No category was specified - show the list of categories with a page schema defined.
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
			$editSchemaPage = SpecialPage::getTitleFor( 'EditSchema' );
			while ( $row = $dbr->fetchRow( $res ) ) {
				if ( $row[2] != null ) {
					$page_id_cat = $row[0];
					if ( Title::newFromId($page_id_cat)->getNamespace() == NS_CATEGORY ) {
						$cat_text = Title::newFromId($page_id_cat)->getText();
						$url = $editSchemaPage ->getFullURL() . '/' . $cat_text;
						$text .= Html::element( 'a', array( 'href' => $url ), $cat_text ) . '<br />';
					}
				}
			}
			$dbr->freeResult( $res );
			$wgOut->addHTML( $text );
			return true;
		}

		// We have a category - show a form.
		$formHTML = self::blankFormHTML( $htmlFromExtensions );
		$formHTML .= self::starterFieldHTML( $htmlFromExtensions );

		$add_xml_label = wfMsg('ps-add-xml-label');

		$pageSchemaObj = new PSSchema( $category );
		$title = Title::newFromText( $category, NS_CATEGORY );
		$pageId = $title->getArticleID();
		$dbr = wfGetDB( DB_SLAVE );
		//get the result set, query : select page_props
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
		if ( $row == null && !$title->exists() ) {
			// Category doesn't exist.
			$text = '<p>'.wfMsg( 'ps-page-desc-cat-not-exist' ).'</p>';
			$text .= $formHTML;
			$wgOut->addHTML( $text );
			return true;
		}

		if ( ($row[1] != 'PageSchema') || ($row[2] == null ) ) {
			// Category exists, but has no page schema.
			$text = '<p>'.wfMsg( 'ps-page-desc-ps-not-exist' ).'</p>';
			$text .= $formHTML;
			$wgOut->addHTML($text );
			return true;
		}

		// If we're here, it's a category with an existing page schema - populate the
		// form with its values.
		$pageXMLstr = $row[2];
		$pageXML = simplexml_load_string( $pageXMLstr );
		$ps_add_xml = "";
		//$pageName = (string)$pageXML->attributes()->name;
		$text_4 = '<form id="editPageSchemaForm" action="" method="post">' . "\n";
		//$text_4 .= '<p>'.$schema_name_label.' <input type="text" name="s_name" value="'.$pageName.'" /> </p> ';
		foreach ( $pageXML->children() as $template_xml ) {
			if ( ( $template_xml->getName() != 'Template') && ($template_xml->getName() != 'semanticforms_Form') ) {
				$ps_add_xml .= (string)$template_xml->asXML();
			}
		}
		$text_4 .= '<p>' . $add_xml_label . '
				<textarea rows=4 style="width: 100%" name="ps_add_xml" >' . $ps_add_xml . '</textarea>
				</p> ';

		$filledHTMLFromExtensions = array();
		wfRunHooks( 'getFilledHtmlTextForFieldInputs', array( $pageSchemaObj, &$filledHTMLFromExtensions ));
		if ( $filledHTMLFromExtensions['sf_form'] != null ) {
			$text_ex = preg_replace('/starter/', '1', $filledHTMLFromExtensions['sf_form']);
			$text_4 .= $text_ex;
		}
		$text_4 .= '<div id="templatesList">';
		$template_num = 0;
		/* index for template objects */
		foreach ( $pageXML->children() as $tag => $template_xml ) {
			if ( $tag == 'Template' ) {
				$template_add_xml = "";
				$template_num++;
				$field_count = 0;
				if ( count($template_xml->children()) > 0 ) {
					$text_4 .= '<div class="templateBox" >';
					$text_4 .= '<fieldset style="background: #ddd;"><legend>Template</legend> ';
					$templateName = (string) $template_xml->attributes()->name;
					$templateNameInput = Html::input( 't_name_' . $template_num, $templateName, 'text' );
					$text_4 .= '<p>Name: ' . $templateNameInput . '</p> ';
					$attrs = array();
					if ( ((string) $template_xml->attributes()->multiple) == "multiple" ) {
						$attrs['checked'] = 'checked';
					}
					$templateIsMultipleInput = Html::input( 'is_multiple_' . $template_num, null, 'checkbox', $attrs );
					$text_4 .= Html::rawElement( 'p', null, $templateIsMultipleInput . ' ' . wfMsg( 'ps-multiple-temp-label' ) );
					foreach ( $template_xml->children() as $field_xml ) {
						if ( $field_xml->getName() != 'Field' ) {
							$template_add_xml .= (string)$field_xml->asXML();
						}
					}
					$text_4 .= '<div id="fieldsList_'.$template_num.'">';
					foreach ( $template_xml->children() as $field_xml ) {
						if ( $field_xml->getName() == "Field" ) {
							$fieldName = (string)$field_xml->attributes()->name;
							$text_4 .= '<div class="fieldBox" >';
							$text_4 .= '<fieldset style="background: #bbb;"><legend>Field</legend> ';
							if ( ((string)$field_xml->attributes()->delimiter) != null || ((string)$field_xml->attributes()->delimiter) != '' ) {
								$delimiter = (string)$field_xml->attributes()->delimiter;
							}
							foreach ($field_xml->children() as $tag => $child ) {
								if ( $tag == 'Label' ) {
									$fieldLabel = (string)$child;
								}
							}
							$text_4 .= '<p>Field name: <input size="15" name="f_name_'.$field_count.'" value="'.$fieldName.'" />';
							$display_label = wfMsg( 'pageschemas-displaylabel' );
							$text_4 .= $display_label . ' <input size="15" name="f_label_'.$field_count.'" value="'.$fieldLabel.'" />
		</p> ';
							$attrs = array();
							$pAttrs = array( 'class' => 'delimiterInput' );
							if ( ((string)$field_xml->attributes()->list) == "list" ) {
								$attrs['checked'] = 'checked';
							} else {
								$pAttrs['style'] = 'display: none';
							}
							$fieldIsListInput = Html::input( 'f_is_list_' . $field_count, null, 'checkbox', $attrs );
							$text_4 .= Html::rawElement( 'p', null, $fieldIsListInput . ' ' . wfMsg( 'ps-field-list-label' ) );
							$fieldDelimiterInput = Html::input ( 'f_delimiter_' . $field_count, $delimiter, 'text', null );
							$text_4 .= Html::rawElement( 'p', $pAttrs, wfMsg( 'ps-delimiter-label' ) . ' ' . $fieldDelimiterInput );

							//Inserting HTML text from Extensions

							if ( $filledHTMLFromExtensions['smw'] != null ) {
								$text_ex_array = $filledHTMLFromExtensions['smw'];
								if ( $text_ex_array[$field_count] != null ) {
									$text_ex = preg_replace('/starter/', $field_count, $text_ex_array[$field_count]);
									$text_4 .= $text_ex;
								}
							}
							if ( $filledHTMLFromExtensions['sf'] != null ) {
								$text_ex_array = $filledHTMLFromExtensions['sf'];
								if ( $text_ex_array[$field_count] != null ) {
									$text_ex = preg_replace('/starter/', $field_count, $text_ex_array[$field_count]);
									$text_4 .= $text_ex;
								}
							}
							if ( $filledHTMLFromExtensions['sd'] != null ) {
								$text_ex_array = $filledHTMLFromExtensions['sd'];
								if ( $text_ex_array[$field_count] != null ) {
									$text_ex = preg_replace('/starter/', $field_count, $text_ex_array[$field_count]);
									$text_4 .= $text_ex;
								}
							}

							$text_4 .= <<<END
		<p>$add_xml_label
		<textarea rows=4 style="width: 100%" name="f_add_xml_$field_count"></textarea>
		</p>

END;
							$removeFieldButton = Html::input( 'remove-field', wfMsg( 'ps-remove-field' ), 'button',
								array( 'class' => 'deleteField' )
							);
							$text_4 .= $removeFieldButton;
							$text_4 .= <<<END
		</fieldset>
		</div>
		</div>

END;
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
							'value' => wfMsg( 'ps-add-field' ),
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
				'value' => wfMsg( 'ps-add-template' ),
				'onclick' => "createAddTemplate()"
			)
		);
		$text_4 .= Xml::tags( 'p', null, $add_template_button ) . "\n";
		$text_4 .= '		<hr />
		<div class="editButtons">
		<input type="submit" id="wpSave" name="wpSave" value="Save" />
		</div>';
		$text_4 .= '	</form>';
		$text_4 .= self::starterFieldHTML( $htmlFromExtensions );
		$wgOut->addHTML($text_4);
		return true;
	}
}
