<?php
/**
 * Displays an interface to let users create all pages based on the
 * Page Schemas XML.
 *
 * @author Ankit Garg
 * @author Yaron Koren
 */

class PSGeneratePages extends IncludableSpecialPage {
	function __construct() {
		parent::__construct( 'GeneratePages', 'generatepages' );
	}

	/**
	 * @param string $category
	 * @return true
	 */
	function execute( $category ) {
		global $wgPageSchemasHandlerClasses;

		$user = $this->getUser();
		$request = $this->getRequest();
		$out = $this->getOutput();

		if ( !$user->isAllowed( 'generatepages' ) ) {
			throw new PermissionsError( 'generatepages' );
		}

		$this->setHeaders();
		$out->enableOOUI();

		$param = $request->getText( 'param' );
		if ( !empty( $param ) && !empty( $category ) ) {
			// Generate the pages!
			$this->generatePages( $param, $request->getArray( 'page' ) );
			$text = Html::element( 'p', null, $this->msg( 'ps-generatepages-success' )->parse() );
			$out->addHTML( $text );
			return true;
		}

		if ( $category == "" ) {
			// No category listed.
			// TODO - show an error message.
			return true;
		}

		// Standard "generate pages" form, with category name set.
		// Check for a valid category, with a page schema defined.
		$pageSchemaObj = new PSSchema( $category );
		if ( !$pageSchemaObj->isPSDefined() ) {
			$text = Html::element( 'p', null, $this->msg( 'ps-generatepages-noschema' )->parse() );
			$out->addHTML( $text );
			return true;
		}

		$text = Html::element(
			'p', null,
			$this->msg( 'ps-generatepages-desc' )->parse()
		) . "\n";
		$text .= '<form method="post">';
		$text .= Html::input( 'param', $category, 'hidden' ) . "\n";

		$checkAllButton = new OOUI\ButtonWidget( [
			'label' => $this->msg( 'powersearch-toggleall' )->parse(),
			'id' => 'ps_check_all'
		] );
		$checkNoneButton = new OOUI\ButtonWidget( [
			'label' => $this->msg( 'powersearch-togglenone' )->parse(),
			'id' => 'ps_check_none'
		] );
		$text .= Html::rawElement(
			'div',
			[ 'id' => 'ps_check_all_check_none' ],
			$checkAllButton . "\n" . $checkNoneButton . "\n"
		) . "<br />\n";

		$out->addModules( 'ext.pageschemas.generatepages' );

		// This hook will set an array of strings, with each value
		// as a title of a page to be created.
		$pageList = [];
		foreach ( $wgPageSchemasHandlerClasses as $psHandlerClass ) {
			$pagesFromHandler = call_user_func( [ $psHandlerClass, "getPagesToGenerate" ], $pageSchemaObj );
			foreach ( $pagesFromHandler as $page ) {
				$pageList[] = $page;
			}
		}
		$linkRenderer = $this->getLinkRenderer();
		foreach ( $pageList as $page ) {
			if ( !( $page instanceof Title ) ) {
				continue;
			}
			$pageName = PageSchemas::titleString( $page );
			$text .= new OOUI\CheckboxInputWidget( [
				'name' => 'page[]',
				'value' => $pageName,
				'selected' => true
			] );
			$text .= "\n" . $linkRenderer->makeLink( $page ) . "<br />\n";
		}
		$text .= "<br />\n";
		$text .= new OOUI\ButtonInputWidget( [
			'type' => 'submit',
			'label' => $this->msg( 'generatepages' )->parse(),
			'flags' => [ 'progressive', 'primary' ]
		] );
		$text .= "\n</form>";
		$out->addHTML( $text );

		return true;
	}

	/**
	 * Creates all the pages that the user specified.
	 *
	 * @param string $categoryName
	 * @param string $selectedPageList
	 */
	function generatePages( $categoryName, $selectedPageList ) {
		$pageSchema = new PSSchema( $categoryName );
		$pageSchema->generateAllPages( $selectedPageList );
	}

	/**
	 * Don't list this in Special:SpecialPages.
	 *
	 * @return false
	 */
	function isListed() {
		return false;
	}

	/**
	 * @return string
	 */
	protected function getGroupName() {
		return 'other';
	}
}
