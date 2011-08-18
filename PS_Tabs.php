<?php

/**
 * Static class with methods to create and handle the push tab.
 *
 * @since 0.1
 *
 * @file _Tab.php
 * @ingroup 
 *
 * @author ankit
 */
 final class PSTabs {
	
	
	public static function displayTabs( $obj, &$content_actions ) {
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
	public static function displayTabs2( $obj, &$links ) {
		// The old '$content_actions' array is thankfully just a sub-array of this one
		$views_links = $links['actions'];
		self::displayTabs( $obj, $views_links );
		$links['actions'] = $views_links;		
		return true;
	}

	/**	
	 * 
	 * @return true
	 */
	public static function onUnknownAction( $action, Article $article ) {
		$title = $article->getTitle();
		$category = $title->getText();		
		 if ( $action == 'generatepages' ) {
            $gen_page  = new GeneratePages();
            $gen_page->execute($category);
            return false;
         } elseif ( $action == 'editschema' ) {
            $edit_schema = new EditSchema();
            $edit_schema->execute($category);
            return false;
        }
		return true;
	}
}