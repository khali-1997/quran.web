<?php
namespace lib\tg;
use \dash\social\telegram\tg as bot;


class detect
{
	public static function run($_cmd)
	{
		$myCommand = $_cmd['commandRaw'];
		if(bot::isCallback())
		{
			$myCommand = substr($myCommand, 3);
		}
		elseif(bot::isInline())
		{
			$myCommand = substr($myCommand, 3);
		}
		// remove command from start
		if(substr($myCommand, 0, 1) == '/')
		{
			$myCommand = substr($myCommand, 1);
		}

		// switch based on user enter
		switch ($myCommand)
		{
			case 'Quran':
			case 'quran':
			case T_('Quran'):
			case 'list':
			case T_('List'):
			case T_('list'):
			case T_('$'):
				// show list of survey
				Quran::start();
				return true;
				break;

			case 'how':
			case 'add':
			case T_('how'):
			case T_('howto'):
			case T_('Add'):
				// show list of survey
				Quran::howto();
				return true;
				break;

			default:
				return false;
				break;
		}

	}


	public static function mainmenu($_onlyMenu = false)
	{
		$menu = ['remove_keyboard' => true];
		// on private chat add keyboard
		if(bot::isPrivate())
		{
			$menu =
			[
				'keyboard' =>[],
				'resize_keyboard' => true,
			];

			$menu['keyboard'][] = [T_("Quran")];
			// add about and contact link
			$menu['keyboard'][] = [T_("About"), T_("Contact")];

			// add sync
			if(\dash\user::detail('mobile'))
			{
				$menu['keyboard'][] =
				[
					T_("Website"). ' '. T_(\dash\option::config('site', 'title')),
					T_("Latest News")
				];
			}
			else
			{
				$menu['keyboard'][] = [T_("Sync with website")];
			}
		}

		if($_onlyMenu)
		{
			return $menu;
		}

		$txt_text = T_("Main menu");

		$result =
		[
			'text'         => $txt_text,
			'reply_markup' => $menu,
		];

		bot::sendMessage($result);
		bot::ok();
	}
}
?>