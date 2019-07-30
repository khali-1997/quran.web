<?php
namespace content_m\reading\edit;


class model
{
	public static function post()
	{
		$quality = intval(\dash\request::post('quality'));
		if($quality)
		{
			$quality = (3 - $quality) +  1;
		}

		$post =
		[
			'teachertxt' => \dash\request::post('answer'),
			'status'     => \dash\request::post('status'),
			'quality'    => $quality,
			'teacher'    => \dash\user::id(),
		];

		$post    = \dash\request::post();
		$mistake = [];

		foreach ($post as $key => $value)
		{
			if(substr($key, 0, 8) === 'mistake_')
			{
				$mistake[substr($key, 8)] = $value;
			}
		}


		$teacheraudio = \dash\app\file::upload_quick('teacheraudio');

 		if($teacheraudio)
		{
			$post['teacheraudio'] = $teacheraudio;
		}

		if($mistake)
		{
			\lib\app\lm_audiomistake::set($mistake, \dash\request::get('id'));
		}

		$post['mistake'] = $mistake;

		\lib\app\lm_audio::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this());

			// \dash\redirect::pwd();
		}

	}
}
?>