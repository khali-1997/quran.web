<?php
namespace content_lms\group\home;


class model
{
	public static function post()
	{
		if(\dash\request::post('action') === 'remove')
		{
			$id     = \dash\request::post('id');

			$remove = \lib\app\group::remove($id);

			if($remove)
			{
				\dash\redirect::pwd();
			}
		}
	}
}
?>
