<?php
namespace content_m\reading\edit;


class model
{
	public static function post()
	{
		$post =
		[
			'teachertxt'  => \dash\request::post('answer'),
			'status'  => \dash\request::post('status'),
			'teacher' => \dash\user::id(),
		];

		$teacheraudio = \dash\app\file::upload_quick('teacheraudio');

 		if($teacheraudio)
		{
			$post['teacheraudio'] = $teacheraudio;
		}

		\lib\app\lm_audio::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this());

			// \dash\redirect::pwd();
		}

	}
}
?>