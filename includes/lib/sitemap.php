<?php
namespace lib;


class sitemap
{
	public static function create()
	{
		$language  = \dash\language::all();
		$read_mode = \lib\app\read_mode::list();

		foreach ($language as $lang => $detail)
		{
			$myLang = $lang;
			if($myLang == \dash\language::primary())
			{
				$myLang = null;
			}

			$translate_list = \lib\app\translate::all_translate_url();
			foreach ($translate_list as $translate)
			{
				self::aya($myLang, $translate);
			}

			foreach ($read_mode as $mode => $value)
			{
				$myMode = $mode;
				if($value['default'])
				{
					$myMode = null;
				}

				self::sura($myLang, $myMode);
				self::page($myLang, $myMode);
				self::juz($myLang, $myMode);
				self::hizb($myLang, $myMode);
				self::rub($myLang, $myMode);
				self::nim($myLang, $myMode);
			}
		}
	}


	private static function sura($_lang = null, $_mode = null)
	{
		$filename = 'quransura';

		$myLang = null;
		if($_lang)
		{
			$myLang = $_lang. '/';
			$filename .= '-'. $_lang;
		}

		$get_url = [];
		if($_mode)
		{
			$get_url['mode'] = $_mode;
			$filename .= '-'. $_mode;
		}

		if($get_url)
		{
			$get_url = '?'. http_build_query($get_url);
		}
		else
		{
			$get_url = null;
		}

		$sitemap  = \dash\utility\sitemap::new_sitemap();

		$sitemap->setFilename($filename);

		for ($i=1; $i <= 114 ; $i++)
		{
			$myUrl = $myLang. 's'.$i. $get_url;

			$sitemap->addItem($myUrl, '0.9', 'monthly', null);
		}

		$sitemap->endSitemap();

		\dash\utility\sitemap::set_result($filename, 114);
	}


	private static function page($_lang = null, $_mode = null)
	{
		$filename = 'quranpage';
		$myLang = null;
		if($_lang)
		{
			$myLang = $_lang. '/';
			$filename .= '-'. $_lang;
		}

		$get_url = [];
		if($_mode)
		{
			$get_url['mode'] = $_mode;
			$filename .= '-'. $_mode;
		}

		if($get_url)
		{
			$get_url = '?'. http_build_query($get_url);
		}
		else
		{
			$get_url = null;
		}

		$sitemap  = \dash\utility\sitemap::new_sitemap();

		$sitemap->setFilename($filename);

		for ($i=1; $i <= 604 ; $i++)
		{
			$myUrl = $myLang. 'p'.$i. $get_url;

			$sitemap->addItem($myUrl, '0.8', 'monthly', null);
		}

		$sitemap->endSitemap();

		\dash\utility\sitemap::set_result($filename, 604);
	}


	private static function juz($_lang = null, $_mode = null)
	{
		$filename = 'quranjuz';
		$myLang = null;
		if($_lang)
		{
			$myLang = $_lang. '/';
			$filename .= '-'. $_lang;
		}

		$get_url = [];
		if($_mode)
		{
			$get_url['mode'] = $_mode;
			$filename .= '-'. $_mode;
		}

		if($get_url)
		{
			$get_url = '?'. http_build_query($get_url);
		}
		else
		{
			$get_url = null;
		}

		$sitemap  = \dash\utility\sitemap::new_sitemap();

		$sitemap->setFilename($filename);

		for ($i=1; $i <= 30 ; $i++)
		{
			$myUrl = $myLang. 'j'.$i. $get_url;

			$sitemap->addItem($myUrl, '0.8', 'monthly', null);
		}

		$sitemap->endSitemap();

		\dash\utility\sitemap::set_result($filename, 30);
	}

	private static function aya($_lang = null, $_translate = null, $_mode = null)
	{
		$filename = 'quranaya';
		$myLang = null;
		if($_lang)
		{
			$myLang = $_lang. '/';
			$filename .= '-'. $_lang;
		}

		$filename .= '-'. $_translate;

		$get_url = [];
		$get_url['t'] = $_translate;

		if($_mode)
		{
			$get_url['mode'] = $_mode;
			$filename .= '-'. $_mode;
		}

		if($get_url)
		{
			$get_url = '?'. http_build_query($get_url);
		}
		else
		{
			$get_url = null;
		}


		$sitemap  = \dash\utility\sitemap::new_sitemap();

		$sitemap->setFilename($filename);

		for ($i=1; $i <= 6236 ; $i++)
		{
			$myUrl = $myLang. 'a'.$i. $get_url;

			$sitemap->addItem($myUrl, '0.7', 'monthly', null);
		}

		$sitemap->endSitemap();

		\dash\utility\sitemap::set_result($filename, 6236);
	}

	private static function hizb($_lang = null, $_mode = null)
	{
		$filename = 'quranhizb';

		$myLang = null;
		if($_lang)
		{
			$myLang = $_lang. '/';
			$filename .= '-'. $_lang;
		}

		$get_url = [];
		if($_mode)
		{
			$get_url['mode'] = $_mode;
			$filename .= '-'. $_mode;
		}

		if($get_url)
		{
			$get_url = '?'. http_build_query($get_url);
		}
		else
		{
			$get_url = null;
		}

		$sitemap  = \dash\utility\sitemap::new_sitemap();

		$sitemap->setFilename($filename);

		for ($i=1; $i <= 60 ; $i++)
		{
			$myUrl = $myLang. 'h'.$i. $get_url;

			$sitemap->addItem($myUrl, '0.9', 'monthly', null);
		}

		$sitemap->endSitemap();

		\dash\utility\sitemap::set_result($filename, 60);
	}

	private static function rub($_lang = null, $_mode = null)
	{
		$filename = 'quranrub';

		$myLang = null;
		if($_lang)
		{
			$myLang = $_lang. '/';
			$filename .= '-'. $_lang;
		}

		$get_url = [];
		if($_mode)
		{
			$get_url['mode'] = $_mode;
			$filename .= '-'. $_mode;
		}

		if($get_url)
		{
			$get_url = '?'. http_build_query($get_url);
		}
		else
		{
			$get_url = null;
		}

		$sitemap  = \dash\utility\sitemap::new_sitemap();

		$sitemap->setFilename($filename);

		for ($i=1; $i <= 240 ; $i++)
		{
			$myUrl = $myLang. 'r'.$i. $get_url;

			$sitemap->addItem($myUrl, '0.9', 'monthly', null);
		}

		$sitemap->endSitemap();

		\dash\utility\sitemap::set_result($filename, 240);
	}

	private static function nim($_lang = null, $_mode = null)
	{
		$filename = 'qurannim';

		$myLang = null;
		if($_lang)
		{
			$myLang = $_lang. '/';
			$filename .= '-'. $_lang;
		}

		$get_url = [];
		if($_mode)
		{
			$get_url['mode'] = $_mode;
			$filename .= '-'. $_mode;
		}

		if($get_url)
		{
			$get_url = '?'. http_build_query($get_url);
		}
		else
		{
			$get_url = null;
		}

		$sitemap  = \dash\utility\sitemap::new_sitemap();

		$sitemap->setFilename($filename);

		for ($i=1; $i <= 120 ; $i++)
		{
			$myUrl = $myLang. 'n'.$i. $get_url;

			$sitemap->addItem($myUrl, '0.9', 'monthly', null);
		}

		$sitemap->endSitemap();

		\dash\utility\sitemap::set_result($filename, 120);
	}

}
?>