<?php
namespace content_lms\level\theme;


class model
{
	public static function post()
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		if(\dash\request::post('ActionType') === 'showvideo')
		{
			\lib\app\lm_star::level_learn('showvideo', \dash\request::get('id'));
		}
		elseif(\dash\request::post('ActionType') === 'answer')
		{
			$post = \dash\request::post();
			$answer = [];
			foreach ($post as $key => $value)
			{
				if(substr($key, 0, 7) === 'answer_')
				{
					$answer[substr($key, 7)] = $value;
				}
			}

			\lib\app\lm_answer::save_array($answer, \dash\request::get('id'));
		}

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this(). '/result?id='. \dash\request::get('id'));
		}

	}
}
?>
