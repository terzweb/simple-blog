/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	
	config.language = 'ja';
	config.uiColor = '#AADC6E';

//	config.filebrowserBrowseUrl = '/ckfinder/browse.php?type=File';
//	config.filebrowserImageBrowseUrl = '/ckfinder/browse.php?type=Image';
//	config.filebrowserFlashBrowseUrl = '/ckfinder/browse.php?type=flash';
//	config.filebrowserUploadUrl = '/ckfinder/upload.php?type=File';
//	config.filebrowserImageUploadUrl = '/ckfinder/upload.php?type=Image';
//	config.filebrowserFlashUploadUrl = '/ckfinder/upload.php?type=flash';
	
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	//config.format_tags = 'p;h1;h2;h3;pre';
        config.allowedContent = true;

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
};
       
                // ALLOW <i></i>
        CKEDITOR.dtd.$removeEmpty['i'] = false;
