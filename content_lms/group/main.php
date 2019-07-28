<?php
namespace content_lms\group;


class main
{
	public static function group()
	{
		$id     = \dash\request::get('id');
		$result = \lib\app\lm_group::get($id);
		if(!$result)
		{
			\dash\header::status(403, T_("Invalid group id"));
		}


		\dash\data::groupDataRow($result);


	}
}
?>