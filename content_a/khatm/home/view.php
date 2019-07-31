<?php
namespace content_a\khatm\home;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Khatm quran"));
		\dash\data::page_pictogram('book');


		\dash\data::badge_text(T_("Add new khatm"));
		\dash\data::badge_link(\dash\url::this(). '/add');

		$dataTable = \lib\app\khatm::public_list();
		\dash\data::dataTable($dataTable);



	}
}
?>