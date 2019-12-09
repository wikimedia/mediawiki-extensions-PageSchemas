<?php
/**
 * Deprecated initialization file for Page Schemas.
 *
 * @file
 * @ingroup Extensions
 */

if ( array_key_exists( 'wgWikimediaJenkinsCI', $GLOBALS ) ) {
        if ( file_exists( __DIR__ . '/../../vendor/autoload.php' ) ) {
                require_once __DIR__ . '/../../vendor/autoload.php';
        }
} elseif ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
        require_once __DIR__ . '/vendor/autoload.php';
}

wfLoadExtension( 'PageSchemas' );

// Keep i18n globals so mergeMessageFileList.php doesn't break.
$wgMessagesDirs['PageSchemas'] = __DIR__ . '/i18n';
$wgExtensionMessagesFiles['PageSchemasAlias'] = $dir . 'PageSchemas.i18n.alias.php';

/* wfWarn(
        'Deprecated PHP entry point used for Page Schemas extension. ' .
        'Please use wfLoadExtension instead, ' .
        'see https://www.mediawiki.org/wiki/Extension_registration for more details.'
); */
