<?php
namespace lib\app;

/**
 * Class for history.
 */

class history
{
	public static $sort_field =
	[
		'id',

	];


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
		$insert['aya']         = (isset($get['aya'])) ? $get['aya'] : null;
		$insert['index']       = $_aya;
		$insert['page']        = (isset($get['page'])) ? $get['page'] : null;;
		$insert['juz']         = (isset($get['juz'])) ? $get['juz'] : null;;
		$insert['rub']         = (isset($get['rub'])) ? $get['sura'] : null;;
		$insert['nim']         = (isset($get['nim'])) ? $get['nim'] : null;;
		$insert['hizb']        = (isset($get['hizb'])) ? $get['hizb'] : null;;
		$insert['datecreated'] = date("Y-m-d H:i:s");
		$insert['time']        = time();

		\lib\db\history::insert($insert);

		\dash\notif::ok(T_("History saved"));
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

		$_args['sort'] = 'id';
		$_args['order'] = 'DESC';

		$result            = \lib\db\history::search($_string, $_args);
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

	public static function ready($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{

			switch ($key)
			{
				case 'sura':
					$result[$key] = $value;
					$result['sura_name'] = T_(\lib\app\sura::detail($value, 'tname'));
					break;

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


				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}

}
?>


