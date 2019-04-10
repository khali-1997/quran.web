<?php
namespace lib\app;


class qari
{

	public static function get_by_slug($_slug, $_key = null)
	{
		$list =
		[

			'muhammad_jibreel' => ['name'  => T_('Muhammad jibreel'), 				'country' => 'EG'],
			'mustafa_ismail'   => ['name'  => T_('Mustafa Ismail'), 				'country' => 'EG'],
			'abdulbasit'       => ['name'  => T_('AbdulBaset AbdulSamad'), 			'country' => 'EG'],
			'afasy'            => ['name'  => T_('Mishary Rashid Alafasy'), 		'country' => 'KW'],
			'husary'           => ['name'  => T_('Mahmoud Khalil Al-Husary'), 		'country' => 'EG'],
			'minshawi'         => ['name'  => T_('Mohamed Siddiq al-Minshawi'), 	'country' => 'EG'],
			'rifai'            => ['name'  => T_('Hani ar-Rifai'), 					'country' => 'SA'],
			'shatri'           => ['name'  => T_('Abu Bakr al-Shatri'), 			'country' => 'SA'],
			'shuraym'          => ['name'  => T_('Sa`ud ash-Shuraym'), 				'country' => 'SA'],
			'sudais'           => ['name'  => T_('Abdur-Rahman as-Sudais'), 		'country' => 'SA'],
			'balayev'          => ['name'  => T_('Rasim Balayev'), 					'country' => null],
			'ibrahimwalk'      => ['name'  => T_('Ibrahim Walk'), 					'country' => null],
			'parhizgar'        => ['name'  => T_('Shahriyar parhizgar'), 			'country' => 'IR'],
			'mansouri'         => ['name'  => T_('Karim mansouri'), 				'country' => 'IR'],
			'qaraati'          => ['name'  => T_('Mohsen Qaraati'), 				'country' => 'IR'],
			'fouladvand'       => ['name'  => T_('Mohammad mahdi fouladvand'), 		'country' => 'IR'],
			'makarem'          => ['name'  => T_('Naser makarem shirazi'), 			'country' => 'IR'],
		];

		if(isset($list[$_slug]))
		{
			if($_key)
			{
				if(isset($list[$_slug][$_key]))
				{
					return $list[$_slug][$_key];
				}
				else
				{
					return null;
				}
			}
			else
			{
				return $list[$_slug];
			}
		}
		return null;
	}


	public static function get_aya_audio($_sura, $_aya, $_meta = [], $_get_key = false)
	{
		if(!isset($_meta['qari']))
		{
			$_meta['qari'] = 1;
		}

		if(!ctype_digit($_meta['qari']))
		{
			$_meta['qari'] = 1;
		}

		$get_url = self::get_aya_url($_meta['qari'], $_sura, $_aya, $_get_key);
		return $get_url;
	}


	public static function qari_image($_slug)
	{
		$url = \dash\url::site(). '/static/images/qariyan/';
		$url .= $_slug. '.png';
		return $url;
	}

	private static function master_path()
	{
		return 'https://dl.salamquran.com/ayat/';
	}

	public static function list()
	{
		$Mujawwad   =	T_('Mujawwad');
		$Murattal   = T_('Murattal');
		$Translate  = T_('Translate');
		$Commentary = T_('Commentary');
		$Muallim    = T_('Muallim');

		$list =
		[
			// ----------------- abdoabaset
			['index' => 1000, 'lang' => 'ar', 'type' => $Mujawwad, 'addr'  => 'abdulbasit-mujawwad-128/', 'slug'  => 'abdulbasit', 'name' => self::get_by_slug('abdulbasit', 'name'), 'default' => false],
			['index' => 1001, 'lang' => 'ar', 'type' => $Murattal, 'addr'  => 'abdulbasit-murattal-192/', 'slug'  => 'abdulbasit', 'name' => self::get_by_slug('abdulbasit', 'name'), ],

			// ----------------- afasy
			['index' => 1020, 'lang' => 'ar', 'type' => $Murattal, 'addr'  => 'afasy-murattal-192/', 'slug'  => 'afasy', 'name' => self::get_by_slug('afasy', 'name'), 'default' => true],

			// ----------------- husary
			['index' => 1030, 'lang' => 'ar', 'type' => $Murattal, 'addr'  => 'husary-murattal-128/', 'slug'  => 'husary', 'name' => self::get_by_slug('husary', 'name'),],
			['index' => 1031, 'lang' => 'ar', 'type' => $Mujawwad, 'addr'  => 'husary-mujawwad-128/', 'slug'  => 'husary', 'name' => self::get_by_slug('husary', 'name'),],
			['index' => 1032, 'lang' => 'ar', 'type' => $Muallim, 'addr'  => 'husary-muallim-128/', 'slug'  => 'husary', 'name' => self::get_by_slug('husary', 'name'), ],

			// ----------------- minshawi
			['index' => 1040, 'lang' => 'ar', 'type' => $Murattal, 'addr'  => 'minshawi-murattal-128/', 'slug'  => 'minshawi', 'name' => self::get_by_slug('minshawi', 'name'),],
			['index' => 1041, 'lang' => 'ar', 'type' => $Mujawwad, 'addr'  => 'minshawi-mujawwad-128/', 'slug'  => 'minshawi', 'name' => self::get_by_slug('minshawi', 'name'),],

			// ----------------- rifai
			['index' => 1050, 'lang' => 'ar', 'type' => $Murattal, 'addr'  => 'rifai-murattal-192/', 'slug'  => 'rifai', 'name' => self::get_by_slug('rifai', 'name'),],

			// ----------------- shatri
			['index' => 1060, 'lang' => 'ar', 'type' => $Murattal, 'addr'  => 'shatri-murattal-128/', 'slug'  => 'shatri', 'name' => self::get_by_slug('shatri', 'name'),],

			// ----------------- shuraym
			['index' => 1070, 'lang' => 'ar', 'type' => $Murattal, 'addr'  => 'shuraym-murattal-128/', 'slug'  => 'shuraym', 'name' => self::get_by_slug('shuraym', 'name'),],

			// ----------------- sudais
			['index' => 1080, 'lang' => 'ar', 'type' => $Murattal, 'addr'  => 'sudais-murattal-192/', 'slug'  => 'sudais', 'name' => self::get_by_slug('sudais', 'name'),],

			// ----------------- trnaslate - az - balayev
			['index' => 1081, 'lang' => 'az', 'type' => $Translate, 'addr'  => 'translation-az-azerbaijani-128/', 'slug'  => 'balayev', 'name' => self::get_by_slug('balayev', 'name'),],

			// ----------------- trnaslate - en - ibrahimwalk
			['index' => 1082, 'lang' => 'en', 'type' => $Translate, 'addr'  => 'translation-en-sahih_international-32/', 'slug'  => 'ibrahimwalk', 'name' => self::get_by_slug('ibrahimwalk', 'name'),],

			// ----------------- parhizgar
			['index' => 1090, 'lang' => 'fa', 'type' => $Murattal, 'addr'  => 'parhizgar-murattal-48/', 'slug'  => 'parhizgar', 'name' => self::get_by_slug('parhizgar', 'name'), 'default_lang' => true],

			// ----------------- mansouri
			['index' => 1091, 'lang' => 'fa', 'type' => $Murattal, 'addr'  => 'mansouri-murattal-40/', 'slug'  => 'mansouri', 'name' => self::get_by_slug('mansouri', 'name'), ],

			// ----------------- trnaslate - fa - qeraati
			['index' => 1086, 'lang' => 'fa', 'type' => $Commentary, 'addr'  => 'translation-fa-qaraati-16/', 'slug'  => 'qaraati', 'name' => self::get_by_slug('qaraati', 'name'), 'default_lang' => false],

			// ----------------- trnaslate - fa - fouladvand
			['index' => 1083, 'lang' => 'fa', 'type' => $Translate, 'addr'  => 'translation-fa-foladvand-40/', 'slug'  => 'fouladvand', 'name' => self::get_by_slug('fouladvand', 'name'), ],

			// ----------------- trnaslate - fa - makarem
			['index' => 1084, 'lang' => 'fa', 'type' => $Translate, 'addr'  => 'translation-fa-makarem-16/', 'slug'  => 'makarem', 'name' => self::get_by_slug('makarem', 'name'), ],


		];

		return $list;
	}

	private static function ready($_data)
	{
		$get                 = \dash\request::get();
		$get['qari']         = $_data['index'];
		$_data['url']        = \dash\url::that(). '?'. http_build_query($get);
		$_data['addr']       = self::master_path(). $_data['addr'];
		$_data['image']      = self::qari_image($_data['slug']);
		$_data['short_name'] = T_($_data['slug']);
		return $_data;
	}

	public static function site_list()
	{
		$list         = self::list();
		$list         = array_map(['self', 'ready'], $list);
		$current_lang = \dash\language::current();
		$lang_list    = [];
		$all_list     = [];

		foreach ($list as $key => $value)
		{
			if(isset($value['lang']) && $value['lang'] === $current_lang)
			{
				$lang_list[] = $value;
			}
			else
			{
				$all_list[] = $value;
			}
		}

		$site_list = array_merge($lang_list, $all_list);

		return $site_list;
	}

	public static function load($_id)
	{
		if(!$_id || !ctype_digit($_id))
		{
			$_id = 1;
		}

		$list    = self::list();

		$current_lang = \dash\language::current();
		$default_lang = null;
		$default      = null;
		$load         = null;

		foreach ($list as $key => $value)
		{
			if(intval($value['index']) === intval($_id))
			{
				$load = $value;
			}

			if(isset($value['default_lang']) && $value['default_lang'] && isset($value['lang']) && $value['lang'] === $current_lang)
			{
				$default_lang = $value;
			}

			if(isset($value['default']) && $value['default'])
			{
				$default = $value;
			}
		}

		if(!$load)
		{
			if(!$default_lang)
			{
				$load = $default;
			}
			else
			{
				$load = $default_lang;
			}
		}

		$load = self::ready($load);

		return $load;
	}


	public static function get_aya_url($_gari, $_sura, $_aya, $_get_key = false)
	{

		$_sura = intval($_sura);
		$_aya  = intval($_aya);

		if($_sura < 10)
		{
			$_sura = '00'. $_sura;
		}
		elseif($_sura < 100)
		{
			$_sura = '0'. $_sura;
		}

		if($_aya < 10)
		{
			$_aya = '00'. $_aya;
		}
		elseif($_aya < 100)
		{
			$_aya = '0'. $_aya;
		}

		if($_get_key)
		{
			$key = $_sura. '_'. $_aya;
			return $key;
		}
		else
		{
			$load = self::load($_gari);


			if(isset($load['addr']))
			{
				$addr = $load['addr'];

				if($load['slug'] === 'qaraati')
				{
					$qeraati = \lib\app\qeraati_audio::get($_sura. $_aya);
					if($qeraati)
					{
						$url = $addr. $qeraati. '.mp3';
					}
					else
					{
						$url = null;
					}
				}
				else
				{
					$url = $addr. $_sura. $_aya. '.mp3';
				}
				return $url;
			}
			else
			{
				return false;
			}

		}
	}
}
?>