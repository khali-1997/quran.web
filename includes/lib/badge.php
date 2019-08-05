<?php
namespace lib;


class badge
{
	public static function list($_key = null)
	{
		$list                      = [];

		$list['OpenMag']           = ['title' => T_("First open magazine"), 'class' => 'warn'];
		$list['OpenAudioBank']     = ['title' => T_("First open audio bank"), 'class' => 'warn'];
		$list['ReadFirstAya']      = ['title' => T_("Read first aya"), 'class' => 'warn'];
		// $list['ReadFirstSura']     = ['title' => T_("Read first sura"), 'class' => 'warn'];
		$list['AddFirstKhatm']     = ['title' => T_("Add first khatm"), 'class' => 'warn'];
		$list['UsePublicKhatm']    = ['title' => T_("User or start a public khatm"), 'class' => 'warn'];
		$list['LmsStartLevel']     = ['title' => T_("Start first level in LMS"), 'class' => 'warn'];
		$list['LmsFirstScore']     = ['title' => T_("Get first score in LMS"), 'class' => 'warn'];
		$list['LmsFirstFullScore'] = ['title' => T_("Get first full score in LMS"), 'class' => 'warn'];

		if($_key)
		{
			if(isset($list[$_key]))
			{
				return $list[$_key];
			}
			else
			{
				return null;
			}
		}
		else
		{
			return $list;
		}
	}


	public static function set($_caller)
	{
		// user not login
		if(!\dash\user::id())
		{
			return false;
		}

		$list = self::list();

		// invalid caller
		if(!array_key_exists($_caller, $list))
		{
			return false;
		}

		// this user get this badge before
		if(self::get_before($_caller))
		{
			return false;
		}

		$insert =
		[
			'badge'       => $_caller,
			'user_id'     => \dash\user::id(),
			'datecreated' => date("Y-m-d H:i:s"),
		];

		// add new badge
		\lib\db\badgeusage::insert($insert);

	}


	public static function person_list()
	{
		$count = \lib\db\badgeusage::get_group_by();
		$list = self::list();
		foreach ($list as $key => $value)
		{
			if(isset($count[$key]))
			{
				$list[$key]['person'] = $count[$key];
			}
		}

		return $list;
	}


	private static function get_before($_caller)
	{
		$check = \lib\db\badgeusage::get_before($_caller, \dash\user::id());
		if($check)
		{
			return true;
		}
		else
		{
			return false;
		}

	}


	public static function user_list($_args)
	{
		$list = \lib\db\badgeusage::search(null, $_args);
		if(!is_array($list))
		{
			$list = [];
		}

		foreach ($list as $key => $value)
		{
			$list[$key]['badge_detail'] = self::list($value['badge']);
		}

		return $list;
	}

}
?>