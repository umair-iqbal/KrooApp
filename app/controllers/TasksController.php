<?php

class TasksController extends \BaseController {

	/**
	 * Display a listing of tasks
	 *
	 * @return Response
	 */
    public $restful = true;
    public function index()
    {
        $tasks = Task::all();
        return View::make('Tasks.index',array("data"=> json_encode($tasks)));
    }



	/**
	 * Show the form for creating a new task
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('tasks.create');
	}

	/**
	 * Store a newly created task in storage.
	 *
	 * @return Response
	 */
    public function store($taskID,$task_desc,$task_module_type,$is_active,$created_on,$created_by,$last_updated_on,$last_updated_by)
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
        DB::table('tasks')
            ->insert(array('task_id'=> $taskID,'task_desc'=>$task_desc,'task_module_type'=>$task_module_type,'is_active'=>$is_active,'created_on'=>$created_on,'created_by'=>$created_by,'last_updated_on'=>$last_updated_on,
                'last_updated_by'=>$last_updated_by));

        $task = DB::table('tasks')->where('task_id', $taskID)->first();
        return View::make("Tasks/Create.index",array("data"=> json_encode($task)));
    }

	/**
	 * Display the specified task.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $tasks = DB::table('tasks')->where('task_id', $id)->first();
        return View::make('Tasks.index', array("data"=> json_encode($tasks)));
	}

	/**
	 * Show the form for editing the specified task.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($taskID,$task_desc,$task_module_type,$is_active,$created_on,$created_by,$last_updated_on,$last_updated_by)
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
        DB::table('tasks')
            ->where('task_id',$taskID)
            ->update(array('task_id'=> $taskID,'task_desc'=>$task_desc,'task_module_type'=>$task_module_type,'is_active'=>$is_active,'created_on'=>$created_on,'created_by'=>$created_by,'last_updated_on'=>$last_updated_on,
                'last_updated_by'=>$last_updated_by));

        $task = DB::table('tasks')->where('task_id', $taskID)->first();
        return View::make("Tasks/Update.index",array("data"=> json_encode($task)));
    }
	/**
	 * Update the specified task in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$task = Task::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Task::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$task->update($data);

		return Redirect::route('tasks.index');
	}

	/**
	 * Remove the specified task from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $task = DB::table('tasks')->where('task_id', $id)->first();
        if($task!=null) {
            DB::table('tasks')->where('task_id', $id)->delete();
            $task = DB::table('tasks')->where('task_id', $id)->first();
            if ($task == null)
                return View::make('Tasks/Delete.index', array("data" => '1'));
            else
                return View::make('Tasks/Delete.index', array("data" => '0'));
        }
        else
            return View::make('Tasks/Delete.index', array("data" => '0'));

    }

}
