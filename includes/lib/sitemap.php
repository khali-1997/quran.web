<?php
namespace lib;


class sitemap
{
	public static function create()
	{
		self::sura();
		self::page();
		self::juz();
	}


	private static function sura()
	{
		$site_url = \dash\url::site().'/';

		$sitemap  = new \dash\utility\sitemap_generator($site_url , root.'public_html/', 'sitemap' );

		$sitemap->setFilename('quransura');

		for ($i=1; $i <= 114 ; $i++)
		{
			$myUrl = 's'.$i;

			$sitemap->addItem($myUrl, '0.9', 'monthly', null);
		}

		$sitemap->createSitemapIndex();

		\dash\utility\sitemap::show_result('quransura', 114);
	}


	private static function page()
	{
		$site_url = \dash\url::site().'/';

		$sitemap  = new \dash\utility\sitemap_generator($site_url , root.'public_html/', 'sitemap' );

		$sitemap->setFilename('quranpage');

		for ($i=1; $i <= 604 ; $i++)
		{
			$myUrl = 'p'.$i;

			$sitemap->addItem($myUrl, '0.8', 'monthly', null);
		}

		$sitemap->createSitemapIndex();

		\dash\utility\sitemap::show_result('page', 604);
	}


	private static function juz()
	{
		$site_url = \dash\url::site().'/';

		$sitemap  = new \dash\utility\sitemap_generator($site_url , root.'public_html/', 'sitemap' );

		$sitemap->setFilename('quranjuz');

		for ($i=1; $i <= 30 ; $i++)
		{
			$myUrl = 'j'.$i;

			$sitemap->addItem($myUrl, '0.8', 'monthly', null);
		}

		$sitemap->createSitemapIndex();

		\dash\utility\sitemap::show_result('juz', 30);
	}
}
?>