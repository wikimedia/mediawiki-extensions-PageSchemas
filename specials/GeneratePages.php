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
			$this->generateAllPages($param);
		
		}
		$text =<<< END
<form method="post">        
		<input type="hidden" name="param" value="$category" /><br />  
		<input type="submit" value="Generate Pages" />
</form>
		
END;
		$wgOut->addHTML($text);
				
    }
		
	function generateAllPages ( $category_name ) {
		global $wgRequest, $wgOut;
	  $wgOut->addWikiText( $category_name );
	
	}
		
}
