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

		$args =
		[
			'sort'  => \dash\request::get('sort'),
			'order' => \dash\request::get('order'),
		];

		if(!$args['order'])
		{
			$args['order'] = 'ASC';
		}


		if(!$args['sort'])
		{
			$args['sort'] = 'sort';
		}

		$args['user_id'] = \dash\user::id();

		// if(\dash\request::get('status'))
		// {
		// 	$args['status'] = \dash\request::get('status');
		// }

		// if(\dash\request::get('type'))
		// {
		// 	$args['type'] = \dash\request::get('type');
		// }

		// if(\dash\request::get('gender'))
		// {
		// 	$args['gender'] = \dash\request::get('gender');
		// }

		// if(\dash\request::get('position'))
		// {
		// 	$args['position'] = \dash\request::get('position');
		// }

		// if(\dash\request::get('capacity'))
		// {
		// 	$args['capacity'] = \dash\request::get('capacity');
		// }

		$sortLink  = \dash\app\sort::make_sortLink(\lib\app\khatm::$sort_field, \dash\url::this());
		$dataTable = \lib\app\khatm::list(null, $args);

		\dash\data::sortLink($sortLink);
		\dash\data::dataTable($dataTable);




	}
}
?>