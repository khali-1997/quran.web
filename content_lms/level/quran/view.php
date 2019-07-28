<?php
namespace content_lms\level\quran;


class view
{
	public static function config()
	{
		$loadLevel = \lib\app\lm_level::public_load_level(\dash\request::get('id'));
		\dash\data::loadLevel($loadLevel);

		$quranLoaded = \lib\app\lm_level::load_quran(\dash\request::get('id'));
		\dash\data::quranLoaded($quranLoaded);
		// \dash\data::pageStyle('uthmani');

	}
}
?>