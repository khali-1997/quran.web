<?php
namespace lib\app;


class aya_day
{

	public static function get()
	{
		$result = self::day_aya();
		$load   = [];

		if(isset($result['index']))
		{
			$load = \lib\db\quran::get(['index' => $result['index']]);
			if(isset($load[0]))
			{
				$load = $load[0];
				$load['sura_detail'] = \lib\app\sura::detail($load['sura']);
			}
		}

		return $load;
	}


	private static function day_aya()
	{
		$date = date("Y-m-d");
		$saved_aya = self::load_file();

		if(isset($saved_aya[$date]))
		{
			return $saved_aya[$date];
		}
		else
		{
			return self::get_random();
		}
	}


	private static function get_random()
	{
		$saved_aya     = self::load_file();
		$loaded_before = array_column($saved_aya, 'index');
		$get_random    = \lib\db\quran::get_day_aya_random($loaded_before);

		if(!isset($get_random['index']))
		{
			// all aya random is displayed
			\dash\file::rename(__DIR__. '/aya-day.me.json', __DIR__.'/aya-day.me.json.old.'.rand(1,200));
			$get_random = \lib\db\quran::get_day_aya_random([]);
		}

		$detail =
		[
			'index' => $get_random['index'],
			'sura'  => $get_random['sura'],
			'aya'   => $get_random['aya'],
			'juz'   => $get_random['juz'],
			'page'  => $get_random['page'],
		];

		$save_file[date("Y-m-d")] = $detail;

		self::load_file($save_file);
		return $detail;

	}


	private static function load_file($_save = null)
	{
		$addr = __DIR__. '/aya-day.me.json';
		$get  = [];

		if(is_file($addr))
		{
			$get = \dash\file::read($addr);
			$get = json_decode($get, true);
			if(!is_array($get))
			{
				$get = [];
			}
		}


		if($_save && is_array($_save))
		{
			$get = array_merge($get, $_save);
			$get = json_encode($get, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
			\dash\file::write($addr, $get);
		}

		return $get;
	}

}
?>