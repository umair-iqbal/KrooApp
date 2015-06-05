<?php

class UserNotificationsController extends \BaseController {

	/**
	 * Display a listing of usernotifications
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$usernotifications = Usernotification::all();

        return View::make('user_notifications.index',array("data"=> json_encode($usernotifications)));
	}

	/**
	 * Show the form for creating a new usernotification
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('usernotifications.create');
	}

	/**
	 * Store a newly created usernotification in storage.
	 *
	 * @return Response
	 */
    public function store($user_id,$notif_type_id,$notif_key,$is_active,$created_on,$user_notificationcol)
    {

        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }

        DB::table('user_notification')
            ->insert(array('user_id'=> $user_id,'notif_type_id'=>$notif_type_id,'notif_key'=>$notif_key,'is_active'=>$is_active,'created_on'=>$created_on,'user_notificationcol'=>$user_notificationcol
            ));

        $role = DB::table('user_notification')->where('user_id', $user_id)->first();
        return View::make("user_notifications/Create.index",array("data"=> json_encode($role)));
    }

	/**
	 * Display the specified usernotification.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $role = DB::table('user_notification')->where('sr_no', $id)->first();

        return View::make('user_notifications.index', array("data"=> json_encode($role)));
	}

    public function showByEmail()
    {
        $data = Input::all();
        if ($data != null) {
            $id = $data['user_id'];

            $dataT = DB::table('users')->where('user_id', $id)->first();

            if ($dataT != null) {
                $match = ['user_id' => $id, 'notif_type_id' => 'K'];
                $data1 = DB::table('user_notification')->where($match)->get();

                if ($data1 != null) {
                    return Response::json(array('status' => 200, 'datajson' => $data1));
                } else {
                    return Response::json(array('status' => 200, 'datajson' => 'no record found'));
                }
            } else {
                return Response::json(array('status' => 200, 'datajson' => 'user not exist'));
            }
        }
        else
        {
            return Response::json(array('status' => 203, 'datajson' => 'invalid query string'));
        }
    }

	/**
	 * Show the form for editing the specified usernotification.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($sr_no,$user_id,$notif_type_id,$notif_key,$is_active,$created_on,$user_notificationcol)
    {

        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }

        DB::table('user_notification')
            ->where('sr_no',$sr_no)
            ->update(array('user_id'=> $user_id,'notif_type_id'=>$notif_type_id,'notif_key'=>$notif_key,'is_active'=>$is_active,'created_on'=>$created_on,'user_notificationcol'=>$user_notificationcol
            ));

        $role = DB::table('user_notification')->where('sr_no', $sr_no)->first();
        return View::make("user_notifications/Create.index",array("data"=> json_encode($role)));
    }

	/**
	 * Update the specified usernotification in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$usernotification = Usernotification::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Usernotification::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$usernotification->update($data);

		return Redirect::route('usernotifications.index');
	}

	/**
	 * Remove the specified usernotification from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $role = DB::table('user_notification')->where('sr_no', $id)->first();
        if($role!=null) {
            DB::table('user_notification')->where('sr_no', $id)->delete();
            $role = DB::table('user_notification')->where('sr_no', $id)->first();
            if ($role == null)
                return View::make('user_notifications/Delete.index', array("data" => '1'));
            else
                return View::make('user_notifications/Delete.index', array("data" => '0'));
        }
        else
            return View::make('user_notifications/Delete.index', array("data" => '0'));

    }

}
