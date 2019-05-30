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
			}
			else
			{
				$user_id = \dash\db\users::signup(['mobile' => $mobile, 'displayname' => $name]);
			}
		}

		if(!$user_id)
		{
			$user_id = 'unverify';
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

		$msg_go = T_("Pay donate :price toman", ['price' => \dash\utility\human::fitNumber($amount)]);


		$meta =
		[
			'turn_back' => $turn_back,
			'amount'    => $amount,
			'user_id'   => $user_id,
			'auto_go'   => $auto_go,
			'msg_go'    => $msg_go,
			'auto_back' => $auto_back,
			'final_msg' => true,

		];

		\dash\utility\pay\start::site($meta);

	}


}
?>