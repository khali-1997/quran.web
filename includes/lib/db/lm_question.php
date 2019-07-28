<?php
namespace lib\db;


class lm_question
{

	public static function insert()
	{
		\dash\db\config::public_insert('lm_question', ...func_get_args());
		return \dash\db::insert_id();
	}


	public static function multi_insert()
	{
		return \dash\db\config::public_multi_insert('lm_question', ...func_get_args());
	}


	public static function update()
	{
		return \dash\db\config::public_update('lm_question', ...func_get_args());
	}


	public static function get()
	{
		return \dash\db\config::public_get('lm_question', ...func_get_args());
	}

	public static function get_count()
	{
		return \dash\db\config::public_get_count('lm_question', ...func_get_args());
	}


	public static function search()
	{
		$result = \dash\db\config::public_search('lm_question', ...func_get_args());
		return $result;
	}


	public static function get_rand($_lm_level_id, $_limit)
	{
		$query =
		"
			SELECT * FROM lm_question
			WHERE
				lm_question.lm_level_id = $_lm_level_id AND
				lm_question.status = 'enable'
			ORDER BY RAND()
			LIMIT $_limit

		";
		$result = \dash\db::get($query);
		return $result;
	}

}
?>
