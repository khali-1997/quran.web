<?php
namespace content_lms\all\home;

class controller
{

	public static function routing()
	{
		if(in_array(\dash\url::child(), ['quran', 'tajweed', 'exam', 'theme']))
		{
			\dash\open::get();
		}

	}
}
?>