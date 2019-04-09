<?php
namespace content\audio;

class model
{

	public static function post()
	{
		if(\dash\permission::supervisor() && \dash\request::post('updatedatabase'))
		{
			if(self::updatedatabase())
			{
				\dash\notif::ok(T_("Insert audiobank successfull"));
			}
			else
			{
				return false;
			}
		}
		else
		{
			\dash\notif::error(T_("Dont!"));
			return false;
		}

	}


	private static function updatedatabase()
	{
		$data = [];
		$addr = __DIR__. '/data.me.json';

		if(is_file($addr))
		{
			$data = \dash\file::read($addr);
			$data = json_decode($data, true);

			if(!is_array($data))
			{
				$data = [];
			}
		}


		$multi_insert = [];

		foreach ($data['list'] as $key => $value)
		{
			$multi_insert[] =
			[
				'qari'    => $value['qari'],
				'type'    => $value['style'],
				'addr'    => $value['folder']. '/'. $value['subfolder'],
				'quality' => $value['quality'],
				'size'    => array_sum(array_column($value['files'], 'size')),
				'status'  => 'enable',
			];
		}

		\lib\db\audiobank::delete_all();

		\lib\db\audiobank::multi_insert($multi_insert);

		return true;
	}

}
?>