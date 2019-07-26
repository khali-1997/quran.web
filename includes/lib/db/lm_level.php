<?php
namespace lib\db;


class lm_level
{

	public static function insert()
	{
		\dash\db\config::public_insert('lm_level', ...func_get_args());
		return \dash\db::insert_id();
	}


	public static function multi_insert()
	{
		return \dash\db\config::public_multi_insert('lm_level', ...func_get_args());
	}


	public static function update()
	{
		return \dash\db\config::public_update('lm_level', ...func_get_args());
	}


	public static function get()
	{
		return \dash\db\config::public_get('lm_level', ...func_get_args());
	}

	public static function get_count()
	{
		return \dash\db\config::public_get_count('lm_level', ...func_get_args());
	}


	public static function search($_string, $_args)
	{
		$default =
		[
			'public_show_field' => 'lm_level.*, lm_group.title as `group_title`',
			'master_join'       => ' LEFT JOIN lm_group ON lm_group.id = lm_level.lm_group_id',
		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		$_args = array_merge($default, $_args);

		$result = \dash\db\config::public_search('lm_level', $_string, $_args);

		return $result;
	}

}
?>
