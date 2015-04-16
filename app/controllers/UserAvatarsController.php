<?php

class UserAvatarsController extends \BaseController {

	/**
	 * Display a listing of useravatars
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$useravatars = Useravatar::all();

        return View::make('user_avatars.index',array("data"=> json_encode($useravatars)));
	}

	/**
	 * Show the form for creating a new useravatar
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('useravatars.create');
	}

	/**
	 * Store a newly created useravatar in storage.
	 *
	 * @return Response
	 */
    public function store($user_id,$user_avatar,$is_active,$is_current_avatar,$created_on,$last_updated_on,$user_avatarscol)
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
        DB::table('user_avatars')
            ->insert(array('user_id'=> $user_id,'user_avatar'=>$user_avatar,'is_active'=>$is_active,'is_current_avatar'=>$is_current_avatar,'created_on'=>$created_on,'last_updated_on'=>$last_updated_on,
                'user_avatarscol'=>$user_avatarscol));

        $role = DB::table('user_avatars')->where('user_id', $user_id)->first();
        return View::make("user_avatars/Create.index",array("data"=> json_encode($role)));
    }


	/**
	 * Display the specified useravatar.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $role = DB::table('user_avatars')->where('sr_no', $id)->first();

        return View::make('user_avatars.index', array("data"=> json_encode($role)));
	}

	/**
	 * Show the form for editing the specified useravatar.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($sr_no,$user_id,$user_avatar,$is_active,$is_current_avatar,$created_on,$last_updated_on,$user_avatarscol)
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
        DB::table('user_avatars')
            ->where('sr_no',$sr_no)
            ->insert(array('user_id'=> $user_id,'user_avatar'=>$user_avatar,'is_active'=>$is_active,'is_current_avatar'=>$is_current_avatar,'created_on'=>$created_on,'last_updated_on'=>$last_updated_on,
                'user_avatarscol'=>$user_avatarscol));

        $role = DB::table('user_avatars')->where('sr_no', $sr_no)->first();
        return View::make("user_avatars/Create.index",array("data"=> json_encode($role)));
    }

	/**
	 * Update the specified useravatar in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$useravatar = Useravatar::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Useravatar::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$useravatar->update($data);

		return Redirect::route('useravatars.index');
	}

	/**
	 * Remove the specified useravatar from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $role = DB::table('user_avatars')->where('sr_no', $id)->first();
        if($role!=null) {
            DB::table('user_avatars')->where('sr_no', $id)->delete();
            $role = DB::table('user_avatars')->where('sr_no', $id)->first();
            if ($role == null)
                return View::make('user_avatars/Delete.index', array("data" => '1'));
            else
                return View::make('user_avatars/Delete.index', array("data" => '0'));
        }
        else
            return View::make('user_avatars/Delete.index', array("data" => '0'));

    }

}
