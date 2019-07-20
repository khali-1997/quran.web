<?php
namespace lib\db;


class donate
{
	public static function last_10_donate()
	{
		$query =
		"
			SELECT
				transactions.plus AS `mysum`,
				transactions.datecreated AS `datecreated`,
				transactions.user_id,
				transactions.url,
				users.displayname,
				users.gender,
				users.avatar
			FROM
				transactions
			INNER JOIN users ON users.id = transactions.user_id
			WHERE
				transactions.verify = 1
			ORDER BY transactions.id DESC
			LIMIT 10
		";
		$result = \dash\db::get($query);
		return $result;

	}

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
				MAX(transactions.datecreated) AS `datecreated`,
				(
					SELECT
						MYtransactions.url
					FROM
						transactions AS `MYtransactions`
					WHERE
						MYtransactions.user_id = transactions.user_id AND
						MYtransactions.url IS NOT NULL
					ORDER BY MYtransactions.id DESC
					LIMIT 1
				) AS `url`,
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

}
?>
