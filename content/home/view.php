<?php
namespace content\home;

class view
{
	public static function config()
	{
		// $title = T_('Quran');
		// $desc  = T_("Say hello to Quran!"). ' '. T_("Quran is calling you.");

		self::set_best_title();

		if(\dash\data::sureLoaded())
		{
			$translation_list = \lib\app\translate::translate_site_list();
			\dash\data::translationList($translation_list);

			\dash\data::bodyclass('holyQuran');
		}

		$list = \lib\app\qari::site_list();
		\dash\data::qariList($list);

		$qariLoaded = \lib\app\qari::load(\dash\request::get('qari'));
		\dash\data::qariLoaded($qariLoaded);

		$readMode = \lib\app\read_mode::site_list();
		\dash\data::readModeList($readMode);

		$readModeLoaded = \lib\app\read_mode::load(\dash\request::get('mode'));
		\dash\data::readModeLoaded($readModeLoaded);

		$fontStyle = \lib\app\font_style::site_list();
		\dash\data::fontStyleList($fontStyle);

		$fontStyleLoaded = \lib\app\font_style::load(\dash\request::get('font'));
		\dash\data::fontStyleLoaded($fontStyleLoaded);

		$pageStyle = 'uthmani';
		if(\dash\request::get('font'))
		{
			switch (\dash\request::get('font'))
			{
				case 'uthmani':
				case 'noorehuda':
				case 'iransans':
					$pageStyle = \dash\request::get('font');
					break;

				default:
					$pageStyle = null;
					break;
			}
		}
		\dash\data::pageStyle($pageStyle);

		\dash\data::zoomInUrl(\lib\app\font_style::zoom_in_url());
		\dash\data::zoomOutUrl(\lib\app\font_style::zoom_out_url());

	}


	private static function set_best_title()
	{
		$type  = \dash\data::quranLoaded_find_by();
		$title = null;
		$desc  = null;

		$find_id = \dash\data::quranLoaded_find_id();

		switch ($type)
		{
			case 'juz':
				$title = T_('Juz'). ' '. \dash\utility\human::fitNumber($find_id);
				$desc  = T_('Quran'). ' #'. \dash\utility\human::fitNumber($find_id). ' '. T_('juz');
				break;

			case 'hizb':
				$title = T_('Hizb'). ' '. \dash\utility\human::fitNumber($find_id);
				$desc  = T_('Quran'). ' #'. \dash\utility\human::fitNumber($find_id). ' '. T_('hizb');
				break;

			case 'rub':
				$title = T_('Rub'). ' '. \dash\utility\human::fitNumber($find_id);
				$desc  = T_('Quran'). ' #'. \dash\utility\human::fitNumber($find_id). ' '. T_('rub');
				break;

			case 'nim':
				$title = T_('Half of hizb'). ' '. \dash\utility\human::fitNumber($find_id);
				$desc  = T_('Quran'). ' #'. \dash\utility\human::fitNumber($find_id). ' '. T_('Half of hizb');
				break;

			case 'aya':
				$title = T_('Aya'). ' '. \dash\utility\human::fitNumber($find_id);
				$desc  = T_('Quran'). ' #'. \dash\utility\human::fitNumber($find_id). ' '. T_('aya');
				break;

			case 'page':
				$title = T_('Page'). ' '. \dash\utility\human::fitNumber($find_id);
				$desc  = T_('Quran'). ' #'. T_('page'). \dash\utility\human::fitNumber($find_id);
				break;

			case 'twopage':
				$page  = \dash\data::quranLoaded_find_id();
				$page1 = null;
				$page2 = null;
				if(isset($page['page1']))
				{
					$page1 = $page['page1'];
				}

				if(isset($page['page2']))
				{
					$page2 = $page['page2'];
				}

				if($page1 && $page2)
				{
					$title = T_('Pages'). ' '. \dash\utility\human::fitNumber($page1). ' '. T_(","). ' '. \dash\utility\human::fitNumber($page2);
					$desc  = T_('Quran'). ' #' . T_('page'). ' '. \dash\utility\human::fitNumber($page1). ' - '. \dash\utility\human::fitNumber($page2);
				}
				elseif($page1)
				{
					$title = T_('Page'). ' '. \dash\utility\human::fitNumber($page1);
					$desc  = T_('Quran'). ' #'. \dash\utility\human::fitNumber($page1). ' '. T_('page');
				}
				self::fillDownloadLink($page1);
				break;

			case 'onepage':
			default:
				if(!\dash\url::directory())
				{
					$title = \dash\data::site_title();
					$desc  = \dash\data::site_desc();
					self::fillDownloadLink();

					$doners = \lib\app\donate::doners_list();

					if(isset($doners['up_to_10_milion']))
					{
						$doners = $doners['up_to_10_milion'];
					}
					elseif(isset($doners['up_to_1_milion']))
					{
						$doners = $doners['up_to_1_milion'];
					}
					elseif(isset($doners['up_to_100_thousand']))
					{
						$doners = $doners['up_to_100_thousand'];
					}
					elseif(isset($doners['other']))
					{
						$doners = $doners['other'];
					}

					\dash\data::lastDoners($doners);
				}
				else
				{
					$page  = \dash\data::quranLoaded_find_id();
					$page1 = null;

					if(isset($page['page1']))
					{
						$page1 = $page['page1'];
					}

					self::fillDownloadLink($page1);

					$title = T_('Page'). ' '. \dash\utility\human::fitNumber($page1);
					$desc  = T_('Quran'). ' #'. T_('page'). \dash\utility\human::fitNumber($page1);
				}

				break;


			case 'sura':
				if(\dash\data::suraDetail())
				{
					$title = T_('Surah'). ' '. T_(\dash\data::suraDetail_tname());
					// add surah name
					$desc  = T_('Quran'). ' #'. \dash\utility\human::fitNumber(\dash\data::suraDetail_index()). ' '. T_('surah');
					// add total ayah number
					$desc  .= ' | '. \dash\utility\human::fitNumber(\dash\data::suraDetail_ayas()). ' '. T_('ayah');
					// add type
					$desc  .= ' | '. T_(\dash\data::suraDetail_type());
					// add juz
					if(\dash\data::suraDetail_alljuz())
					{
						$desc  .= ' | '. T_('juz'). \dash\utility\human::fitNumber(\dash\data::suraDetail_ayas());
					}

					// add translated name
					$desc  .= ' | '. T_(\dash\data::suraDetail_ename());
					// add arabic name
					$desc  .= ' | '. \dash\data::suraDetail_name();
				}
				break;


			// default:
			// 	$title = \dash\data::site_title();
			// 	$desc = \dash\data::site_desc();
			// 	break;
		}

		\dash\data::page_title($title);
		\dash\data::page_desc($desc);

	}


	private static function fillDownloadLink($_page = null)
	{
		if($_page === null)
		{
			$page_day = \lib\app\page_day::get();
			if(isset($page_day['page']))
			{
				// page of the day
				$_page = intval($page_day['page']);
			}
			else
			{
				// random page
				$_page = mt_rand(1, 604);
			}
		}

		$imgSrc = str_pad($_page, 3, '0', STR_PAD_LEFT);
		$imgSrc = 'https://dl.salamquran.com/images/v1/page'. $imgSrc. '.png';

		\dash\data::dl_pageNum($_page);
		\dash\data::dl_pageLink(\dash\url::kingdom().'/p'.$_page);
		\dash\data::dl_pageImage($imgSrc);
		\dash\data::dl_pageTitle(T_('Download image of Quran page :val', ['val' => $_page]));
	}
}
?>