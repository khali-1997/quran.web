<?php
namespace lib\app;


class donate
{

	public static function add($_args)
	{
		\dash\app::variable($_args);

		$amount = \dash\app::request('amount');
		if(!$amount)
		{
			\dash\notif::error(T_("Please set amount"), 'amount');
			return false;
		}

		if(!is_numeric($amount))
		{
			\dash\notif::error(T_("Plase set amount as a number"), 'amount');
			return false;
		}

		$amount = abs(intval($amount));

		if($amount > 1000000000)
		{
			\dash\notif::error(T_("Amount is out of range"), 'amount');
			return false;
		}

		$name   = \dash\app::request('name');
		if($name && mb_strlen($name) > 100)
		{
			\dash\notif::error(T_("Name is too large"), 'name');
			return false;
		}

		$user_id = null;
		$mobile = \dash\app::request('mobile');

		if($mobile)
		{
			$mobile = \dash\utility\filter::mobile($mobile);
			if(!$mobile)
			{
				\dash\notif::error(T_("Invalid mobile number"), 'mobile');
				return false;
			}

			$user_detail = \dash\db\users::get_by_mobile($mobile);
			if(isset($user_detail['id']))
			{
				$user_id = $user_detail['id'];

				if($name && array_key_exists('displayname', $user_detail) && !$user_detail['displayname'])
				{
					\dash\db\users::update(['displayname' => $name], $user_id);
				}
			}
			else
			{
				$user_id = \dash\db\users::signup(['mobile' => $mobile, 'displayname' => $name]);
			}
		}

		if(!$user_id)
		{
			if(\dash\user::id())
			{
				$user_id = \dash\user::id();
			}
			else
			{
				$user_id = 'unverify';
			}
		}

		if(isset($_args['turn_back']))
		{
			$turn_back = $_args['turn_back'];
		}
		else
		{
			$turn_back = \dash\url::that();
		}

		$auto_go   = false;

		$auto_back = true;

		$msg_go = T_("Pay :price toman", ['price' => \dash\utility\human::fitNumber($amount)]);


		$meta =
		[
			'turn_back' => $turn_back,
			'amount'    => $amount,
			'user_id'   => $user_id,
			'auto_go'   => $auto_go,
			// 'msg_go'    => $msg_go,
			'auto_back' => $auto_back,
			'final_msg' => true,

		];

		\dash\utility\pay\start::site($meta);

	}



	public static function doners_list()
	{
		$result                       = [];
		$result['up_to_10_milion']    = \lib\db\donate::sum_from_to(10000000, null);
		$result['up_to_1_milion']     = \lib\db\donate::sum_from_to(1000000, 9999999);
		$result['up_to_100_thousand'] = \lib\db\donate::sum_from_to(100000, 999999);
		$result['other']              = \lib\db\donate::sum_from_to(null, 99999);

		foreach ($result as $key => $value)
		{
			if($value)
			{
				$result[$key] = array_map(['\\dash\\app', 'fix_avatar'], $value);
			}
		}
		return $result;
	}


}
?>