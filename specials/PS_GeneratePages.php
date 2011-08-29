<?php
/**
 * Displays an interface to let users create all pages based on the Page Schemas XML
 *
 * @author Ankit Garg
 */

class GeneratePages extends IncludableSpecialPage {
	function __construct() {
		parent::__construct( 'GeneratePages' );
	}

	function execute( $category ) {
		global $wgRequest, $wgOut;

		$this->setHeaders();
		$param = $wgRequest->getText('param');
		if ( $param != "" && $category != "" ) {
			$this->generatePages( $param, $_POST['page'] );
			$text = '<p>All pages will be generated! </p>';
			$wgOut->addHTML( $text );
			return true;
		}

		if ( $category == "") {
			// No category listed - show a list of links to all categories with a page
			// schema defined.
			$text = "";
			$cat_titles = PageSchemas::getCategoriesWithPSDefined();
			foreach( $cat_titles as $cat_text ) {
				$generatePagesPage = SpecialPage::getTitleFor( 'GeneratePages' );
				$url = $generatePagesPage->getFullURL() . '/' . $cat_text;
				$text .= '<a href="' . $url . '">' . $cat_text . '</a> <br /> ';
			}
			$wgOut->addHTML( $text );
			return true;
		}

		// Standard "generate pages" form, with category name set.
		// Check for a valid category, with a page schema defined.
		$pageSchemaObj = new PSSchema( $category );
		if ( !$pageSchemaObj->isPSDefined() ) {
			$text = "<p>Error: there is no page schema defined for that category in the wiki. </p>";
			$wgOut->addHTML( $text );
			return true;
		}

		$generate_page_desc = wfMsg( 'ps-generatepages-desc' );
		$text = "<p>$generate_page_desc</p>\n";
		$text = '<form method="post"><input type="hidden" name="param" value="'.$category.'" /><br />';
		//add code to generate a list of check-box for pages to be generated.
		$pageList = array();

		// This hook will return an array of strings, with each value as a title of
		// the page to be created.
		wfRunHooks( 'PageSchemasGetPageList', array( $pageSchemaObj, &$pageList ) );
		foreach( $pageList as $page ){
			$pageURL = $page->getFullUrl();
			$pageName = PageSchemas::titleString( $page );
			$pageLink = Html::element( 'a', array( 'href' => $pageURL ), $pageName );
			$text .= '<input type="checkbox" name="page[]" value="' . $pageName . '" checked="checked" />' . $pageLink . ' <br />';
		}
		$generate_page_text = wfMsg( 'ps-generatepages' );
		$text .= '<br /> <input type="submit" value="'.$generate_page_text.'" /> <br /> <br /></form>';
		$wgOut->addHTML( $text );
		return true;
	}

	function generatePages ( $categoryName, $toGenPageList ) {
		$pageSchema = new PSSchema( $categoryName );
		$pageSchema->generateAllPages( $toGenPageList );
	}
}
