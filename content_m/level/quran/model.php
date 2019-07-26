<?php
namespace content_m\level\quran;


class model
{
	public static function post()
	{
		$post =
		[
			'startaya'   => \dash\request::post('startaya'),
			'endaya'     => \dash\request::post('endaya'),
			'startsurah' => \dash\request::post('startsurah'),
			'endsurah'   => \dash\request::post('endsurah'),
			'besmellah'   => \dash\request::post('besmellah'),
		];

		\lib\app\lm_level::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}
}
?>