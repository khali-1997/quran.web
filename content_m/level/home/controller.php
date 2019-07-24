<?php
namespace content_m\level\home;


class controller
{
	public static function routing()
	{
		if(!\dash\request::get('gid'))
		{
			\dash\redirect::to(\dash\url::here());
		}

		$learngroup_id = \dash\coding::decode(\dash\request::get('gid'));
		if(!$learngroup_id)
		{
			\dash\header::status(404, T_("Invalid learngroup id"));
		}

	}
}
?>