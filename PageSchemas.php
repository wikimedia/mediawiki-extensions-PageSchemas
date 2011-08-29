<?php
/**
 * Page Schemas extension
 *
 * @file
 * @ingroup Extensions
 *
 * This is the main include file for the Page Schemas MediaWiki extension.
 *
 * Usage: Add the following line in LocalSettings.php:
 * require_once( "$IP/extensions/PageSchemas/PageSchemas.php" );
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
	'name'			=> 'Page Schemas',
	'author'		=> array( 'Ankit Garg', 'Yaron Koren' ),
	'version'		=> '0.1',
	'url'			=> 'http://www.mediawiki.org/wiki/Extension:PageSchemas',
	'descriptionmsg'	=> 'pageschemas-desc',
);

// Shortcut to this extension directory
$dir = dirname( __FILE__ ) . '/';

// Internationalization
$wgExtensionMessagesFiles['PageSchemas'] = $dir . 'PageSchemas.i18n.php';

//Job classes
$wgJobClasses['createPage'] = 'PSCreatePageJob';
$wgAutoloadClasses['PSCreatePageJob'] = $dir . 'PS_CreatePageJob.php';


// Register auto load for the special page class
$wgAutoloadClasses['PageSchemasHooks'] = $dir . 'PageSchemas.hooks.php';
$wgAutoloadClasses['PageSchemas'] = $dir . 'PageSchemas.classes.php';
$wgAutoloadClasses['PSSchema'] = $dir . 'PageSchemas.classes.php';
$wgAutoloadClasses['ApiQueryPageSchemas'] = $dir . 'ApiQueryPageSchemas.php';
$wgAutoloadClasses['GeneratePages'] = $dir . 'specials/PS_GeneratePages.php';
$wgAutoloadClasses['EditSchema'] = $dir . 'specials/PS_EditSchema.php';
$wgAutoloadClasses['PSTabs'] = $dir . 'PS_Tabs.php';
// registering Special page 
$wgSpecialPages['GeneratePages'] = 'GeneratePages'; 
$wgSpecialPages['EditSchema'] = 'EditSchema'; 
$wgSpecialPageGroups['GeneratePages'] = 'other';
$wgSpecialPageGroups['EditSchema'] = 'other';
// Register parser hook
$wgHooks['ParserFirstCallInit'][] = 'PageSchemasHooks::register';

// Register page_props usage
$wgPageProps['PageSchema'] = 'Contents of &lt;PageSchema&gt; tag';

$wgHooks['UnknownAction'][] = 'PSTabs::onUnknownAction';
$wgHooks['SkinTemplateTabs'][] = 'PSTabs::displayTabs';
$wgHooks['SkinTemplateNavigation'][] = 'PSTabs::displayTabs2';
