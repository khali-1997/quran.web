<?php
namespace content_m\level\home;


class view
{
	public static function config()
	{
		\dash\permission::access('aLearnlevelView');
		\dash\data::page_title(T_("Donate learnlevel list"));
		\dash\data::page_desc(T_('Check list and search or filter them.'). ' '. T_('Also add or edit specefic item.'));

		\dash\data::page_pictogram('coffee');

		\dash\data::badge_link(\dash\url::here(). '/learn?gid='. \dash\request::get('gid'));
		\dash\data::badge_text(T_('Back to dashboard'));

		$search_string            = \dash\request::get('q');
		if($search_string)
		{
			\dash\data::page_title(\dash\data::page_title(). ' | '. T_('Search for :search', ['search' => $search_string]));
		}

		$learngroup_id = \dash\coding::decode(\dash\request::get('gid'));

		$args =
		[
			'sort'          => \dash\request::get('sort'),
			'order'         => \dash\request::get('order'),
			'learngroup_id' => $learngroup_id,
		];

		if(!$args['order'])
		{
			$args['order'] = 'ASC';
		}


		if(!$args['sort'])
		{
			$args['sort'] = 'sort';
		}

		if(\dash\request::get('status'))
		{
			$args['status'] = \dash\request::get('status');
		}

		if(\dash\request::get('type'))
		{
			$args['type'] = \dash\request::get('type');
		}

		if(\dash\request::get('gender'))
		{
			$args['gender'] = \dash\request::get('gender');
		}

		if(\dash\request::get('position'))
		{
			$args['position'] = \dash\request::get('position');
		}

		if(\dash\request::get('capacity'))
		{
			$args['capacity'] = \dash\request::get('capacity');
		}

		$sortLink  = \dash\app\sort::make_sortLink(\lib\app\learnlevel::$sort_field, \dash\url::this());
		$dataTable = \lib\app\learnlevel::list(\dash\request::get('q'), $args);

		\dash\data::sortLink($sortLink);
		\dash\data::dataTable($dataTable);

		$check_empty_datatable = $args;
		unset($check_empty_datatable['sort']);
		unset($check_empty_datatable['order']);
		unset($check_empty_datatable['learngroup_id']);

		// set dataFilter
		$dataFilter = \dash\app\sort::createFilterMsg($search_string, $check_empty_datatable);
		\dash\data::dataFilter($dataFilter);



	}
}
?>