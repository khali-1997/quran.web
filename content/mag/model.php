<?php
namespace content\mag;


class model extends \content_support\ticket\contact_ticket\model
{
	public static function post()
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		parent::post();

		\dash\notif::ok(T_("Your request was saved"));
	}
}
?>
