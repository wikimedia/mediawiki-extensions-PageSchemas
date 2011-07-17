<?php
/**
 * Displays an interface to let users create all pages based on xml
 *
 * @author Ankit Garg
 */

class GeneratePages extends IncludableSpecialPage {
    function __construct() {
        parent::__construct( 'GeneratePages' );
        wfLoadExtensionMessages('GeneratePages');
    }
 
    function execute( $category ) {
		global $wgRequest, $wgOut;
		global $wgSkin;
        $this->setHeaders();
		$generate_page_text = wfMsg( 'ps-generate-pages' );
		$generate_page_desc = wfMsg( 'ps-generate-pages-desc' );
		$param = $wgRequest->getText('param');		
		$text_1 = '<p>All pages will be generated! </p>';				
		if ( $param != "" &&  $category != "" ) {			
			$this->generate_pages( $param, $_POST['page'] );
			$wgOut->addHTML($text_1);
		}else {
			if( $category == ""){
				$cat_titles = array();
				$count_title = 0;
				$text = "";
				$dbr = wfGetDB( DB_SLAVE );
				//get the result set, query : slect page_props
				$res = $dbr->select( 'page_props',
				array(
					'pp_page',
					'pp_propname',
					'pp_value'	
				),
				array(					
					'pp_propname' => 'PageSchema'
				)
				);
				while ( $row = $dbr->fetchRow( $res ) ) {
					if( $row[2] != null ){
						$page_id_cat = $row[0];
						if( Title::newFromId($page_id_cat)->getNamespace() == NS_CATEGORY){
							$cat_text = Title::newFromId($page_id_cat)->getText();
							$generatePagesPage = SpecialPage::getTitleFor( 'GeneratePages' );
							$url = $generatePagesPage ->getFullURL() . '/' . $cat_text;						
							$text .= '<a href='.$url.'>'.$cat_text.'   </a> <br /> ';	
						}							
					}					
				}
				$dbr->freeResult( $res );						
				$wgOut->addHTML( $text );								
			}else {
			//this is when Special:GeneratePages/Category is accessed first time 
			//Here check for the valid Category  name and allow for generating pages 
				$title = Title::newFromText( $category, NS_CATEGORY );
				$pageId = $title->getArticleID();			
				$dbr = wfGetDB( DB_SLAVE );
				//get the result set, query : slect page_props
				$res = $dbr->select( 'page_props',
				array(
					'pp_page',
					'pp_propname',
					'pp_value'	
				),
				array(
					'pp_page' => $pageId,
					'pp_propname' => 'PageSchema'
				)
				);
				//first row of the result set 
				$row = $dbr->fetchRow( $res );
				if( $row != null ){
					$text_2 = '<p>'.$generate_page_desc.'</p> <form method="post">  <input type="hidden" name="param" value="'.$category.'" /><br />  ';
					//add code to generate a list of check-box for pages to be generated.
					$pageSchemaObj = new PSSchema( $category );
					$pageList = array();
					wfRunHooks( 'PageSchemasGetPageList', array( $pageSchemaObj, &$pageList ));	//will return an array of string, with each value as a title of the page to be created.					
					foreach( $pageList as $page ){
						//$page_link = $wgSkin->link( $page );
						$page_link = $page->getFullUrl();
						$page_val = PageSchemas::titleString( $page );
						$text_2 .= '<input type="checkbox" name="page[]" value="'.$page_val.'" />  '.$page_link.' <br />';
					}
					$text_2 .= '<br /> <input type="submit" value="'.$generate_page_text.'" /> <br /> <br /></form>';
					$wgOut->addHTML($text_2);
				}else {
						$text = "<p>Error: there is no page schema defined for that category in the wiki. </p>";
						$wgOut->addHTML( $text );
				}
			}
		}
    }	
	function generate_pages ( $categoryName, $toGenPageList ) {
		global $wgRequest, $wgOut;
        $pageSchema = new PSSchema( $categoryName );
		$pageSchema->generateAllPages( $toGenPageList );
	}
}
