<?php
namespace content_m\mag\home;


class view
{
	public static function config()
	{
		$get_post_counter_args = [];
		$filterArray           = [];

		$args   = [];

		$option =
		[
			'sort'  => \dash\request::get('sort'),
			'order' => \dash\request::get('order'),
		];

		if(!$option['order'])
		{
			$option['order'] = 'DESC';
		}

		if(!$option['sort'])
		{
			$option['sort'] = 'id';
		}

		if(\dash\request::get('status'))
		{
			$args['status'] = \dash\request::get('status');
			$filterArray['status'] = $args['status'];
		}

		if(\dash\request::get('type'))
		{
			$args['type']        = \dash\request::get('type');
			$filterArray['type'] = $args['type'];
		}

		if(\dash\request::get('page'))
		{
			$args['page']        = \dash\request::get('page');
			$filterArray['page'] = $args['page'];
		}

		if(\dash\request::get('sura'))
		{
			$args['sura']        = \dash\request::get('sura');
			$filterArray['sura'] = $args['sura'];
		}

		if(\dash\request::get('aya'))
		{
			$args['aya']        = \dash\request::get('aya');
			$filterArray['aya'] = $args['aya'];
		}

		if(\dash\request::get('type'))
		{
			$args['type'] = \dash\request::get('type');
		}



		\dash\data::dataTable(\lib\app\mag::list(null, $args, $option));

		// set dataFilter
		$dataFilter = \dash\app\sort::createFilterMsg(null, $filterArray);
		\dash\data::dataFilter($dataFilter);

	}
}
?>