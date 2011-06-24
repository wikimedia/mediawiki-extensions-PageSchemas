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
	
		# Get request data from, e.g.
        $param = $wgRequest->getText('param');
		if ( $param != "" ) {
			$this->generate_pages($param);
		
		}
		$generate_page_text = wfMsg( 'ps-generate-pages' );
		$text =<<< END
<form method="post">        
		<input type="hidden" name="param" value="$category" /><br />  
		<input type="submit" value="$generate_page_text" />
</form>
		
END;
		$wgOut->addHTML($text);
				
    }
		
	function generate_pages ( $categoryName ) {
		global $wgRequest, $wgOut;	
        $pageSchema = new PSSchema( $categoryName );
		$pageSchema->generateAllPages();					
	
	
	}
		
}
