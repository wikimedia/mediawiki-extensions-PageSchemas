<?php
/**
 * Class that holds utility functions for the Page Schemas extension.
 *
 * @file
 * @ingroup Extensions
 */

use MediaWiki\MediaWikiServices;

class PageSchemas {

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
		if ( $parser !== null ) {
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
			return $namespace . MediaWikiServices::getInstance()->getContentLanguage()->ucfirst( $title->getText() );
		} else {
			return $namespace . $title->getText();
		}
	}

	public static function validateXML( $xml, &$error_msg ) {
		$xmlDTD = <<<END
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
		libxml_use_internal_errors( true );
		$xml_success = simplexml_load_string( $xmlDTD . $xml );
		$errors = libxml_get_errors();
		$error_msg = $errors[0]->message;
		return $xml_success;
	}

	static function tableRowHTML( $css_class, $data_type, $value = null, $bgColor = null ) {
		$data_type = htmlspecialchars( $data_type );
		if ( $bgColor !== null ) {
			// We don't actually use the passed-in background color, except as an indicator
			// that this is a header row for extension data, and thus should have special
			// display.
			// In the future, the background color may get used, though.
			$data_type = Html::element( 'span', [ 'style' => "color: #993333;" ], $data_type );
		}
		if ( $value == '' ) {
			$content = $data_type;
		} else {
			$content = "$data_type: " . Html::element( 'span', [ 'class' => 'rowValue' ], $value );
		}
		$cellAttrs = [ 'colspan' => 2, 'class' => $css_class ];
		$cell = Html::rawElement( 'td', $cellAttrs, $content );
		$text = Html::rawElement( 'tr', [ 'style' => 'border: 1px black solid; margin: 10px;' ], $cell );
		$text .= "\n";
		return $text;
	}

	static function attrRowHTML( $cssClass, $fieldName, $value ) {
		$fieldNameAttrs = [ 'class' => $cssClass, 'style' => 'font-weight: normal;' ];
		$fieldNameCell = Html::rawElement( 'td', $fieldNameAttrs, $fieldName );
		$valueCell = Html::element( 'td', [ 'class' => 'msg', 'style' => 'font-weight: bold;' ], $value );
		$text = Html::rawElement( 'tr', null, $fieldNameCell . "\n" . $valueCell );
		$text .= "\n";
		return $text;
	}

	// TODO - this should be a non-static method of the PSSchema class,
	// instead of taking in XML.
	static function displaySchema( $schemaXML ) {
		global $wgPageSchemasHandlerClasses;

		$title = RequestContext::getMain()->getTitle();

		if ( $title === null || $title->getNamespace() != NS_CATEGORY ) {
			return '';
		}
		$text = "<table class=\"pageSchema mw-collapsible mw-collapsed\">\n";
		$name = $schemaXML->attributes()->name;
		$text .= self::tableRowHTML( 'pageSchemaHeader', 'Page schema' );

		foreach ( $wgPageSchemasHandlerClasses as $psHandlerClass ) {
			$returnVals = call_user_func( [ $psHandlerClass, 'getSchemaDisplayValues' ], $schemaXML );
			if ( !is_array( $returnVals ) || count( $returnVals ) != 2 ) {
				continue;
			}
			list( $elementName, $values ) = $returnVals;
			$label = call_user_func( [ $psHandlerClass, 'getSchemaDisplayString' ] );
			$bgColor = call_user_func( [ $psHandlerClass, 'getDisplayColor' ] );
			$text .= self::tableRowHTML( 'schemaExtensionRow', $label, $elementName, $bgColor );
			foreach ( $values as $fieldName => $value ) {
				$text .= self::attrRowHTML( 'schemaAttrRow', $fieldName, $value );
			}
		}
		foreach ( $schemaXML->children() as $tag => $child ) {
			if ( $tag == 'Template' ) {
				$text .= self::displayTemplate( $child );
			} elseif ( $tag == 'Section' ) {
				$text .= self::displayPageSection( $child );
			}
		}
		$text .= "</table>\n";
		return $text;
	}

	/**
	 * Display the schema information for a single template, in HTML form.
	 */
	static function displayTemplate( $templateXML ) {
		global $wgPageSchemasHandlerClasses;

		$name = $templateXML->attributes()->name;
		$text = self::tableRowHTML( 'templateRow', wfMessage( 'ps-template' )->parse(), $name );
		$multiple = $templateXML->attributes()->multiple;
		if ( $multiple == 'multiple' ) {
			$text .= self::attrRowHTML( 'schemaAttrRow', 'multiple', null );
		}
		$format = $templateXML->attributes()->format;
		if ( $format ) {
			$text .= self::attrRowHTML( 'schemaAttrRow', 'format', $format );
		}

		foreach ( $wgPageSchemasHandlerClasses as $psHandlerClass ) {
			$returnVals = call_user_func( [ $psHandlerClass, 'getTemplateDisplayValues' ], $templateXML );
			if ( !is_array( $returnVals ) || count( $returnVals ) != 2 ) {
				continue;
			}
			list( $elementName, $values ) = $returnVals;
			$label = call_user_func( [ $psHandlerClass, 'getTemplateDisplayString' ] );
			$bgColor = call_user_func( [ $psHandlerClass, 'getDisplayColor' ] );
			$text .= self::tableRowHTML( 'fieldExtensionRow', $label, $elementName, $bgColor );
			foreach ( $values as $fieldName => $value ) {
				$text .= self::attrRowHTML( 'fieldAttrRow', $fieldName, $value );
			}
		}
		foreach ( $templateXML->children() as $elementName => $child ) {
			if ( $elementName == 'Field' ) {
				$text .= self::displayField( $child );
			}
		}
		return $text;
	}

	/**
	 * Display the schema information for a single template field, in HTML
	 * form.
	 */
	static function displayField( $fieldXML ) {
		global $wgPageSchemasHandlerClasses;

		$name = $fieldXML->attributes()->name;
		$text = self::tableRowHTML( 'fieldRow', wfMessage( 'ps-field' )->parse(), $name );

		if ( ( (string)$fieldXML->attributes()->list ) == "list" ) {
			$text .= self::attrRowHTML( 'fieldAttrRow', 'List', null );
		}
		$fieldDisplay = (string)$fieldXML->attributes()->display;
		if ( $fieldDisplay != "" ) {
			$text .= self::attrRowHTML( 'fieldAttrRow', 'Display', $fieldDisplay );
		}
		foreach ( $fieldXML->children() as $tag => $child ) {
			if ( $tag == 'Label' ) {
				$text .= self::attrRowHTML( 'fieldAttrRow', 'Label', $child );
			}
		}

		// Let extensions that store data within the Page Schemas XML
		// each handle displaying their data, by adding to this array.
		foreach ( $wgPageSchemasHandlerClasses as $psHandlerClass ) {
			$returnVals = call_user_func( [ $psHandlerClass, 'getFieldDisplayValues' ], $fieldXML );
			if ( $returnVals == null || count( $returnVals ) != 2 ) {
				continue;
			}
			list( $elementName, $values ) = $returnVals;
			$label = call_user_func( [ $psHandlerClass, 'getFieldDisplayString' ] );
			$bgColor = call_user_func( [ $psHandlerClass, 'getDisplayColor' ] );
			$text .= self::tableRowHTML( 'fieldExtensionRow', $label, $elementName, $bgColor );
			foreach ( $values as $fieldName => $value ) {
				$text .= self::attrRowHTML( 'fieldAttrRow', $fieldName, $value );
			}
		}
		return $text;
	}

	/**
	 * Display the schema information for a single page section, in HTML
	 * form.
	 */
	static function displayPageSection( $pageSectionXML ) {
		global $wgPageSchemasHandlerClasses;

		$name = $pageSectionXML->attributes()->name;
		$level = $pageSectionXML->attributes()->level;
		$text = self::tableRowHTML( 'templateRow', wfMessage( 'ps-section' )->parse(), $name );
		$text .= self::attrRowHTML( 'schemaAttrRow', wfMessage( 'ps-level' )->parse(), $level );

		foreach ( $wgPageSchemasHandlerClasses as $psHandlerClass ) {
			$returnVals = call_user_func( [ $psHandlerClass, 'getPageSectionDisplayValues' ], $pageSectionXML );
			if ( count( $returnVals ) != 2 ) {
				continue;
			}
			list( $elementName, $values ) = $returnVals;
			$label = call_user_func( [ $psHandlerClass, 'getPageSectionDisplayString' ] );
			$bgColor = call_user_func( [ $psHandlerClass, 'getDisplayColor' ] );
			$text .= self::tableRowHTML( 'fieldExtensionRow', $label, $elementName, $bgColor );
			foreach ( $values as $fieldName => $value ) {
				$text .= self::attrRowHTML( 'fieldAttrRow', $fieldName, $value );
			}
		}

		return $text;
	}

	public static function getValueFromObject( $object, $key ) {
		if ( $object === null ) {
			return null;
		} elseif ( !array_key_exists( $key, $object ) ) {
			return null;
		}
		return $object[$key];
	}

	public static function createOrModifyPage( $wikiPage, $pageText, $editSummary, $user ) {
		$newContent = new WikitextContent( $pageText );
		$flags = 0;

		if ( class_exists( 'PageUpdater' ) ) {
			// MW 1.32+
			$updater = $wikiPage->newPageUpdater( $user );
			$updater->setContent( SlotRecord::MAIN, $newContent );
			$updater->saveRevision( CommentStoreComment::newUnsavedComment( $editSummary ), $flags );
		} else {
			$wikiPage->doEditContent( $newContent, $editSummary, $flags, $originalRevId = false, $user );
		}
	}

}
