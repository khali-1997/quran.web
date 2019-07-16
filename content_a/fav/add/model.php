<?php
namespace content_a\fav\add;


class model
{
	public static function post()
	{
		$post          = [];
		$post['desc']  = \dash\request::post('desc');
		$post['page']  = \dash\request::post('page');
		$post['aya']   = \dash\request::post('aya');
		$post['surah'] = \dash\request::post('surah');
		$add           = \lib\app\fav::add($post);
	}
}
?>