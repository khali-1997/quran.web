<?php
namespace content_mag\home;

class view
{

	public static function config()
	{
		\dash\data::page_title(T_("Magazine"));
		// \dash\data::page_desc(T_("Easily manage your tickets and monitor or track them to get best answer until fix your problem"));
		\dash\data::page_pictogram('book');


		\dash\data::display_magAdmin('content_mag/home/article.html');
		self::magazine();


	}

	public static function magazine()
	{
		$master = \dash\data::moduelRow();
		if(!isset($master['id']))
		{
			return;
		}
		$subchildPost = \dash\db\posts::get(['type' => 'mag', 'parent' => $master['id'], 'status' => 'publish']);
		if(is_array($subchildPost))
		{
			$subchildPost = array_map(['\dash\app\posts', 'ready'], $subchildPost);
			\dash\data::subchildPost($subchildPost);
		}

		$master = \dash\app\posts::ready($master);
		\dash\data::datarow($master);


		// set back link
		\dash\data::badge_text(T_('Return to help center'));
		\dash\data::badge_link(\dash\url::here());

		// set page title
		if(isset($master['title']))
		{
			\dash\data::page_title($master['title']);
		}
		// set page desc
		if(isset($master['excerpt']))
		{
			\dash\data::page_desc($master['excerpt']);
		}
		// set page desc
		if(isset($master['meta']['icon']))
		{
			\dash\data::page_pictogram($master['meta']['icon']);
		}



	}



}
?>