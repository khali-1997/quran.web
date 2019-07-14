<?php
namespace content_m\mag\connect;

class view
{
	public static function config()
	{
		$args               = [];
		$args['type']       = 'post';
		$post_list = \dash\app\posts::all_post_title($args);

		\dash\data::postList($post_list);
	}
}
?>