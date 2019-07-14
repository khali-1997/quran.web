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
		$q = null;
		if(isset($_string))
		{
			$_string = \dash\db\safe::value($_string);
			$q       = " WHERE posts.title LIKE '%$_string%' ";
		}

		$pagination_query =
		"
			SELECT
				COUNT(*) AS `count`
			FROM
				mags

				$q
		";

		$limit = \dash\db::pagination_query($pagination_query);

		$query =
		"
			SELECT
				mags.id AS `mag_id`,
				mags.*,
				posts.title
			FROM
				mags
			INNER JOIN posts ON posts.id = mags.post_id
			$q
			$limit
		";
		$result = \dash\db::get($query);

		return $result;
	}




}
?>
