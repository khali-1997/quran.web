<?php
namespace content\mag;

class view extends \content_support\ticket\contact_ticket\view
{
	public static function config()
	{
		\lib\badge::set('OpenMag');

		\dash\data::display_magAdmin('content/mag/dashboard.html');
		\dash\data::page_title(T_('Contact Us'));
		\dash\data::page_desc(T_("Help us improve SalamQuran project"));

		$mag_count = \dash\app\posts::category_count();
		\dash\data::categoryCount($mag_count);
		self::codeurl();
	}

}
?>

