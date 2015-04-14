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
Route::get('/nfl_events/Create/{event_id}/{season_id}/{season_year}/{season_type}/{league_id}/{status}/{home_team_id}/{away_team_id}/{venue_id}/{venue_name}/{venue_city}/{venue_country}/{venue_zip}/{venue_state}/{is_active}/{created_on}/{schedduled_on}/{last_update_on}' ,'NflEventsController@store');
Route::get('/nfl_events/Update/{event_id}/{season_id}/{season_year}/{season_type}/{league_id}/{status}/{home_team_id}/{away_team_id}/{venue_id}/{venue_name}/{venue_city}/{venue_country}/{venue_zip}/{venue_state}/{is_active}/{created_on}/{schedduled_on}/{last_update_on}' ,'NflEventsController@edit');
Route::get('/nfl_events' ,'NflEventsController@index');
Route::get('/nfl_events/{id}' ,'NflEventsController@show');
Route::get('/nfl_events/Delete/{id}' ,'NflEventsController@destroy');

/*
 *  Nhl_Events Routes
 */
Route::get('/nhl_events/Create/{event_id}/{season_id}/{season_year}/{season_type}/{league_id}/{status}/{home_team_id}/{away_team_id}/{venue_id}/{venue_name}/{venue_city}/{venue_country}/{venue_zip}/{venue_state}/{is_active}/{created_on}/{schedduled_on}/{last_update_on}' ,'NhlEventsController@store');
Route::get('/nhl_events/Update/{event_id}/{season_id}/{season_year}/{season_type}/{league_id}/{status}/{home_team_id}/{away_team_id}/{venue_id}/{venue_name}/{venue_city}/{venue_country}/{venue_zip}/{venue_state}/{is_active}/{created_on}/{schedduled_on}/{last_update_on}' ,'NhlEventsController@edit');
Route::get('/nhl_events' ,'NhlEventsController@index');
Route::get('/nhl_events/{id}' ,'NhlEventsController@show');
Route::get('/nhl_events/Delete/{id}' ,'NhlEventsController@destroy');


/*
 *  Mlb_live_events Routes
 */
Route::get('/mlb_live_events/Create/{event_id}/{season_id}/{season_year}/{season_type}/{league_id}/{status}/{home_team_id}/{away_team_id}/{venue_id}/{venue_name}/{venue_city}/{venue_country}/{venue_zip}/{venue_state}/{is_active}/{created_on}/{schedduled_on}/{last_update_on}' ,'MlbLiveEventsController@store');
Route::get('/mlb_live_events/Update/{sr_no}/{event_id}/{season_id}/{season_year}/{season_type}/{league_id}/{status}/{home_team_id}/{away_team_id}/{venue_id}/{venue_name}/{venue_city}/{venue_country}/{venue_zip}/{venue_state}/{is_active}/{created_on}/{schedduled_on}/{last_update_on}' ,'MlbLiveEventsController@edit');
Route::get('/mlb_live_events' ,'MlbLiveEventsController@index');
Route::get('/mlb_live_events/{id}' ,'MlbLiveEventsController@show');
Route::get('/mlb_live_events/Delete/{id}' ,'MlbLiveEventsController@destroy');

/*
 *  Nba_live_events Routes
 */
Route::get('/nba_live_events/Create/{event_id}/{season_id}/{season_year}/{season_type}/{league_id}/{status}/{home_team_id}/{away_team_id}/{venue_id}/{venue_name}/{venue_city}/{venue_country}/{venue_zip}/{venue_state}/{is_active}/{created_on}/{schedduled_on}/{last_update_on}' ,'NbaLiveEventsController@store');
Route::get('/nba_live_events/Update/{sr_no}/{event_id}/{season_id}/{season_year}/{season_type}/{league_id}/{status}/{home_team_id}/{away_team_id}/{venue_id}/{venue_name}/{venue_city}/{venue_country}/{venue_zip}/{venue_state}/{is_active}/{created_on}/{schedduled_on}/{last_update_on}' ,'NbaLiveEventsController@edit');
Route::get('/nba_live_events' ,'NbaLiveEventsController@index');
Route::get('/nba_live_events/{id}' ,'NbaLiveEventsController@show');
Route::get('/nba_live_events/Delete/{id}' ,'NbaLiveEventsController@destroy');


/*
 *  Nfl_live_events Routes
 */
Route::get('/nfl_live_events/Create/{event_id}/{season_id}/{season_year}/{season_type}/{league_id}/{status}/{home_team_id}/{away_team_id}/{venue_id}/{venue_name}/{venue_city}/{venue_country}/{venue_zip}/{venue_state}/{is_active}/{created_on}/{schedduled_on}/{last_update_on}' ,'NflLiveEventsController@store');
Route::get('/nfl_live_events/Update/{sr_no}/{event_id}/{season_id}/{season_year}/{season_type}/{league_id}/{status}/{home_team_id}/{away_team_id}/{venue_id}/{venue_name}/{venue_city}/{venue_country}/{venue_zip}/{venue_state}/{is_active}/{created_on}/{schedduled_on}/{last_update_on}' ,'NflLiveEventsController@edit');
Route::get('/nfl_live_events' ,'NflLiveEventsController@index');
Route::get('/nfl_live_events/{id}' ,'NflLiveEventsController@show');
Route::get('/nfl_live_events/Delete/{id}' ,'NflLiveEventsController@destroy');

/*
 *  Nhl_live_events Routes
 */
Route::get('/nhl_live_events/Create/{event_id}/{season_id}/{season_year}/{season_type}/{league_id}/{status}/{home_team_id}/{away_team_id}/{venue_id}/{venue_name}/{venue_city}/{venue_country}/{venue_zip}/{venue_state}/{is_active}/{created_on}/{schedduled_on}/{last_update_on}' ,'NhlLiveEventsController@store');
Route::get('/nhl_live_events/Update/{sr_no}/{event_id}/{season_id}/{season_year}/{season_type}/{league_id}/{status}/{home_team_id}/{away_team_id}/{venue_id}/{venue_name}/{venue_city}/{venue_country}/{venue_zip}/{venue_state}/{is_active}/{created_on}/{schedduled_on}/{last_update_on}' ,'NhlLiveEventsController@edit');
Route::get('/nhl_live_events' ,'NhlLiveEventsController@index');
Route::get('/nhl_live_events/{id}' ,'NhlLiveEventsController@show');
Route::get('/nhl_live_events/Delete/{id}' ,'NhlLiveEventsController@destroy');


/*
 *  Mlb_event_scores Routes
 */
Route::get('/mlb_event_scores/Create/{event_id}/{h_runs}/{a_runs}/{h_pitches}/{a_pitches}/{h_balls}/{a_balls}/{h_strikes}/{a_strikes}/{h_strikes_outs}/{a_strikes_outs}/{h_doubles}/{a_doubles}/{h_triples}/{a_triples}/{h_home_runs}/{a_home_runs}/{h_works}/{a_works}/{h_errors}/{a_errors}/{h_hit_by_pitch}/{a_hit_by_pitch}/{h_double_plays}/{a_double_plays}/{inning_no}/{created_on}/{last_updated_on}' ,'MlbEventScoresController@store');
Route::get('/mlb_event_scores/Update/{sr_no}/{event_id}/{h_runs}/{a_runs}/{h_pitches}/{a_pitches}/{h_balls}/{a_balls}/{h_strikes}/{a_strikes}/{h_strikes_outs}/{a_strikes_outs}/{h_doubles}/{a_doubles}/{h_triples}/{a_triples}/{h_home_runs}/{a_home_runs}/{h_works}/{a_works}/{h_errors}/{a_errors}/{h_hit_by_pitch}/{a_hit_by_pitch}/{h_double_plays}/{a_double_plays}/{inning_no}/{created_on}/{last_updated_on}' ,'MlbEventScoresController@edit');
Route::get('/mlb_event_scores' ,'MlbEventScoresController@index');
Route::get('/mlb_event_scores/{id}' ,'MlbEventScoresController@show');
Route::get('/mlb_event_scores/Delete/{id}' ,'MlbEventScoresController@destroy');


/*
 *  Mlb_live_event_scores Routes
 */
Route::get('/mlb_live_event_scores/Create/{event_id}/{h_runs}/{a_runs}/{h_pitches}/{a_pitches}/{h_balls}/{a_balls}/{h_strikes}/{a_strikes}/{h_strikes_outs}/{a_strikes_outs}/{h_doubles}/{a_doubles}/{h_triples}/{a_triples}/{h_home_runs}/{a_home_runs}/{h_works}/{a_works}/{h_errors}/{a_errors}/{h_hit_by_pitch}/{a_hit_by_pitch}/{h_double_plays}/{a_double_plays}/{inning_no}/{created_on}/{last_updated_on}' ,'MlbLiveEventScoresController@store');
Route::get('/mlb_live_event_scores/Update/{sr_no}/{event_id}/{h_runs}/{a_runs}/{h_pitches}/{a_pitches}/{h_balls}/{a_balls}/{h_strikes}/{a_strikes}/{h_strikes_outs}/{a_strikes_outs}/{h_doubles}/{a_doubles}/{h_triples}/{a_triples}/{h_home_runs}/{a_home_runs}/{h_works}/{a_works}/{h_errors}/{a_errors}/{h_hit_by_pitch}/{a_hit_by_pitch}/{h_double_plays}/{a_double_plays}/{inning_no}/{created_on}/{last_updated_on}' ,'MlbLiveEventScoresController@edit');
Route::get('/mlb_live_event_scores' ,'MlbLiveEventScoresController@index');
Route::get('/mlb_live_event_scores/{id}' ,'MlbLiveEventScoresController@show');
Route::get('/mlb_live_event_scores/Delete/{id}' ,'MlbLiveEventScoresController@destroy');


/*
 *  Nba_event_scores Routes
 */
Route::get('/nba_event_scores/Create/{event_id}/{h_points}/{a_points}/{h_assists}/{a_assists}/{h_rebounds}/{a_rebounds}/{h_blocks}/{a_blocks}/{h_steals}/{a_steals}/{h_turnovers}/{a_turnovers}/{h_3pointers_made}/{a_3pointers_made}/{h_3pointers_attempt}/{a_3pointers_attempt}/{h_foul_shots_made}/{a_foul_shots_made}/{h_foul_shots_attempt}/{a_foul_shots_attempt}/{quarter_no}/{created_on}/{last_updated_on}' ,'NbaEventScoresController@store');
Route::get('/nba_event_scores/Update/{sr_no}/{event_id}/{h_points}/{a_points}/{h_assists}/{a_assists}/{h_rebounds}/{a_rebounds}/{h_blocks}/{a_blocks}/{h_steals}/{a_steals}/{h_turnovers}/{a_turnovers}/{h_3pointers_made}/{a_3pointers_made}/{h_3pointers_attempt}/{a_3pointers_attempt}/{h_foul_shots_made}/{a_foul_shots_made}/{h_foul_shots_attempt}/{a_foul_shots_attempt}/{quarter_no}/{created_on}/{last_updated_on}' ,'NbaEventScoresController@edit');
Route::get('/nba_event_scores' ,'NbaEventScoresController@index');
Route::get('/nba_event_scores/{id}' ,'NbaEventScoresController@show');
Route::get('/nba_event_scores/Delete/{id}' ,'NbaEventScoresController@destroy');


/*
 *  Nba_live_event_scores Routes
 */
Route::get('/nba_live_event_scores/Create/{event_id}/{h_points}/{a_points}/{h_assists}/{a_assists}/{h_rebounds}/{a_rebounds}/{h_blocks}/{a_blocks}/{h_steals}/{a_steals}/{h_turnovers}/{a_turnovers}/{h_3pointers_made}/{a_3pointers_made}/{h_3pointers_attempt}/{a_3pointers_attempt}/{h_foul_shots_made}/{a_foul_shots_made}/{h_foul_shots_attempt}/{a_foul_shots_attempt}/{quarter_no}/{created_on}/{last_updated_on}' ,'NbaLiveEventScoresController@store');
Route::get('/nba_live_event_scores/Update/{sr_no}/{event_id}/{h_points}/{a_points}/{h_assists}/{a_assists}/{h_rebounds}/{a_rebounds}/{h_blocks}/{a_blocks}/{h_steals}/{a_steals}/{h_turnovers}/{a_turnovers}/{h_3pointers_made}/{a_3pointers_made}/{h_3pointers_attempt}/{a_3pointers_attempt}/{h_foul_shots_made}/{a_foul_shots_made}/{h_foul_shots_attempt}/{a_foul_shots_attempt}/{quarter_no}/{created_on}/{last_updated_on}' ,'NbaLiveEventScoresController@edit');
Route::get('/nba_live_event_scores' ,'NbaLiveEventScoresController@index');
Route::get('/nba_live_event_scores/{id}' ,'NbaLiveEventScoresController@show');
Route::get('/nba_live_event_scores/Delete/{id}' ,'NbaLiveEventScoresController@destroy');