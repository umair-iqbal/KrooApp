<?php

class UserFollowersController extends \BaseController {

	/**
	 * Display a listing of userfollowers
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$userfollowers = Userfollower::all();

        return View::make('user_followers.index',array("data"=> json_encode($userfollowers)));
	}

	/**
	 * Show the form for creating a new userfollower
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('userfollowers.create');
	}

	/**
	 * Store a newly created userfollower in storage.
	 *
	 * @return Response
	 */
    public function store($user_id,$follower_id,$followed_on,$is_active,$last_updated_on)
    {

        if($last_updated_on!="")
        {
            $last_updated_on =new DateTime($last_updated_on);
        }


        //$user->save();
        DB::table('user_followers')
            ->insert(array('user_id'=> $user_id,'follower_id'=>$follower_id,'followed_on'=>$followed_on,'is_active'=>$is_active,'last_updated_on'=>$last_updated_on
            ));

        $role = DB::table('user_followers')->where('user_id', $user_id)->first();
        return View::make("user_followers/Create.index",array("data"=> json_encode($role)));
    }

	/**
	 * Display the specified userfollower.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $role = DB::table('user_followers')->where('sr_no', $id)->first();

        return View::make('user_followers.index', array("data"=> json_encode($role)));
	}

	/**
	 * Show the form for editing the specified userfollower.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($sr_no,$user_id,$follower_id,$followed_on,$is_active,$last_updated_on)
    {

        if($last_updated_on!="")
        {
            $last_updated_on =new DateTime($last_updated_on);
        }



        DB::table('user_followers')
            ->where('sr_no',$sr_no)
            ->update(array('user_id'=> $user_id,'follower_id'=>$follower_id,'followed_on'=>$followed_on,'is_active'=>$is_active,'last_updated_on'=>$last_updated_on
            ));

        $role = DB::table('user_followers')->where('sr_no', $sr_no)->first();
        return View::make("user_followers/Create.index",array("data"=> json_encode($role)));
    }

	/**
	 * Update the specified userfollower in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$userfollower = Userfollower::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Userfollower::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$userfollower->update($data);

		return Redirect::route('userfollowers.index');
	}

	/**
	 * Remove the specified userfollower from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $role = DB::table('user_followers')->where('sr_no', $id)->first();
        if($role!=null) {
            DB::table('user_followers')->where('sr_no', $id)->delete();
            $role = DB::table('user_followers')->where('sr_no', $id)->first();
            if ($role == null)
                return View::make('user_followers/Delete.index', array("data" => '1'));
            else
                return View::make('user_followers/Delete.index', array("data" => '0'));
        }
        else
            return View::make('user_followers/Delete.index', array("data" => '0'));

    }

}
