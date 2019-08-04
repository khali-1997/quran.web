<?php
namespace content\fromto;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Load quran from ... to ...'));
		$sura = \lib\app\sura::list();
		\dash\data::quranListQuick($sura);

		$sura     = \dash\request::get('surah');
		$startaya = \dash\request::get('startaya');
		$endaya   = \dash\request::get('endaya');

		if($sura && $startaya && $endaya)
		{
			\dash\data::fromtoLink('f'. $sura. '-'. $startaya. '-'. $endaya);
		}
	}
}
?>