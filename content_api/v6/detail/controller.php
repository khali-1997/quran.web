<?php
namespace content_api\v6\detail;


class controller
{

	public static function routing()
	{
		$subchild = \dash\url::subchild();
		if(!$subchild)
		{
			\content_api\v6::no(404);
		}

		switch ($subchild)
		{
			case 'juz-sura':
				$data = self::juz_sura();
				break;

			default:
				\content_api\v6::no(404);
				break;
		}

		\content_api\v6::bye($data);
	}

	private static function juz_sura()
	{
		$dir = __DIR__. '/juz-sura.json';

		if(is_file($dir))
		{
			$get = \dash\file::read($dir);
			$get = json_decode($get, true);
			return $get;
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