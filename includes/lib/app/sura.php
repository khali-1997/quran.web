<?php
namespace lib\app;


class sura
{
	public static $sort_field =
	[

		'index',
		'ayas',
		'start',
		'end',
		'name',
		'tname',
		'ename',
		'type',
		'order',
		'word',
		'theletter',
		'startjuz',
		'endjuz',
		'startpage',
		'endpage',
	];


	public static function load($_id)
	{
		$load             = \lib\db\quran::get(['sura' => $_id]);
		$result           = [];
		$result['aye']    = $load;
		$result['detail'] = \lib\db\sura::get(['index' => $_id, 'limit' => 1]);
		return $result;
	}


	public static function db_list($_string, $_args)
	{

		$default_args =
		[
			'order' => null,
			'sort'  => 'index',
		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		$_args = array_merge($default_args, $_args);

		if($_args['order'])
		{
			if(!in_array($_args['order'], ['asc', 'desc']))
			{
				unset($_args['order']);
			}
		}

		if($_args['sort'])
		{
			if(!in_array($_args['sort'], self::$sort_field))
			{
				$_args['sort'] = 'index';
			}
		}


		$result = \lib\db\sura::search($_string, $_args);

		return $result;
	}



	public static function list()
	{
		$addr = root. '/content_api/v6/sura/sura.json';
		if(is_file($addr))
		{
			$get = \dash\file::read($addr);
			$get = json_decode($get, true);
			if(is_array($get))
			{
				return $get;
			}
		}
		return null;
	}


	public static function detail($_id, $_field = null)
	{
		$get = self::list();
		if(is_array($get))
		{
			if(isset($get[$_id]))
			{
				if(!$_field)
				{
					return $get[$_id];
				}
				elseif(isset($get[$_id][$_field]))
				{
					return $get[$_id][$_field];
				}
				else
				{
					return null;
				}
			}
		}

		return null;
	}
}
?>