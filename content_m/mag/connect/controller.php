<?php
namespace content_m\mag\connect;

class controller
{

	public static function routing()
	{
		$subchild = \dash\url::subchild();
		if(in_array($subchild, ['aya', 'page', 'surah', 'word']))
		{
			\dash\open::get();
			\dash\open::post();
		}
	}
}
?>