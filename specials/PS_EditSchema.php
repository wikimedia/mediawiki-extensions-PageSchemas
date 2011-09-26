<?php
/**
 * Displays an interface to let users create and edit the <PageSchema> XML.
 *
 * @author Ankit Garg
 * @author Yaron Koren
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
var fieldNum = 0;
var templateNum = 0;
// TODO - this function should be a jQuery 'fn' instead
function psAddField(template_num) {
	fieldNum++;
	newField = jQuery('#starterField').clone().css('display', '').removeAttr('id');
	newHTML = newField.html().replace(/fnum/g, fieldNum);
	newField.html(newHTML);
	newField.find(".deleteField").click( function() {
		// Remove the encompassing div for this instance.
		jQuery(this).closest(".fieldBox")
			.fadeOut('fast', function() { jQuery(this).remove(); });
	});
	jQuery('#fieldsList_'+template_num).append(newField);
	addjQueryToCheckboxes();
}

function psAddTemplate() {
	templateNum++;
	newField = jQuery('#starterTemplate').clone().css('display', '').removeAttr('id');
	newHTML = newField.html().replace(/tnum/g, templateNum);
	newField.html(newHTML);
	newField.find(".deleteTemplate").click( function() {
		// Remove the encompassing div for this instance.
		jQuery(this).closest(".templateBox")
			.fadeOut('fast', function() { jQuery(this).remove(); });
	});
	jQuery('#templatesList').append(newField);
}

function updateFieldNum(field_num) {
	fieldNum = field_num;
}

function addjQueryToCheckboxes() {
	jQuery('.isListCheckbox').each(function() {
		if (jQuery(this).is(":checked")) {
			jQuery(this).closest('.fieldBox').find('.delimiterInput').css('display', '');
		} else {
			jQuery(this).closest('.fieldBox').find('.delimiterInput').css('display', 'none');
		}
	});
	jQuery('.isListCheckbox').click(function() {
		if (jQuery(this).is(":checked")) {
			jQuery(this).closest('.fieldBox').find('.delimiterInput').css('display', '');
		} else {
			jQuery(this).closest('.fieldBox').find('.delimiterInput').css('display', 'none');
		}
	});
	jQuery('.sectionCheckbox').each(function() {
		if (jQuery(this).is(":checked")) {
			jQuery(this).closest('.sectionBox').find('.extensionInputs').css('display', '').removeClass('hiddenSection');
		} else {
			jQuery(this).closest('.sectionBox').find('.extensionInputs').css('display', 'none').addClass('hiddenSection');
		}
	});
	jQuery('.sectionCheckbox').click(function() {
		if (jQuery(this).is(":checked")) {
			jQuery(this).closest('.sectionBox').find('.extensionInputs').css('display', '').removeClass('hiddenSection');
		} else {
			jQuery(this).closest('.sectionBox').find('.extensionInputs').css('display', 'none').addClass('hiddenSection');
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
	addjQueryToCheckboxes();
	jQuery('#editPageSchemaForm').submit( function() {
		jQuery('#starterTemplate').find("input, select, textarea").attr('disabled', 'disabled');
		jQuery('.hiddenSection').find("input, select, textarea").attr('disabled', 'disabled');
		return true;
	} );
});
</script>

END;
		$wgOut->addScript( $jsText );
	}

	/**
	 * Creates full <PageSchema> XML text, based on what was passed in by
	 * the form.
	 */
	static function pageSchemaXMLFromRequest() {
		global $wgRequest;

		//Generate the XML from the Form elements
		//$s_name = $wgRequest->getText('s_name');
		$psXML = '<PageSchema>';
		$additionalXML = $wgRequest->getText( 'ps_add_xml' );
		$psXML .= $additionalXML;
		$fieldName = "";
		$fieldNum = -1;
		$templateNum = -1;
		// Arrays to store the extension-specific XML entered in the form
		$schemaXMLFromExtensions = array();
		$fieldXMLFromExtensions = array();
		wfRunHooks( 'PageSchemasGetSchemaXML', array( $wgRequest, &$schemaXMLFromExtensions ));
		wfRunHooks( 'PageSchemasGetFieldXML', array( $wgRequest, &$fieldXMLFromExtensions ));
		foreach ( $schemaXMLFromExtensions as $extensionName => $xml ) {
			if ( !empty( $xml ) ) {
				$psXML .= $xml;
			}
		}
		$indexGlobalField = 0 ; //this variable is use to index the array returned by extensions for XML.
		foreach ( $wgRequest->getValues() as $var => $val ) {
			$suffix = substr( $var, -3 );
			// Ignore fields from the hidden/starter div
			if ( substr( $var, 0, 7 ) == 't_name_' ) {
				$templateNum = substr( $var, 7 );
				if ( $wgRequest->getCheck( 'is_multiple_' . $templateNum ) ) {
					$psXML .= '<Template name="'.$val.'" multiple="multiple">';
				} else {
					$psXML .= '<Template name="'.$val.'">';
				}
			} elseif ( substr( $var, 0, 7 ) == 'f_name_' ) {
				$fieldNum = substr( $var, 7 );
				$fieldName = $val;
				if ( $wgRequest->getCheck( 'f_is_list_' . $fieldNum ) ) {
					if ( $wgRequest->getText( 'f_delimiter_' . $fieldNum ) != '' ) {
						$delimiter = $wgRequest->getText( 'f_delimiter_' . $fieldNum );
						$psXML .= '<Field name="'.$fieldName . '" list="list" delimiter="' . $delimiter . '">';
					} else {
						$psXML .= '<Field name="'.$fieldName . '" list="list">';
					}
				} else {
					$psXML .= '<Field name="' . $fieldName . '">';
				}
			} elseif ( substr( $var, 0, 8 ) == 'f_label_' ) {
				if ( !empty( $val ) ) {
					$psXML .= '<Label>' . $val . '</Label>';
				}

				// Get XML created by extensions
				foreach ( $fieldXMLFromExtensions as $extensionName => $xmlPerField ) {
					if ( !empty( $xmlPerField[$indexGlobalField] ) ) {
						$psXML .= $xmlPerField[$indexGlobalField];
					}
				}
				$indexGlobalField++ ;
			} elseif ( substr( $var, 0, 10 ) == 'f_add_xml_' ) {
				$psXML .= $val;
				$psXML .= '</Field>';
			} elseif ( substr( $var, 0, 10 ) == 't_add_xml_' ) {
				$psXML .= $val;
				$psXML .= '</Template>';
			}
		}
		$psXML .= '</PageSchema>';
		return $psXML;
	}

	/**
	 * Displays a list of links to categories that have a page schema
	 * defined; for use in Special:EditSchema, if no category is specified.
	 */
	static function showLinksToCategories() {
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
				if ( Title::newFromId( $page_id_cat )->getNamespace() == NS_CATEGORY ) {
					$cat_text = Title::newFromId( $page_id_cat )->getText();
					$url = $editSchemaPage ->getFullURL() . '/' . $cat_text;
					$text .= Html::element( 'a', array( 'href' => $url ), $cat_text ) . '<br />';
				}
			}
		}
		$dbr->freeResult( $res );
		return $text;
	}

	/*
	 * Returns the HTML for one section of the EditSchema form.
	 */
	static function printFormSection( $label, $topColor, $html, $bgColor = 'white', $isCollapsible = false, $hasExistingValues = true ) {
		$className = $isCollapsible ? 'sectionBox' : '';
		$text =  "<div class=\"$className\" style=\"background: $bgColor; border: 1px #999 solid; padding: 0px; margin-bottom: 10px; margin-top: 10px;\">\n";
		$text .= "<div style=\"font-weight: bold; background: $topColor; padding: 4px 7px; border-bottom: 1px #bbb solid;\">";
		if ( $isCollapsible ) {
			$checkboxAttrs =  array( 'class' => 'sectionCheckbox' );
			if ( $hasExistingValues ) {
				$checkboxAttrs['checked'] = true;
			}
			$text .= " " . Html::input( 'show_section', null, 'checkbox', $checkboxAttrs );
		}
		$className = $isCollapsible ? 'extensionInputs' : '';
		$text .= "$label</div>" . "<div class=\"$className\" style=\"padding: 5px 15px;\">$html</div>\n" . "</div>\n";
		return $text;
	}

	/*
	 * Returns the HTML for a form section coming from a specific extension.
	 */
	static function printFieldHTMLForExtension( $valuesFromExtension ) {
		list( $label, $color, $html, $hasExistingValues ) = $valuesFromExtension;
		return self::printFormSection( $label, $color, $html, 'white', true, $hasExistingValues );
	}

	/**
	 * Returns the HTML for a section of the form comprising one
	 * template field.
	 */
	static function printFieldSection( $field_xml = null, $pageSchemaField = null, $field_count = 'fnum' ) {
		$fieldName = '';
		$delimiter = '';
		$fieldLabel = '';
		$isListAttrs = array( 'class' => 'isListCheckbox' );
		$delimiterAttrs = array( 'class' => 'delimiterInput' );
		if ( is_null( $field_xml ) ) {
			$text = '<div class="fieldBox" id="starterField" style="display: none" >';
		} else {
			$text = '<div class="fieldBox" >';
			$fieldName = (string)$field_xml->attributes()->name;
			if ( ((string)$field_xml->attributes()->delimiter) != null || ((string)$field_xml->attributes()->delimiter) != '' ) {
				$delimiter = (string)$field_xml->attributes()->delimiter;
			}
			foreach ( $field_xml->children() as $tag => $child ) {
				if ( $tag == 'Label' ) {
					$fieldLabel = (string)$child;
				}
			}
			if ( ((string)$field_xml->attributes()->list) == "list" ) {
				$isListAttrs['checked'] = 'checked';
			}
		}
		$fieldHTML = '<p>Field name: ';
		$fieldHTML .= Html::input( 'f_name_' . $field_count, $fieldName, 'text', array( 'size' => 15 ) ) . ' ';
		$fieldHTML .= wfMsg( 'ps-displaylabel' ) . ' ';
		$fieldHTML .= Html::input( 'f_label_' . $field_count, $fieldLabel, 'text', array( 'size' => 15 ) );
		$fieldHTML .= "\t\t</p>\n";
		$fieldIsListInput = Html::input( 'f_is_list_' . $field_count, null, 'checkbox', $isListAttrs );
		$fieldHTML .= Html::rawElement( 'p', null, $fieldIsListInput . ' ' . wfMsg( 'ps-field-list-label' ) );
		$fieldDelimiterInput = Html::input ( 'f_delimiter_' . $field_count, $delimiter, 'text', array( 'size' => 3 ) );
		$fieldHTML .= Html::rawElement( 'p', $delimiterAttrs, wfMsg( 'ps-delimiter-label' ) . ' ' . $fieldDelimiterInput );

		// Insert HTML text from extensions
		$htmlFromExtensions = array();
		wfRunHooks( 'PageSchemasGetFieldHTML', array( $pageSchemaField, &$htmlFromExtensions ) );
		foreach ( $htmlFromExtensions as $valuesFromExtension ) {
			$html = self::printFieldHTMLForExtension( $valuesFromExtension );
			// We use 'num' here, instead of 'fnum', to distinguish
			// between field names from Page Schemas (which get
			// their number set via Javascript) and field names from
			// other extensions (which get their number set via PHP).
			// Is this important to do? Probably not.
			$fieldHTML .= str_replace( 'num', $field_count, $html );
		}

		$add_xml_label = wfMsg('ps-add-xml-label');
		$fieldHTML .= <<<END
		<p>$add_xml_label
		<textarea rows=4 style="width: 100%" name="f_add_xml_$field_count"></textarea>
		</p>

END;
		$fieldHTML .= Html::input( 'remove-field', wfMsg( 'ps-remove-field' ), 'button',
			array( 'class' => 'deleteField' )
		);
		$text .= self::printFormSection( wfMsg( 'ps-field' ), '#AAA', $fieldHTML, '#CCC' );
		$text .= "\t</div><!-- fieldBox -->\n";
		return $text;
	}

	/**
	 * Returns the HTML for a section of the form comprising one template.
	 */
	static function printTemplateSection( $template_num = 'tnum', $template_xml = null, $pageSchemaTemplate = null ) {
		if ( is_null( $pageSchemaTemplate ) ) {
			$pageSchemaTemplateFields = array();
		} else {
			$pageSchemaTemplateFields = $pageSchemaTemplate->getFields();
		}
		$attrs = array();
		if ( is_null( $template_xml ) ) {
			$text = '<div class="templateBox" id="starterTemplate" style="display: none">';
			$templateName = '';
			$fields_xml_array = array( null );
		} else {
			$text = '<div class="templateBox" >';
			$templateName = (string) $template_xml->attributes()->name;
			if ( ( (string)$template_xml->attributes()->multiple ) == "multiple" ) {
				$attrs['checked'] = 'checked';
			}
			$fields_xml_array = $template_xml->children();
		}
		$templateNameInput = Html::input( 't_name_' . $template_num, $templateName, 'text' );
		$templateHTML = '<p>Name: ' . $templateNameInput . '</p> ';
		$templateIsMultipleInput = Html::input( 'is_multiple_' . $template_num, null, 'checkbox', $attrs );
		$templateHTML .= Html::rawElement( 'p', null, $templateIsMultipleInput . ' ' . wfMsg( 'ps-multiple-temp-label' ) );
		$template_add_xml = "";
		foreach ( $fields_xml_array as $field_xml ) {
			if ( !empty( $field_xml ) && $field_xml->getName() != 'Field' ) {
				$template_add_xml .= (string)$field_xml->asXML();
			}
		}
		$templateHTML .= '<div id="fieldsList_'.$template_num.'">';
		$field_count = 0;
		foreach ( $fields_xml_array as $field_xml ) {
			if ( empty( $field_xml ) ) {
				$templateHTML .= self::printFieldSection();
			} elseif ( $field_xml->getName() == "Field" ) {
				$pageSchemaField = $pageSchemaTemplateFields[$field_count];
				$templateHTML .= self::printFieldSection( $field_xml, $pageSchemaField, $field_count );
				$field_count++;
			}
		}
		$templateHTML .= "\t</div><!-- fieldsList -->\n";
		$templateHTML .=<<<END
<script type="text/javascript">
	$(document).ready(function() {
		updateFieldNum($field_count);
	});
</script>

END;
		$add_field_button = Xml::element( 'input',
			array(
				'type' => 'button',
				'value' => wfMsg( 'ps-add-field' ),
				'onclick' => "psAddField($template_num)"
			)
		);
		$templateHTML .= Xml::tags( 'p', null, $add_field_button ) . "\n";
		$templateHTML .= '<hr />
					<p>'. wfMsg('ps-add-xml-label') .'
						<textarea rows=4 style="width: 100%" name="t_add_xml_'.$template_num.'">'.$template_add_xml.'</textarea>
					</p>';
		$templateHTML .= '<p>' . Html::input( 'remove-template', 'Remove template', 'button', array( 'class' => 'deleteTemplate' ) ) . "</p>\n";
		$text .= self::printFormSection( wfMsg( 'ps-template' ), '#CCC', $templateHTML, '#EEE' );
		$text .= "	</div><!-- templateBox-->";
		return $text;
	}

	/**
	 * Returns the HTML to display an entire form.
	 */
	static function printForm( $pageSchemaObj = null, $pageXML = null ) {
		$htmlForSchema = array();
		wfRunHooks( 'PageSchemasGetSchemaHTML', array( $pageSchemaObj, &$htmlForSchema ) );

		if ( is_null( $pageSchemaObj ) ) {
			$template_all = array();
		} else {
			$template_all = $pageSchemaObj->getTemplates();
		}

		if ( is_null( $pageXML ) ) {
			$pageXMLChildren = array();
		} else {
			$pageXMLChildren = $pageXML->children();
		}

		$ps_add_xml = '';
		foreach ( $pageXMLChildren as $template_xml ) {
			if ( ( $template_xml->getName() != 'Template') && ( $template_xml->getName() != 'semanticforms_Form' ) ) {
				$ps_add_xml .= (string)$template_xml->asXML();
			}
		}

		$text = '<form id="editPageSchemaForm" action="" method="post">' . "\n";
		$text .= '<p>' . wfMsg('ps-add-xml-label') . '
				<textarea rows=4 style="width: 100%" name="ps_add_xml" >' . $ps_add_xml . '</textarea>
				</p> ';

		foreach ( $htmlForSchema as $valuesFromExtension ) {
			$text .= self::printFieldHTMLForExtension( $valuesFromExtension );
		}

		$text .= '<div id="templatesList">';

		$template_num = 0;

		// Add 'starter', hidden template section.
		$text .= self::printTemplateSection();
		/* index for template objects */
		foreach ( $pageXMLChildren as $tag => $template_xml ) {
			if ( $tag == 'Template' ) {
				$pageSchemaTemplate = $template_all[$template_num];
				$text .= self::printTemplateSection( $template_num, $template_xml, $pageSchemaTemplate );
				$template_num++;
			}
		}
		$add_template_button = Xml::element( 'input',
			array(
				'type' => 'button',
				'value' => wfMsg( 'ps-add-template' ),
				'onclick' => "psAddTemplate()"
			)
		);
		$text .= "\t</div><!-- templatesList -->\n";
		$text .= Xml::tags( 'p', null, $add_template_button ) . "\n";
		$text .= "\t\t<hr />\n";
		$label = wfMsg( 'summary' );
		$text .= <<<END
	<p>
	<span id='wpSummaryLabel'><label for='wpSummary'>$label</label></span>
	<input type='text' value="" name='wpSummary' id='wpSummary' maxlength='200' size='60' />
	</p>

END;
		$attr = array(
			'id'        => 'wpSave',
			'accesskey' => wfMsg( 'accesskey-save' ),
			'title'     => wfMsg( 'tooltip-save' ),
		);
		$saveButton = Html::input( 'wpSave', wfMsg( 'savearticle' ), 'submit', $attr );
		$text .= "\t\t" . Html::rawElement( 'div', array( 'class' => 'editButtons' ),
			$saveButton ) . "\n";
		$text .= "\t</form>\n";

		return $text;
	}

	function execute( $category ) {
		global $wgRequest, $wgOut, $wgUser;
		global $wgSkin;

		$this->setHeaders();
		$text = '<p>' . wfMsg( 'ps-page-desc-edit-schema' ) . '</p>';
		self::addJavascript();

		$save_page = $wgRequest->getCheck( 'wpSave' );
		if ( $save_page ) {
			$psXML = self::pageSchemaXMLFromRequest();
			$categoryTitle = Title::newFromText( $category, NS_CATEGORY );
			$categoryArticle = new Article( $categoryTitle );
			if ( $categoryTitle->exists() ) {
				$pageText = $categoryArticle->getContent();
				$pageSchemaObj = new PSSchema( $category );
				if ( $pageSchemaObj->isPSDefined() ) {
					// Do some preg_replace magic.
					// This is necessary if the <PageSchema> tag
					// accepts any attributes - which it currently
					// does not, but it may well in the future.
					$tag = "PageSchema";
					$pageText = preg_replace( '{<' . $tag . '[^>]*>([^@]*?)</' . $tag . '>' . '}', $psXML, $pageText );
				} else {
					$pageText = $psXML . $pageText;
				}
			} else {
				$pageText = $psXML;
			}
			$editSummary = $wgRequest->getVal( 'wpSummary' );
			$categoryArticle->doEdit( $pageText, $editSummary );
			$redirectURL = $categoryTitle->getLocalURL();
			$text = <<<END
		<script type="text/javascript">
		window.onload = function() {
			window.location="$redirectURL";
		}
		</script>

END;
			$wgOut->addHTML( $text );
			return true;
		}

		if ( $category == "" ) {
			// No category was specified - show the list of
			// categories with a page schema defined.
			$text = self::showLinksToCategories();
			$wgOut->addHTML( $text );
			return true;
		}

		// We have a category - show a form.
		// See if a page schema has already been defined for this category.
		$title = Title::newFromText( $category, NS_CATEGORY );
		$pageId = $title->getArticleID();
		$dbr = wfGetDB( DB_SLAVE );
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

		$row = $dbr->fetchRow( $res );
		if ( $row == null && !$title->exists() ) {
			// Category doesn't exist.
			$wgOut->setPageTitle( wfMsg( 'createschema' ) );
			$text = '<p>' . wfMsg( 'ps-page-desc-cat-not-exist' ) . '</p>';
			$text .= self::printForm();
		} elseif ( ( $row[1] != 'PageSchema' ) || ( $row[2] == null ) ) {
			// Category exists, but has no page schema.
			$text = '<p>' . wfMsg( 'ps-page-desc-ps-not-exist' ) . '</p>';
			$wgOut->setPageTitle( wfMsg( 'createschema' ) );
			$text .= self::printForm();
		} else {
			// It's a category with an existing page schema -
			// populate the form with its values.
			$pageSchemaObj = new PSSchema( $category );
			$pageXMLstr = $row[2];
			$pageXML = simplexml_load_string( $pageXMLstr );
			$text = self::printForm( $pageSchemaObj, $pageXML );
		}
		$wgOut->addHTML( $text );
		return true;
	}
}
