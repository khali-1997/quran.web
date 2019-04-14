<?php
namespace content_mag;

class view
{
	public static function config()
	{
		// define default value for global
		\dash\data::site_title(T_("Salam Quran Magazine"));
		\dash\data::site_desc(T_("Read about Quran!"). ' '. T_("Quran is calling you."));
		\dash\data::site_slogan(T_("Quran Anywhere Anytime"));
		\dash\data::page_title(\dash\data::site_title());
		\dash\data::page_desc(\dash\data::site_desc(). ' | '. \dash\data::site_slogan());
		\dash\data::page_special(true);

		\dash\data::page_copyright(
			T_('© :year :site. All right reserved.',
			[
				'year' => \dash\datetime::fit("now", "Y"),
				'site' => "<a href='". \dash\url::kingdom(). "' title='". \dash\data::site_desc() ."'>". \dash\data::site_title(). "</a>"
			]
		));
	}
}
?>