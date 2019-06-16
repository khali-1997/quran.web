<?php
namespace lib\app;


class sura
{
	public static function setNav()
	{

		// hizb
		$list = \dash\file::read('my addr');
		$list = json_decode($list, true);

		$inset_hizb = [];
		for ($i=1; $i <= 604 ; $i++)

		{
			$start = self::get(['page' => $i, 'limit' => 1], false);
			$end = self::get(['page' => $i, 'limit' => 1], true);

			$inset_hizb[] =
			[
				'type'      => 'page',
				'index'     => intval($i),
				'startjuz'  => intval($start['juz']),
				'endjuz'    => intval($end['juz']),
				'juzcount'  => intval($end['juz']) - intval($start['juz']) + 1,

				'startpage' => intval($start['page']),
				'endpage'   => intval($end['page']),
				'pagecount' => intval($end['page']) - intval($start['page']) + 1,

				'startaya'  => intval($start['index']),
				'endaya'    => intval($end['index']),
				'ayacount'  => intval($end['index']) - intval($start['index']) + 1,

				'startsura' => intval($start['sura']),
				'endsura'   => intval($end['sura']),
				'suracount' => intval($end['sura']) - intval($start['sura']) + 1,

				'starthizb' => intval($start['hizb']),
				'endhizb'   => intval($end['hizb']),
				'hizbcount' => intval($end['hizb']) - intval($start['hizb']) + 1,

				'startnim'  => intval($start['nim']),
				'endnim'    => intval($end['nim']),
				'nimcount'  => intval($end['nim']) - intval($start['nim']) + 1,

				'startrub'  => intval($start['rub']),
				'endrub'    => intval($end['rub']),
				'rubcount'  => intval($end['rub']) - intval($start['rub']) + 1,


				// 'words'     => $value['words'],
			];
		}
		// j($inset_hizb);
		j(\dash\db\config::make_multi_insert($inset_hizb));


		//-------------------------------------------------------------------------
		// juz
		$list = \lib\app\juz::list();
		$inset_juz = [];
		foreach ($list as $key => $value)
		{
			$START = self::get(['juz' => $value['index'], 'limit' => 1], false);
			$END = self::get(['juz' => $value['index'], 'limit' => 1], true);

			$inset_juz[] =
			[
				'type'      => 'juz',
				'index'     => $value['index'],
				'startjuz'  => $value['index'],
				'endjuz'    => $value['index'],
				'juzcount'  => 1,
				'startpage' => $value['startpage'],
				'endpage'   => $value['endpage'],
				'pagecount' => intval($value['endpage']) - intval($value['startpage']) + 1,
				'startaya'  => $START['index'],
				'endaya'    => $END['index'],
				'ayacount'  => intval($END['index']) - intval($START['index']) + 1,
				'startsura' => $value['startsura'],
				'endsura'   => $value['endsura'],
				'suracount' => intval($value['endsura']) - intval($value['startsura']) + 1,
				'starthizb' => $value['starthizb'],
				'endhizb'   => $value['endhizb'],
				'hizbcount' => intval($value['endhizb']) - intval($value['starthizb']) + 1,
				'startnim'  => $value['startnim'],
				'endnim'    => $value['endnim'],
				'nimcount'  => intval($value['endnim']) - intval($value['startnim']) + 1,
				'startrub'  => $value['startrub'],
				'endrub'    => $value['endrub'],
				'rubcount'  => intval($value['endrub']) - intval($value['startrub']) + 1,
				'words'     => $value['words'],
			];
		}
		j(\dash\db\config::make_multi_insert($inset_juz));
	}

	public static function get($_where,  $_desc = false)
	{
		$_option = [];
		$_option['db_name'] = \lib\db\db_data_name::get();

		if($_desc)
		{
			$_option['order'] = ' ORDER BY `1_quran_ayat`.`index` DESC ';
		}
		else
		{
			$_option['order'] = ' ORDER BY `1_quran_ayat`.`index` ASC ';
		}

		return \dash\db\config::public_get('1_quran_ayat', $_where, $_option);
	}

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
				unset($_args['sort']);
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