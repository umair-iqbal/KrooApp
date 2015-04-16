<?php

class UserSocailNetworksController extends \BaseController {

	/**
	 * Display a listing of usersocailnetworks
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$usersocailnetworks = Usersocailnetwork::all();

        return View::make('user_socail_networks.index',array("data"=> json_encode($userprofiles)));
	}

	/**
	 * Show the form for creating a new usersocailnetwork
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('usersocailnetworks.create');
	}

	/**
	 * Store a newly created usersocailnetwork in storage.
	 *
	 * @return Response
	 */
    public function store($user_id,$social_net_id,$is_active,$last_updated_on,$is_notif_allowed)
    {

        if($last_updated_on!="")
        {
            $last_updated_on =new DateTime($last_updated_on);
        }


        //$user->save();
        DB::table('user_socail_networks')
            ->insert(array('user_id'=> $user_id,'social_net_id'=>$social_net_id,'is_active'=>$is_active,'last_updated_on'=>$last_updated_on,'is_notif_allowed'=>$is_notif_allowed));

        $role = DB::table('user_socail_networks')->where('user_id', $user_id)->first();
        return View::make("user_socail_networks/Create.index",array("data"=> json_encode($role)));
    }

	/**
	 * Display the specified usersocailnetwork.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $role = DB::table('user_socail_networks')->where('sr_no', $id)->first();

        return View::make('user_socail_networks.index', array("data"=> json_encode($role)));
	}

	/**
	 * Show the form for editing the specified usersocailnetwork.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($sr_no,$user_id,$social_net_id,$is_active,$last_updated_on,$is_notif_allowed)
    {

        if($last_updated_on!="")
        {
            $last_updated_on =new DateTime($last_updated_on);
        }


        //$user->save();
        DB::table('user_socail_networks')
            ->where('sr_no',$sr_no)
            ->update(array('user_id'=> $user_id,'social_net_id'=>$social_net_id,'is_active'=>$is_active,'last_updated_on'=>$last_updated_on,'is_notif_allowed'=>$is_notif_allowed));

        $role = DB::table('user_socail_networks')->where('sr_no', $sr_no)->first();
        return View::make("user_socail_networks/Create.index",array("data"=> json_encode($role)));
    }

	/**
	 * Update the specified usersocailnetwork in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$usersocailnetwork = Usersocailnetwork::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Usersocailnetwork::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$usersocailnetwork->update($data);

		return Redirect::route('usersocailnetworks.index');
	}

	/**
	 * Remove the specified usersocailnetwork from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $role = DB::table('user_socail_networks')->where('sr_no', $id)->first();
        if($role!=null) {
            DB::table('user_socail_networks')->where('sr_no', $id)->delete();
            $role = DB::table('user_socail_networks')->where('sr_no', $id)->first();
            if ($role == null)
                return View::make('user_socail_networks/Delete.index', array("data" => '1'));
            else
                return View::make('user_socail_networks/Delete.index', array("data" => '0'));
        }
        else
            return View::make('user_socail_networks/Delete.index', array("data" => '0'));

    }

}
