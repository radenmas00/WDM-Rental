/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config
	//config.language = 'es';
	//config.height = 600;
	//config.toolbarCanCollapse = true;
	
	/* 
	config.filebrowserBrowseUrl = 'ckeditor/kcfinder/browse.php?opener=ckeditor&type=files';
	config.filebrowserImageBrowseUrl = 'ckeditor/kcfinder/browse.php?opener=ckeditor&type=images';
	config.filebrowserFlashBrowseUrl = 'ckeditor/kcfinder/browse.php?opener=ckeditor&type=flash';
	config.filebrowserUploadUrl = 'ckeditor/kcfinder/upload.php?opener=ckeditor&type=files';
	config.filebrowserImageUploadUrl = 'ckeditor/kcfinder/upload.php?opener=ckeditor&type=images';
	config.filebrowserFlashUploadUrl = 'ckeditor/kcfinder/upload.php?opener=ckeditor&type=flash';
	*/
	
	
	config.extraPlugins = 'imageuploader,btgrid';
	 

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'tools' },
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'links' },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'others' },//button
		'/',
		{ name: 'styles' },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'colors' },
		{ name: 'about' }
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
};
