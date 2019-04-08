<?php
/**
 *
 */
class audiobank
{
	private static $file_addr = __DIR__.'/audiobank.json';
	private static $addr      = __DIR__;
	private static $folder    = 'qari';

	private static function load()
	{
		if(is_file(self::$file_addr))
		{
			$load = @file_get_contents(self::$file_addr);
			$load = json_decode($load, true);
			return $load;
		}
		return null;
	}

	private static function check_last_update()
	{
		$load = self::load();
		if(isset($load['lastupdate']))
		{
			if(time() - strtotime($load['lastupdate']) < 60)
			{
				return false;
			}
		}
		return true;
	}


	private static function save_json()
	{
		$json               = [];
		$json['lastupdate'] = date("Y-m-d H:i:s");
		$json['list']       = self::make_json();
		$json               = json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		$save_addr          = self::$file_addr;
		@file_put_contents($save_addr, $json);
		return true;
	}


	private static function make_json()
	{
		// the addr
		$addr        = self::$addr;
		$folder      = self::$folder;
		$folder_addr = $addr .'/'. $folder;
		$list        = glob($folder_addr. '/*', GLOB_ONLYDIR);
		$result      = [];

		foreach ($list as $key => $value)
		{
			$folder_name = str_replace($folder_addr. '/', '', $value);
			$split       = explode('-', $folder_name);
			$meta        = [];

			foreach ($split as $k => $v)
			{
				if(strpos($v, '[') !== false && strpos($v, ']') !== false)
				{
					$myMeta   = substr($v, strpos($v, '[') + 1, (strpos($v, ']') - strpos($v, '[')) - 1);
					$meta[$k] = explode('_', $myMeta);
				}
				$split[$k] = preg_replace("/\[.*\]/", "", $v);
			}


			$temp            = [];
			$temp['qari']    = isset($split[0]) ? $split[0] : null;

			if(isset($meta[0]))
			{
				$temp['qari_detail'] =
				[
					'lang'       => isset($meta[0][0]) ? $meta[0][0] : null,
					'translater' => isset($meta[0][1]) ? $meta[0][1] : null,
					'reader'     => isset($meta[0][2]) ? $meta[0][2] : null,
				];
			}

			$temp['style']   = isset($split[1]) ? $split[1] : null;
			if(isset($meta[1]))
			{
				$temp['style_detail'] =
				[
					'desc'       => isset($meta[1][0]) ? $meta[1][0] : null,
				];
			}

			$temp['quality'] = isset($split[2]) ? $split[2] : null;

			$result[]        = $temp;

		}

		return $result;
	}


	public static function run()
	{
		if(self::check_last_update())
		{
			self::save_json();

			self::end('The operation successfully completed');
			self::end(self::load());
		}
		else
		{
			self::end('Too many tries');
			self::end(self::load());
		}
	}


	private static function end($_a)
	{
		echo '<pre>';
		print_r($_a);
		echo '</pre>';
		echo '<hr>';
	}
}

\audiobank::run();

?>