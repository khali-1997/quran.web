<?php
namespace lib\db;


class lm_group
{

	public static function insert()
	{
		\dash\db\config::public_insert('lm_group', ...func_get_args());
		return \dash\db::insert_id();
	}


	public static function multi_insert()
	{
		return \dash\db\config::public_multi_insert('lm_group', ...func_get_args());
	}


	public static function update()
	{
		return \dash\db\config::public_update('lm_group', ...func_get_args());
	}


	public static function get()
	{
		return \dash\db\config::public_get('lm_group', ...func_get_args());
	}

	public static function get_count()
	{
		return \dash\db\config::public_get_count('lm_group', ...func_get_args());
	}


	public static function search()
	{
		$result = \dash\db\config::public_search('lm_group', ...func_get_args());
		return $result;
	}

}
?>
