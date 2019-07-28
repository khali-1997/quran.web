<?php
namespace lib\app;

/**
 * Class for lm_audio.
 */

class lm_audio
{
	public static function add_new($_file, $_level_id)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("User not found"), 'user');
			return false;
		}

		$load_level = \lib\app\lm_level::get($_level_id);

		if(!$load_level || !isset($load_level['lm_group_id']))
		{
			return false;
		}

		$group_id = \dash\coding::decode($load_level['lm_group_id']);

		$args                 = [];
		$args['user_id']      = \dash\user::id();
		$args['lm_group_id']  = $group_id;
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



}
?>