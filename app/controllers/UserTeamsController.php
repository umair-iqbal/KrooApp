<?php

class UserTeamsController extends \BaseController {

	/**
	 * Display a listing of userteams
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$userteams = Userteam::all();

        return View::make('user_teams.index',array("data"=> json_encode($userteams)));
	}

	/**
	 * Show the form for creating a new userteam
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('userteams.create');
	}

	/**
	 * Store a newly created userteam in storage.
	 *
	 * @return Response
	 */
    public function store($user_id,$team_id,$is_active,$created_on,$last_updated_on)
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
        DB::table('user_teams')
            ->insert(array('user_id'=> $user_id,'team_id'=>$team_id,'is_active'=>$is_active,'created_on'=>$created_on,'last_updated_on'=>$last_updated_on));

        $role = DB::table('user_teams')->where('user_id', $user_id)->first();
        return View::make("user_teams/Create.index",array("data"=> json_encode($role)));
    }


	/**
	 * Display the specified userteam.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

        $role = DB::table('user_teams')->where('sr_no', $id)->first();

        return View::make('user_teams.index', array("data"=> json_encode($role)));
	}

    public function showByEmail($id)
    {

        $data = DB::table('users')->where('user_id', $id)->first();

        if($data!=null)
        {
            $team = DB::table('user_teams')->where('user_id', $id)->get();


            foreach($team as $item)
            {

                $data1 = DB::table('league_teams')->where('team_id', $item->team_id)->get();
                if ($data1 != null) {
                    $result[] =$data1;
                }
            }

            if($team!=null) {
                return Response::json(array( 'status' => 200,'datajson' => $result));
            }
            else
            {
                return Response::json(array('status' => '405', 'datajson' => 'no record found.'));
            }
        }
        else{
            return Response::json(array('status' => '405', 'datajson' => 'user not exist.'));
        }

    }

	/**
	 * Show the form for editing the specified userteam.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($sr_no,$user_id,$team_id,$is_active,$created_on,$last_updated_on)
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
        DB::table('user_teams')
            ->where('sr_no',$sr_no)
            ->update(array('user_id'=> $user_id,'team_id'=>$team_id,'is_active'=>$is_active,'created_on'=>$created_on,'last_updated_on'=>$last_updated_on));

        $role = DB::table('user_teams')->where('sr_no', $sr_no)->first();
        return View::make("user_teams/Create.index",array("data"=> json_encode($role)));
    }


    /**
	 * Update the specified userteam in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$userteam = Userteam::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Userteam::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$userteam->update($data);

		return Redirect::route('userteams.index');
	}

	/**
	 * Remove the specified userteam from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $role = DB::table('user_teams')->where('sr_no', $id)->first();
        if($role!=null) {
            DB::table('user_teams')->where('sr_no', $id)->delete();
            $role = DB::table('user_teams')->where('sr_no', $id)->first();
            if ($role == null)
                return View::make('user_teams/Delete.index', array("data" => '1'));
            else
                return View::make('user_teams/Delete.index', array("data" => '0'));
        }
        else
            return View::make('user_teams/Delete.index', array("data" => '0'));

    }

}
