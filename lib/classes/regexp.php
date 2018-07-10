<?php

class regexp {
	use static_class;

	public static function get_regexp_for_autoclosed_tags_without_arguments() {
		return '`\<([A-Z][A-Za-z0-9\-\_]+)\/\>`';
	}
	public static function get_regexp_for_autoclosed_tags_without_arguments_and_spaces() {
		return '`\<([A-Z][A-Za-z0-9\-\_]+)[\ ]+\/\>`';
	}
	public static function get_regexp_for_autoclosed_tags_with_arguments() {
		return '`\<([A-Z][A-Za-z0-9\-\_]+)\ ([\ a-zA-Z0-9\=\-\_\\\'\"\%\\n\\t]+)\/\>`';
	}

	public static function get_regexp_for_no_autoclosed_tags_with_content_and_arguments() {
		return '`\<([A-Z][A-Za-z0-9\-\_]+)\ ([\ a-zA-Z0-9\=\-\_\\\'\"\%\\n\\t]+)\>([A-Za-z0-9\ \-\_\%]+)\<\/[A-Z][A-Za-z0-9\-\_]+\>`';
	}
	public static function get_regexp_for_no_autoclosed_tags_with_content_and_not_arguments_and_spaces() {
		return '`\<([A-Z][A-Za-z0-9\-\_]+)[\ ]+\>([A-Za-z0-9\ \-\_\%]+)\<\/[A-Z][A-Za-z0-9\-\_]+\>`';
	}
	public static function get_regexp_for_no_autoclosed_tags_with_content_and_not_arguments() {
		return '`\<([A-Z][A-Za-z0-9\-\_]+)\>([A-Za-z0-9\ \-\_\%]+)\<\/[A-Z][A-Za-z0-9\-\_]+\>`';
	}

	public static function get_regexp_for_no_autoclosed_tags_without_content_and_with_arguments() {
		return '`\<([A-Z][A-Za-z0-9\-\_]+)\ ([\ a-zA-Z0-9\=\-\_\\\'\"\%\\n\\t]+)\>\<\/[A-Z][A-Za-z0-9\-\_]+\>`';
	}
	public static function get_regexp_for_no_autoclosed_tags_without_content_and_arguments_and_with_spaces() {
		return '`\<([A-Z][A-Za-z0-9\-\_]+)[\ ]+\>\<\/[A-Z][A-Za-z0-9\-\_]+\>`';
	}
	public static function get_regexp_for_no_autoclosed_tags_without_content_and_arguments() {
		return '`\<([A-Z][A-Za-z0-9\-\_]+)\>\<\/([A-Z][A-Za-z0-9\-\_]+)\>`';
	}
}