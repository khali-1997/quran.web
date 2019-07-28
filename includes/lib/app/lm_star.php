<?php
namespace lib\app;

/**
 * Class for lm_star.
 */

class lm_star
{


	public static function level_quran($_type, $_level_id)
	{

		if(!\dash\user::id())
		{
			\dash\notif::error(T_("User not found"), 'user');
			return false;
		}

		$star = 0;
		switch ($_type)
		{
			case 'listenfirst':
				$star = 1;
				break;

			case 'listensecond':
				$star = 2;
				break;

			case 'debate':
				$star = 3;
				break;

			default:
				return false;
				break;
		}

		$load_level = \lib\app\lm_level::get($_level_id);

		if(!$load_level || !isset($load_level['lm_group_id']))
		{
			return false;
		}

		$group_id = \dash\coding::decode($load_level['lm_group_id']);

		$args                = [];
		$args['user_id']     = \dash\user::id();
		$args['lm_group_id'] = $group_id;
		$args['lm_level_id'] = \dash\coding::decode($_level_id);
		$args['star']        = $star;
		$args['score']       = 0;
		$args['status']      = 'enable';
		$args['datecreated']  = date("Y-m-d H:i:s");

		$lm_star_id = \lib\db\lm_star::insert($args);

		if(!$lm_star_id)
		{
			\dash\notif::error(T_("No way to insert data"), 'db');
			return false;
		}

		$return['id'] = \dash\coding::encode($lm_star_id);

		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Hooray!"));
		}

		return $return;
	}


	public static function user_level_star($_level_id)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("User not found"), 'user');
			return false;
		}

		$user_id = \dash\user::id();

		$load_level = \lib\app\lm_level::get($_level_id);

		if(!$load_level || !isset($load_level['lm_group_id']))
		{
			return false;
		}

		$level_id = \dash\coding::decode($_level_id);

		$user_star = \lib\db\lm_star::get_user_star($level_id, $user_id);

		$result = [];

		if(isset($user_star['star']))
		{
			$result['star'] = intval($user_star['star']);
		}

		return $result;

	}


}
?>