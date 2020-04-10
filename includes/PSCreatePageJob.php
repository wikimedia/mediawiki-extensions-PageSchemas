<?php

/**
 * Background job to create a new property page,
 *
 * @author Ankit Garg
 */
class PSCreatePageJob extends Job {

	/**
	 * @param Title $title
	 * @param array $params
	 * @param int $id
	 */
	function __construct( $title, $params = '', $id = 0 ) {
		parent::__construct( 'pageSchemasCreatePage', $title, $params, $id );
	}

	/**
	 * Run a pageSchemasCreatePage job
	 * @return bool success
	 */
	function run() {
		if ( $this->title === null ) {
			$this->error = wfMessage( 'ps-createpage-invalidtitle' )->text();
			return false;
		}
		if ( $this->title->getContentModel() !== CONTENT_MODEL_WIKITEXT ) {
			$this->error = wfMessage( 'ps-createpage-irregulartext', $this->title->getPrefixedDBkey() )->text();
			return false;
		}

		$wikiPage = new WikiPage( $this->title );
		$page_text = $this->params['page_text'];

		// Change global $wgUser variable to the one
		// specified by the job only for the extent of this
		// replacement.
		global $wgUser;
		$actual_user = $wgUser;
		$wgUser = User::newFromId( $this->params['user_id'] );
		$edit_summary = wfMessage( 'ps-generatepages-editsummary' )->inContentLanguage()->parse();
		$content = new WikitextContent( $page_text );
		$wikiPage->doEditContent( $content, $edit_summary );

		$wgUser = $actual_user;
		return true;
	}
}
