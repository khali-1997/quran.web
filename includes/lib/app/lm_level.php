<?php
namespace lib\app;

/**
 * Class for lm_level.
 */

class lm_level
{
	public static $sort_field =
	[
		'id',
		'lm_group_id',
		'title',
		// 'desc',
		'type',
		'quranfrom',
		'quranto',
		// 'file',
		// 'setting',
		'sort',
		'ratio',
		'unlockscore',
		'status',
		'datecreated',

	];


	public static function add($_args = [])
	{
		\dash\app::variable($_args);

		if(!\dash\user::id())
		{
			\dash\notif::error(T_("User not found"), 'user');
			return false;
		}

		// check args
		$args = self::check();

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$return = [];

		if(!$args['status'])
		{
			$args['status']  = 'enable';
		}

		$lm_level_id = \lib\db\lm_level::insert($args);

		if(!$lm_level_id)
		{
			\dash\notif::error(T_("No way to insert data"), 'db');
			return false;
		}

		$return['id'] = \dash\coding::encode($lm_level_id);

		if(\dash\engine\process::status())
		{
			\dash\log::set('addNewLevelGroup', ['code' => $lm_level_id]);
			\dash\notif::ok(T_("Level group successfuly added"));
		}

		return $return;
	}


	public static function edit($_args, $_id)
	{
		\dash\app::variable($_args);

		$result = self::get($_id);

		if(!$result)
		{
			return false;
		}

		$id = \dash\coding::decode($_id);

		$args = self::check($id);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}


		if(!\dash\app::isset_request('lm_group_id')) unset($args['lm_group_id']);
		if(!\dash\app::isset_request('title')) unset($args['title']);
		if(!\dash\app::isset_request('desc')) unset($args['desc']);
		if(!\dash\app::isset_request('type')) unset($args['type']);
		if(!\dash\app::isset_request('quranfrom')) unset($args['quranfrom']);
		if(!\dash\app::isset_request('quranto')) unset($args['quranto']);
		if(!\dash\app::isset_request('besmellah')) unset($args['besmellah']);
		if(!\dash\app::isset_request('file')) unset($args['file']);
		if(!\dash\app::isset_request('setting')) unset($args['setting']);
		if(!\dash\app::isset_request('sort')) unset($args['sort']);
		if(!\dash\app::isset_request('ratio')) unset($args['ratio']);
		if(!\dash\app::isset_request('unlockscore')) unset($args['unlockscore']);
		if(!\dash\app::isset_request('status')) unset($args['status']);


		if(!empty($args))
		{
			$update = \lib\db\lm_level::update($args, $id);

			$title = isset($args['title']) ? $args['title'] : T_("LevelGroup");

			\dash\log::set('editLevelGroup', ['code' => $id]);

			if(\dash\engine\process::status())
			{
				\dash\notif::ok(T_(":val successfully updated", ['val' => $title]));
			}
		}

		return \dash\engine\process::status();
	}


	public static function get($_id)
	{
		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			\dash\notif::error(T_("lm_level id not set"));
			return false;
		}

		$get = \lib\db\lm_level::get(['id' => $id, 'limit' => 1]);

		if(!$get)
		{
			\dash\notif::error(T_("Invalid lm_level id"));
			return false;
		}

		$result = self::ready($get);

		return $result;
	}


	public static function list($_string = null, $_args = [])
	{
		if(!\dash\user::id())
		{
			return false;
		}

		$default_meta =
		[
			'sort'  => null,
			'order' => null,
		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		$_args = array_merge($default_meta, $_args);

		if($_args['sort'] && !in_array($_args['sort'], self::$sort_field))
		{
			$_args['sort'] = null;
		}

		$result            = \lib\db\lm_level::search($_string, $_args);
		$temp              = [];

		foreach ($result as $key => $value)
		{
			$check = self::ready($value);
			if($check)
			{
				$temp[] = $check;
			}
		}

		return $temp;
	}


	private static function check($_id = null)
	{
		$title = \dash\app::request('title');
		if(!$title)
		{
			\dash\notif::error(T_("Please fill the title"), 'title');
			return false;
		}

		if(mb_strlen($title) > 300)
		{
			\dash\notif::error(T_("Please fill the title less than 300 character"), 'title');
			return false;
		}

		$lm_group_id = \dash\app::request('lm_group_id');
		$lm_group_id = \dash\coding::decode($lm_group_id);
		if(!$lm_group_id && !$_id)
		{
			\dash\notif::error(T_("Please set group id"));
			return false;
		}

		$check_duplicate = \lib\db\lm_level::get(['title' => $title, 'lm_group_id' => $lm_group_id, 'limit' => 1]);
		if(isset($check_duplicate['id']))
		{
			if(intval($_id) === intval($check_duplicate['id']))
			{
				// no problem to edit it
			}
			else
			{
				$code = \dash\coding::encode($check_duplicate['id']);
				$msg = T_("This title is already exist in your list");
				$msg .= ' <a href="'. \dash\url::this(). '/edit?id='.$code. '">'. T_("Click here to edit it"). "</a>";
				\dash\notif::error($msg, 'title');
				return false;
			}
		}

		$status = \dash\app::request('status');
		if($status && !in_array($status, ['enable', 'disable', 'awaiting', 'deleted', 'publish', 'expire']))
		{
			\dash\notif::error(T_("Invalid status"), 'status');
			return false;
		}

		$desc    = \dash\app::request('desc');
		$file    = \dash\app::request('file');
		$setting    = \dash\app::request('setting');

		$sort = \dash\app::request('sort');
		$sort = \dash\utility\convert::to_en_number($sort);
		if($sort && !is_numeric($sort))
		{
			\dash\notif::error(T_("Please set the sort as a number"), 'sort');
			return false;
		}

		if($sort)
		{
			$sort = intval($sort);
			$sort = abs($sort);
		}

		if($sort && intval($sort) > 1E+4)
		{
			\dash\notif::error(T_("Sort is out of range!"), 'sort');
			return false;
		}

		$unlockscore = \dash\app::request('unlockscore');
		$unlockscore = \dash\utility\convert::to_en_number($unlockscore);
		if($unlockscore && !is_numeric($unlockscore))
		{
			\dash\notif::error(T_("Please set the unlockscore as a number"), 'unlockscore');
			return false;
		}

		if($unlockscore)
		{
			$unlockscore = intval($unlockscore);
			$unlockscore = abs($unlockscore);
		}

		if($unlockscore && intval($unlockscore) > 1E+4)
		{
			\dash\notif::error(T_("Unlock score is out of range!"), 'unlockscore');
			return false;
		}


		$type = \dash\app::request('type');
		if($type && mb_strlen($type) > 150)
		{
			\dash\notif::error(T_("Please fill the type less than 150 character"), 'type');
			return false;
		}

		$quranfrom = \dash\app::request('quranfrom');
		$quranfrom = \dash\utility\convert::to_en_number($quranfrom);
		if($quranfrom && !is_numeric($quranfrom))
		{
			\dash\notif::error(T_("Please set the quranfrom as a number"), 'quranfrom');
			return false;
		}

		if($quranfrom)
		{
			$quranfrom = intval($quranfrom);
			$quranfrom = abs($quranfrom);
		}

		if($quranfrom && intval($quranfrom) > 1E+4)
		{
			\dash\notif::error(T_("Unlock score is out of range!"), 'quranfrom');
			return false;
		}

		$quranto = \dash\app::request('quranto');
		$quranto = \dash\utility\convert::to_en_number($quranto);
		if($quranto && !is_numeric($quranto))
		{
			\dash\notif::error(T_("Please set the quranto as a number"), 'quranto');
			return false;
		}

		if($quranto)
		{
			$quranto = intval($quranto);
			$quranto = abs($quranto);
		}

		if($quranto && intval($quranto) > 1E+4)
		{
			\dash\notif::error(T_("Unlock score is out of range!"), 'quranto');
			return false;
		}

		$besmellah = \dash\app::request('besmellah') ? 1 : null;

		$ratio = \dash\app::request('ratio');
		$ratio = \dash\utility\convert::to_en_number($ratio);
		if($ratio && !is_numeric($ratio))
		{
			\dash\notif::error(T_("Please set the ratio as a number"), 'ratio');
			return false;
		}

		if($ratio)
		{
			$ratio = intval($ratio);
			$ratio = abs($ratio);
		}

		if($ratio && intval($ratio) > 1E+4)
		{
			\dash\notif::error(T_("Unlock score is out of range!"), 'ratio');
			return false;
		}

		$args                = [];
		$args['title']       = $title;
		$args['lm_group_id'] = $lm_group_id;
		$args['status']      = $status;
		$args['desc']        = $desc;
		$args['file']        = $file;
		$args['setting']     = $setting;
		$args['sort']        = $sort;
		$args['unlockscore'] = $unlockscore;
		$args['type']        = $type;
		$args['quranfrom']   = $quranfrom;
		$args['quranto']     = $quranto;
		$args['ratio']       = $ratio;
		$args['besmellah']   = $besmellah;


		return $args;
	}



	public static function ready($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{

			switch ($key)
			{
				case 'id':
				case 'lm_group_id':
					if(isset($value))
					{
						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'setting':
					if($value)
					{
						$result[$key] = json_decode($value, true);
					}
					else
					{
						$result[$key] = $value;
					}
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}
}
?>