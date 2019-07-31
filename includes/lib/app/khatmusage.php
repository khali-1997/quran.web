<?php
namespace lib\app;


class khatmusage
{

	public static function start($_id)
	{
		$check = \lib\app\khatm::site_start($_id);
		if(!$check)
		{
			\dash\notif::error(T_("Can not start this khatm"));
			return false;
		}


	}

	public static function remain($_id, $_khatm_detail)
	{
		$list = \lib\db\khatmusage::in_use($_id);
		if(!$list)
		{
			return true;
		}
		j($list);
		return true;
	}

	public static function check_remain($_id, $_khatm_detail)
	{
		if(self::remain($_id, $_khatm_detail))
		{
			return true;
		}
		return false;
	}
}
?>
