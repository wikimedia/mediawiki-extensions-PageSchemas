<?php
/**
 * Hook functions for the Page Schemas extension
 *
 * @file
 * @ingroup Extensions
 */

use MediaWiki\HookContainer\HookContainer;

class PageSchemasHooks implements
	\MediaWiki\Hook\ParserFirstCallInitHook
{
	private HookContainer $hookContainer;

	public function __construct(
		HookContainer $hookContainer
	) {
		$this->hookContainer = $hookContainer;
	}

	/**
	 * Initialization
	 *
	 * @param Parser $parser
	 * @return true
	 */
	public function onParserFirstCallInit( $parser ) {
		// Register the hook with the parser.
		$parser->setHook( 'PageSchema', [ 'PageSchemasHooks', 'render' ] );

		// Initialize the global array of "handler" classes.
		$this->hookContainer->run( 'PageSchemasRegisterHandlers' );
		return true;
	}

	/**
	 * Render the displayed XML, if any.
	 *
	 * @param string $input
	 * @param array $args
	 * @param Parser $parser
	 * @param PPFrame $frame
	 * @return string|void
	 */
	public static function render( $input, $args, $parser, $frame ) {
		$parserOutput = $parser->getOutput();
		// Disable cache so that CSS will get loaded.
		$parserOutput->updateCacheExpiry( 0 );

		// If this call is contained in a transcluded page or template,
		// or if the input is empty, display nothing.
		if ( !$frame->title->equals( $parser->getTitle() ) || $input == '' ) {
			return;
		}

		// TODO: Do processing here, like parse to an array
		$error_msg = null;

		// Recreate the top-level <PageSchema> tag, with whatever
		// attributes it contained, because that was actually a tag-
		// function call, as opposed to a real XML tag.
		$input = Xml::tags( 'PageSchema', $args, $input );

		$xml_object = PageSchemas::validateXML( $input, $error_msg );
		if ( $xml_object ) {
			// Store the XML in the page_props table
			$parserOutput->setPageProperty( 'PageSchema', $input );
			// Display the schema on the screen
			global $wgOut, $wgScriptPath;
			$wgOut->addStyle( $wgScriptPath . '/extensions/PageSchemas/resources/PageSchemas.css' );
			$text = PageSchemas::displaySchema( $xml_object );
		} else {
			// Store error message in the page_props table
			$parserOutput->setPageProperty( 'PageSchema', $error_msg );
			$text = Html::element( 'p', null, "The (incorrect) XML definition for this template is:" ) . "\n";
			$text .= Html::element( 'pre', null, $input );
		}

		return $text;
	}
}
