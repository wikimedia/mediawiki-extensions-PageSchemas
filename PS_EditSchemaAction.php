<?php
/**
 * Handles the 'editschema' action and tab.
 *
 * @author Yaron Koren
 * @file
 * @ingroup PageSchemas
 */

class PSEditSchemaAction extends Action {

	/**
	 * Return the name of the action this object responds to
	 * @return String lowercase
	 */
	public function getName() {
		return 'editschema';
	}

	/**
	 * The main action entry point.  Do all output for display and send it to the context
	 * output.  Do not use globals $wgOut, $wgRequest, etc, in implementations; use
	 * $this->getOutput(), etc.
	 * @throws ErrorPageError
	 * @return false
	 */
	public function show() {
		$title = $this->page->getTitle();

		// These tabs should only exist for category pages
		if ( $title->getNamespace() != NS_CATEGORY ) {
			return true;
		}

		$categoryName = $title->getText();
		$editSchemaPage = new PSEditSchema();
		$editSchemaPage->execute( $categoryName );

		return false;
	}

	/**
	 * Execute the action in a silent fashion: do not display anything or release any errors.
	 * @return Bool whether execution was successful
	 */
	public function execute() {
		return true;
	}

	/**
	 * Adds an "action" (i.e., a tab) to edit the current article with
	 * a form
	 * @param Title $obj
	 * @param array &$links
	 * @return bool
	 */
	static function displayTab( $obj, &$links ) {
		if ( method_exists( $obj, 'getTitle' ) ) {
			$title = $obj->getTitle();
		} else {
			$title = $obj->mTitle;
		}

		if ( $title->getNamespace() != NS_CATEGORY ){
			return true;
		}

		$user = $obj->getUser();
		if ( !$user->isAllowed( 'edit' ) || !$title->userCan( 'edit' ) ) {
			return true;
		}

		$request = $obj->getRequest();

		$content_actions = &$links['views'];
		$category = $title->getText();
		$pageSchemaObj = new PSSchema( $category );

		$content_actions['editschema'] = array(
			'text' => ( $pageSchemaObj->isPSDefined() ) ? wfMessage( 'editschema' )->parse() : wfMessage( 'createschema' )->parse(),
			'class' => $request->getVal( 'action' ) == 'editschema' ? 'selected' : '',
			'href' => $title->getLocalURL( 'action=editschema' )
		);

		$content_actions['generatepages'] = array(
			'text' => wfMessage( 'generatepages' )->parse(),
			'class' => $request->getVal( 'action' ) == 'generatepages' ? 'selected' : '',
			'href' => $title->getLocalURL( 'action=generatepages' )
		);

		return true; // always return true, in order not to stop MW's hook processing!
	}

}