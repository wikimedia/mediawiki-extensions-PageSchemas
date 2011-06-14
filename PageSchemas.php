<?php
/**
 * PageSchemas extension
 *
 * @file
 * @ingroup Extensions
 *
 * This file contains the main include file for the PageSchemas extension of
 * MediaWiki.
 *
 * Usage: Add the following line in LocalSettings.php:
 * require_once( "$IP/extensions/PageSchemas/PageSchemas.php" );
 *
 * @version 0.0.1
 */

// Check environment
if ( !defined( 'MEDIAWIKI' ) ) {
	echo( "This is an extension to the MediaWiki package and cannot be run standalone.\n" );
	die( -1 );
}

/* Configuration */

// Credits
$wgExtensionCredits['parserhook'][] = array(
	'path'			=> __FILE__,
	'name'			=> 'PageSchemas',
	'author'		=> array( 'Ankit Garg' ),
	'version'		=> '0.0.1',
	'url'			=> 'http://www.mediawiki.org/wiki/Extension:PageSchemas',
	'descriptionmsg'	=> 'PageSchema-desc',
);

// Shortcut to this extension directory
$dir = dirname( __FILE__ ) . '/';

// Internationalization
$wgExtensionMessagesFiles['PageSchemas'] = $dir . 'PageSchemas.i18n.php';

// Register auto load for the special page class
$wgAutoloadClasses['PageSchemasHooks'] = $dir . 'PageSchemas.hooks.php';
$wgAutoloadClasses['PageSchemas'] = $dir . 'PageSchemas.classes.php';
$wgAutoloadClasses['PageSchema'] = $dir . 'PageSchemas.classes.php';
$wgAutoloadClasses['ApiQueryPageSchemas'] = $dir . 'ApiQueryPageSchemas.php';
$wgAutoloadClasses['GeneratePages'] = $dir . 'specials/GeneratePages.php';
// registering Special page 
$wgSpecialPages['GeneratePages'] = 'GeneratePages'; 
$wgSpecialPageGroups['GeneratePages'] = 'other';
// Register parser hook
$wgHooks['ParserFirstCallInit'][] = 'PageSchemasHooks::register';

// Register API action
$wgAPIPropModules['PageSchema'] = 'ApiQueryPageSchemas';

// Register page_props usage
$wgPageProps['PageSchema'] = 'Content of &lt;PageSchema&gt; tag';
