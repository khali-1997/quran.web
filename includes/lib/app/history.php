<?php
namespace lib\app;

/**
 * Class for history.
 */

class history
{

	public static function save($_aya)
	{
		if(!\dash\user::id())
		{
			return false;
		}

		if(!is_numeric($_aya))
		{
			return false;
		}

		$_aya = intval($_aya);
		if($_aya <= 0 || $_aya > 6236)
		{
			return false;
		}

		$get = \lib\db\quran::get_by_index($_aya);

		$insert                = [];
		$insert['user_id']     = \dash\user::id();
		$insert['sura']        = (isset($get['sura'])) ? $get['sura'] : null;
		$insert['aya']         = $_aya;
		$insert['page']        = (isset($get['page'])) ? $get['page'] : null;;
		$insert['juz']         = (isset($get['juz'])) ? $get['juz'] : null;;
		$insert['rub']         = (isset($get['rub'])) ? $get['sura'] : null;;
		$insert['nim']         = (isset($get['nim'])) ? $get['nim'] : null;;
		$insert['datecreated'] = date("Y-m-d H:i:s");

		\lib\db\history::insert($insert);

		\dash\notif::ok(T_("History saved"));
	}
}
?>