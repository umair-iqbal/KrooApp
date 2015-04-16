<?php

class SystemParametersController extends \BaseController {

	/**
	 * Display a listing of systemparameters
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$systemparameters = Systemparameter::all();

        return View::make('system_parameters.index',array("data"=> json_encode($systemparameters)));
	}

	/**
	 * Show the form for creating a new systemparameter
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('systemparameters.create');
	}

	/**
	 * Store a newly created systemparameter in storage.
	 *
	 * @return Response
	 */
    public function store($param_id,$param_desc,$is_active,$created_on,$created_by,$last_updated_on,$last_updated_by)
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
        DB::table('system_parameters')
            ->insert(array('param_id'=> $param_id,'param_desc'=>$param_desc,'is_active'=>$is_active,'created_on'=>$created_on,'created_by'=>$created_by,'last_updated_on'=>$last_updated_on,
                'last_updated_by'=>$last_updated_by));

        $role = DB::table('system_parameters')->where('param_id', $param_id)->first();
        return View::make("system_parameters/Create.index",array("data"=> json_encode($role)));
    }


	/**
	 * Display the specified systemparameter.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $role = DB::table('system_parameters')->where('param_id', $id)->first();

        return View::make('system_parameters.index', array("data"=> json_encode($role)));
	}

	/**
	 * Show the form for editing the specified systemparameter.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($param_id,$param_desc,$is_active,$created_on,$created_by,$last_updated_on,$last_updated_by)
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
        DB::table('system_parameters')
            ->where('param_id',$param_id)
            ->update(array('param_id'=> $param_id,'param_desc'=>$param_desc,'is_active'=>$is_active,'created_on'=>$created_on,'created_by'=>$created_by,'last_updated_on'=>$last_updated_on,
                'last_updated_by'=>$last_updated_by));

        $role = DB::table('system_parameters')->where('param_id', $param_id)->first();
        return View::make("system_parameters/Create.index",array("data"=> json_encode($role)));
    }


    /**
	 * Update the specified systemparameter in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$systemparameter = Systemparameter::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Systemparameter::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$systemparameter->update($data);

		return Redirect::route('systemparameters.index');
	}

	/**
	 * Remove the specified systemparameter from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $role = DB::table('system_parameters')->where('param_id', $id)->first();
        if($role!=null) {
            DB::table('system_parameters')->where('param_id', $id)->delete();
            $role = DB::table('system_parameters')->where('param_id', $id)->first();
            if ($role == null)
                return View::make('system_parameters/Delete.index', array("data" => '1'));
            else
                return View::make('system_parameters/Delete.index', array("data" => '0'));
        }
        else
            return View::make('system_parameters/Delete.index', array("data" => '0'));

    }

}
