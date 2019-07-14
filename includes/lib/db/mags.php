<?php
namespace lib\db;


class mags
{

	public static function insert()
	{
		\dash\db\config::public_insert('mags', ...func_get_args());
		return \dash\db::insert_id();
	}


	public static function update()
	{
		return \dash\db\config::public_update('mags', ...func_get_args());
	}


	public static function get()
	{
		return \dash\db\config::public_get('mags', ...func_get_args());
	}

	public static function get_count()
	{
		return \dash\db\config::public_get_count('mags', ...func_get_args());
	}


	public static function search($_string = null, $_option = [])
	{
		$default =
		[
			'search_field' =>
			"
				mags.qari LIKE ('%__string__%') OR
				mags.type LIKE ('%__string__%') OR
				mags.readtype LIKE ('%__string__%')
			",
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default, $_option);

		$result = \dash\db\config::public_search('mags', $_string, $_option);
		return $result;
	}

}
?>
