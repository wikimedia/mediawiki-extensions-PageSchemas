/**
 * Javascript for the Page Schemas extension.
 *
 * @author Ankit Garg
 * @author Yaron Koren
 */


var fieldNum;
var templateNum;
var pageSectionNum;

jQuery.fn.editSchemaMakeTemplateDeleter = function() {
	jQuery(this).click( function() {
		// Remove the encompassing div for this instance.
		jQuery(this).closest(".templateBox")
			.fadeOut('fast', function() { jQuery(this).remove(); });
	});
}

jQuery.fn.editSchemaMakeFieldDeleter = function() {
	jQuery(this).click( function() {
		// Remove the encompassing div for this instance.
		jQuery(this).closest(".fieldBox")
			.fadeOut('fast', function() { jQuery(this).remove(); });
	});
}

jQuery.fn.editSchemaMakePageSectionDeleter = function() {
	jQuery(this).click( function() {
		// Remove the encompassing div for this instance.
		jQuery(this).closest(".pageSectionBox")
			.fadeOut('fast', function() { jQuery(this).remove(); });
	});
}

jQuery.fn.editSchemaMakeFieldAdder = function() {
	jQuery(this).click( function() {
		newField = jQuery('#starterField').clone().css('display', '').removeAttr('id');
		newHTML = newField.html().replace(/fnum/g, fieldNum);
		newField.html(newHTML);
		newField.find(".deleteField").editSchemaMakeFieldDeleter();
		jQuery(this).closest('.templateBox').find('.fieldsList').append(newField);
		// TODO - have this apply only to the added field, instead of all fields.
		jQuery(".deleteField").editSchemaMakeFieldDeleter();
		jQuery('.sectionCheckbox').click(function() {
			jQuery(this).editSchemaToggleSectionDisplay();
		});
		jQuery('.isListCheckbox').click(function() {
			jQuery(this).editSchemaToggleDelimiterInput();
		});
		fieldNum++;
	} );
}

jQuery.fn.editSchemaMakeTemplateAdder = function() {
	jQuery(this).click( function() {
		newField = jQuery('#starterTemplate').clone().css('display', '').remove('#starterField').removeAttr('id');
		newHTML = newField.html().replace(/tnum/g, templateNum);
		newField.html(newHTML);
		newField.find(".deleteTemplate").editSchemaMakeTemplateDeleter();
		jQuery('#templatesList').append(newField);
		// TODO - have this apply only to the added template, instead of all templates.
		jQuery(".editSchemaAddField").editSchemaMakeFieldAdder();
		jQuery('.sectionCheckbox').click(function() {
			jQuery(this).editSchemaToggleSectionDisplay();
		});
		jQuery('.isListCheckbox').click(function() {
			jQuery(this).editSchemaToggleDelimiterInput();
		});
		jQuery('.multipleInstanceTemplateCheckbox').click(function() {
			jQuery(this).editSchemaToggleMultiInstanceTemplateAttrs();
		});
		templateNum++;
	} );
}

jQuery.fn.editSchemaMakePageSectionAdder = function() {
	jQuery(this).click( function() {
		newField = jQuery('#starterPageSection').clone().css('display', '').removeAttr('id');
		newHTML = newField.html().replace(/snum/g, pageSectionNum);
		newField.html(newHTML);
		newField.find(".deletePageSection").editSchemaMakePageSectionDeleter();
		jQuery('#templatesList').append(newField);
		pageSectionNum++;
	});
}

jQuery.fn.editSchemaToggleDelimiterInput = function() {
	if (this.is(":checked")) {
		this.closest('.fieldBox').find('.delimiterInput').css('display', '');
	} else {
		this.closest('.fieldBox').find('.delimiterInput').css('display', 'none');
	}
}

jQuery.fn.editSchemaToggleSectionDisplay = function() {
	if (this.find("input").is(":checked")) {
		this.closest('.editSchemaSection').find('.sectionBody').css('display', '').removeClass('hiddenSection');
	} else {
		this.closest('.editSchemaSection').find('.sectionBody').css('display', 'none').addClass('hiddenSection');
	}
}

jQuery.fn.editSchemaToggleMultiInstanceTemplateAttrs = function() {
	if (this.is(":checked")) {
		this.closest('.sectionBody').find('.multipleInstanceTemplateAttributes').show('fast');
	} else {
		this.closest('.sectionBody').find('.multipleInstanceTemplateAttributes').hide('fast');
	}
}

jQuery(document).ready(function() {
	fieldNum = jQuery('.fieldBox:visible').length;
	templateNum = jQuery('.templateBox:visible').length;
	pageSectionNum = jQuery('.pageSectionBox:visible').length;

	// Add and delete buttons
	jQuery(".deleteTemplate").editSchemaMakeTemplateDeleter();
	jQuery(".editSchemaAddTemplate").editSchemaMakeTemplateAdder();
	jQuery(".deleteField").editSchemaMakeFieldDeleter();
	jQuery(".editSchemaAddField").editSchemaMakeFieldAdder();
	jQuery(".deletePageSection").editSchemaMakePageSectionDeleter();
	jQuery(".editSchemaAddSection").editSchemaMakePageSectionAdder();

	// Checkboxes
	jQuery('.isListCheckbox').each(function() {
		jQuery(this).editSchemaToggleDelimiterInput();
	});
	jQuery('.isListCheckbox').click(function() {
		jQuery(this).editSchemaToggleDelimiterInput();
	});
	jQuery('.sectionCheckbox').each(function() {
		jQuery(this).editSchemaToggleSectionDisplay();
	});
	jQuery('.sectionCheckbox').click(function() {
		jQuery(this).editSchemaToggleSectionDisplay();
	});
	jQuery('.multipleInstanceTemplateCheckbox').each(function() {
		jQuery(this).editSchemaToggleMultiInstanceTemplateAttrs();
	});
	jQuery('.multipleInstanceTemplateCheckbox').click(function() {
		jQuery(this).editSchemaToggleMultiInstanceTemplateAttrs();
	});
	jQuery('#editSchemaForm').submit( function() {
		jQuery(':hidden').find("input, select, textarea").attr('disabled', 'disabled');
		return true;
	} );
});
