<?php
namespace content\surah;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Sura list'));

		$args =
		[
			'order' => \dash\request::get('order'),
			'pagenation' => false,
		];

		if(\dash\request::get('sort'))
		{
			$args['sort'] = \dash\request::get('sort');
		}

		$dataTable = \lib\app\sura::db_list(null, $args);
		\dash\data::dataTable($dataTable);

		$sortLink  = \dash\app\sort::make_sortLink(\lib\app\sura::$sort_field, \dash\url::this());
		\dash\data::sortLink($sortLink);

	}
}
?>