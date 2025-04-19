/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function (config) {
    config.filebrowserBrowseUrl = "/admin/laravel-filemanager?type=Files";
    config.filebrowserImageBrowseUrl = "/admin/laravel-filemanager?type=Images";
    config.filebrowserUploadUrl = "/admin/laravel-filemanager/upload?type=Files";
    config.filebrowserImageUploadUrl =
        "/admin/laravel-filemanager/upload?type=Images";
};
