<?php
namespace content_api\v6\detail;


class controller
{

	public static function routing()
	{
		\content_api\v6\access::check();

		$subchild = \dash\url::subchild();
		if(!$subchild)
		{
			\content_api\v6::no(404);
		}

		switch ($subchild)
		{
		;

			case 'juz-hizb':
				$data = self::juz_hizb();
				break;

			case 'quick-access':
				$data = self::quick_access();
				break;

			case 'aya-day':
				$data = self::aya_day();
				break;

			case 'page-day':
				$data = self::page_day();
				break;

			case 'hefz-program':
				$data = self::hefz_program();
				break;

			default:
				\content_api\v6::no(404);
				break;
		}

		\content_api\v6::bye($data);
	}











	private static function make_juz_hizb()
	{
		$data       = \lib\db\quran::get(['1.1' => 1.1]);
		$result     = [];
		$index_rub  = 0;
		$index_hizb = 0;
		foreach ($data as $key => $value)
		{
			if(!isset($result[$value['juz']]))
			{
				$index_hizb = 0;
				$result[$value['juz']] = [];
			}

			if(!isset($result[$value['juz']][$value['hizb']]))
			{
				$index_rub = 0;
				$index_hizb++;
				$result[$value['juz']][$value['hizb']] = [];
			}

			if(!isset($result[$value['juz']][$value['hizb']][$value['rub']]))
			{
				$index_rub++;
				$text = $value['text'];
				$text = explode(' ', $text);
				$x = 0;
				$my_Text = [];
				foreach ($text as $v)
				{
					$x++;
					if($x === 7)
					{
						break;
					}
					$my_Text[] = $v;
					# code...
				}
				$my_Text = implode(' ', $my_Text);

				$text = $value['simple'];
				$text = explode(' ', $text);
				$x = 0;
				$my_Text_simple = [];
				foreach ($text as $v)
				{
					$x++;
					if($x === 7)
					{
						break;
					}
					$my_Text_simple[] = $v;
					# code...
				}
				$my_Text_simple = implode(' ', $my_Text_simple);

				$result[$value['juz']][$value['hizb']][$value['rub']] =
				[
					'index_rub'  => $index_rub,
					'index_hizb' => $index_hizb,
					'rub'        => $value['rub'],
					'sura'       => $value['sura'],
					'page'       => $value['page'],
					'sura_detail' => \lib\app\sura::detail($value['sura']),
					'aya'        => $value['aya'],
					'text'       => $value['text'],
					'simple'     => $value['simple'],
					'first_word' => $my_Text,
					'first_word_simple' => $my_Text_simple,

				];
			}
		}

		j($result);













		if(is_file($dir))
		{
			$get = \dash\file::read($dir);
			$get = json_decode($get, true);

			if(!is_array($get))
			{
				return null;
			}

			$result = [];
			$last_juz_sura = [];

			foreach ($get as $key => $value)
			{
				$temp              = [];
				$temp['index']     = $value['index'];
				$temp['startpage'] = $value['startpage'];
				$temp['sura']      = [];

				foreach ($value['allsura'] as $k => $v)
				{
					if(in_array($v, $last_juz_sura))
					{
						continue;
					}
					$temp['sura'][] = \lib\app\sura::detail($v);
				}

				$last_juz_sura = $value['allsura'];

				if(empty($temp['sura']))
				{
					unset($temp['sura']);
				}
				$result[] = $temp;
			}

			return $result;
		}

		return null;
	}

	private static function make_juz_sura()
	{

		$dir = __DIR__;
		$dir = str_replace('/detail', '', $dir);
		$dir = $dir. '/juz/juz.json';

		if(is_file($dir))
		{
			$get = \dash\file::read($dir);
			$get = json_decode($get, true);

			if(!is_array($get))
			{
				return null;
			}

			$result = [];
			$last_juz_sura = [];

			foreach ($get as $key => $value)
			{
				$temp              = [];
				$temp['index']     = $value['index'];
				$temp['startpage'] = $value['startpage'];
				$temp['sura']      = [];

				foreach ($value['allsura'] as $k => $v)
				{
					if(in_array($v, $last_juz_sura))
					{
						continue;
					}
					$temp['sura'][] = \lib\app\sura::detail($v);
				}

				$last_juz_sura = $value['allsura'];

				if(empty($temp['sura']))
				{
					unset($temp['sura']);
				}
				$result[] = $temp;
			}

			return $result;
		}

		return null;
	}
}
?>