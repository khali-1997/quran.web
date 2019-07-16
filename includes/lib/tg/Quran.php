<?php
namespace lib\tg;
// use telegram class as bot
use \dash\social\telegram\tg as bot;
use \dash\social\telegram\step;

class Quran
{
	public static function start()
	{
		bot::ok();

		// if start with callback answer callback
		if(bot::isCallback())
		{
			bot::answerCallbackQuery(T_("Quran is calling you!"));
		}

		// show message to go to website
		$msg = '';
		// $msg .= T_('You have no survey yet!') ."\n\n";
		$msg .= "<b>". T_('SalamQuran'). "</b>\n\n";
		$msg .= T_('Please choose from below keyboard or type your request.');
		$msg .= "\n\n";

		$result =
		[
			'text' => $msg,
			'reply_markup' =>
			[
				'inline_keyboard' =>
				[
					[
						[
							'text' => T_("Page"),
							'callback_data'  => '/p',
						],
					],
					[
						[
							'text' => T_("Surah"),
							'callback_data'  => '/s',
						],
						[
							'text' => T_("Juz"),
							'callback_data'  => '/j',
						],
					],
					[
						[
							'text' => T_("Aye of the day"),
							'callback_data'  => '/a_today',
						],
						[
							'text' => T_("Page of the day"),
							'callback_data'  => '/p_today',
						],
					],
				]
			]
		];


		// add sync
		if(!\dash\user::detail('mobile'))
		{
			$result['reply_markup']['inline_keyboard'][][] =
			[
				'text'          => T_("Sync with website"),
				'callback_data' => 'sync',
			];
		}

		bot::sendMessage($result);
	}
}
