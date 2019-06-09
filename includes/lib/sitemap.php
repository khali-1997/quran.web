<?php
namespace lib;


class sitemap
{
	public static function create()
	{
		$language = \dash\language::all();
		foreach ($language as $lang => $detail)
		{
			$myLang = $lang;
			if($myLang == \dash\language::primary())
			{
				$myLang = null;
			}

			self::sura($myLang);
			self::page($myLang);
			self::juz($myLang);
			$translate_list = \lib\app\translate::all_translate_url();
			foreach ($translate_list as $translate)
			{
				self::aya($myLang, $translate);
			}
		}

	}


	private static function sura($_lang = null)
	{
		$filename = 'quransura';

		$myLang = null;
		if($_lang)
		{
			$myLang = $_lang. '/';
			$filename .= '-'. $_lang;
		}

		$sitemap  = \dash\utility\sitemap::new_sitemap();

		$sitemap->setFilename($filename);

		for ($i=1; $i <= 114 ; $i++)
		{
			$myUrl = $myLang. 's'.$i;

			$sitemap->addItem($myUrl, '0.9', 'monthly', null);
		}

		$sitemap->endSitemap();

		\dash\utility\sitemap::set_result($filename, 114);
	}


	private static function page($_lang = null)
	{
		$filename = 'quranpage';
		$myLang = null;
		if($_lang)
		{
			$myLang = $_lang. '/';
			$filename .= '-'. $_lang;
		}

		$sitemap  = \dash\utility\sitemap::new_sitemap();

		$sitemap->setFilename($filename);

		for ($i=1; $i <= 604 ; $i++)
		{
			$myUrl = $myLang. 'p'.$i;

			$sitemap->addItem($myUrl, '0.8', 'monthly', null);
		}

		$sitemap->endSitemap();

		\dash\utility\sitemap::set_result($filename, 604);
	}


	private static function juz($_lang = null)
	{
		$filename = 'quranjuz';
		$myLang = null;
		if($_lang)
		{
			$myLang = $_lang. '/';
			$filename .= '-'. $_lang;
		}

		$sitemap  = \dash\utility\sitemap::new_sitemap();

		$sitemap->setFilename($filename);

		for ($i=1; $i <= 30 ; $i++)
		{
			$myUrl = $myLang. 'j'.$i;

			$sitemap->addItem($myUrl, '0.8', 'monthly', null);
		}

		$sitemap->endSitemap();

		\dash\utility\sitemap::set_result($filename, 30);
	}

	private static function aya($_lang = null, $_translate)
	{
		$filename = 'quranaya';
		$myLang = null;
		if($_lang)
		{
			$myLang = $_lang. '/';
			$filename .= '-'. $_lang;
		}

		$filename .= '-'. $_translate;

		$sitemap  = \dash\utility\sitemap::new_sitemap();

		$sitemap->setFilename($filename);

		for ($i=1; $i <= 6236 ; $i++)
		{
			$myUrl = $myLang. 'a'.$i. '?t='. $_translate;

			$sitemap->addItem($myUrl, '0.7', 'monthly', null);
		}

		$sitemap->endSitemap();

		\dash\utility\sitemap::set_result($filename, 6236);
	}
}
?>