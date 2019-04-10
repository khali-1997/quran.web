<?php
namespace content\audio;

class model
{

	public static function post()
	{
		if(\dash\request::post('updatedatabase') && \dash\permission::supervisor())
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
			if(
				!array_key_exists('qari', $value) ||
				!array_key_exists('style', $value) ||
				!array_key_exists('folder', $value) ||
				!array_key_exists('subfolder', $value) ||
				!array_key_exists('quality', $value) ||
				!array_key_exists('files', $value)
			  )
			{
				continue;
			}

			$multi_insert[] =
			[
				'qari'    => $value['qari'],
				'type'    => $value['style'],
				'addr'    => $value['folder']. '/'. $value['subfolder'],
				'quality' => $value['quality'],
				// 'size'    => array_sum(array_column($value['files'], 'size')),
				'status'  => 'enable',
			];
		}

		if(empty($multi_insert))
		{
			\dash\notif::error(T_("No data founded"));
			return false;
		}
		else
		{
			\lib\db\audiobank::delete_all();

			\lib\db\audiobank::multi_insert($multi_insert);

			return true;
		}
	}

}
?>