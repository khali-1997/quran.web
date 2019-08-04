<?php
namespace lib;


class badge
{
	public static function list()
	{
		$list                      = [];

		$list['OpenMag']           = ['title' => T_("First open magazine"), 'class' => 'warn'];
		$list['OpenAudioBank']     = ['title' => T_("First open audio bank"), 'class' => 'warn'];
		$list['ReadFirstAya']      = ['title' => T_("Read first aya"), 'class' => 'warn'];
		$list['ReadFirstSura']     = ['title' => T_("Read first sura"), 'class' => 'warn'];
		$list['AddFirstKhatm']     = ['title' => T_("Add first khatm"), 'class' => 'warn'];
		$list['UsePublicKhatm']    = ['title' => T_("User or start a public khatm"), 'class' => 'warn'];
		$list['LmsStartLevel']     = ['title' => T_("Start first level in LMS"), 'class' => 'warn'];
		$list['LmsFirstScore']     = ['title' => T_("Get first score in LMS"), 'class' => 'warn'];
		$list['LmsFirstFullScore'] = ['title' => T_("Get first full score in LMS"), 'class' => 'warn'];

		return $list;
	}


}
?>