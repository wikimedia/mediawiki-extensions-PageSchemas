<?php

class PSTemplate {
	private $mFields = [];
	private $mTemplateName = "";
	private $mTemplateXML = null;
	private $mMultipleAllowed = false;
	private $mTemplateFormat = null;

	function __construct( $templateXML ) {
		$this->mTemplateXML = $templateXML;
		$this->mTemplateName = (string)$templateXML->attributes()->name;
		if ( ( (string)$templateXML->attributes()->multiple ) == "multiple" ) {
			$this->mMultipleAllowed = true;
		}
		$this->mTemplateFormat = (string)$templateXML->attributes()->format;
		// Index for template objects
		$i = 0;
		$inherited_fields = [];
		foreach ( $templateXML->children() as $child ) {
			if ( $child->getName() == 'InheritsFrom' ) {
				$schema_to_inherit = (string)$child->attributes()->schema;
				$template_to_inherit = (string)$child->attributes()->template;
				if ( $schema_to_inherit != null && $template_to_inherit != null ) {
					$inheritedSchemaObj = new PSSchema( $schema_to_inherit );
					$inherited_templates = $inheritedSchemaObj->getTemplates();
					foreach ( $inherited_templates as $inherited_template ) {
						if ( $template_to_inherit == $inherited_template->getName() ) {
							$inherited_fields = $inherited_template->getFields();
						}
					}
				}
			} elseif ( $child->getName() == "Field" ) {
				$fieldObj = new PSTemplateField( $child );
				$this->mFields[$i++] = $fieldObj;
				// "Ignore" the below code for now; it's not
				// needed, and doesn't work yet.
/*
				$ignore = (string) $child->attributes()->ignore;
				if ( $ignore != "true" ) {
					// Code to add fields from inherited templates
					$field_name = (string) $child->attributes()->name;
					foreach ( $inherited_fields as $inherited_field ) {
						if ( $field_name == $inherited_field->getName() ) {
							$this->mFields[$i++]= $inherited_field;
						}
					}
				}
*/
			}
		}
	}

	public function getName() {
		return $this->mTemplateName;
	}

	public function getXML() {
		return $this->mTemplateXML;
	}

	public function isMultiple() {
		return $this->mMultipleAllowed;
	}

	/**
	 * @since 0.3.1
	 */
	public function getFormat() {
		return $this->mTemplateFormat;
	}

	public function getObject( $objectName ) {
		global $wgPageSchemasHandlerClasses;
		foreach ( $wgPageSchemasHandlerClasses as $psHandlerClass ) {
			$object = call_user_func( [ $psHandlerClass, 'createPageSchemasObject' ], $objectName, $this->mTemplateXML );
			if ( $object ) {
				return $object;
			}
		}
		return null;
	}

	public function getFields() {
		return $this->mFields;
	}
}
