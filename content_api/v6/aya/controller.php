<?php
namespace content_api\v6\aya;


class controller
{

	public static function routing()
	{
		\content_api\v6\access::check();

		$subchild = \dash\url::subchild();
		if($subchild)
		{
			\content_api\v6::no(404);
		}

		$data = self::aya();
		\content_api\v6::bye($data);
	}

	private static function aya()
	{
		$id = \dash\request::get('id');
		if(!$id)
		{
			\dash\notif::error(T_("Parameter id is required"));
			return false;
		}

		if(!is_numeric($id))
		{
			\dash\notif::error(T_("Id must be a number"));
			return false;
		}

		$id = intval($id);
		if($id < 1 || $id > 6236)
		{
			\dash\notif::error(T_("Id is out of range, Id must between 1 and 6236"));
			return false;
		}

		$load = \lib\db\quran::get(['index' => $id]);
		if(isset($load[0]))
		{
			$load                = $load[0];
			$load['sura_detail'] = \lib\app\sura::detail($load['sura']);
			return $load;
		}
		else
		{
			\dash\notif::error(T_("Id not found"));
			\dash\log::set('apiBugAyaNotFound');
			return false;
		}

	}

}
?>