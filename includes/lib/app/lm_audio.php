<?php
namespace lib\app;

/**
 * Class for lm_audio.
 */

class lm_audio
{

	public static $sort_field =
	[
		'id',

	];

	public static function add_new($_file, $_level_id)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("User not found"), 'user');
			return false;
		}

		$load_level = \lib\app\lm_level::get($_level_id);

		if(!$load_level || !isset($load_level['lm_audio_id']))
		{
			return false;
		}

		$group_id = \dash\coding::decode($load_level['lm_audio_id']);

		$args                 = [];
		$args['user_id']      = \dash\user::id();
		$args['lm_audio_id']  = $group_id;
		$args['lm_level_id']  = \dash\coding::decode($_level_id);
		$args['teacher']      = null;
		$args['audio']        = $_file;
		$args['teachertxt']   = null;
		$args['teacheraudio'] = null;
		$args['quality']      = null;
		$args['status']       = 'awaiting';
		$args['datecreated']  = date("Y-m-d H:i:s");

		$lm_audio_id = \lib\db\lm_audio::insert($args);

		if(!$lm_audio_id)
		{
			\dash\notif::error(T_("No way to insert data"), 'db');
			return false;
		}

		$return['id'] = \dash\coding::encode($lm_audio_id);

		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Your audio uploaded"));
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


		if(!\dash\app::isset_request('title')) unset($args['title']);
		if(!\dash\app::isset_request('desc')) unset($args['desc']);
		if(!\dash\app::isset_request('sort')) unset($args['sort']);
		if(!\dash\app::isset_request('type')) unset($args['type']);
		if(!\dash\app::isset_request('status')) unset($args['status']);
		if(!\dash\app::isset_request('file')) unset($args['file']);


		if(!empty($args))
		{
			$update = \lib\db\lm_audio::update($args, $id);

			$title = isset($args['title']) ? $args['title'] : T_("LearnAudio");

			\dash\log::set('editLearnAudio', ['code' => $id]);

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
			\dash\notif::error(T_("lm_audio id not set"));
			return false;
		}

		$get = \lib\db\lm_audio::get(['id' => $id, 'limit' => 1]);

		if(!$get)
		{
			\dash\notif::error(T_("Invalid lm_audio id"));
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

		$result            = \lib\db\lm_audio::search($_string, $_args);
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

		$check_duplicate = \lib\db\lm_audio::get(['title' => $title, 'limit' => 1]);
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


		$type = \dash\app::request('type');
		if(!$type && \dash\app::isset_request('type'))
		{
			\dash\notif::error(T_("Please choose type"), 'type');
			return false;
		}

		if($type && !self::type_list($type))
		{
			\dash\notif::error(T_("Invalid type"), 'type');
			return false;
		}



		$args           = [];
		$args['title']  = $title;
		$args['status'] = $status;
		$args['desc']   = $desc;
		$args['file']   = $file;
		$args['sort']   = $sort;
		$args['type']   = $type;

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
					if(isset($value))
					{
						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'file':
					if(!$value)
					{
						$value = \dash\app::static_logo_url();
					}
					$result[$key] = $value;
					break;

				case 'status':
					$result[$key] = $value;
					$result['t'.$key] = T_(ucfirst($value));
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