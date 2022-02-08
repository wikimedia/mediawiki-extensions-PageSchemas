<?php
/**
 * Handles the 'generatepages' action and tab.
 *
 * @author Yaron Koren
 * @file
 * @ingroup PageSchemas
 */

class PSGeneratePagesAction extends Action {

	/**
	 * Return the name of the action this object responds to
	 * @return string lowercase
	 */
	public function getName() {
		return 'generatepages';
	}

	/**
	 * The main action entry point. Do all output for display and send it
	 * to the context output. Do not use globals $wgOut, $wgRequest, etc,
	 * in implementations; use $this->getOutput(), etc.
	 *
	 * @return bool
	 */
	public function show() {
		$title = $this->page->getTitle();

		// These tabs should only exist for category pages
		if ( $title->getNamespace() != NS_CATEGORY ) {
			return true;
		}

		$categoryName = $title->getText();
		$generatePagesPage = new PSGeneratePages();
		$generatePagesPage->execute( $categoryName );
		return false;
	}

	/**
	 * Execute the action in a silent fashion: do not display anything or release any errors.
	 *
	 * @return bool whether execution was successful
	 */
	public function execute() {
		return true;
	}

	/**
	 * Adds an "action" (i.e., a tab) to edit the current article with
	 * a form.
	 *
	 * @param SkinTemplate $obj
	 * @param array &$links
	 * @return bool
	 */
	static function displayTab( $obj, &$links ) {
		$title = $obj->getTitle();
		if ( $title->getNamespace() != NS_CATEGORY ) {
			return true;
		}

		$user = $obj->getUser();
		if ( !$user->isAllowed( 'generatepages' ) ) {
			return true;
		}

		$request = $obj->getRequest();

		$content_actions = &$links['views'];
		$category = $title->getText();
		$pageSchemaObj = new PSSchema( $category );
		if ( !$pageSchemaObj->isPSDefined() ) {
			return true;
		}

		$content_actions['generatepages'] = [
			'text' => $obj->msg( 'generatepages' )->parse(),
			'class' => $request->getVal( 'action' ) == 'generatepages' ? 'selected' : '',
			'href' => $title->getLocalURL( 'action=generatepages' )
		];

		// always return true, in order not to stop MW's hook processing!
		return true;
	}
}
