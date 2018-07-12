<?php

class regexp {
	use static_class;

	public static function get_regexp_for_autoclosed_tags_without_arguments():string {
		return '`\<'.self::get_regexp_for_tag_name().'\/\>`';
	}
	public static function get_regexp_for_autoclosed_tags_without_arguments_and_spaces():string {
		return '`\<'.self::get_regexp_for_tag_name().self::get_regexp_for_juste_space().'\/\>`';
	}
	public static function get_regexp_for_autoclosed_tags_with_arguments():string {
		return '`\<'.self::get_regexp_for_tag_name().self::get_regexp_for_attributs().'\/\>`';
	}

	public static function get_regexp_for_no_autoclosed_tags_with_content_and_arguments():string {
		return '`\<'.self::get_regexp_for_tag_name().self::get_regexp_for_attributs().'\>'.self::get_regexp_for_content().'\<\/'.self::get_regexp_for_tag_name(true).'\>`';
	}
	public static function get_regexp_for_no_autoclosed_tags_with_content_and_not_arguments_and_spaces():string {
		return '`\<'.self::get_regexp_for_tag_name().self::get_regexp_for_juste_space().'\>'.self::get_regexp_for_content().'\<\/'.self::get_regexp_for_tag_name(true).'\>`';
	}
	public static function get_regexp_for_no_autoclosed_tags_with_content_and_not_arguments():string {
		return '`\<'.self::get_regexp_for_tag_name().'\>'.self::get_regexp_for_content().'\<\/'.self::get_regexp_for_tag_name(true).'\>`';
	}

	public static function get_regexp_for_no_autoclosed_tags_without_content_and_with_arguments():string {
		return '`\<'.self::get_regexp_for_tag_name().self::get_regexp_for_attributs().'>\<\/'.self::get_regexp_for_tag_name(true).'\>`';
	}
	public static function get_regexp_for_no_autoclosed_tags_without_content_and_arguments_and_with_spaces():string {
		return '`\<'.self::get_regexp_for_tag_name().self::get_regexp_for_juste_space().'\>\<\/'.self::get_regexp_for_tag_name(true).'\>`';
	}
	public static function get_regexp_for_no_autoclosed_tags_without_content_and_arguments():string {
		return '`\<'.self::get_regexp_for_tag_name().'\>\<\/'.self::get_regexp_for_tag_name(true).'\>`';
	}

	private static function get_regexp_for_content():string {
	    return '([\ a-zA-Z0-9\=\-\_\\\'\"\%\é\&\;\,\:\/\!\§\*ù\$\^\#\{\}\[\]\(\)\+\\n\\t]+)';
    }

    private static function get_regexp_for_attributs():string {
	    return '\ ([\ a-zA-Z0-9\=\-\_\\\'\"\%\é\&\;\,\:\/\.\!\§\*ù\$\^\#\{\}\[\]\(\)\+\\n\\t]+)';
    }

    private static function get_regexp_for_juste_space():string {
	    return '[\ ]+';
    }

    private static function get_regexp_for_tag_name($close = false):string {
	    $start = $close ? '' : '(';
	    $end = $close ? '' : ')';
	    return $start.'[A-Z][A-Za-z0-9\-\_]+'.$end;
    }

    public static function regexp_for_parse_attributs_with_only_integers():string {
	    return '`([\w\-]+\=\\d+)+`';
    }

    public static function regexp_for_parse_attributs():string {
        return '`([\w\-]+\=\"[\w\ \-\/\$\']+\")+`';
    }
}