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
 
        function execute( $par ) {
                global $wgRequest, $wgOut;
 
                $this->setHeaders();
 
                # Get request data from, e.g.
         $param = $wgRequest->getText('param');
 
                # Do stuff
         # ...
         $output="Hello world!".$param;
                $wgOut->addWikiText( $output );
        }
}

