<?php

/**
 * Displays an interface to let users create and edit the <PageSchema> XML.
 *
 * @author Ankit Garg
 * @author Yaron Koren
 */
class PSEditSchema extends IncludableSpecialPage {
	function __construct() {
		parent::__construct( 'EditSchema', 'edit' );
	}

	/**
	 * Returns a nicely-formatted version of the XML passed in.
	 *
	 * Code based on
	 * http://coffeecoders.de/2011/03/how-to-pretty-print-a-simplexmlobject-in-php/
	 */
	static function prettyPrintXML( $xml ){
		// Turn the XML string into a DOMDocument object, and then
		// back again, to have it displayed nicely.
		$domDocument = new DOMDocument('1.0');
		$domDocument->preserveWhiteSpace = false;
		$domDocument->formatOutput = true;
		$domDocument->loadXML( $xml );
		$domDocument->encoding="UTF-8";
		return $domDocument->saveXML( $domDocument->documentElement );
	}

	/**
	 * Creates full <PageSchema> XML text, based on what was passed in by
	 * the form.
	 */
	static function createPageSchemaXMLFromForm() {
		global $wgRequest, $wgPageSchemasHandlerClasses;

		// Generate the XML from the form elements.
		$psXML = '<PageSchema>';
		$additionalXML = $wgRequest->getText( 'ps_add_xml' );
		$psXML .= $additionalXML;
		$fieldName = "";
		$fieldNum = -1;
		$templateNum = -1;
		$pageSectionNum = -1;
		// Arrays to store the extension-specific XML entered in the form
		$schemaXMLFromExtensions = array();
		$templateXMLFromExtensions = array();
		$fieldXMLFromExtensions = array();
		$pageSectionXMLFromExtensions = array();
		foreach ( $wgPageSchemasHandlerClasses as $psHandlerClass ) {
			$schemaXMLFromExtensions[] = call_user_func( array( $psHandlerClass, 'createSchemaXMLFromForm' ) );
			$templateXMLFromExtensions[] = call_user_func( array( $psHandlerClass, 'createTemplateXMLFromForm' ) );
			$fieldXMLFromExtensions[] = call_user_func( array( $psHandlerClass, 'createFieldXMLFromForm' ) );
			$pageSectionXMLFromExtensions[] = call_user_func( array( $psHandlerClass, 'createPageSectionXMLFromForm' ) );
		}
		foreach ( $schemaXMLFromExtensions as $xml ) {
			if ( !empty( $xml ) ) {
				$psXML .= $xml;
			}
		}
		foreach ( $wgRequest->getValues() as $var => $val ) {
			// Ignore fields from the hidden/starter div
			if ( substr( $var, 0, 7 ) == 't_name_' ) {
				$templateNum = substr( $var, 7 );
				$templateAttrs = array( 'name' => $val );
				if ( $wgRequest->getCheck( 'is_multiple_' . $templateNum ) ) {
					$templateAttrs['multiple'] = 'multiple';
				}
				if ( $wgRequest->getCheck( 'template_format_' . $templateNum ) ) {
					$templateAttrs['format'] = $wgRequest->getVal( 'template_format_' . $templateNum );
				}
				$psXML .= Xml::openElement( 'Template', $templateAttrs );

				// Get XML created by extensions for this template
				foreach ( $templateXMLFromExtensions as $extensionName => $xmlPerTemplate ) {
					if ( !empty( $xmlPerTemplate[$templateNum] ) ) {
						$psXML .= $xmlPerTemplate[$templateNum];
					}
				}
			} elseif ( substr( $var, 0, 7 ) == 'f_name_' ) {
				$fieldNum = substr( $var, 7 );
				$fieldName = $val;
				$fieldAttrs = array( 'name' => $fieldName );
				if ( $wgRequest->getCheck( 'f_is_list_' . $fieldNum ) ) {
					$fieldAttrs['list'] = 'list';
					$delimiter = $wgRequest->getText( 'f_delimiter_' . $fieldNum );
					if ( $delimiter != '' ) {
						$fieldAttrs['delimiter'] = $delimiter;
					}
				}
				$fieldDisplay = $wgRequest->getText( 'f_display_' . $fieldNum );
				if ( $fieldDisplay != 'show' ) {
					$fieldAttrs['display'] = $fieldDisplay;
				}
				$psXML .= Xml::openElement( 'Field', $fieldAttrs );
			} elseif ( substr( $var, 0, 8 ) == 'f_label_' ) {
				if ( !empty( $val ) ) {
					$psXML .= '<Label>' . $val . '</Label>';
				}

				// Get XML created by extensions for this field
				foreach ( $fieldXMLFromExtensions as $extensionName => $xmlPerField ) {
					if ( !empty( $xmlPerField[$fieldNum] ) ) {
						$psXML .= $xmlPerField[$fieldNum];
					}
				}
			} elseif ( substr( $var, 0, 10 ) == 'f_add_xml_' ) {
				$psXML .= $val;
				$psXML .= '</Field>';
			} elseif ( substr( $var, 0, 10 ) == 't_add_xml_' ) {
				$psXML .= $val;
				$psXML .= '</Template>';
			} elseif ( substr( $var, 0, 7 ) == 's_name_' ) {
				$pageSectionNum = substr( $var, 7 );
				$sectionName = $val;
				$sectionLevel = $wgRequest->getVal( "s_level_" . $pageSectionNum );
				$psXML .= '<Section name="' . $sectionName . '" level="' . $sectionLevel . '">';
				foreach ( $pageSectionXMLFromExtensions as $extensionName => $xmlPerPageSection ) {
					if ( !empty( $xmlPerPageSection[$pageSectionNum] ) ) {
						$psXML .= $xmlPerPageSection[$pageSectionNum];
					}
				}
				$psXML .= '</Section>';
			}
		}
		$psXML .= '</PageSchema>';
		return self::prettyPrintXML( $psXML );
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
		$text .= "<ul>\n";
		while ( $row = $dbr->fetchRow( $res ) ) {
			if ( $row[2] == null ) {
				continue;
			}
			$catTitle = Title::newFromID( $row[0] );
			if ( $catTitle->getNamespace() !== NS_CATEGORY ) {
				continue;
			}
			$catName = $catTitle->getText();
			$url = $catTitle->getFullURL( 'action=editschema' );
			$text .= Html::rawElement( 'li',
				null,
				Html::element( 'a', array( 'href' => $url ), $catName )
			);
		}
		$text .= "</ul>\n";
		$dbr->freeResult( $res );
		return $text;
	}

	/**
	 * Returns the HTML for one section of the EditSchema form.
	 */
	static function printFormSection( $label, $headerColor, $mainHTML, $sectionClass, $hasExistingValues = true ) {
		// Section header
		$headerContents = '';
		if ( empty( $sectionClass ) ) {
			$checkboxAttrs = array( 'class' => 'sectionCheckbox' );
			if ( $hasExistingValues ) {
				$checkboxAttrs['checked'] = true;
			}
			$headerContents .= "\n\t\t" . Html::input( 'show_section', null, 'checkbox', $checkboxAttrs ) . ' ';
		}
		$headerContents .= $label . "\n";
		$sectionHTML = "\n\t\t\t\t\t" . Html::rawElement( 'div', array(
			'class' => 'sectionHeader',
			'style' => "background: $headerColor;"
		), $headerContents );

		// Body of section, with all the inputs.
		$sectionHTML .= "\n\t" . Html::rawElement( 'div', array( 'class' => 'sectionBody' ), "\n" . $mainHTML );

		// Wrapper around the whole thing.
		$className = "editSchemaSection $sectionClass";
		$text = "\n\t\t\t\t" . Html::rawElement( 'div', array( 'class' => $className ), $sectionHTML ) . "\n";
		return $text;
	}

	/**
	 * Returns the HTML for a form section coming from a specific extension.
	 */
	static function printFieldHTMLForExtension( $valuesFromExtension, $label, $color ) {
		list( $html, $hasExistingValues ) = $valuesFromExtension;
		return self::printFormSection( $label, $color, $html, null, $hasExistingValues );
	}

	/**
	 * Returns the HTML for a section of the form comprising one
	 * template field.
	 */
	static function printFieldSection( $field_xml = null, $psField = null ) {
		global $wgPageSchemasHandlerClasses;

		if ( is_null( $field_xml ) ) {
			$fieldNum = 'fnum';
		} else {
			global $wgPageSchemasFieldNum;
			$fieldNum = $wgPageSchemasFieldNum;
			$wgPageSchemasFieldNum++;
		}

		$fieldName = '';
		$delimiter = '';
		$fieldLabel = '';
		$isListAttrs = array( 'class' => 'isListCheckbox' );
		$delimiterAttrs = array( 'class' => 'delimiterInput' );
		$fieldDisplay = '';
		$text = "\n\t\t\t";
		if ( is_null( $field_xml ) ) {
			$text .= '<div class="fieldBox" id="starterField" style="display: none" >';
		} else {
			$text .= '<div class="fieldBox" >';
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
			$fieldDisplay = (string)$field_xml->attributes()->display;
		}
		$fieldHTML = wfMessage( 'ps-namelabel' )->text() . ' ';
		$fieldHTML .= Html::input( 'f_name_' . $fieldNum, $fieldName, 'text', array( 'size' => 25 ) ) . ' ';
		$fieldHTML .= wfMessage( 'ps-displaylabel' )->text() . ' ';
		$fieldHTML .= Html::input( 'f_label_' . $fieldNum, $fieldLabel, 'text', array( 'size' => 25 ) );
		$fieldHTML = Html::rawElement( 'p', null, $fieldHTML ) . "\n";
		$fieldIsListInput = Html::input( 'f_is_list_' . $fieldNum, null, 'checkbox', $isListAttrs );
		$fieldHTML .= Html::rawElement( 'p', null, $fieldIsListInput . ' ' . wfMessage( 'ps-field-list-label' )->text() );
		$fieldDelimiterInput = Html::input ( 'f_delimiter_' . $fieldNum, $delimiter, 'text', array( 'size' => 3 ) );
		$fieldHTML .= "\n" . Html::rawElement( 'p', $delimiterAttrs, wfMessage( 'ps-delimiter-label' )->text() . ' ' . $fieldDelimiterInput );
		// Create radiobutton for display of field
		$displayShownAttrs = array();
		$displayIfNonEmptyAttrs = array();
		$displayHiddenAttrs = array();
		// Now set which of the values should be checked
		if ( $fieldDisplay == '' ) {
			$displayShownAttrs['checked'] = true;
		} elseif ( $fieldDisplay == 'nonempty' ) {
			$displayIfNonEmptyAttrs['checked'] = true;
		} elseif ( $fieldDisplay == 'hidden' ) {
			$displayHiddenAttrs['checked'] = true;
		}
		$groupName = 'f_display_' . $fieldNum;
		$fieldDisplayShownInput = Html::input( $groupName, 'show', 'radio', $displayShownAttrs );
		$fieldDisplayIfNonEmptyInput = Html::input( $groupName, 'nonempty', 'radio', $displayIfNonEmptyAttrs );
		$fieldDisplayHiddenInput = Html::input( $groupName, 'hidden', 'radio', $displayHiddenAttrs );
		$fieldHTML .= Html::rawElement( 'p', null, $fieldDisplayShownInput . ' ' . "Display this field always" . ' ' . $fieldDisplayIfNonEmptyInput . ' ' . "Display if not empty" . ' ' . $fieldDisplayHiddenInput . ' ' . "Hide" );

		// Insert HTML text from extensions
		foreach ( $wgPageSchemasHandlerClasses as $psHandlerClass ) {
			$valuesFromExtension = call_user_func( array( $psHandlerClass, "getFieldEditingHTML" ), $psField );
			if ( is_null( $valuesFromExtension ) ) {
				continue;
			}
			$label = call_user_func( array( $psHandlerClass, "getFieldDisplayString" ) );
			$color = call_user_func( array( $psHandlerClass, "getDisplayColor" ) );
			$html = self::printFieldHTMLForExtension( $valuesFromExtension, $label, $color );
			// We use 'num' here, instead of 'fnum', to distinguish
			// between field names from Page Schemas (which get
			// their number set via Javascript) and field names from
			// other extensions (which get their number set via PHP).
			// Is this important to do? Probably not.
			$fieldHTML .= str_replace( 'num', $fieldNum, $html );
		}

		// TODO - this needs to get set.
		$field_add_xml = null;
		$fieldHTML .= "\n\t\t\t\t" . Html::hidden( "f_add_xml_$fieldNum", $field_add_xml );
		//$additionalXMLInput = "\n\t\t\t\t" . Html::textarea( "f_add_xml_$fieldNum", $field_add_xml, array( 'rows' => 4, 'style' => 'width: 100%;' ) );
		//$fieldHTML .= "<p>" . wfMessage('ps-add-xml-label')->text() . $additionalXMLInput . "</p>\n";
		$fieldHTML .= Html::input( 'remove-field', wfMessage( 'ps-remove-field' )->text(), 'button',
			array( 'class' => 'deleteField' )
		);
		$text .= "\n" . self::printFormSection( wfMessage( 'ps-field' )->text(), '#AAA', $fieldHTML, 'editSchemaFieldSection' );
		$text .= "\t</div><!-- fieldBox -->\n";
		return $text;
	}

	/**
	 * Returns the HTML for a section of the form comprising one template.
	 */
	static function printTemplateSection( $template_num = 'tnum', $templateXML = null, $psTemplate = null ) {
		global $wgPageSchemasHandlerClasses;

		if ( is_null( $psTemplate ) ) {
			$psTemplateFields = array();
		} else {
			$psTemplateFields = $psTemplate->getFields();
		}
		$attrs = array( 'class' => 'multipleInstanceTemplateCheckbox' );
		$templateXMLElements = array();
		$text = "\t";
		if ( is_null( $templateXML ) ) {
			$text .= '<div class="templateBox" id="starterTemplate" style="display: none">' . "\n";
			$templateName = '';
			$templateFormat = null;
		} else {
			$text .= '<div class="templateBox" >' . "\n";
			$templateName = (string) $templateXML->attributes()->name;
			if ( ( (string)$templateXML->attributes()->multiple ) == "multiple" ) {
				$attrs['checked'] = 'checked';
			}
			$templateFormat = (string)$templateXML->attributes()->format;
			$templateXMLElements = $templateXML->children();
		}
		$templateNameInput = wfMessage( 'ps-namelabel' )->text() . ' ';
		$templateNameInput .= Html::input( 't_name_' . $template_num, $templateName, 'text' );
		$templateHTML = "\t\t" . Html::rawElement( 'p', null, $templateNameInput ) . "\n";
		$templateIsMultipleInput = Html::input( 'is_multiple_' . $template_num, null, 'checkbox', $attrs );
		$templateHTML .= "\t\t" . Html::rawElement( 'p', null, $templateIsMultipleInput . ' ' . wfMessage( 'ps-multiple-temp-label' )->text() );

		// Use an input from the Semantic Forms extension for the
		// template format.
		// This is against the basic principles of Page Schemas, which
		// is that other extensions should rely on it, not the other
		// way around. However, the creation of templates is a special
		// case: they're a standard MediaWiki component, but the
		// creation of them is (for no strong reason) done by Semantic
		// Forms. In the future, this may change.
		if ( class_exists( 'SFCreateTemplate' ) && method_exists( 'SFCreateTemplate', 'printTemplateStyleInput' ) ) {
			$templateHTML .= SFCreateTemplate::printTemplateStyleInput( 'template_format_' . $template_num, $templateFormat );
		}
		$template_add_xml = "";
		// TODO - set this correctly.
		/*
		foreach ( $templateXMLElements as $templateXMLElement ) {
			if ( !empty( $templateXMLElement ) && $templateXMLElement->getName() != 'Field' ) {
				$template_add_xml .= (string)$templateXMLElement->asXML();
			}
		}
		 */
		// We're just going to assume that all attributes related to
		// templates apply only to multiple-instance templates - and
		// that these fields should only be shown if the "multiple
		// instances" checkbox is selected.
		// For now, that's a safe assumption, although that may change.
		$templateHTML .= "\n\t\t" . '<div class="multipleInstanceTemplateAttributes">';

		foreach ( $wgPageSchemasHandlerClasses as $psHandlerClass ) {
			$valuesFromExtension = call_user_func( array( $psHandlerClass, "getTemplateEditingHTML" ), $psTemplate );
			if ( is_null( $valuesFromExtension ) ) {
				continue;
			}
			$label = call_user_func( array( $psHandlerClass, "getTemplateDisplayString" ) );
			$color = call_user_func( array( $psHandlerClass, "getDisplayColor" ) );
			$html = self::printFieldHTMLForExtension( $valuesFromExtension, $label, $color );
			$templateHTML .= str_replace( 'num', $template_num, $html );
		}

		$templateHTML .= "\n\t\t" . '</div><!-- multipleInstanceTemplateAttributes -->';
		$templateHTML .= "\n\t\t" . '<div class="fieldsList">';
		$fieldNumInTemplate = 0;
		// If this is a "starter" template, create the starter
		// field HTML.
		if ( is_null( $psTemplate ) ) {
			$templateHTML .= self::printFieldSection();
		}
		foreach ( $templateXMLElements as $templateXMLElement ) {
			if ( empty( $templateXMLElement ) ) {
				// Do nothing (?)
			} elseif ( $templateXMLElement->getName() == "Field" ) {
				if ( array_key_exists( $fieldNumInTemplate, $psTemplateFields ) ) {
					$psTemplateField = $psTemplateFields[$fieldNumInTemplate];
				} else {
					continue;
					//$psTemplateField = new PSTemplateField();
				}
				$templateHTML .= self::printFieldSection( $templateXMLElement, $psTemplateField );
				$fieldNumInTemplate++;
			}
		}
		$templateHTML .= "\t</div><!-- fieldsList -->\n";
		$add_field_button = Xml::element( 'input',
			array(
				'type' => 'button',
				'class' => 'editSchemaAddField',
				'value' => wfMessage( 'ps-add-field' )->text(),
			)
		);
		$templateHTML .= Xml::tags( 'p', null, $add_field_button ) . "\n";
		$templateHTML .= "<hr />\n";
		$templateHTML .= "\n\t\t\t\t" . Html::hidden( "t_add_xml_$template_num", $template_add_xml );
		//$additionalXMLInput = "\n\t\t\t\t" . Html::textarea( "t_add_xml_$template_num", $template_add_xml, array( 'rows' => 4, 'style' => 'width: 100%;' ) );
		//$templateHTML .= "\n<p>" . wfMessage('ps-add-xml-label')->text() . "\n\t\t\t\t" . $additionalXMLInput . "\n\t\t\t</p>";
		$templateHTML .= '<p>' . Html::input( 'remove-template', 'Remove template', 'button', array( 'class' => 'deleteTemplate' ) ) . "</p>\n";
		$text .= self::printFormSection( wfMessage( 'ps-template' )->text(), '#CCC', $templateHTML, 'editSchemaTemplateSection' );
		$text .= "\t</div><!-- templateBox-->\n";
		return $text;
	}

	/**
	 * Returns the HTML for a section of the form comprising of one page section.
	 */
	static function printPageSection( $section_num = 'snum', $pageSectionXML = null, $psPageSection = null ) {
		global $wgPageSchemasHandlerClasses;

		$text = "\t";
		if ( is_null( $pageSectionXML ) ) {
			$text .= '<div class="pageSectionBox" id="starterPageSection" style="display: none">' . "\n";
			$pageSectionName = "";
			$section_level = 2;
		} else {
			$text .= '<div class="pageSectionBox" >' . "\n";
			$pageSectionName = (string)$pageSectionXML->attributes()->name;
			$section_level = (string)$pageSectionXML->attributes()->level;
		}

		$pageSectionHTML = '<p>' . Html::rawElement( 'span', null, wfMessage( 'ps-sectionname' )->text() ) . "\n";
		$pageSectionHTML .= '</t>' . Html::input( 's_name_' . $section_num, $pageSectionName, 'text', array( 'size' => '30', 'id' => 'sectionname' ) ) . "\n";
		$header_options = '';
		$pageSectionHTML .= '<br />' . Html::rawElement( 'span', null, wfMessage( 'ps-sectionlevel' )->text() ) . "\n";
		for ( $i = 1; $i < 7; $i++ ) {
			if ( $section_level == $i ) {
				$header_options .= " " . Html::element( 'option', array( 'value' => $i, 'selected' ), $i ) . "\n";
			} else {
				$header_options .= " " . Html::element( 'option', array( 'value' => $i ), $i ) . "\n";
			}
		}
		$pageSectionHTML .= '&nbsp&nbsp' . Html::rawElement( 'select', array( 'name' => "s_level_" . $section_num ), $header_options ) . "</p>\n";

		foreach ( $wgPageSchemasHandlerClasses as $psHandlerClass ) {
			$valuesFromExtension = call_user_func( array( $psHandlerClass, "getPageSectionEditingHTML" ), $psPageSection );
			$label = call_user_func( array( $psHandlerClass, "getFieldDisplayString" ) );
			$color = call_user_func( array( $psHandlerClass, "getDisplayColor" ) );
			if ( is_null( $valuesFromExtension ) ) {
				continue;
			}
			$html = self::printFormSection( $label, $color, $valuesFromExtension, 'editSchemaPageSection' );
			$pageSectionHTML .= str_replace( 'num', $section_num, $html );
		}
		$pageSectionHTML .= '<p>' . Html::input( 'remove-pageSection', wfMessage( 'ps-removepagesection' )->text(), 'button', array( 'class' => 'deletePageSection' ) ) . "</p>\n";
		$text .= self::printFormSection( wfMessage( 'ps-section' )->text(), '#A6B7CC', $pageSectionHTML, 'pageSection' );
		$text .= "\t</div><!-- pageSectionBox-->\n";
		return $text;
	}

	/**
	 * Returns the HTML to display an entire form.
	 */
	static function printForm( $pageSchemaObj = null, $pageXML = null ) {
		global $wgPageSchemasHandlerClasses;

		if ( is_null( $pageSchemaObj ) ) {
			$psFormItemList = array();
		} else {
			$psFormItemList = $pageSchemaObj->getFormItemsList();
		}

		if ( is_null( $pageXML ) ) {
			$pageXMLChildren = array();
		} else {
			$pageXMLChildren = $pageXML->children();
		}

		$ps_add_xml = '';
		// TODO - set this correctly.
		/*
		foreach ( $pageXMLChildren as $template_xml ) {
			if ( $template_xml->getName() != 'Template') {
				$ps_add_xml .= (string)$template_xml->asXML();
			}
		}
		 */

		$text = '<form id="editSchemaForm" action="" method="post">' . "\n";
		$text .= "\n\t\t\t\t" . Html::hidden( 'ps_add_xml', $ps_add_xml );
		//$additionalXMLInput = "\n\t\t\t\t" . Html::textarea( 'ps_add_xml', $ps_add_xml, array( 'rows' => 4, 'style' => 'width: 100%;' ) );
		//$text .= '<p>' . wfMessage( 'ps-add-xml-label' )->text() . $additionalXMLInput . "\n</p>";

		foreach ( $wgPageSchemasHandlerClasses as $psHandlerClass ) {
			$valuesFromExtension = call_user_func( array( $psHandlerClass, "getSchemaEditingHTML" ), $pageSchemaObj );
			if ( is_null( $valuesFromExtension ) ) {
				continue;
			}
			$label = call_user_func( array( $psHandlerClass, "getSchemaDisplayString" ) );
			$color = call_user_func( array( $psHandlerClass, "getDisplayColor" ) );
			$text .= self::printFieldHTMLForExtension( $valuesFromExtension, $label, $color );
		}

		$text .= '<div id="templatesList">' . "\n";

		$templateNum = 0;
		$pageSectionNum = 0;

		// Add 'starter', hidden template section.
		$text .= self::printTemplateSection();
		//Add 'starter', hidden pagesection
		$text .= self::printPageSection();

		/* index for template objects */
		foreach ( $pageXMLChildren as $tag => $pageXMLChild ) {
			if ( $tag == 'Template' ) {
				$psTemplate = null;
				foreach ( $psFormItemList as $psFormItem ) {
					if ( $psFormItem['type'] == 'Template' && $psFormItem['number'] == $templateNum ) {
						$psTemplate = $psFormItem['item'];
					}
				}
				$text .= self::printTemplateSection( $templateNum, $pageXMLChild, $psTemplate );
				$templateNum++;
			} elseif ( $tag == 'Section' ) {
				$psPageSection = null;
				foreach ( $psFormItemList as $psFormItem ) {
					if ( $psFormItem['type'] == 'Section' && $psFormItem['number'] == $pageSectionNum ) {
						$psPageSection = $psFormItem['item'];
					}
				}
				$text .= self::printPageSection( $pageSectionNum, $pageXMLChild, $psPageSection );
				$pageSectionNum++;
			}
		}
		$add_template_button = Xml::element( 'input',
			array(
				'type' => 'button',
				'class' => 'editSchemaAddTemplate',
				'value' => wfMessage( 'ps-add-template' )->text(),
			)
		);
		$add_section_button = Xml::element( 'input',
			array(
				'type' => 'button',
				'class' => 'editSchemaAddSection',
				'value' => wfMessage( 'ps-add-section' )->text(),
			)
		);
		$text .= "\t</div><!-- templatesList -->\n";
		$text .= Xml::tags( 'p', null, $add_template_button . $add_section_button ) . "\n";
		$text .= "\t\t<hr />\n";
		$label = wfMessage( 'summary' )->text();
		$text .= <<<END
	<p>
	<span id='wpSummaryLabel'><label for='wpSummary'>$label</label></span>
	<input type='text' value="" name='wpSummary' id='wpSummary' maxlength='200' size='60' />
	</p>

END;
		$attr = array(
			'id' => 'wpSave',
			'accesskey' => wfMessage( 'accesskey-save' )->text(),
			'title' => wfMessage( 'tooltip-save' )->text(),
		);
		$saveButton = Html::input( 'wpSave', wfMessage( 'savearticle' )->text(), 'submit', $attr );
		$text .= "\t\t" . Html::rawElement( 'div', array( 'class' => 'editButtons' ),
			$saveButton ) . "\n";
		$text .= "\t</form>\n";

		return $text;
	}

	function execute( $category ) {
		global $wgRequest, $wgOut, $wgUser, $wgTitle;

		// If a category has been selected (i.e., it's not just
		// Special:EditSchema), only display this if the user is
		// allowed to edit the category page.
		if ( !is_null( $category ) && ( !$wgUser->isAllowed( 'edit' ) || !$wgTitle->userCan( 'edit' ) ) ) {
			$wgOut->permissionRequired( 'edit' );
			return;
		}


		$this->setHeaders();
		$text = '<p>' . wfMessage( 'ps-page-desc-edit-schema' )->text() . '</p>';
		PageSchemas::addJavascriptAndCSS();

		$save_page = $wgRequest->getCheck( 'wpSave' );
		if ( $save_page ) {
			$psXML = self::createPageSchemaXMLFromForm();
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
			$wgOut->setPageTitle( wfMessage( 'createschema' )->text() );
			$text = '<p>' . wfMessage( 'ps-page-desc-cat-not-exist' )->text() . '</p>';
			$text .= self::printForm();
		} elseif ( ( $row[1] != 'PageSchema' ) || ( $row[2] == null ) ) {
			// Category exists, but has no page schema.
			$text = '<p>' . wfMessage( 'ps-page-desc-ps-not-exist' )->text() . '</p>';
			$wgOut->setPageTitle( wfMessage( 'createschema' )->text() );
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
