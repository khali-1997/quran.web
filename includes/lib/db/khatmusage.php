<?php
namespace lib\db;


class khatmusage
{

	public static function get_count_done_sura($_id)
	{
		$query = "SELECT COUNT(*) AS `count` FROM khatmusage WHERE khatmusage.khatm_id = $_id AND khatmusage.status = 'done' ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	public static function get_count_reserved_sura($_id)
	{
		$query = "SELECT COUNT(*) AS `count` FROM khatmusage WHERE khatmusage.khatm_id = $_id AND khatmusage.status IN ('reserved', 'done') ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}



	public static function get_last_record($_user_id, $_khatm_id)
	{
		$query = "SELECT * FROM khatmusage WHERE khatmusage.khatm_id = $_khatm_id AND khatmusage.user_id = $_user_id ORDER BY khatmusage.id DESC LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function user_have_running_khatm($_user_id)
	{
		$query = "SELECT * FROM khatmusage WHERE khatmusage.user_id = $_user_id AND khatmusage.status IN ('request', 'reading') LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function in_use($_id)
	{
		$query = "SELECT * FROM khatmusage WHERE khatmusage.khatm_id = $_id AND khatmusage.status IN ('done', 'reading') ";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function insert()
	{
		\dash\db\config::public_insert('khatmusage', ...func_get_args());
		return \dash\db::insert_id();
	}


	public static function multi_insert()
	{
		return \dash\db\config::public_multi_insert('khatmusage', ...func_get_args());
	}


	public static function update()
	{
		return \dash\db\config::public_update('khatmusage', ...func_get_args());
	}


	public static function get()
	{
		return \dash\db\config::public_get('khatmusage', ...func_get_args());
	}

	public static function get_count()
	{
		return \dash\db\config::public_get_count('khatmusage', ...func_get_args());
	}


		public static function search($_string, $_args)
	{
		$default =
		[

			'search_field'       => " khatmusage.title LIKE ('%__string__%')",
		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		$_args = array_merge($default, $_args);

		$result = \dash\db\config::public_search('khatmusage', $_string, $_args);

		return $result;
	}

}
?>
