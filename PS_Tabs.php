<?php

/**
 * Static class with methods to create and handle the push tab.
 *
 * @since 0.1
 *
 * @file Push_Tab.php
 * @ingroup Push
 *
 * @author ankit
 */
 final class PSTabs {
	
	/**
	 * Adds an "action" (i.e., a tab) to allow pushing the current article.
	 */
	public static function displayTab( $obj, &$content_actions ) {
		global $wgUser;
		
		// Make sure that this is not a special page, the page has contents, and the user can push.
		$title = $obj->getTitle();
		if (
			$title->getNamespace() == NS_CATEGORY
			&& $title->exists() ){	
			global $wgRequest;			
			
			$category = $title->getText();
			$pageSchemaObj = new PSSchema( $category );
			if( $pageSchemaObj->isPSDefined() ){
				$content_actions['editschema'] = array(
				'text' => wfMsg( 'editschema' ),
				'class' => $wgRequest->getVal( 'action' ) == 'editschema' ? 'selected' : '',
				'href' => $title->getLocalURL( 'action=editschema' )
				);
				$content_actions['generatepages'] = array(
				'text' => wfMsg( 'generatepages' ),
				'class' => $wgRequest->getVal( 'action' ) == 'generatepages' ? 'selected' : '',
				'href' => $title->getLocalURL( 'action=generatepages' )
				);
			}else{
				$content_actions['editschema'] = array(
					'text' => wfMsg( 'createpages' ),
					'class' => $wgRequest->getVal( 'action' ) == 'editschema' ? 'selected' : '',
					'href' => $title->getLocalURL( 'action=editschema' )
				);
			}
		}
		
		return true;
	}

	/**
	 * Function currently called only for the 'Vector' skin, added in
	 * MW 1.16 - will possibly be called for additional skins later
	 */
	public static function displayTab2( $obj, &$links ) {
		// The old '$content_actions' array is thankfully just a sub-array of this one
		$views_links = $links['actions'];
		self::displayTab( $obj, $views_links );
		$links['actions'] = $views_links;		
		return true;
	}

	/**
	 * Handle actions not known to MediaWiki. If the action is push,
	 * display the push page by calling the displayPushPage method.
	 *  
	 * @param string $action
	 * @param Article $article
	 * 
	 * @return true
	 */
	public static function onUnknownAction( $action, Article $article ) {
		$title = $article->getTitle();
		$category = $title->getText();		
		if ( $action == 'generatepages' ) {
			$gen_page  = new GeneratePages();
			return $gen_page->execute($category);
		}
		else if( $action == 'editschema' ) {
			$edit_schema = new EditSchema();
			return $edit_schema->execute($category);
		}
		return true;
	}
}