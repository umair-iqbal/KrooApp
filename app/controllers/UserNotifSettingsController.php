<?php

class UserNotifSettingsController extends \BaseController {

	/**
	 * Display a listing of usernotifsettings
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$usernotifsettings = Usernotifsetting::all();

        return View::make('user_notif_settings.index',array("data"=> json_encode($usernotifsettings)));
	}

	/**
	 * Show the form for creating a new usernotifsetting
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('usernotifsettings.create');
	}

	/**
	 * Store a newly created usernotifsetting in storage.
	 *
	 * @return Response
	 */
    public function store($user_id,$notif_setting_id,$is_active)
    {


        //$user->save();
        DB::table('user_notif_settings')
            ->insert(array('user_id'=> $user_id,'notif_setting_id'=>$notif_setting_id,'is_active'=>$is_active));

        $role = DB::table('user_notif_settings')->where('user_id', $user_id)->first();
        return View::make("user_notif_settings/Create.index",array("data"=> json_encode($role)));
    }


	/**
	 * Display the specified usernotifsetting.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $role = DB::table('user_notif_settings')->where('sr_no', $id)->first();

        return View::make('user_notif_settings.index', array("data"=> json_encode($role)));
	}

	/**
	 * Show the form for editing the specified usernotifsetting.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($sr_no,$user_id,$notif_setting_id,$is_active)
    {
        DB::table('user_notif_settings')
            ->where('sr_no',$sr_no)
            ->update(array('user_id'=> $user_id,'notif_setting_id'=>$notif_setting_id,'is_active'=>$is_active));

        $role = DB::table('user_notif_settings')->where('sr_no', $sr_no)->first();
        return View::make("user_notif_settings/Create.index",array("data"=> json_encode($role)));
    }

	/**
	 * Update the specified usernotifsetting in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$usernotifsetting = Usernotifsetting::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Usernotifsetting::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$usernotifsetting->update($data);

		return Redirect::route('usernotifsettings.index');
	}

	/**
	 * Remove the specified usernotifsetting from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $role = DB::table('user_notif_settings')->where('sr_no', $id)->first();
        if($role!=null) {
            DB::table('user_notif_settings')->where('sr_no', $id)->delete();
            $role = DB::table('user_notif_settings')->where('sr_no', $id)->first();
            if ($role == null)
                return View::make('user_notif_settings/Delete.index', array("data" => '1'));
            else
                return View::make('user_notif_settings/Delete.index', array("data" => '0'));
        }
        else
            return View::make('user_notif_settings/Delete.index', array("data" => '0'));

    }

}
