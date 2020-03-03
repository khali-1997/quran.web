<?php
namespace content_m\hi;


class controller
{
	public static function routing()
	{
		$query = "SELECT * FROM lm_group WHERE lm_group.title LIKE '%xdelete%' AND lm_group.status = 'disable' ";
		$group = \dash\db::get($query);

		$result['group_count'] = count($group);

		$group_id = array_column($group, 'id');

		$deleteGroupId = array_filter($group_id);
		$deleteGroupId = array_unique($deleteGroupId);
		if($deleteGroupId)
		{

			$deleteGroupId = implode(',', $deleteGroupId);
			$level = "SELECT * FROM lm_level WHERE lm_level.lm_group_id IN ($deleteGroupId) ";
			$level = \dash\db::get($level);
			$result['level_count'] = count($level);
			$result['level_list'] = $level;
		}

		$result['group_list'] = $group;


		if(\dash\request::get('run') !== '1')
		{
			self::j($result);
			exit();
		}

		if(isset($level) && is_array($level))
		{
			foreach ($level as $key => $value)
			{
				if(isset($value['file']) && substr($value['file'], 0, 23) === 'https://salamquran.com/')
				{
					$remove = $value['file'];
					$remove = str_replace('https://salamquran.com/', root. 'public_html/', $remove);
					if(is_file($remove))
					{
						\dash\file::remove($remove);
					}

				}
				\dash\db::query("DELETE FROM lm_question WHERE lm_level_id = $value[id] LIMIT 1");
				$level_id = \dash\db::query("DELETE FROM lm_level WHERE lm_level.id = $value[id] LIMIT 1");
			}

		}

		foreach ($group as $key => $value)
		{
			\dash\db::query("DELETE FROM lm_group WHERE lm_group.id = $value[id] LIMIT 1");
		}

	}




	private static function j($_a)
	{
		\dash\notif::api($_a);
	}
}
?>