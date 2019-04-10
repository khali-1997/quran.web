<?php
namespace lib\app;


class sura
{

	public static function load($_id)
	{
		$load             = \lib\db\quran::get(['sura' => $_id]);
		$result           = [];
		$result['aye']    = $load;
		$result['detail'] = \lib\db\sura::get(['index' => $_id, 'limit' => 1]);
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