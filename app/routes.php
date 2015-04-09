<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{

    $users = DB::table('user')->get();
    return $users;
	return View::make('hello');
});

Route::get('/AppUser/{name}/{password}/{email}' ,'AppController@SignUp');

/*
 *   Users Routes
 */
Route::get('/Users/Create/{userID}/{user_category}/{password}/{is_active}/{is_pass_changed}/{is_thirdparty_user}/{potential_points}/{global_rank}/{created_on}/{last_login_date}/{last_updated_on}' ,'UsersController@SignUp');
Route::get('/Users/Update/{userID}/{user_category}/{password}/{is_active}/{is_pass_changed}/{is_thirdparty_user}/{potential_points}/{global_rank}/{created_on}/{last_login_date}/{last_updated_on}' ,'UsersController@edit');
Route::get('/Users' ,'UsersController@index');
Route::get('/Users/{id}' ,'UsersController@show');
Route::get('/Users/Delete/{id}' ,'UsersController@destroy');

/*
 *   Admins Routes
 */
Route::get('/admins/Create/{adminID}/{password}/{is_active}/{created_on}/{last_login_date}/{last_updated_on}' ,'AdminsController@store');
Route::get('/admins/Update/{adminID}/{password}/{is_active}/{created_on}/{last_login_date}/{last_updated_on}' ,'AdminsController@edit');
Route::get('/admins' ,'AdminsController@index');
Route::get('/admins/{id}' ,'AdminsController@show');
Route::get('/admins/Delete/{id}' ,'AdminsController@destroy');

/*
 *  Admin_profiles Routes
 */
Route::get('/Admin_profiles/Create/{adminID}/{full_name}/{phone}/{dob}/{country}/{gender}/{is_active}/{created_on}/{last_updated_on}' ,'AdminProfilesController@store');
Route::get('/Admin_profiles/Update/{id}/{adminID}/{password}/{is_active}/{created_on}/{last_login_date}/{last_updated_on}' ,'AdminProfilesController@edit');
Route::get('/Admin_profiles' ,'AdminProfilesController@index');
Route::get('/Admin_profiles/{id}' ,'AdminProfilesController@show');
Route::get('/Admin_profiles/Delete/{id}' ,'AdminProfilesController@destroy');

/*
 *  Roles Routes
 */
Route::get('/Roles/Create/{roleID}/{role_desc}/{is_active}/{created_on}/{created_by}/{last_updated_on}/{last_updated_by}' ,'RolesController@store');
Route::get('/Roles/Update/{roleID}/{role_desc}/{is_active}/{created_on}/{created_by}/{last_updated_on}/{last_updated_by}' ,'RolesController@edit');
Route::get('/Roles' ,'RolesController@index');
Route::get('/Roles/{id}' ,'RolesController@show');
Route::get('/Roles/Delete/{id}' ,'RolesController@destroy');

/*
 *  Tasks Routes
 */
Route::get('/Tasks/Create/{taskID}/{task_desc}/{task_module_type}/{is_active}/{created_on}/{created_by}/{last_updated_on}/{last_updated_by}' ,'TasksController@store');
Route::get('/Tasks/Update/{taskID}/{task_desc}/{task_module_type}/{is_active}/{created_on}/{created_by}/{last_updated_on}/{last_updated_by}' ,'TasksController@edit');
Route::get('/Tasks' ,'TasksController@index');
Route::get('/Tasks/{id}' ,'TasksController@show');
Route::get('/Tasks/Delete/{id}' ,'TasksController@destroy');

/*
 *  Leagues Routes
 */
Route::get('/Leagues/Create/{leagueID}/{league_name}/{is_active}/{created_on}/{created_by}/{last_updated_on}/{last_updated_by}' ,'LeaguesController@store');
Route::get('/Leagues/Update/{leagueID}/{league_name}/{is_active}/{created_on}/{created_by}/{last_updated_on}/{last_updated_by}' ,'LeaguesController@edit');
Route::get('/Leagues' ,'LeaguesController@index');
Route::get('/Leagues/{id}' ,'LeaguesController@show');
Route::get('/Leagues/Delete/{id}' ,'LeaguesController@destroy');

/*
 *  League_teams Routes
 */
Route::get('/League_teams/Create/{teamID}/{team_name}/{team_abbr}/{division_id}/{division_name/{venue}/{city}/{country}/{league_id}/{is_active}/{created_on}/{last_updated_on}' ,'LeagueTeamsController@store');
Route::get('/League_teams/Update/{teamID}/{team_name}/{team_abbr}/{division_id}/{division_name/{venue}/{city}/{country}/{league_id}/{is_active}/{created_on}/{last_updated_on}' ,'LeagueTeamsController@edit');
Route::get('/League_teams' ,'LeagueTeamsController@index');
Route::get('/League_teams/{id}' ,'LeagueTeamsController@show');
Route::get('/League_teams/Delete/{id}' ,'LeagueTeamsController@destroy');

