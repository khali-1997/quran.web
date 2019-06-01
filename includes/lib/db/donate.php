<?php
namespace lib\db;


class donate
{
	public static function sum_from_to($_from, $_to)
	{
		$having = [];
		if($_from)
		{
			$having[] = "mysum >= $_from ";
		}

		if($_to)
		{
			$having[] = "mysum <= $_to ";
		}

		$having = implode(' AND ', $having);

		$query =
		"
			SELECT
				SUM(transactions.plus) AS `mysum`,
				transactions.user_id,
				users.displayname,
				users.gender,
				users.avatar
			FROM
				transactions
			INNER JOIN users ON users.id = transactions.user_id
			WHERE
				transactions.verify = 1 AND
				transactions.user_id IS NOT NULL
			GROUP BY
				transactions.user_id
			HAVING
				$having
		";
		$result = \dash\db::get($query);
		return $result;

	}


	public static function get_id($_id)
	{
		if(is_numeric($_id) && intval($_id) >= 1 && intval($_id) <= 114 )
		{
			$_id = intval($_id);
			return self::get(['sura' => $_id, 'limit' => 1]);
		}

		return false;
	}

}
?>
