<?php

class UserEventRewardsController extends \BaseController {

	/**
	 * Display a listing of usereventrewards
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$usereventrewards = Usereventreward::all();

		return View::make('usereventrewards.index', compact('usereventrewards'));
	}

	/**
	 * Show the form for creating a new usereventreward
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('usereventrewards.create');
	}

	/**
	 * Store a newly created usereventreward in storage.
	 *
	 * @return Response
	 */
    public function store($user_id,$event_id,$game_level,$user_rank,$live_points,$last_updated_on)
    {

        if($last_updated_on!="")
        {
            $last_updated_on =new DateTime($last_updated_on);
        }

        //$user->save();
        DB::table('user_event_rewards')
            ->insert(array('user_id'=> $user_id,'event_id'=>$event_id,'game_level'=>$game_level,'user_rank'=>$user_rank,'live_points'=>$live_points,'last_updated_on'=>$last_updated_on,));

        $role = DB::table('user_event_rewards')->where('user_id', $user_id)->first();
        return View::make("user_event_rewards/Create.index",array("data"=> json_encode($role)));
    }
	/**
	 * Display the specified usereventreward.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $role = DB::table('user_event_rewards')->where('sr_no', $id)->first();

        return View::make('user_event_rewards.index', array("data"=> json_encode($role)));
	}

	/**
	 * Show the form for editing the specified usereventreward.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($sr_no,$user_id,$event_id,$game_level,$user_rank,$live_points,$last_updated_on)
    {

        if($last_updated_on!="")
        {
            $last_updated_on =new DateTime($last_updated_on);
        }

        //$user->save();
        DB::table('user_event_rewards')
            ->where('sr_no',$sr_no)
            ->update(array('user_id'=> $user_id,'event_id'=>$event_id,'game_level'=>$game_level,'user_rank'=>$user_rank,'live_points'=>$live_points,'last_updated_on'=>$last_updated_on,));

        $role = DB::table('user_event_rewards')->where('sr_no', $sr_no)->first();
        return View::make("user_event_rewards/Create.index",array("data"=> json_encode($role)));
    }

	/**
	 * Update the specified usereventreward in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$usereventreward = Usereventreward::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Usereventreward::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$usereventreward->update($data);

		return Redirect::route('usereventrewards.index');
	}

	/**
	 * Remove the specified usereventreward from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	    public function destroy($id)
        {
            $role = DB::table('user_event_rewards')->where('sr_no', $id)->first();
            if($role!=null) {
                DB::table('user_event_rewards')->where('sr_no', $id)->delete();
                $role = DB::table('user_event_rewards')->where('sr_no', $id)->first();
                if ($role == null)
                    return View::make('user_event_rewards/Delete.index', array("data" => '1'));
                else
                    return View::make('user_event_rewards/Delete.index', array("data" => '0'));
            }
            else
                return View::make('user_event_rewards/Delete.index', array("data" => '0'));

        }

}
