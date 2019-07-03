<?php
namespace lib\app;


class quick_access
{

	public static function list()
	{
		$list = [];

		$list[] =
		[
			'title' => T_('Al-Fatihah'),
			'desc'  => null,
			'url'   => \dash\url::kingdom(). '/s1',
		];

		$list[] =
		[
			'title' => T_("Ar-Rahman"),
			'desc'  => null,
			'url'   => \dash\url::kingdom(). '/s55',
		];

		$list[] =
		[
			'title' => T_('Al-Mulk'),
			'desc'  => null,
			'url'   => \dash\url::kingdom(). '/s67',
		];

		$list[] =
		[
			'title' => T_('Ya-Sin'),
			'desc'  => null,
			'url'   => \dash\url::kingdom(). '/s36',
		];

		$list[] =
		[
			'title' => T_("Al-Waqi'ah"),
			'desc'  => null,
			'url'   => \dash\url::kingdom(). '/s56',
		];
		return $list;
	}
}
?>