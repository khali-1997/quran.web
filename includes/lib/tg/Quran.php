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
					[
						[
							'text' => T_("Random Aye"),
							'callback_data'  => '/a_random',
						],
						[
							'text' => T_("Random Page"),
							'callback_data'  => '/p_random',
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


	public static function requireCode()
	{
		bot::ok();
		$msg = T_("We need a number!")." 🙁";

		// if start with callback answer callback
		if(bot::isCallback())
		{
			$callbackResult =
			[
				'text' => $msg,
			];
			bot::answerCallbackQuery($callbackResult);
		}

		$result =
		[
			'text' => $msg,
		];
		bot::sendMessage($result);
	}


	public static function page($_pageNumber)
	{
		$current = $_pageNumber;
		bot::ok();


		if($_pageNumber)
		{
			if(is_numeric($_pageNumber))
			{
				if($_pageNumber < 1 && $_pageNumber > 604)
				{
					return self::requireCode();
				}
			}
			else
			{
				// if text like today, get today page number
				$current = 260;
			}

		}
		else
		{
			// we dont have number show help of page
			$msg = '';
			$msg .= "<b>". T_('SalamQuran'). "</b>". "\n";
			$msg .= T_('For access to specefic page of Quran please use and type one of below syntax')."\n";
			$msg .= "<code>ص200</code>"."\n";
			$msg .= "<code>p200</code>"."\n";
			$msg .= "/p200"."\n";

			$msg .= "\n";
			$msg .= bot::website();
			bot::sendMessage($msg);
			return true;
		}

		// if start with callback answer callback
		if(bot::isCallback())
		{
			bot::answerCallbackQuery(T_("Request for Quran page"). ' ' . $current);
		}

		$next = $current + 1;
		if($next > 604)
		{
			$next = 1;
		}
		$prev = $current - 1;
		if($prev < 1)
		{
			$prev = 604;
		}

		$website = bot::website(). '/p'. $current;

		$currentPageNum = str_pad($current, 3, "0", STR_PAD_LEFT);
		$dlLink = 'https://dl.salamquran.com/images/v1/page'. $currentPageNum. '.png';


		// show message to go to website
		$msg = '';
		// $msg .= T_('You have no survey yet!') ."\n\n";
		$msg .= "<b>". T_('SalamQuran'). "</b> | ";
		$msg .= T_('Page'). ' '. $current;
		$msg .= "\n";
		$msg .= $website;

		$result =
		[
			'photo'        => $dlLink,
			'caption'      => $msg,
			'reply_markup' =>
			[
				'inline_keyboard' =>
				[
					[
						[
							'text' => T_("Next"),
							'callback_data'  => '/p'. $next,
						],
						[
							'text' => T_("Prev"),
							'callback_data'  => '/p'. $prev,
						],
					],
					[
						[
							'text' => T_("Iqra"),
							'url'  => $website. '?autoplay=1',
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

		bot::sendPhoto($result);
	}



	public static function juz($_code)
	{
		self::page($_code);
	}


	public static function surah($_code)
	{
		self::page($_code);
	}



	public static function aya($_code)
	{
		self::page($_code);
	}

}
