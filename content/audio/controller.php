<?php
namespace content\audio;

class controller
{

	public static function routing()
	{
		$child = \dash\url::child();
		$subchild = \dash\url::subchild();

		if($child === 'data.me.json' && \dash\permission::supervisor())
		{
			\dash\open::get();
			\dash\notif::api(\dash\file::read(__DIR__.'/data.me.json'));
		}

		$get = \lib\db\audiobank::get(['addr' => $child. '/'. $subchild, 'limit' => 1]);
		if(isset($get['id']))
		{
			$get = \lib\app\audiobank::ready($get);
			\dash\data::loadAudioFolder($get);
			\dash\open::get();
		}

	}
}
?>