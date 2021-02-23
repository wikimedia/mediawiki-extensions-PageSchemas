<?php

use MediaWiki\MediaWikiServices;

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
	function prettyPrintXML( $xml ) {
		// Turn the XML string into a DOMDocument object, and then
		// back again, to have it displayed nicely.
		$domDocument = new DOMDocument( '1.0' );
		$domDocument->preserveWhiteSpace = false;
		$domDocument->formatOutput = true;
		$domDocument->loadXML( $xml );
		$domDocument->encoding = "UTF-8";
		return $domDocument->saveXML( $domDocument->documentElement );
	}

	/**
	 * Creates full <PageSchema> XML text, based on what was passed in by
	 * the form.
	 */
	function createPageSchemaXMLFromForm() {
		global $wgPageSchemasHandlerClasses;

		$request = $this->getRequest();

		// Generate the XML from the form elements.
		$psXML = '<PageSchema>';
		$additionalXML = $request->getText( 'ps_add_xml' );
		$psXML .= $additionalXML;
		$fieldName = "";
		$fieldNum = -1;
		$templateNum = -1;
		$pageSectionNum = -1;
		// Arrays to store the extension-specific XML entered in the form
		$schemaXMLFromExtensions = [];
		$templateXMLFromExtensions = [];
		$fieldXMLFromExtensions = [];
		$pageSectionXMLFromExtensions = [];
		foreach ( $wgPageSchemasHandlerClasses as $psHandlerClass ) {
			$schemaXMLFromExtensions[] = call_user_func( [ $psHandlerClass, 'createSchemaXMLFromForm' ] );
			$templateXMLFromExtensions[] = call_user_func( [ $psHandlerClass, 'createTemplateXMLFromForm' ] );
			$fieldXMLFromExtensions[] = call_user_func( [ $psHandlerClass, 'createFieldXMLFromForm' ] );
			$pageSectionXMLFromExtensions[] = call_user_func( [ $psHandlerClass, 'createPageSectionXMLFromForm' ] );
		}
		foreach ( $schemaXMLFromExtensions as $xml ) {
			if ( !empty( $xml ) ) {
				$psXML .= $xml;
			}
		}
		foreach ( $request->getValues() as $var => $val ) {
			// Ignore fields from the hidden/starter div
			if ( substr( $var, 0, 7 ) == 't_name_' ) {
				$templateNum = substr( $var, 7 );
				$templateAttrs = [ 'name' => $val ];
				if ( $request->getCheck( 'is_multiple_' . $templateNum ) ) {
					$templateAttrs['multiple'] = 'multiple';
				}
				if ( $request->getCheck( 'template_format_' . $templateNum ) ) {
					$templateAttrs['format'] = $request->getVal( 'template_format_' . $templateNum );
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
				$fieldAttrs = [ 'name' => $fieldName ];
				if ( $request->getCheck( 'f_is_list_' . $fieldNum ) ) {
					$fieldAttrs['list'] = 'list';
					$delimiter = $request->getText( 'f_delimiter_' . $fieldNum );
					if ( $delimiter != '' ) {
						$fieldAttrs['delimiter'] = $delimiter;
					}
				}
				$fieldDisplay = $request->getText( 'f_display_' . $fieldNum );
				if ( $fieldDisplay != 'show' ) {
					$fieldAttrs['display'] = $fieldDisplay;
				}
				$fieldNamespace = $request->getText( 'f_namespace_' . $fieldNum );
				if ( $fieldNamespace != '' ) {
					$fieldAttrs['namespace'] = $fieldNamespace;
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
				$sectionLevel = $request->getVal( "s_level_" . $pageSectionNum );
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
		return $this->prettyPrintXML( $psXML );
	}

	/**
	 * Displays a list of links to categories that have a page schema
	 * defined; for use in Special:EditSchema, if no category is specified.
	 */
	static function showLinksToCategories() {
		$cat_titles = [];
		$count_title = 0;
		$text = "";
		$dbr = wfGetDB( DB_REPLICA );
		// get the result set, query : slect page_props
		$res = $dbr->select( 'page_props',
			[
				'pp_page',
				'pp_value'
			],
			[
				'pp_propname' => 'PageSchema'
			]
		);
		$editSchemaPage = SpecialPage::getTitleFor( 'EditSchema' );
		$text .= "<ul>\n";
		while ( $row = $dbr->fetchRow( $res ) ) {
			if ( $row[1] == null ) {
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
				Html::element( 'a', [ 'href' => $url ], $catName )
			);
		}
		$text .= "</ul>\n";
		$dbr->freeResult( $res );
		return $text;
	}

	/**
	 * Returns the HTML for one section of the EditSchema form.
	 */
	function printFormSection( $label, $headerColor, $mainHTML, $sectionClass, $hasExistingValues = true ) {
		// Section header
		$headerContents = '';
		if ( empty( $sectionClass ) ) {
			$checkboxAttrs = [ 'classes' => [ 'sectionCheckbox' ] ];
			if ( $hasExistingValues ) {
				$checkboxAttrs['selected'] = true;
			}
			$checkbox = new OOUI\CheckboxInputWidget( $checkboxAttrs );
			$headerContents .= "\n\t\t" . new OOUI\FieldLayout(
				$checkbox,
				[
					'label' => $label,
					'align' => 'inline'
				]
			 );
		} else {
			$headerContents .= $label . "\n";
		}
		$sectionHTML = "\n\t\t\t\t\t" . Html::rawElement( 'div', [
			'class' => 'sectionHeader',
			'style' => "background: $headerColor;"
		], $headerContents );

		// Body of section, with all the inputs.
		$sectionHTML .= "\n\t" . Html::rawElement( 'div', [ 'class' => 'sectionBody' ], "\n" . $mainHTML );

		// Wrapper around the whole thing.
		$className = "editSchemaSection $sectionClass";
		$text = "\n\t\t\t\t" . Html::rawElement( 'div', [ 'class' => $className ], $sectionHTML ) . "\n";
		return $text;
	}

	/**
	 * Returns the HTML for a form section coming from a specific extension.
	 */
	function printFieldHTMLForExtension( $valuesFromExtension, $label, $color ) {
		list( $html, $hasExistingValues ) = $valuesFromExtension;
		return $this->printFormSection( $label, $color, $html, null, $hasExistingValues );
	}

	/**
	 * Based in part on MediaWiki's Html::namespaceSelector().
	 */
	static function printNamespaceDropdown( $inputName, $curNamespace ) {
		global $wgContLang;
		$options = $wgContLang->getFormattedNamespaces();

		// Convert $options to HTML and filter out namespaces below 0
		$optionsHtml = [];
		foreach ( $options as $nsId => $nsName ) {
			// Skip the special namespaces.
			if ( $nsId < 0 ) {
				continue;
			}
			// Skip all the odd, i.e. "Talk", namespaces.
			if ( $nsId % 2 == 1 ) {
				continue;
			}
			// Skip some of the helper namespaces.
			if ( $nsId == NS_MEDIAWIKI || $nsId == NS_TEMPLATE || $nsId == NS_HELP ) {
				continue;
			}
			$optionsHtml[] = Html::element( 'option',
				[ 'selected' => $nsName === $curNamespace ],
				$nsName );
		}

		return Html::rawElement( 'select', [ 'name' => $inputName ],
			implode( "\n", $optionsHtml ) );
	}

	/**
	 * Returns the HTML for a section of the form comprising one
	 * template field.
	 */
	function printFieldSection( $field_xml = null, $psField = null ) {
		global $wgPageSchemasHandlerClasses;

		if ( $field_xml === null ) {
			$fieldNum = 'fnum';
		} else {
			global $wgPageSchemasFieldNum;
			$fieldNum = $wgPageSchemasFieldNum;
			$wgPageSchemasFieldNum++;
		}

		$fieldName = '';
		$delimiter = '';
		$fieldLabel = '';
		$isListAttrs = [ 'class' => 'isListCheckbox' ];
		$delimiterAttrs = [ 'class' => 'delimiterInput' ];
		$fieldDisplay = '';
		$fieldNamespace = '';
		$text = "\n\t\t\t";
		if ( $field_xml === null ) {
			$text .= '<div class="fieldBox" id="starterField" style="display: none" >';
		} else {
			$text .= '<div class="fieldBox" >';
			$fieldName = (string)$field_xml->attributes()->name;
			if ( ( (string)$field_xml->attributes()->delimiter ) != null || ( (string)$field_xml->attributes()->delimiter ) != '' ) {
				$delimiter = (string)$field_xml->attributes()->delimiter;
			}
			foreach ( $field_xml->children() as $tag => $child ) {
				if ( $tag == 'Label' ) {
					$fieldLabel = (string)$child;
				}
			}
			if ( ( (string)$field_xml->attributes()->list ) == "list" ) {
				$isListAttrs['checked'] = 'checked';
			}
			$fieldDisplay = (string)$field_xml->attributes()->display;
			$fieldNamespace = (string)$field_xml->attributes()->namespace;
		}
		$fieldHTML = $this->msg( 'ps-namelabel' )->parse() . ' ';
		$fieldHTML .= Html::input( 'f_name_' . $fieldNum, $fieldName, 'text', [ 'size' => 25 ] ) . ' ';
		$fieldHTML .= $this->msg( 'ps-displaylabel' )->parse() . ' ';
		$fieldHTML .= Html::input( 'f_label_' . $fieldNum, $fieldLabel, 'text', [ 'size' => 25 ] );
		$fieldHTML = Html::rawElement( 'p', null, $fieldHTML ) . "\n";
		$fieldIsListInput = Html::input( 'f_is_list_' . $fieldNum, null, 'checkbox', $isListAttrs );
		$fieldIsListSet = $fieldIsListInput . ' ';
		$fieldIsListSet .= $this->msg( 'ps-field-list-label' )->parse();
		$fieldHTML .= Html::rawElement( 'p', null,  $fieldIsListSet );
		$fieldDelimiterSet = $this->msg( 'ps-delimiter-label' )->parse() . ' ' .
			Html::input( 'f_delimiter_' . $fieldNum, $delimiter, 'text', [ 'size' => 3 ] );
		$fieldHTML .= "\n" . Html::rawElement( 'p', $delimiterAttrs, $fieldDelimiterSet );
		// Create radiobutton for display of field
		$displayShownAttrs = [];
		$displayIfNonEmptyAttrs = [];
		$displayHiddenAttrs = [];
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
		$fieldDisplaySet = $fieldDisplayShownInput . ' ';
		$fieldDisplaySet .= $this->msg( 'ps-field-display-always' )->parse() . ' ';
		$fieldDisplayIfNonEmptyInput = Html::input( $groupName, 'nonempty', 'radio', $displayIfNonEmptyAttrs );
		$fieldDisplaySet .= $fieldDisplayIfNonEmptyInput . ' ';
		$fieldDisplaySet .= $this->msg( 'ps-field-display-notempty' )->parse() . ' ';
		$fieldDisplayHiddenInput = Html::input( $groupName, 'hidden', 'radio', $displayHiddenAttrs );
		$fieldDisplaySet .= $fieldDisplayHiddenInput . ' ';
		$fieldDisplaySet .= $this->msg( 'ps-field-display-hide' )->parse();
		$fieldHTML .= Html::rawElement( 'p', null, $fieldDisplaySet );

		$fieldNamespaceSet = $this->msg( 'ps-field-namespace' )->parse() . ' ';
		$fieldNamespaceSet .= self::printNamespaceDropdown( 'f_namespace_' . $fieldNum, $fieldNamespace );
		$fieldHTML .= Html::rawElement( 'div', [ 'class' => 'editSchemaMinorFields' ], $fieldNamespaceSet );

		// Insert HTML text from extensions
		foreach ( $wgPageSchemasHandlerClasses as $psHandlerClass ) {
			$valuesFromExtension = call_user_func( [ $psHandlerClass, "getFieldEditingHTML" ], $psField );
			if ( $valuesFromExtension === null ) {
				continue;
			}
			$label = call_user_func( [ $psHandlerClass, "getFieldDisplayString" ] );
			$color = call_user_func( [ $psHandlerClass, "getDisplayColor" ] );
			$html = self::printFieldHTMLForExtension( $valuesFromExtension, $label, $color );
			// We use 'num' here, instead of 'fnum', to distinguish
			// between field names from Page Schemas (which get
			// their number set via Javascript) and field names from
			// other extensions (which get their number set via PHP).
			// Is this important to do? Probably not.
			$fieldHTML .= str_replace( '_num', '_' . $fieldNum, $html );
		}

		// TODO - this needs to get set.
		$field_add_xml = null;
		$fieldHTML .= "\n\t\t\t\t" . Html::hidden( "f_add_xml_$fieldNum", $field_add_xml );
		// $additionalXMLInput = "\n\t\t\t\t" . Html::textarea( "f_add_xml_$fieldNum", $field_add_xml, array( 'rows' => 4, 'style' => 'width: 100%;' ) );
		//$fieldHTML .= "<p>" . $this->msg('ps-add-xml-label')->parse() . $additionalXMLInput . "</p>\n";
		$fieldHTML .= new OOUI\ButtonWidget(
			[
				'name' => 'remove-field',
				'classes' => [ 'deleteField' ],
				'icon' => 'close',
				'label' => $this->msg( 'ps-remove-field' )->parse(),
			]
		);
		$text .= "\n" . $this->printFormSection( $this->msg( 'ps-field' )->parse(), '#AAA', $fieldHTML, 'editSchemaFieldSection' );
		$text .= "\t</div><!-- fieldBox -->\n";
		return $text;
	}

	/**
	 * Returns the HTML for a section of the form comprising one template.
	 */
	function printTemplateSection( $template_num = 'tnum', $templateXML = null, $psTemplate = null ) {
		global $wgPageSchemasHandlerClasses;

		if ( $psTemplate === null ) {
			$psTemplateFields = [];
		} else {
			$psTemplateFields = $psTemplate->getFields();
		}
		$attrs = [ 'class' => 'multipleInstanceTemplateCheckbox' ];
		$templateXMLElements = [];
		$text = "\t";
		if ( $templateXML === null ) {
			$text .= '<div class="templateBox" id="starterTemplate" style="display: none">' . "\n";
			$templateName = '';
			$templateFormat = null;
		} else {
			$text .= '<div class="templateBox" >' . "\n";
			$templateName = (string)$templateXML->attributes()->name;
			if ( ( (string)$templateXML->attributes()->multiple ) == "multiple" ) {
				$attrs['checked'] = 'checked';
			}
			$templateFormat = (string)$templateXML->attributes()->format;
			$templateXMLElements = $templateXML->children();
		}
		$templateNameInput = $this->msg( 'ps-namelabel' )->parse() . ' ';
		$templateNameInput .= Html::input( 't_name_' . $template_num, $templateName, 'text' );
		$templateHTML = "\t\t" . Html::rawElement( 'p', null, $templateNameInput ) . "\n";
		$templateIsMultipleInput = Html::input( 'is_multiple_' . $template_num, null, 'checkbox', $attrs );
		$templateHTML .= "\t\t" . Html::rawElement( 'p', null, $templateIsMultipleInput . ' ' . $this->msg( 'ps-multiple-temp-label' )->parse() );

		// Use an input from the Page Forms extension for the template
		// format.
		// This is against the basic principles of Page Schemas, which
		// is that other extensions should rely on it, not the other
		// way around. However, the creation of templates is a special
		// case: they're a standard MediaWiki component, but the
		// creation of them is (for no strong reason) done by Page
		// Forms. In the future, this may change.
		if ( method_exists( 'PFCreateTemplate', 'printTemplateStyleInput' ) ) {
			$templateHTML .= PFCreateTemplate::printTemplateStyleInput( 'template_format_' . $template_num, $templateFormat );
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
			$multipleInstanceOnly = call_user_func( [ $psHandlerClass, "isTemplateDataMultipleInstanceOnly" ] );
			if ( !$multipleInstanceOnly ) {
				continue;
			}
			$valuesFromExtension = call_user_func( [ $psHandlerClass, "getTemplateEditingHTML" ], $psTemplate );
			if ( $valuesFromExtension === null ) {
				continue;
			}
			$label = call_user_func( [ $psHandlerClass, "getTemplateDisplayString" ] );
			$color = call_user_func( [ $psHandlerClass, "getDisplayColor" ] );
			$html = self::printFieldHTMLForExtension( $valuesFromExtension, $label, $color );
			$templateHTML .= str_replace( '_num', '_' . $template_num, $html );
		}

		$templateHTML .= "\n\t\t" . '</div><!-- multipleInstanceTemplateAttributes -->';

		foreach ( $wgPageSchemasHandlerClasses as $psHandlerClass ) {
			$multipleInstanceOnly = call_user_func( [ $psHandlerClass, "isTemplateDataMultipleInstanceOnly" ] );
			if ( $multipleInstanceOnly ) {
				continue;
			}
			$valuesFromExtension = call_user_func( [ $psHandlerClass, "getTemplateEditingHTML" ], $psTemplate );
			if ( $valuesFromExtension === null ) {
				continue;
			}
			$label = call_user_func( [ $psHandlerClass, "getTemplateDisplayString" ] );
			$color = call_user_func( [ $psHandlerClass, "getDisplayColor" ] );
			$html = self::printFieldHTMLForExtension( $valuesFromExtension, $label, $color );
			$templateHTML .= str_replace( 'num', $template_num, $html );
		}

		$templateHTML .= "\n\t\t" . '<div class="fieldsList">';
		$fieldNumInTemplate = 0;
		// If this is a "starter" template, create the starter
		// field HTML.
		if ( $psTemplate === null ) {
			$templateHTML .= $this->printFieldSection();
		}
		foreach ( $templateXMLElements as $templateXMLElement ) {
			if ( empty( $templateXMLElement ) ) {
				// Do nothing (?)
			} elseif ( $templateXMLElement->getName() == "Field" ) {
				if ( array_key_exists( $fieldNumInTemplate, $psTemplateFields ) ) {
					$psTemplateField = $psTemplateFields[$fieldNumInTemplate];
				} else {
					continue;
					// $psTemplateField = new PSTemplateField();
				}
				$templateHTML .= $this->printFieldSection( $templateXMLElement, $psTemplateField );
				$fieldNumInTemplate++;
			}
		}
		$templateHTML .= "\t</div><!-- fieldsList -->\n";
		$add_field_button = new OOUI\ButtonWidget(
			[
				'classes' => [ 'editSchemaAddField' ],
				'icon' => 'add',
				'label' => $this->msg( 'ps-add-field' )->parse(),
			]
		);
		$templateHTML .= Html::rawElement( 'p', null, $add_field_button ) . "\n";
		$templateHTML .= "<hr />\n";
		$templateHTML .= "\n\t\t\t\t" . Html::hidden( "t_add_xml_$template_num", $template_add_xml );
		// $additionalXMLInput = "\n\t\t\t\t" . Html::textarea( "t_add_xml_$template_num", $template_add_xml, array( 'rows' => 4, 'style' => 'width: 100%;' ) );
		//$templateHTML .= "\n<p>" . $this->msg('ps-add-xml-label')->parse() . "\n\t\t\t\t" . $additionalXMLInput . "\n\t\t\t</p>";
		$templateHTML .= '<p>' . new OOUI\ButtonWidget(
			[
				'name' => 'remove-template',
				'classes' => [ 'deleteTemplate' ],
				'icon' => 'close',
				'label' => $this->msg( 'ps-remove-template' )->parse(),
			]
		) . "</p>\n";
		$text .= $this->printFormSection( $this->msg( 'ps-template' )->parse(), '#CCC', $templateHTML, 'editSchemaTemplateSection' );
		$text .= "\t</div><!-- templateBox-->\n";
		return $text;
	}

	/**
	 * Returns the HTML for a section of the form comprising of one page section.
	 */
	function printPageSection( $section_num = 'snum', $pageSectionXML = null, $psPageSection = null ) {
		global $wgPageSchemasHandlerClasses;

		$text = "\t";
		if ( $pageSectionXML === null ) {
			$text .= '<div class="pageSectionBox" id="starterPageSection" style="display: none">' . "\n";
			$pageSectionName = "";
			$section_level = 2;
		} else {
			$text .= '<div class="pageSectionBox" >' . "\n";
			$pageSectionName = (string)$pageSectionXML->attributes()->name;
			$section_level = (string)$pageSectionXML->attributes()->level;
		}

		$pageSectionHTML = '<p>' . Html::rawElement( 'span', null, $this->msg( 'ps-sectionname' )->parse() ) . "\n";
		$pageSectionHTML .= '</t>' . Html::input(
			's_name_' . $section_num,
			$pageSectionName,
			'text',
			[ 'size' => '30', 'id' => 'sectionname' ]
		) . "\n";
		$header_options = '';
		$pageSectionHTML .= '<br />' . Html::rawElement( 'span', null, $this->msg( 'ps-sectionlevel' )->parse() ) . "\n";
		for ( $i = 1; $i < 7; $i++ ) {
			if ( $section_level == $i ) {
				$header_options .= " " . Html::element( 'option', [ 'value' => $i, 'selected' ], $i ) . "\n";
			} else {
				$header_options .= " " . Html::element( 'option', [ 'value' => $i ], $i ) . "\n";
			}
		}
		$pageSectionHTML .= '&nbsp&nbsp' . Html::rawElement( 'select', [ 'name' => "s_level_" . $section_num ], $header_options ) . "</p>\n";

		foreach ( $wgPageSchemasHandlerClasses as $psHandlerClass ) {
			$valuesFromExtension = call_user_func( [ $psHandlerClass, "getPageSectionEditingHTML" ], $psPageSection );
			$label = call_user_func( [ $psHandlerClass, "getFieldDisplayString" ] );
			$color = call_user_func( [ $psHandlerClass, "getDisplayColor" ] );
			if ( $valuesFromExtension === null ) {
				continue;
			}
			$html = $this->printFormSection( $label, $color, $valuesFromExtension, 'editSchemaPageSection' );
			$pageSectionHTML .= str_replace( 'num', $section_num, $html );
		}
		$pageSectionHTML .= '<p>' . new OOUI\ButtonWidget(
			[
				'name' => 'remove-pageSection',
				'label' => $this->msg( 'ps-removepagesection' )->parse(),
				'icon' => 'close',
				'classes' => [ 'deletePageSection' ]
			]
		) . "</p>\n";
		$text .= $this->printFormSection( $this->msg( 'ps-section' )->parse(), '#A6B7CC', $pageSectionHTML, 'pageSection' );
		$text .= "\t</div><!-- pageSectionBox-->\n";
		return $text;
	}

	/**
	 * Returns the HTML to display an entire form.
	 */
	function printForm( $pageSchemaObj = null, $pageXML = null ) {
		global $wgPageSchemasHandlerClasses;

		if ( $pageSchemaObj === null ) {
			$psFormItemList = [];
		} else {
			$psFormItemList = $pageSchemaObj->getFormItemsList();
		}

		if ( $pageXML === null ) {
			$pageXMLChildren = [];
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
		// $additionalXMLInput = "\n\t\t\t\t" . Html::textarea( 'ps_add_xml', $ps_add_xml, array( 'rows' => 4, 'style' => 'width: 100%;' ) );
		//$text .= '<p>' . $this->msg( 'ps-add-xml-label' )->parse() . $additionalXMLInput . "\n</p>";

		foreach ( $wgPageSchemasHandlerClasses as $psHandlerClass ) {
			$valuesFromExtension = call_user_func( [ $psHandlerClass, "getSchemaEditingHTML" ], $pageSchemaObj );
			if ( $valuesFromExtension === null ) {
				continue;
			}
			$label = call_user_func( [ $psHandlerClass, "getSchemaDisplayString" ] );
			$color = call_user_func( [ $psHandlerClass, "getDisplayColor" ] );
			$text .= self::printFieldHTMLForExtension( $valuesFromExtension, $label, $color );
		}

		$text .= '<div id="templatesList">' . "\n";

		$templateNum = 0;
		$pageSectionNum = 0;

		// Add 'starter', hidden template section.
		$text .= $this->printTemplateSection();
		// Add 'starter', hidden pagesection
		$text .= $this->printPageSection();

		/* index for template objects */
		foreach ( $pageXMLChildren as $tag => $pageXMLChild ) {
			if ( $tag == 'Template' ) {
				$psTemplate = null;
				foreach ( $psFormItemList as $psFormItem ) {
					if ( $psFormItem['type'] == 'Template' && $psFormItem['number'] == $templateNum ) {
						$psTemplate = $psFormItem['item'];
					}
				}
				$text .= $this->printTemplateSection( $templateNum, $pageXMLChild, $psTemplate );
				$templateNum++;
			} elseif ( $tag == 'Section' ) {
				$psPageSection = null;
				foreach ( $psFormItemList as $psFormItem ) {
					if ( $psFormItem['type'] == 'Section' && $psFormItem['number'] == $pageSectionNum ) {
						$psPageSection = $psFormItem['item'];
					}
				}
				$text .= $this->printPageSection( $pageSectionNum, $pageXMLChild, $psPageSection );
				$pageSectionNum++;
			}
		}
		$add_template_button = new OOUI\ButtonWidget(
			[
				'label' => $this->msg( 'ps-add-template' )->parse(),
				'icon' => 'add',
				'classes' => [ 'editSchemaAddTemplate' ]
			]
		);
		$add_section_button = new OOUI\ButtonWidget(
			[
				'label' => $this->msg( 'ps-add-section' )->parse(),
				'icon' => 'add',
				'classes' => [ 'editSchemaAddSection' ]
			]
		);
		$text .= "\t</div><!-- templatesList -->\n";
		$text .= Html::rawElement( 'p', null, $add_template_button . $add_section_button ) . "\n";
		$text .= "\t\t<hr />\n";
		$label = $this->msg( 'summary' )->parse();
		$summaryInput = Html::input(
			'wpSummary', null, 'text',
			[
				'id' => 'wpSummary',
				'maxlength' => 200,
				'size' => 60
			]
		);
		$text .= <<<END
	<p>
	<span id='wpSummaryLabel'><label for='wpSummary'>$label</label></span>
	$summaryInput
	</p>

END;
		$saveButton = new OOUI\ButtonInputWidget(
			[
				'name' => 'wpSave',
				'label' => $this->msg( 'savearticle' )->parse(),
				'type' => 'submit',
				'flags' => [ 'progressive', 'primary' ],
				'id' => 'wpSave',
				'accessKey' => $this->msg( 'accesskey-save' )->parse(),
				'title' => $this->msg( 'tooltip-save' )->parse(),
			]
		);
		$text .= "\t\t" . Html::rawElement(
			'div',
			[ 'class' => 'editButtons' ],
			$saveButton
		) . "\n";
		$text .= "\t</form>\n";

		return $text;
	}

	function execute( $category ) {
		$categoryTitle = Title::newFromText( $category, NS_CATEGORY );
		$user = $this->getUser();
		$request = $this->getRequest();
		$out = $this->getOutput();

		// If a category has been selected (i.e., it's not just
		// Special:EditSchema), only display this if the user is
		// allowed to edit the category page.
		if ( $categoryTitle !== null ) {
			if ( method_exists( 'MediaWiki\Permissions\PermissionManager', 'userCan' ) ) {
				// MW 1.33+
				$permissionManager = MediaWikiServices::getInstance()->getPermissionManager();
				$userCanEdit = $permissionManager->userCan( 'edit', $user, $categoryTitle );
			} else {
				$userCanEdit = ( $user->isAllowed( 'edit' ) && $categoryTitle->userCan( 'edit' ) );
			}
			if ( !$userCanEdit ) {
				throw new PermissionsError( 'edit' );
			}
		}

		$this->setHeaders();
		$out->enableOOUI();
		$text = '<p>' . $this->msg( 'ps-page-desc-edit-schema' )->parse() . '</p>';
		PageSchemas::addJavascriptAndCSS();

		$save_page = $request->getCheck( 'wpSave' );
		if ( $save_page ) {
			$psXML = $this->createPageSchemaXMLFromForm();
			$categoryTitle = Title::newFromText( $category, NS_CATEGORY );
			$categoryPage = WikiPage::factory( $categoryTitle );
			if ( $categoryTitle->exists() ) {
				$pageText = $categoryPage->getContent()->getNativeData();
				$pageSchemaObj = new PSSchema( $category );
				if ( $pageSchemaObj->isPSDefined() ) {
					// Do some preg_replace magic.
					// This is necessary if the <PageSchema>
					// tag accepts any attributes - which it
					// currently does not, but it may well
					// in the future.
					$tag = "PageSchema";
					$pageText = preg_replace( '{<' . $tag . '[^>]*>([^@]*?)</' . $tag . '>' . '}', $psXML, $pageText );
				} else {
					$pageText = $psXML . $pageText;
				}
			} else {
				$pageText = $psXML;
			}
			$editSummary = $request->getVal( 'wpSummary' );
			PageSchemas::createOrModifyPage( $categoryPage, $pageText, $editSummary, $user );

			$redirectURL = $categoryTitle->getLocalURL();
			$text = <<<END
		<script type="text/javascript">
		window.onload = function() {
			window.location="$redirectURL";
		}
		</script>

END;
			$out->addHTML( $text );
			return true;
		}

		if ( $category == "" ) {
			// No category was specified - show the list of
			// categories with a page schema defined.
			$text = self::showLinksToCategories();
			$out->addHTML( $text );
			return true;
		}

		// We have a category - show a form.
		// See if a page schema has already been defined for this category.
		$pageId = $categoryTitle->getArticleID();
		$dbr = wfGetDB( DB_REPLICA );
		$res = $dbr->select( 'page_props',
			[
				'pp_value'
			],
			[
				'pp_page' => $pageId,
				'pp_propname' => 'PageSchema',
			]
		);

		$row = $dbr->fetchRow( $res );
		if ( !$categoryTitle->exists() ) {
			// Category doesn't exist.
			$out->setPageTitle( $this->msg( 'createschema' )->parse() );
			$text = '<p>' . $this->msg( 'ps-page-desc-cat-not-exist' )->parse() . '</p>';
			$text .= $this->printForm();
		} elseif ( $row == null ) {
			// Category exists, but has no page schema.
			$text = '<p>' . $this->msg( 'ps-page-desc-ps-not-exist' )->parse() . '</p>';
			$out->setPageTitle( $this->msg( 'createschema' )->parse() );
			$text .= $this->printForm();
		} else {
			// It's a category with an existing page schema -
			// populate the form with its values.
			$pageSchemaObj = new PSSchema( $category );
			$pageXMLstr = $row[0];
			$pageXML = simplexml_load_string( $pageXMLstr );
			$text = $this->printForm( $pageSchemaObj, $pageXML );
		}
		$out->addHTML( $text );
		return true;
	}

	protected function getGroupName() {
		return 'other';
	}
}
