<?php
namespace content_api\v6\audio;


class controller
{
	public static function routing()
	{
		if(count(\dash\url::dir()) > 2)
		{
			\content_api\v6::no(404);
		}

		\content_api\v6::check_apikey();

		$child = \dash\url::child();

		if(!$child)
		{
			\content_api\v6::no(404);
		}


		switch ($child)
		{
			case 'audio':
				$data = self::audio();
				break;



			default:
				\content_api\v6::no(404);
				break;
		}

		\content_api\v6::bye($data);
	}


	private static function audio()
	{
		\dash\permission::access('mAudioFileView');
		$args          = [];
		$args['order'] = 'DESC';
		$args['sort']  = 'id';
		$dataTable = \lib\app\lm_audio::list(null, $args);
		return $dataTable;
	}

}
?>