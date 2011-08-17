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
		$generate_page_text = wfMsg( 'ps-generatepages' );
		$generate_page_desc = wfMsg( 'ps-generatepages-desc' );
		$param = $wgRequest->getText('param');
		$text_1 = '<p>All pages will be generated! </p>';				
		if ( $param != "" &&  $category != "" ) {			
			$this->generate_pages( $param, $_POST['page'] );
			$wgOut->addHTML($text_1);
		}else {
			if( $category == ""){
				$text = "";
				$cat_titles = PageSchemas::getCategoriesWithPSDefined();
					foreach( $cat_titles as $cat_text ) {
						$generatePagesPage = SpecialPage::getTitleFor( 'GeneratePages' );
						$url = $generatePagesPage ->getFullURL() . '/' . $cat_text;						
						$text .= '<a href='.$url.'>'.$cat_text.'   </a> <br /> ';	
					}
				$wgOut->addHTML( $text );				
			}else {
			//this is when Special:GeneratePages/Category is accessed first time 
			//Here check for the valid Category  name and allow for generating pages 
				$pageSchemaObj = new PSSchema( $category );
				if(!$pageSchemaObj->isPSDefined()){
					$text = "<p>Error: there is no psssage schema defined for that category in the wiki. </p>";
					$wgOut->addHTML( $text );
				}else{								
					$text_2 = '<p>'.$generate_page_desc.'</p> <form method="post">  <input type="hidden" name="param" value="'.$category.'" /><br />  ';
					//add code to generate a list of check-box for pages to be generated.					
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
			}
			}
		}
		return true;
    }
	function generate_pages ( $categoryName, $toGenPageList ) {
		global $wgRequest, $wgOut;
        $pageSchema = new PSSchema( $categoryName );
		$pageSchema->generateAllPages( $toGenPageList );
	}
}
