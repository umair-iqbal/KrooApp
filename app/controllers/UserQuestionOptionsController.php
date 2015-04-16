<?php

class UserQuestionOptionsController extends \BaseController {

	/**
	 * Display a listing of userquestionoptions
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$userquestionoptions = Userquestionoption::all();

        return View::make('user_question_option.index',array("data"=> json_encode($userquestionoptions)));
	}

	/**
	 * Show the form for creating a new userquestionoption
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('userquestionoptions.create');
	}

	/**
	 * Store a newly created userquestionoption in storage.
	 *
	 * @return Response
	 */
    public function store($user_id,$option_id,$event_id,$event_level,$selected_on,$is_selection_correct)
    {
        if($selected_on!="")
        {
            $selected_on =new DateTime($selected_on);
        }

        DB::table('user_question_option')
            ->insert(array('user_id'=> $user_id,'option_id'=>$option_id,'event_id'=>$event_id,'event_level'=>$event_level,'selected_on'=>$selected_on,'is_selection_correct'=>$is_selection_correct));

        $role = DB::table('user_question_option')->where('user_id', $user_id)->first();
        return View::make("user_question_option/Create.index",array("data"=> json_encode($role)));
    }


	/**
	 * Display the specified userquestionoption.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

        $role = DB::table('user_question_option')->where('sr_no', $id)->first();

        return View::make('user_question_option.index', array("data"=> json_encode($role)));
	}

	/**
	 * Show the form for editing the specified userquestionoption.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($sr_no,$user_id,$option_id,$event_id,$event_level,$selected_on,$is_selection_correct)
    {
        if($selected_on!="")
        {
            $selected_on =new DateTime($selected_on);
        }

        DB::table('user_question_option')
            ->where('sr_no',$sr_no)
            ->update(array('user_id'=> $user_id,'option_id'=>$option_id,'event_id'=>$event_id,'event_level'=>$event_level,'selected_on'=>$selected_on,'is_selection_correct'=>$is_selection_correct));

        $role = DB::table('user_question_option')->where('sr_no', $sr_no)->first();
        return View::make("user_question_option/Create.index",array("data"=> json_encode($role)));
    }

	/**
	 * Update the specified userquestionoption in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$userquestionoption = Userquestionoption::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Userquestionoption::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$userquestionoption->update($data);

		return Redirect::route('userquestionoptions.index');
	}

	/**
	 * Remove the specified userquestionoption from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	
   public function destroy($id)
   {
       $role = DB::table('user_question_option')->where('sr_no', $id)->first();
       if($role!=null) {
           DB::table('user_question_option')->where('sr_no', $id)->delete();
           $role = DB::table('user_question_option')->where('sr_no', $id)->first();
           if ($role == null)
               return View::make('user_question_option/Delete.index', array("data" => '1'));
           else
               return View::make('user_question_option/Delete.index', array("data" => '0'));
       }
       else
           return View::make('user_question_option/Delete.index', array("data" => '0'));

   }

}
