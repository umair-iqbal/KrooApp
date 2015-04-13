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
Route::get('/Users/Create/{userID}/{user_category}/{role_id}/{password}/{is_active}/{is_pass_changed}/{is_thirdparty_user}/{potential_points}/{global_rank}/{created_on}/{last_login_date}/{last_updated_on}' ,'UsersController@SignUp');
Route::get('/Users/Update/{userID}/{user_category}/{role_id}/{password}/{is_active}/{is_pass_changed}/{is_thirdparty_user}/{potential_points}/{global_rank}/{created_on}/{last_login_date}/{last_updated_on}' ,'UsersController@edit');
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

/*
 *  League_game_levels Routes
 */
Route::get('/League_game_levels/Create/{leagueID}/{level_no}/{level_desc}/{is_active}/{created_on}' ,'LeagueGameLevelsController@store');
Route::get('/League_game_levels/Update/{sr_no}/{leagueID}/{level_no}/{level_desc}/{is_active}/{created_on}' ,'LeagueGameLevelsController@edit');
Route::get('/League_game_levels' ,'LeagueGameLevelsController@index');
Route::get('/League_game_levels/{id}' ,'LeagueGameLevelsController@show');
Route::get('/League_game_levels/Delete/{id}' ,'LeagueGameLevelsController@destroy');

/*
 *  Team_profiles Routes
 */
Route::get('/Team_profiles/Create/{teamID}/{email}/{phone_no}/{is_active}/{created_on}/{last_updated_on}' ,'TeamProfilesController@store');
Route::get('/Team_profiles/Update/{id}/{teamID}/{email}/{phone_no}/{is_active}/{created_on}/{last_updated_on}' ,'TeamProfilesController@edit');
Route::get('/Team_profiles' ,'TeamProfilesController@index');
Route::get('/Team_profiles/{id}' ,'TeamProfilesController@show');
Route::get('/Team_profiles/Delete/{id}' ,'TeamProfilesController@destroy');

/*
 *  Team_avatars Routes
 */
Route::get('/Team_avatars/Create/{teamID}/{avatarID}/{is_current_avatar}/{is_active}/{created_on}/{last_updated_on}' ,'TeamAvatarsController@store');
Route::get('/Team_avatars/Update/{id}/{teamID}/{avatarID}/{is_current_avatar}/{is_active}/{created_on}/{last_updated_on}' ,'TeamAvatarsController@edit');
Route::get('/Team_avatars' ,'TeamAvatarsController@index');
Route::get('/Team_avatars/{id}' ,'TeamAvatarsController@show');
Route::get('/Team_avatars/Delete/{id}' ,'TeamAvatarsController@destroy');

/*
 *  League_question_constants Routes
 */
Route::get('/league_question_constants/Create/{constant_id}/{leagueID}/{constant_name}/{is_active}/{created_on}/{created_by}/{last_updated_on}/{last_updated_by}' ,'LeagueQuestionConstantsController@store');
Route::get('/league_question_constants/Update/{constant_id}/{leagueID}/{constant_name}/{is_active}/{created_on}/{created_by}/{last_updated_on}/{last_updated_by}' ,'LeagueQuestionConstantsController@edit');
Route::get('/league_question_constants' ,'LeagueQuestionConstantsController@index');
Route::get('/league_question_constants/{id}' ,'LeagueQuestionConstantsController@show');
Route::get('/league_question_constants/Delete/{id}' ,'LeagueQuestionConstantsController@destroy');


/*
 *  League_question_options Routes
 */
Route::get('/league_question_options/Create/{league_ques_id}/{range_start}/{range_end}/{potential_points}/{is_active}/{created_on}/{created_by}/{last_updated_on}/{last_updated_by}/{option_motiv_text}' ,'LeagueQuestionOptionsController@store');
Route::get('/league_question_options/Update/{sr_no}/{league_ques_id}/{range_start}/{range_end}/{potential_points}/{is_active}/{created_on}/{created_by}/{last_updated_on}/{last_updated_by}/{option_motiv_text}' ,'LeagueQuestionOptionsController@edit');
Route::get('/league_question_options' ,'LeagueQuestionOptionsController@index');
Route::get('/league_question_options/{id}' ,'LeagueQuestionOptionsController@show');
Route::get('/league_question_options/Delete/{id}' ,'LeagueQuestionOptionsController@destroy');

/*
 *  League_Questions Routes
 */
Route::get('/league_questions/Create/{league_id}/{constant_id}/{question_text}/{event_id}/{is_active}/{created_on}/{created_by}/{last_updated_on}/{last_updated_by}' ,'LeagueQuestionsController@store');
Route::get('/league_questions/Update/{sr_no}/{league_id}/{constant_id}/{question_text}/{event_id}/{is_active}/{created_on}/{created_by}/{last_updated_on}/{last_updated_by}' ,'LeagueQuestionsController@edit');
Route::get('/league_questions' ,'LeagueQuestionsController@index');
Route::get('/league_questions/{id}' ,'LeagueQuestionsController@show');
Route::get('/league_questions/Delete/{id}' ,'LeagueQuestionsController@destroy');

/*
 *  Mlb_Events Routes
 */
Route::get('/mlb_events/Create/{event_id}/{season_id}/{season_year}/{season_type}/{league_id}/{status}/{home_team_id}/{away_team_id}/{venue_id}/{venue_name}/{venue_city}/{venue_country}/{venue_zip}/{venue_state}/{is_active}/{created_on}/{schedduled_on}/{last_update_on}' ,'MlbEventsController@store');
Route::get('/mlb_events/Update/{event_id}/{season_id}/{season_year}/{season_type}/{league_id}/{status}/{home_team_id}/{away_team_id}/{venue_id}/{venue_name}/{venue_city}/{venue_country}/{venue_zip}/{venue_state}/{is_active}/{created_on}/{schedduled_on}/{last_update_on}' ,'MlbEventsController@edit');
Route::get('/mlb_events' ,'MlbEventsController@index');
Route::get('/mlb_events/{id}' ,'MlbEventsController@show');
Route::get('/mlb_events/Delete/{id}' ,'MlbEventsController@destroy');

/*
 *  Nba_Events Routes
 */
Route::get('/nba_events/Create/{event_id}/{season_id}/{season_year}/{season_type}/{league_id}/{status}/{home_team_id}/{away_team_id}/{venue_id}/{venue_name}/{venue_city}/{venue_country}/{venue_zip}/{venue_state}/{is_active}/{created_on}/{schedduled_on}/{last_update_on}' ,'NbaEventsController@store');
Route::get('/nba_events/Update/{event_id}/{season_id}/{season_year}/{season_type}/{league_id}/{status}/{home_team_id}/{away_team_id}/{venue_id}/{venue_name}/{venue_city}/{venue_country}/{venue_zip}/{venue_state}/{is_active}/{created_on}/{schedduled_on}/{last_update_on}' ,'NbaEventsController@edit');
Route::get('/nba_events' ,'NbaEventsController@index');
Route::get('/nba_events/{id}' ,'NbaEventsController@show');
Route::get('/nba_events/Delete/{id}' ,'NbaEventsController@destroy');

/*
 *  Nfl_Events Routes
 */
Route::get('/nfl_events/Create/{event_id}/{season_id}/{season_year}/{season_type}/{league_id}/{status}/{home_team_id}/{away_team_id}/{venue_id}/{venue_name}/{venue_city}/{venue_country}/{venue_zip}/{venue_state}/{is_active}/{created_on}/{schedduled_on}/{last_update_on}' ,'NbflEventsController@store');
Route::get('/nfl_events/Update/{event_id}/{season_id}/{season_year}/{season_type}/{league_id}/{status}/{home_team_id}/{away_team_id}/{venue_id}/{venue_name}/{venue_city}/{venue_country}/{venue_zip}/{venue_state}/{is_active}/{created_on}/{schedduled_on}/{last_update_on}' ,'NbflEventsController@edit');
Route::get('/nfl_events' ,'NbflEventsController@index');
Route::get('/nfl_events/{id}' ,'NbflEventsController@show');
Route::get('/nfl_events/Delete/{id}' ,'NbflEventsController@destroy');
