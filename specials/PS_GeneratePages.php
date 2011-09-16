<?php
/**
 * Displays an interface to let users create all pages based on the Page Schemas XML
 *
 * @author Ankit Garg
 */


class PSGeneratePages extends IncludableSpecialPage {
	function __construct() {
		parent::__construct( 'GeneratePages' );
	}

	function execute( $category ) {
		global $wgRequest, $wgOut;

		$this->setHeaders();
		$param = $wgRequest->getText('param');
		if ( !empty( $param ) && !empty( $category ) ) {
			// Generate the pages!
			$this->generatePages( $param, $wgRequest->getArray( 'page' ) );
			$text = Html::element( 'p', null, wfMsg( 'ps-generatepages-success' ) );
			$wgOut->addHTML( $text );
			return true;
		}

		if ( $category == "") {
			// No category listed - show a list of links to all
			// categories with a page schema defined.
			$text = "";
			$categoryNames = PageSchemas::getCategoriesWithPSDefined();
			$generatePagesPage = SpecialPage::getTitleFor( 'GeneratePages' );
			foreach( $categoryNames as $categoryName ) {
				$url = $generatePagesPage->getFullURL() . '/' . $categoryName;
				$text .= '<a href="' . $url . '">' . $categoryName . '</a> <br /> ';
			}
			$wgOut->addHTML( $text );
			return true;
		}

		// Standard "generate pages" form, with category name set.
		// Check for a valid category, with a page schema defined.
		$pageSchemaObj = new PSSchema( $category );
		if ( !$pageSchemaObj->isPSDefined() ) {
			$text = Html::element( 'p', null, wfMsg( 'ps-generatepages-noschema' ) );
			$wgOut->addHTML( $text );
			return true;
		}

		$text = Html::element( 'p', null,  wfMsg( 'ps-generatepages-desc' ) ) . "\n";
		$text .= '<form method="post"><input type="hidden" name="param" value="'.$category.'" />' . "\n";
		// Display a list of checkboxes for pages to be generated.
		$pageList = array();

		// This hook will set an array of strings, with each value
		// as a title of a page to be created.
		wfRunHooks( 'PageSchemasGetPageList', array( $pageSchemaObj, &$pageList ) );
		$skin = $this->getSkin();
		foreach( $pageList as $page ){
			$pageName = PageSchemas::titleString( $page );
			$text .= Html::input( 'page[]', $pageName, 'checkbox', array( 'checked' => true ) );
			$text .= "\n" . $skin->link( $page ) . "<br />\n";
		}
		$generate_page_text = wfMsg( 'generatepages' );
		$text .= '<br /> <input type="submit" value="'.$generate_page_text.'" /> </form>';
		$wgOut->addHTML( $text );
		return true;
	}

	function generatePages( $categoryName, $toGenPageList ) {
		$pageSchema = new PSSchema( $categoryName );
		$pageSchema->generateAllPages( $toGenPageList );
	}
}
