<?php
namespace lib\app;


class quick_access
{

	public static function list()
	{
		$list = [];
		$list[] =
		[
			'title' => 'Fatiha',
			'desc'  => 'fatiha alketab',
			'url'   => \dash\url::kingdom(). '/s1',
		];
		return $list;
	}
}
?>