<?php
namespace lib\app;


class mag
{

	public static function add($_args)
	{
		\dash\app::variable($_args);

		if(!\dash\user::id())
		{
			\dash\notif::error(T_("User not found"));
			return false;
		}

		$type  = \dash\app::request('type');
		if(!in_array($type, ['aya', 'sura', 'page']))
		{
			\dash\notif::error(T_("Invalid type"));
			return false;
		}

		$post = \dash\app::request('post');
		if(!$post)
		{
			\dash\notif::error(T_("Plese choose one magazine"));
			return false;
		}

		$load_post = \dash\app\posts::get($post);
		if(!$load_post)
		{
			\dash\notif::error(T_("Invalid post"));
			return false;
		}

		$insert               = [];
		$duplicate            = [];
		$insert['post_id']    = \dash\coding::decode($post);
		$duplicate['post_id'] = $insert['post_id'];
		$insert['type']       = $type;
		$duplicate['type']    = $insert['type'];
		$insert['creator']    = \dash\user::id();

		switch ($type)
		{
			case 'sura':
				$surah = \dash\app::request('surah');
				$surah = intval($surah);
				if($surah < 1 || $surah > 114)
				{
					\dash\notif::error(T_("Invalid sura id"));
					return false;
				}
				$insert['sura']    = $surah;
				$duplicate['sura'] = $insert['sura'];
				break;

			case 'aya':
				$surah = \dash\app::request('surah');
				$surah = intval($surah);
				if($surah < 1 || $surah > 114)
				{
					\dash\notif::error(T_("Invalid sura id"));
					return false;
				}

				$aya       = \dash\app::request('aya');
				$aya       = intval($aya);
				$sura_ayas = \lib\app\sura::detail($surah, 'ayas');

				if($aya < 1 || $aya > $sura_ayas)
				{
					\dash\notif::error(T_("This sura have :val aya", ['val' => \dash\utility\human::fitNumber($sura_ayas)]));
					return false;
				}

				$insert['sura']    = $surah;
				$insert['aya']     = $aya;
				$duplicate['sura'] = $insert['sura'];
				$duplicate['aya']  = $insert['aya'];
				break;

			case 'page':
				$page = \dash\app::request('page');
				$page = intval($page);
				if($page < 1 || $page > 604)
				{
					\dash\notif::error(T_("Invalid page number"));
					return false;
				}
				$insert['page']    = $page;
				$duplicate['page'] = $insert['page'];
				break;


			default:
				\dash\notif::error(T_("This method is not supported"));
				return false;
				break;
		}

		if(!empty($insert))
		{
			$duplicate['limit'] = 1;
			$check_duplicate    = \lib\db\mags::get($duplicate);
			if(isset($check_duplicate['id']))
			{
				\dash\notif::error(T_("Duplicate connection mags to quran"), ['element' => ['post_id', 'page', 'aya', 'surah']]);
				return false;
			}

			$insert_ok          = \lib\db\mags::insert($insert);
			if($insert_ok)
			{
				\dash\notif::ok(T_("The magazine connect to quran"));
				return true;
			}
		}
	}


	public static function list($_string = null, $_args = null, $_option = null)
	{
		$list = \lib\db\mags::search($_string, $_args, $_option);
		if(is_array($list))
		{
			$list = array_map(['self', 'ready'], $list);
		}

		return $list;
	}


	public static function ready($_data)
	{
		$result = [];
		if(!is_array($_data))
		{
			return $result;
		}

		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'mag_id':
				case 'post_id':
					$result[$key] = \dash\coding::encode($value);
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}


	public static function remove($_id)
	{
		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Id not set"));
			return false;
		}

		$load = \lib\db\mags::get_to_remove($id);
		if($load)
		{
			\lib\db\mags::remove($id);
			\dash\notif::ok(T_("Connection mag to quran removed"));
			return true;
		}
		else
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}
	}
}
?>