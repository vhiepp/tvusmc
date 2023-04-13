/**
 * @license Copyright (c) 2003-2023, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function (config) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	config.width = '190mm';
	config.height = '277mm';
	config.enterMode = CKEDITOR.ENTER_BR;
	config.extraPlugins = 'youtube,emoji,autocomplete,textmatch,ajax,panelbutton,floatpanel,textwatcher,save-to-pdf';
	config.skin = 'office2013';
	// config.uiColor = '#AADC6E';
	config.pdfHandler = '/files/savepdf';
	config.allowedContent = true;
	config.editorplaceholder = 'Soạn nội dung...';

	config.removePlugins = 'exportpdf';

	config.filebrowserBrowseUrl = '/assets/ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = '/assets/ckfinder/ckfinder.html?type=Images';
	config.filebrowserFlashBrowseUrl = '/assets/ckfinder/ckfinder.html?type=Flash';
	config.filebrowserUploadUrl = '/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserImageUploadUrl = '/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserFlashUploadUrl = '/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
