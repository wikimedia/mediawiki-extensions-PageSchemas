<?php

/**
 * @file PSTabs.php
 * @ingroup
 *
 * @author ankit
 */
 final class PSTabs {

	public static function displayTabs( $obj, &$content_actions ) {
		global $wgUser;

		$title = $obj->getTitle();
		if ( $title->getNamespace() != NS_CATEGORY || !$title->exists() ){
			return true;
		}

		global $wgRequest;

		$content_actions['editschema'] = array(
			'text' => wfMsg( 'ps-editschema' ),
			'class' => $wgRequest->getVal( 'action' ) == 'editschema' ? 'selected' : '',
			'href' => $title->getLocalURL( 'action=editschema' )
		);

		$category = $title->getText();
		$pageSchemaObj = new PSSchema( $category );
		if ( $pageSchemaObj->isPSDefined() ) {
			$content_actions['generatepages'] = array(
				'text' => wfMsg( 'ps-generatepages' ),
				'class' => $wgRequest->getVal( 'action' ) == 'generatepages' ? 'selected' : '',
				'href' => $title->getLocalURL( 'action=generatepages' )
			);
		}

		return true;
	}

	/**
	 * Function called for some skins, most notably 'Vector'.
	 */
	public static function displayTabs2( $obj, &$links ) {
		// The old '$content_actions' array is thankfully just a sub-array of this one
		$views_links = $links['actions'];
		self::displayTabs( $obj, $views_links );
		$links['actions'] = $views_links;
		return true;
	}

	/**
	 * Adds handling for the tabs 'generatepages' and 'editschema'.
	 */
	public static function onUnknownAction( $action, Article $article ) {
		$title = $article->getTitle();

		// These tabs should only exist for category pages
		if ( $title->getNamespace() != NS_CATEGORY ) {
			return false;
		}

		$categoryName = $title->getText();
		if ( $action == 'generatepages' ) {
			$gen_page = new PSGeneratePages();
			$gen_page->execute( $categoryName );
			return false;
		} elseif ( $action == 'editschema' ) {
			$edit_schema = new PSEditSchema();
			$edit_schema->execute( $categoryName );
			return false;
		}
		return true;
	}
}
