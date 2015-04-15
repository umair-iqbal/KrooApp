<?php

class NotifSettingsController extends \BaseController {

	/**
	 * Display a listing of notifsettings
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$notifsettings = Notifsetting::all();

        return View::make('notif_settings.index',array("data"=> json_encode($notifsettings)));
	}

	/**
	 * Show the form for creating a new notifsetting
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('notifsettings.create');
	}

	/**
	 * Store a newly created notifsetting in storage.
	 *
	 * @return Response
	 */
    public function store($notif_setting_id,$notif_setting_desc,$is_active,$created_on,$created_by,$last_updated_on,$last_updated_by)
    {
        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }
        if($last_updated_on!="")
        {
            $last_updated_on =new DateTime($last_updated_on);
        }


        //$user->save();
        DB::table('notif_settings')
            ->insert(array('notif_setting_id'=> $notif_setting_id,'notif_setting_desc'=>$notif_setting_desc,'is_active'=>$is_active,'created_on'=>$created_on,'created_by'=>$created_by,'last_updated_on'=>$last_updated_on,
                'last_updated_by'=>$last_updated_by));

        $role = DB::table('notif_settings')->where('notif_setting_id', $notif_setting_id)->first();
        return View::make("notif_settings/Create.index",array("data"=> json_encode($role)));
    }

	/**
	 * Display the specified notifsetting.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $role = DB::table('notif_settings')->where('notif_setting_id', $id)->first();

        return View::make('notif_settings.index', array("data"=> json_encode($role)));
	}

	/**
	 * Show the form for editing the specified notifsetting.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($notif_setting_id,$notif_setting_desc,$is_active,$created_on,$created_by,$last_updated_on,$last_updated_by)
    {
        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }
        if($last_updated_on!="")
        {
            $last_updated_on =new DateTime($last_updated_on);
        }


        //$user->save();
        DB::table('notif_settings')
            ->where('notif_setting_id',$notif_setting_id)
            ->update(array('notif_setting_id'=> $notif_setting_id,'notif_setting_desc'=>$notif_setting_desc,'is_active'=>$is_active,'created_on'=>$created_on,'created_by'=>$created_by,'last_updated_on'=>$last_updated_on,
                'last_updated_by'=>$last_updated_by));

        $role = DB::table('notif_settings')->where('notif_setting_id', $notif_setting_id)->first();
        return View::make("notif_settings/Create.index",array("data"=> json_encode($role)));
    }
	/**
	 * Update the specified notifsetting in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$notifsetting = Notifsetting::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Notifsetting::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$notifsetting->update($data);

		return Redirect::route('notifsettings.index');
	}

	/**
	 * Remove the specified notifsetting from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $role = DB::table('notif_settings')->where('notif_setting_id', $id)->first();
        if($role!=null) {
            DB::table('notif_settings')->where('notif_setting_id', $id)->delete();
            $role = DB::table('notif_settings')->where('notif_setting_id', $id)->first();
            if ($role == null)
                return View::make('notif_settings/Delete.index', array("data" => '1'));
            else
                return View::make('notif_settings/Delete.index', array("data" => '0'));
        }
        else
            return View::make('notif_settings/Delete.index', array("data" => '0'));

    }

}
