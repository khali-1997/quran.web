<?php
namespace content_m\mag\home;


class view
{
	public static function config()
	{
		$get_post_counter_args = [];
		$filterArray           = [];

		$args =
		[
			'sort'  => \dash\request::get('sort'),
			'order' => \dash\request::get('order'),
		];


		if(\dash\request::get('status'))
		{
			$args['status'] = \dash\request::get('status');
			$filterArray['status'] = $args['status'];
		}


		if(\dash\request::get('type'))
		{
			$args['type'] = \dash\request::get('type');
		}

		if(!$args['order'])
		{
			$args['order'] = 'DESC';
		}


		if(!$args['sort'])
		{
			$args['sort'] = 'id';
		}



		\dash\data::dataTable(\lib\app\mag::list(null, $args));

		// set dataFilter
		$dataFilter = \dash\app\sort::createFilterMsg(null, $filterArray);
		\dash\data::dataFilter($dataFilter);

	}
}
?>