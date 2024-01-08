<?php

use MediaWiki\MediaWikiServices;

/**
 * Background job to create or modify a "data structure" page.
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

		$wikiPage = MediaWikiServices::getInstance()->getWikiPageFactory()->newFromTitle( $this->title );
		$pageText = $this->params['page_text'];
		$editSummary = wfMessage( 'ps-generatepages-editsummary' )->inContentLanguage()->parse();
		$user = User::newFromId( $this->params['user_id'] );
		PageSchemas::createOrModifyPage( $wikiPage, $pageText, $editSummary, $user );

		return true;
	}
}
