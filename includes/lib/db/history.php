<?php
namespace lib\db;


class history
{

	public static function insert()
	{
		return \dash\db\config::public_insert('history', ...func_get_args());
	}
}
?>