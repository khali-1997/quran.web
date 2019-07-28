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
			'search_field'       =>
			"
				(
					lm_group.title LIKE ('%__string__%') OR
					lm_level.title LIKE ('%__string__%')
				)


			",

		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		$_args = array_merge($default, $_args);

		$result = \dash\db\config::public_search('lm_level', $_string, $_args);

		return $result;
	}

	public static function public_level_list($_group_id, $_user_id)
	{
		$query =
		"
			SELECT
				lm_level.*,
				(
					SELECT
						MAX(lm_star.star) AS `star`
					FROM
						lm_star
					WHERE
						lm_star.user_id = $_user_id AND
						lm_star.lm_level_id = lm_level.id
					GROUP BY
						lm_star.user_id
				)
				AS `userstar`
			FROM
				lm_level
			WHERE
				lm_level.lm_group_id = $_group_id AND
				lm_level.status = 'enable'
			ORDER BY lm_level.sort ASC


		";
		$result = \dash\db::get($query);
		return $result;
	}

}
?>
