<?php
namespace lib\app\quran;


class aya
{
	public static function load($_type, $_id, $_aye = null, $_meta = [])
	{
		if(in_array($_meta['mode'], ['onepage', 'twopage']))
		{
			return \lib\app\quran\page::load(...func_get_args());
		}

		// load sure
		$_id = intval($_id);
		$result           = [];

		$get_quran         = [];

		if($_type === 'aya')
		{
			$get_quran['index'] = $_id;
		}
		else
		{
			$get_quran[$_type] = $_id;
		}

		if($_aye)
		{
			$get_quran['aya'] = $_aye;
		}

		$mode              = null;

		if(isset($_meta['mode']))
		{
			$mode = $_meta['mode'];
		}

		if(!in_array($mode, ['quran', 'default']))
		{
			$mode = null;
		}

		$startpage               = intval(\lib\app\sura::detail($_id, 'startpage'));
		$endpage                 = intval(\lib\app\sura::detail($_id, 'endpage'));

		$a                       = isset($_meta['a']) && is_numeric($_meta['a']) ? intval($_meta['a']) : 0;

		$pagination_current = null;
		$pagination         = null;

		// if(!$_aye)
		// {
		// 	$pagination_current = \lib\app\quran\pagination::pagination_current($_type, $_id, $_meta);
		// 	$pagination         = \lib\app\quran\pagination::pagination($_type, $_id, $_meta);
		// }

		if($_type === 'sura')
		{
			if(!$_aye)
			{
				// $get_quran['2.2'] = [' = 2.2 AND', " `aya` >= $pagination_current[0] AND `aya` <= $pagination_current[1] "];
			}
		}
		elseif($_type === 'juz')
		{
			// $get_quran['2.2'] = [' = 2.2 AND', " `page` >= $pagination_current[0] AND `page` <= $pagination_current[1] "];
		}
		elseif($_type === 'hizb')
		{
			// nothing
		}
		elseif($_type === 'page')
		{
			// nothing
		}
		elseif($_type === 'aya')
		{
			// nothing
		}
		elseif($_type === 'rub')
		{
			// nothing
		}

		$load           = \lib\db\quran_word::get($get_quran);

		$load_quran_aya = \lib\db\quran::get($get_quran);

		$quran_aya      = [];

		foreach ($load_quran_aya as $key => $value)
		{
			$quran_aya[$value['sura']. '_'. $value['aya']] = $value;
		}


		\lib\app\quran\translate::load($load, $_meta);

		$quran             = [];

		$first_verse = [];

		foreach ($load as $key => $value)
		{
			if($mode === 'quran')
			{
				$myKey      = 'line';
				$myArrayKey = $value['sura']. '_'. $value['line'];
			}
			else
			{
				$myKey      = 'aya';
				$myArrayKey = $value['sura']. '_'. $value['aya'];
			}

			if(!isset($quran[$myKey][$myArrayKey]['detail']))
			{
				$quran_aya_key = $value['sura']. '_'. $value['aya'];

				$verse_title = null;
				$verse_title .= T_("Quran");
				$verse_title .= ' - ';
				$verse_title .= T_("Sura");
				$verse_title .= ' ';
				$verse_title .= \dash\utility\human::fitNumber($value['sura']). ' '. T_(\lib\app\sura::detail($value['sura'], 'tname'));
				$verse_title .= ' - ';
				$verse_title .= T_("Aya");
				$verse_title .= ' ';
				$verse_title .= \dash\utility\human::fitNumber($value['aya']);

				$verse_url = \dash\url::kingdom();
				$verse_url .= '/s'. $value['sura'];
				$verse_url .= '/'. $value['aya'];

				if(!$first_verse)
				{
					$first_verse['title'] = $verse_title;
					$first_verse['url']   = $verse_url;
					$first_verse['audio'] = \lib\app\qari::get_aya_audio($value['sura'], $value['aya'], $_meta);
					$first_verse['juz']   = $value['juz'];
					$first_verse['page']  = $value['page'];
					$first_verse['sura']  = $value['sura'];
					$first_verse['index']  = $value['index'];
				}

				$quran[$myKey][$myArrayKey]['detail'] =
				[
					'index'         => isset($quran_aya[$quran_aya_key]['index']) ? $quran_aya[$quran_aya_key]['index'] : null,
					'text'          => isset($quran_aya[$quran_aya_key]['text']) ? \lib\app\quran::normalize($quran_aya[$quran_aya_key]['text']) : null,
					'simple'        => isset($quran_aya[$quran_aya_key]['simple']) ? $quran_aya[$quran_aya_key]['simple'] : null,
					'page'          => isset($quran_aya[$quran_aya_key]['page']) ? $quran_aya[$quran_aya_key]['page'] : null,
					'class_name'    => isset($quran_aya[$quran_aya_key]['page']) ? 'p'.$quran_aya[$quran_aya_key]['page'] : null,
					'juz'           => isset($quran_aya[$quran_aya_key]['juz']) ? $quran_aya[$quran_aya_key]['juz'] : null,
					'hizb'          => isset($quran_aya[$quran_aya_key]['hizb']) ? $quran_aya[$quran_aya_key]['hizb'] : null,
					'word'          => isset($quran_aya[$quran_aya_key]['word']) ? $quran_aya[$quran_aya_key]['word'] : null,
					'sajdah'        => isset($quran_aya[$quran_aya_key]['sajdah']) ? $quran_aya[$quran_aya_key]['sajdah'] : null,
					'sajdah_number' => isset($quran_aya[$quran_aya_key]['sajdah_number']) ? $quran_aya[$quran_aya_key]['sajdah_number'] : null,
					'rub'           => isset($quran_aya[$quran_aya_key]['rub']) ? $quran_aya[$quran_aya_key]['rub'] : null,
					'word'          => isset($quran_aya[$quran_aya_key]['word']) ? $quran_aya[$quran_aya_key]['word'] : null,
					'aya'           => $value['aya'],
					'sura'          => $value['sura'],
					'verse_key'     => $value['verse_key'],
					'verse_title'   => $verse_title,
					'verse_url'     => $verse_url,
					'page'          => $value['page'],
					'audio'         => \lib\app\qari::get_aya_audio($value['sura'], $value['aya'], $_meta),
					'translate'     => \lib\app\quran\translate::get_translation($value['sura'], $value['aya'], $_meta),
				];
			}

			if(!isset($quran[$myKey][$myArrayKey]['word']))
			{
				$quran[$myKey][$myArrayKey]['word'] = [];
			}
			if(isset($value['audio']))
			{
				$my_sura = intval($value['sura']);

				if($my_sura < 10)
				{
					$my_sura = '00'. $my_sura;
				}
				elseif($my_sura < 100)
				{
					$my_sura = '0'. $my_sura;
				}

				$value['audio'] = $my_sura. $value['audio'];
			}

			if(isset($value['text']))
			{
				$value['text'] = \lib\app\quran::normalize($value['text']);
			}

			if(isset($value['audio']))
			{
				$audio_key = $value['audio'];

				$value['audio_key'] = substr($audio_key, 4, 11);
			}

			if(isset($value['char_type']) && $value['char_type'] === 'end')
			{
				$value = \lib\app\quran::load_aya_detail($value, $_meta);
			}

			$quran[$myKey][$myArrayKey]['word'][] = $value;
		}

		$result['text']    = $quran;

		switch ($_type)
		{
			case 'sura':

				$next_sura = intval($_id) + 1;
				$prev_sura = intval($_id) - 1;

				if($next_sura > 114)
				{
					$next_sura = null;
				}

				if($prev_sura < 1)
				{
					$prev_sura = null;
				}

				$quran_detail = \lib\app\sura::detail($_id);

				$quran_detail['beginning'] = ['title' => T_("Beginning of Surah"), 'link' => \dash\url::that(). \lib\app\quran::url_query()];

				if($_aye)
				{
					$start_aya = 1;
					$end_aya   = intval(\lib\app\sura::detail($_id, 'ayas'));

					$next_aya = intval($_aye) + 1;
					$prev_aya = intval($_aye) - 1;

					if($next_aya > $end_aya)
					{
						if($next_sura)
						{
							$quran_detail['next'] =
							[
								'index'    => $next_aya,
								'url'      => \dash\url::kingdom(). '/s'. $next_sura. '/1?'. \dash\url::query(),
								'title'    => T_("Next Surah"),
								'subtitle' => T_(\lib\app\sura::detail($next_sura, 'tname')),
							];
						}
					}
					else
					{
						$quran_detail['next'] =
						[
							'index'    => $next_aya,
							'url'      => \dash\url::kingdom(). '/s'. $_id. '/'. $next_aya. \lib\app\quran::url_query(),
							'title'    => T_("Next aya"),
							'subtitle' => \dash\utility\human::fitNumber($next_aya),
						];
					}

					if($prev_aya < 1)
					{
						if($prev_sura)
						{
							$quran_detail['prev'] =
							[
								'index' => $prev_sura,
								'url'   => \dash\url::kingdom(). '/s'. $prev_sura. '/'. \lib\app\sura::detail($prev_sura, 'ayas') .\lib\app\quran::url_query(),
								'title' => T_("Previous Surah"),
								'subtitle' => T_(\lib\app\sura::detail($prev_sura, 'tname')),
							];
						}
					}
					else
					{
						$quran_detail['prev'] =
						[
							'index'    => $prev_aya,
							'url'      => \dash\url::kingdom(). '/s'. $_id. '/'. $prev_aya .\lib\app\quran::url_query(),
							'title'    => T_("Previous aya"),
							'subtitle' => \dash\utility\human::fitNumber($prev_aya),
						];
					}
				}
				else
				{
					if($next_sura)
					{
						$quran_detail['next'] =
						[
							'index'    => $next_sura,
							'url'      => \dash\url::kingdom(). '/s'. $next_sura. \lib\app\quran::url_query(),
							'title'    => T_("Next Surah"),
							'subtitle' => T_(\lib\app\sura::detail($next_sura, 'tname')),
						];
					}

					if($prev_sura)
					{
						$quran_detail['prev'] =
						[
							'index' => $prev_sura,
							'url'   => \dash\url::kingdom(). '/s'. $prev_sura. \lib\app\quran::url_query(),
							'title' => T_("Previous Surah"),
							'subtitle' => T_(\lib\app\sura::detail($prev_sura, 'tname')),
						];
					}
				}
				break;

			case 'juz':
				$quran_detail = self::make_next_prev($_id, 'j', 30,  T_("Beginning of juz"), T_("Juz"), T_("Next juz"), T_("Previous juz"));
				break;

			case 'hizb':
				$quran_detail = self::make_next_prev($_id, 'h', 60,  T_("Beginning of hizb"), T_("Hizb"), T_("Next hizb"), T_("Previous hizb"));
				break;

			case 'page':
				$quran_detail = self::make_next_prev($_id, 'p', 604,  T_("Beginning of page"), T_("page"), T_("Next page"), T_("Previous page"));
				break;

			case 'aya':
				$quran_detail = self::make_next_prev($_id, 'a', 6236,  T_("Beginning of aya"), T_("Aya"), T_("Next aya"), T_("Previous aya"));
				break;

			case 'rub':
				$quran_detail = self::make_next_prev($_id, 'r', 240,  T_("Beginning of rub"), T_("rub"), T_("Next rub"), T_("Previous rub"));
				break;

			case 'nim':
				$quran_detail = self::make_next_prev($_id, 'n', 120,  T_("Beginning of half hizb"), T_("half hizb"), T_("Next half hizb"), T_("Previous half hizb"));
				break;


			default:
				# code...
				break;
		}




		$quran_detail['first_verse'] = $first_verse;
		$result['detail']            = $quran_detail;
		$result['pagination']        = $pagination;
		$result['find_by']           = $_type;
		$result['find_id']           = $_id;
		$result['mode']              = $_meta['mode'];
		$result['translatelist']     = \lib\app\translate::current_list();

		// \dash\notif::api($result);


		return $result;
	}


	private static function make_next_prev($_id, $_url_key, $_max, $_biginning_title, $_title, $_next_title, $_prev_title)
	{

		$next = intval($_id) + 1;
		$prev = intval($_id) - 1;

		if($next > $_max)
		{
			$next = null;
		}

		if($prev < 1)
		{
			$prev = null;
		}

		$quran_detail = [];
		$quran_detail['beginning'] = ['title' => $_biginning_title, 'link' => \dash\url::that(). \lib\app\quran::url_query()];

		if($next)
		{
			$quran_detail['next'] =
			[
				'index'    => $next,
				'url'      => \dash\url::kingdom(). '/'. $_url_key. $next. \lib\app\quran::url_query(),
				'title'    => $_next_title,
				'subtitle' => $_title . ' '. \dash\utility\human::fitNumber($next),
			];
		}

		if($prev)
		{
			$quran_detail['prev'] =
			[
				'index'    => $prev,
				'url'      => \dash\url::kingdom(). '/'. $_url_key. $prev. \lib\app\quran::url_query(),
				'title'    => $_prev_title,
				'subtitle' => $_title . ' '. \dash\utility\human::fitNumber($prev),
			];
		}

		return $quran_detail;
	}
}
?>