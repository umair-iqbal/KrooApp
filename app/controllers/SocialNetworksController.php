<?php

class SocialNetworksController extends \BaseController {

	/**
	 * Display a listing of socialnetworks
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$socialnetworks = Socialnetwork::all();

        return View::make('social_networks.index',array("data"=> json_encode($socialnetworks)));
	}

	/**
	 * Show the form for creating a new socialnetwork
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('socialnetworks.create');
	}

	/**
	 * Store a newly created socialnetwork in storage.
	 *
	 * @return Response
	 */
    public function store($social_net_id,$social_net_name,$is_active,$created_on,$created_by,$last_updated_on,$last_updated_by)
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
        DB::table('social_networks')
            ->insert(array('social_net_id'=> $social_net_id,'social_net_name'=>$social_net_name,'is_active'=>$is_active,'created_on'=>$created_on,'created_by'=>$created_by,'last_updated_on'=>$last_updated_on,
                'last_updated_by'=>$last_updated_by));

        $role = DB::table('social_networks')->where('social_net_id', $social_net_id)->first();
        return View::make("social_networks/Create.index",array("data"=> json_encode($role)));
    }

	/**
	 * Display the specified socialnetwork.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $role = DB::table('social_networks')->where('social_net_id', $id)->first();

        return View::make('social_networks.index', array("data"=> json_encode($role)));
	}

	/**
	 * Show the form for editing the specified socialnetwork.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($social_net_id,$social_net_name,$is_active,$created_on,$created_by,$last_updated_on,$last_updated_by)
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
        DB::table('social_networks')
            ->where('social_net_id',$social_net_id)
            ->update(array('social_net_id'=> $social_net_id,'social_net_name'=>$social_net_name,'is_active'=>$is_active,'created_on'=>$created_on,'created_by'=>$created_by,'last_updated_on'=>$last_updated_on,
                'last_updated_by'=>$last_updated_by));

        $role = DB::table('social_networks')->where('social_net_id', $social_net_id)->first();
        return View::make("social_networks/Create.index",array("data"=> json_encode($role)));
    }

	/**
	 * Update the specified socialnetwork in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$socialnetwork = Socialnetwork::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Socialnetwork::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$socialnetwork->update($data);

		return Redirect::route('socialnetworks.index');
	}

	/**
	 * Remove the specified socialnetwork from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $role = DB::table('social_networks')->where('social_net_id', $id)->first();
        if($role!=null) {
            DB::table('social_networks')->where('social_net_id', $id)->delete();
            $role = DB::table('social_networks')->where('social_net_id', $id)->first();
            if ($role == null)
                return View::make('social_networks/Delete.index', array("data" => '1'));
            else
                return View::make('social_networks/Delete.index', array("data" => '0'));
        }
        else
            return View::make('social_networks/Delete.index', array("data" => '0'));

    }

}
