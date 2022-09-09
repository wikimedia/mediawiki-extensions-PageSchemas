/**
 * Javascript for the Page Schemas extension.
 *
 * @author Ankit Garg
 * @author Yaron Koren
 */

var fieldNum;
var templateNum;
var pageSectionNum;

jQuery.fn.editSchemaMakeTemplateDeleter = function () {
	jQuery( this ).click( function () {
		// Remove the encompassing div for this instance.
		jQuery( this ).closest( '.templateBox' )
			.fadeOut( 'fast', function () { jQuery( this ).remove(); } );
	} );
};

jQuery.fn.editSchemaMakeFieldDeleter = function () {
	jQuery( this ).click( function () {
		// Remove the encompassing div for this instance.
		jQuery( this ).closest( '.fieldBox' )
			.fadeTo( 'fast', 0, function () {
				$( this ).slideUp( 'fast', function () {
					$( this ).remove();
				} );
			} );
	} );
};

jQuery.fn.editSchemaMakePageSectionDeleter = function () {
	jQuery( this ).click( function () {
		// Remove the encompassing div for this instance.
		jQuery( this ).closest( '.pageSectionBox' )
			.fadeOut( 'fast', function () { jQuery( this ).remove(); } );
	} );
};

jQuery.fn.editSchemaMakeFieldAdder = function () {
	var addAbove = $( this ).hasClass( 'addAboveButton' );
	jQuery( this ).click( function () {
		jQuery( '.editSchemaFieldSection > .sectionHeader' ).each( function () {
			jQuery( this ).editSchemaToggleFieldDisplay( true );
		} );
		newField = jQuery( '#starterField' ).clone().css( 'display', '' ).removeAttr( 'id' );
		newHTML = newField.html().replace( /fnum/g, fieldNum );
		newField.html( newHTML );
		newField.find( 'a.addAboveButton' ).editSchemaMakeFieldAdder();
		newField.find( 'a.removeButton' ).editSchemaMakeFieldDeleter();
		if ( addAbove ) {
			newField.insertBefore( jQuery( this ).closest( '.fieldBox' ) ).hide().fadeIn();
		} else {
			newField.appendTo( jQuery( this ).closest( '.templateBox' ).find( '.fieldsList' ) ).hide().fadeIn();
		}
		// TODO - have this apply only to the added field, instead of all fields.
		newField.find( '.sectionCheckbox' ).click( function () {
			jQuery( this ).editSchemaToggleSectionDisplay();
		} );
		newField.find( '.editSchemaFieldSection > .sectionHeader' ).click( function ( e ) {
			jQuery( this ).editSchemaToggleFieldOnClick( e );
		} );
		jQuery( '.isListCheckbox' ).click( function () {
			jQuery( this ).editSchemaToggleDelimiterInput();
		} );
		fieldNum++;
	} );
};

jQuery.fn.editSchemaMakeTemplateAdder = function () {
	jQuery( this ).click( function () {
		newField = jQuery( '#starterTemplate' ).clone().css( 'display', '' ).remove( '#starterField' ).removeAttr( 'id' );
		newHTML = newField.html().replace( /tnum/g, templateNum );
		newField.html( newHTML );
		newField.find( '.deleteTemplate' ).editSchemaMakeTemplateDeleter();
		jQuery( '#templatesList' ).append( newField );
		// TODO - have this apply only to the added template, instead of all templates.
		jQuery( '.editSchemaAddField' ).editSchemaMakeFieldAdder();
		newField.find( '.sectionCheckbox' ).click( function () {
			jQuery( this ).editSchemaToggleSectionDisplay();
		} );
		jQuery( '.isListCheckbox' ).click( function () {
			jQuery( this ).editSchemaToggleDelimiterInput();
		} );
		jQuery( '.multipleInstanceTemplateCheckbox' ).click( function () {
			jQuery( this ).editSchemaToggleMultiInstanceTemplateAttrs();
		} );
		newField.find( '.fieldsList' ).each( function () {
			jQuery( this ).editSchemaMakeFieldListSortable();
		} );
		templateNum++;
	} );
};

jQuery.fn.editSchemaMakePageSectionAdder = function () {
	jQuery( this ).click( function () {
		newField = jQuery( '#starterPageSection' ).clone().css( 'display', '' ).removeAttr( 'id' );
		newHTML = newField.html().replace( /snum/g, pageSectionNum );
		newField.html( newHTML );
		newField.find( '.deletePageSection' ).editSchemaMakePageSectionDeleter();
		jQuery( '#templatesList' ).append( newField );
		pageSectionNum++;
	} );
};

jQuery.fn.editSchemaToggleDelimiterInput = function () {
	if ( this.is( ':checked' ) ) {
		this.closest( '.fieldBox' ).find( '.delimiterInput' ).css( 'display', '' );
	} else {
		this.closest( '.fieldBox' ).find( '.delimiterInput' ).css( 'display', 'none' );
	}
};

jQuery.fn.editSchemaToggleFieldOnClick = function ( e ) {
	// Ignore clicks on interface elements.
	var $target = $( e.target );
	if ( $target.hasClass( 'oo-ui-icon-draggable' ) || $target.hasClass( 'addAboveButton' ) || $target.hasClass( 'removeButton' ) ) {
		return;
	}

	// Toggle this div, minimize all the rest.
	var $clickedDiv = $( this );
	jQuery( '.editSchemaFieldSection > .sectionHeader' ).each( function () {
		var $curDiv = $( this );
		if ( $curDiv.is( $clickedDiv ) ) {
			$curDiv.editSchemaToggleFieldDisplay();
		} else {
			$curDiv.editSchemaToggleFieldDisplay( true );
		}
	} );
};

jQuery.fn.editSchemaToggleFieldDisplay = function ( minimizeOnly = false ) {
	var $instance = this.closest( '.editSchemaFieldSection' );
	var $fieldBox = $instance.closest( '.fieldBox' );
	if ( $fieldBox.attr( 'id' ) === 'starterField' ) {
		return;
	}
	var $instanceBody = $instance.find( '.sectionBody' );
	var minimized = $instanceBody.css( 'display' ) === 'none';
	if ( minimized && minimizeOnly ) {
		return;
	}
	var fieldLabel = mw.msg( 'ps-field' );
	if ( !minimized ) {
		var fieldName = $instance.find( 'input.nameInput' ).val();
		fieldLabel += ': ' + fieldName;
	}
	$instanceBody.fadeToggle( 'medium' );
	$instance.find( '.fieldLabel' ).text( fieldLabel );
};

jQuery.fn.editSchemaToggleSectionDisplay = function () {
	if ( this.find( 'input' ).is( ':checked' ) ) {
		this.closest( '.editSchemaSection' ).find( '.sectionBody' ).css( 'display', '' ).removeClass( 'hiddenSection' );
	} else {
		this.closest( '.editSchemaSection' ).find( '.sectionBody' ).css( 'display', 'none' ).addClass( 'hiddenSection' );
	}
};

jQuery.fn.editSchemaToggleMultiInstanceTemplateAttrs = function () {
	if ( this.is( ':checked' ) ) {
		this.closest( '.sectionBody' ).find( '.multipleInstanceTemplateAttributes' ).show( 'fast' );
	} else {
		this.closest( '.sectionBody' ).find( '.multipleInstanceTemplateAttributes' ).hide( 'fast' );
	}
};

jQuery.fn.editSchemaMakeFieldListSortable = function () {
	var $list = $( this );
	Sortable.create( $list[ 0 ], {
		handle: '.fieldRearranger',
		onStart: function () {
			jQuery( '.editSchemaFieldSection > .sectionHeader' ).each( function () {
				jQuery( this ).editSchemaToggleFieldDisplay( true );
			} );
		}
	} );
};

jQuery( document ).ready( function () {
	fieldNum = jQuery( '.fieldBox:visible' ).length;
	templateNum = jQuery( '.templateBox:visible' ).length;
	pageSectionNum = jQuery( '.pageSectionBox:visible' ).length;

	// Add and delete buttons
	jQuery( '.deleteTemplate' ).editSchemaMakeTemplateDeleter();
	jQuery( '.editSchemaAddTemplate' ).editSchemaMakeTemplateAdder();
	jQuery( 'a.removeButton' ).editSchemaMakeFieldDeleter();
	jQuery( '.editSchemaAddField' ).editSchemaMakeFieldAdder();
	jQuery( 'a.addAboveButton' ).editSchemaMakeFieldAdder();
	jQuery( '.deletePageSection' ).editSchemaMakePageSectionDeleter();
	jQuery( '.editSchemaAddSection' ).editSchemaMakePageSectionAdder();

	// Checkboxes
	jQuery( '.isListCheckbox' ).each( function () {
		jQuery( this ).editSchemaToggleDelimiterInput();
	} );
	jQuery( '.isListCheckbox' ).click( function () {
		jQuery( this ).editSchemaToggleDelimiterInput();
	} );
	jQuery( '.sectionCheckbox' ).each( function () {
		jQuery( this ).editSchemaToggleSectionDisplay();
	} );
	jQuery( '.sectionCheckbox' ).click( function () {
		jQuery( this ).editSchemaToggleSectionDisplay();
	} );
	jQuery( '.editSchemaFieldSection > .sectionHeader' ).click( function ( e ) {
		jQuery( this ).editSchemaToggleFieldOnClick( e );
	} );
	jQuery( '.multipleInstanceTemplateCheckbox' ).each( function () {
		jQuery( this ).editSchemaToggleMultiInstanceTemplateAttrs();
	} );
	jQuery( '.multipleInstanceTemplateCheckbox' ).click( function () {
		jQuery( this ).editSchemaToggleMultiInstanceTemplateAttrs();
	} );
	jQuery( '#editSchemaForm' ).submit( function () {
		jQuery( '#starterTemplate, #starterPageSection' ).find( 'input, select, textarea' ).attr( 'disabled', 'disabled' );
		return true;
	} );

	jQuery( '.editSchemaFieldSection > .sectionHeader' ).each( function () {
		jQuery( this ).editSchemaToggleFieldDisplay( true );
	} );

	$( '.fieldsList' ).each( function () {
		jQuery( this ).editSchemaMakeFieldListSortable();
	} );

	$( 'form#editSchemaForm' ).click( function ( e ) {
		var $target = $( e.target );

		// Ignore clicks on "Add field" button
		var addButton = $target.closest( '.editSchemaAddField' )[ 0 ];
		if ( addButton !== undefined ) {
			return;
		}

		var instance = $target.closest( '.editSchemaFieldSection' )[ 0 ];
		if ( instance === undefined ) {
			jQuery( '.editSchemaFieldSection' ).each( function () {
				jQuery( this ).children( '.sectionHeader' ).editSchemaToggleFieldDisplay( true );
			} );
		}
	} );

} );
