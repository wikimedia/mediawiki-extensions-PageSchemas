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
        $this->setHeaders();
		$generate_page_text = wfMsg( 'ps-generate-pages' );
		$generate_page_desc = wfMsg( 'ps-generate-pages-desc' );
		$param = $wgRequest->getText('param');		
		$text_1 = '<p>All pages will be generated! </p>';				
		$text_2 = '<p>'.$generate_page_desc.'</p> <form method="post">  <input type="hidden" name="param" value="'.$category.'" /><br />  <input type="submit" value="'.$generate_page_text.'" /> </form>';
		if ( $param != "" &&  $category != "" ) {		
			$this->generate_pages($param);
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
					$wgOut->addHTML($text_2);
				}else {
						$text = "<p>Error: there is no page schema defined for that category in the wiki. </p>";
						$wgOut->addHTML( $text );
				}				
			}
		
		}															
    }
		
	function generate_pages ( $categoryName ) {
		global $wgRequest, $wgOut;	
        $pageSchema = new PSSchema( $categoryName );
		$pageSchema->generateAllPages();					
	
	
	}		
}