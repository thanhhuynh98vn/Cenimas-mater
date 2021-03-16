<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::pattern('id','([0-9]*)');
Route::pattern('slug','(.*)');
Auth::routes();
use Illuminate\Support\Facades\Auth;
Route::get('/', function () {
    return view('auth.login');
});


Route::group(['namespace'=>'Admin','middleware'=>'auth'],function (){

    Route::get('film',function (){
        $userId = Auth::id();
        $filmTop = \Illuminate\Support\Facades\DB::table('vote_value')
            ->selectRaw('vote_value.* ,(select count(vote_value_user.id) from vote_value_user where vote_value_id = vote_value.id ) as vote ')
            ->whereIn( 'vote_id',\Illuminate\Support\Facades\DB::table('votes')->select('id')->whereMonth('updated_at',date('m'))
                ->whereYear('updated_at',date('Y')))
            ->orderBy('vote','DESC')
            ->first();
        $userBook = \App\Models\Ticket::where('vote_value_id',$filmTop->id)->where('user_id',$userId)->first();
        $adminBook = \App\Models\BookingSeat::where('film_id',$filmTop->id)->where('user_id',$userId)->count('name');
        $seatNeed = (int)$userBook->quantity - $adminBook;
        $getSeat = \App\Models\BookingSeat::where('user_id',null)->where('film_id',$filmTop->id)->get()->toArray();
        $random = array_random($getSeat,$seatNeed);
        $name = $random[0]['name'];
        if($seatNeed == 1){
            $a=  $random[0]['seat_number'];
            while ($a %2 == 0) {
                $random = array_random($getSeat,$seatNeed);
                $a=  $random[0]['seat_number'];
                $name = $random[0]['name'];
            }
            return $name ;
        }

    });

    Route::group(['prefix'=>'users','middleware' => ['role:superadmin|admin']],function() {
        Route::get('add/check-email')->name('admin.user.AjaxCheckEmail')
            ->uses('UsersController@AjaxCheckEmail');
        Route::get('sentMail', [
            'uses' => 'UsersController@sentMail',
            'as' => 'admin.mailbox'
        ]);
        Route::get('', [
            'uses' => 'UsersController@index',
            'as' => 'admin.users.index'
        ]);
        Route::post('uploadExcel', [
            'uses' => 'UsersController@uploadExcel',
            'as' => 'admin.users.upload'
        ]);
        Route::get('xExportExcel', [
            'uses' => 'UsersController@xExportExcel',
            'as' => 'admin.users.xExport'
        ]);
        Route::get('cExportExcel', [
            'uses' => 'UsersController@cExportExcel',
            'as' => 'admin.users.cExport'
        ]);
        Route::post('create', ['middleware' =>['permission:create_user'],
            'uses' => 'UsersController@store',
            'as' => 'admin.users.create'
        ]);
        Route::get('{id}', [
            'uses' => 'UsersController@show',
            'as' => 'admin.users.show'
        ]);
        Route::get('/dell/{id}', ['middleware' =>['permission:dell_user'],
            'uses' => 'UsersController@destroy',
            'as' => 'admin.users.destroy'
        ]);
        Route::get('/edit/{id}', ['middleware' =>['permission:edit_user'],
            'uses' => 'UsersController@edit',
            'as' => 'admin.users.edit'
        ]);
        Route::post('/edit/{id}', ['middleware' =>['permission:edit_user'],
            'uses' => 'UsersController@update',
            'as' => 'admin.users.update'
        ]);
    });
    Route::group(['prefix'=>'role','middleware' => ['role:superadmin']],function(){
        Route::get('add/check-name')
            ->name('admin.role.AjaxCheckName')
            ->uses('RolesController@AjaxCheckName');
        Route::get('',[
            'uses'=>'RolesController@index',
            'as'=>'admin.role.role'
        ]);
        Route::get('/edit/{id}', [
            'uses'=>'RolesController@edit',
            'as'=>'admin.role.edit'
        ]);
        Route::post('/edit/{id}', [
            'uses' => 'RolesController@update',
            'as' => 'admin.role.update'
        ]);
        Route::get('{id}',[
            'uses'=>'RolesController@show',
            'as'=>'admin.role.show'
        ]);
        Route::post('create', [
            'uses' => 'RolesController@store',
            'as' => 'admin.role.create'
        ]);
        Route::get('/dell/{id}', [
            'uses' => 'RolesController@destroy',
            'as' => 'admin.role.destroy'
        ]);
    });
    Route::group(['prefix'=>'posts'],function(){

        Route::get('', [
            'uses' => 'PostsController@index',
            'as' => 'admin.posts.index'
        ]);
        Route::get('create', ['middleware' =>['permission:create_post'],
            'uses' => 'PostsController@create',
            'as' => 'admin.posts.create'
        ]);
        Route::post('store', ['middleware' =>['permission:create_post'],
            'uses' => 'PostsController@store',
            'as' => 'admin.posts.store'
        ]);
        Route::get('/show/{id}',[
            'uses'=>'PostsController@show',
            'as'=>'admin.posts.show'
        ]);
        Route::get('edit/{id}', ['middleware' =>['permission:editor_post'],
            'uses' => 'PostsController@edit',
            'as' => 'admin.posts.edit'
        ]);
        Route::post('edit/{id}', ['middleware' =>['permission:editor_post'],
            'uses' => 'PostsController@update',
            'as' => 'admin.posts.update'
        ]);
        Route::get('dell/{id}', ['middleware' =>['permission:dell_post'],
            'uses' => 'PostsController@destroy',
            'as' => 'admin.posts.destroy'
        ]);
    });
    Route::group(['prefix'=>'cinemas','middleware' => ['role:superadmin']],function(){
        Route::get('', [
            'uses' => 'CinemasController@index',
            'as' => 'admin.cinemas.index'
        ]);
        Route::post('create', [
            'uses' => 'CinemasController@store',
            'as' => 'admin.cinemas.create'
        ]);
        Route::post('/edit/{id}', [
            'uses' => 'CinemasController@update',
            'as' => 'admin.cinemas.update'
        ]);
        Route::get('/dell/{id}', [
            'uses' => 'CinemasController@destroy',
            'as' => 'admin.cinemas.destroy'
        ]);
    });

    Route::group(['prefix'=>'dashboard','middleware' => 'auth'],function(){
        Route::get('', [
            'uses' => 'DashboardsController@index',
            'as' => 'admin.dashboard.index'
        ]);
    });

    Route::group(['prefix'=>'companies','middleware' => ['role:superadmin']],function(){
        Route::get('', [
            'uses' => 'CompaniesController@index',
            'as' => 'admin.companies.index'
        ]);
        Route::post('create', [
            'uses' => 'CompaniesController@store',
            'as' => 'admin.companies.create'
        ]);
        Route::post('/edit/{id}', [
            'uses' => 'CompaniesController@update',
            'as' => 'admin.companies.update'
        ]);
        Route::get('/dell/{id}', [
            'uses' => 'CompaniesController@destroy',
            'as' => 'admin.companies.destroy'
        ]);
    });
    Route::group(['prefix'=>'rooms','middleware' => ['role:superadmin']],function(){
        Route::get('', [
            'uses' => 'RoomsController@index',
            'as' => 'admin.rooms.index'
        ]);
        Route::post('create', [
            'uses' => 'RoomsController@store',
            'as' => 'admin.rooms.create'
        ]);
        Route::post('/edit/{id}', [
            'uses' => 'RoomsController@update',
            'as' => 'admin.rooms.update'
        ]);
        Route::get('/dell/{id}', [
            'uses' => 'RoomsController@destroy',
            'as' => 'admin.rooms.destroy'
        ]);


    });
    Route::group(['prefix'=>'vote_value','middleware' => ['role:superadmin']],function(){
        //show fim choice

        Route::get('index2', [
            'uses' => 'VoteValuesController@show',
            'as' => 'admin.vote_value.index2'
        ]);
        Route::post('create', [
            'uses' => 'VoteValuesController@store',
            'as' => 'admin.vote_value.create'
        ]);
        Route::get('/editFilm/{id}', [
            'uses' => 'VoteValuesController@edit',
            'as' => 'admin.vote_value.edit']);
        Route::post('/editFilm/{id}', [
            'uses' => 'VoteValuesController@update',
            'as' => 'admin.vote_value.update'
        ]);
        Route::get('/dell/{id}', [
            'uses' => 'VoteValuesController@destroy',
            'as' => 'admin.vote_value.destroy'
        ]);
        Route::post('/bookingSeat', [
            'uses' => 'VoteValuesController@bookingSeat',
            'as' => 'admin.vote_value.bookingSeat'
        ]);
        Route::post('/bookingVip', [
            'uses' => 'VoteValuesController@bookingVip',
            'as' => 'admin.vote_value.bookingVip'
        ]);
    });
    Route::get('votes/show', [
        'uses' => 'VotesController@voteMonth',
        'as' => 'admin.votes.show'
    ]);
    Route::get('votes/ticket', [
        'uses' => 'VotesController@getTicket',
        'as' => 'admin.ticket.index'
    ]);
    Route::post('votes/ajaxTicket', [
        'uses' => 'VotesController@ajaxTicket',
        'as' => 'admin.ticket.ajaxTicket'
    ]);
    Route::post('getIdVote', [
        'uses' => 'VotesController@getIdVote',
        'as' => 'admin.votes.getId'
    ]);
    Route::post('checkVote', [
        'uses' => 'VotesController@checkVote',
        'as' => 'admin.votes.check'
    ]);
    Route::post('random', [
        'uses' => 'VotesController@randomSeat',
        'as' => 'admin.votes.random'
    ]);
    Route::group(['prefix'=>'votes','middleware' => ['role:superadmin']],function(){
        Route::get('', [
            'uses' => 'VotesController@index',
            'as' => 'admin.votes.index'
        ]);

        Route::post('create', [
            'uses' => 'VotesController@store',
            'as' => 'admin.votes.create'
        ]);
        Route::post('/edit/{id}', [
            'uses' => 'VotesController@update',
            'as' => 'admin.votes.update'
        ]);
        Route::get('/dell/{id}', [
            'uses' => 'VotesController@destroy',
            'as' => 'admin.votes.destroy'
        ]);
        Route::post('load', [
            'uses' => 'VotesController@loadAjax',
            'as' => 'admin.votes.load'
        ]);
        //selection seat
        Route::get('selection/seat', [
            'uses' => 'VotesController@getSelectSeat',
            'as' => 'admin.rooms.room1'
        ]);
        Route::post('load/seat', [
            'uses' => 'VotesController@LoadSeat',
            'as' => 'admin.rooms.room'
        ]);
        Route::post('load/seatChecked', [
            'uses' => 'VotesController@LoadSeatChecked',
            'as' => 'admin.rooms.room2'
        ]);

    });

    Route::group(['prefix'=>'setting','middleware' => ['role:superadmin']],function(){
        Route::get('', [
            'uses' => 'RoomSettingController@index',
            'as' => 'admin.settingrooms.index'
        ]);
        Route::post('create', [
            'uses' => 'RoomSettingController@store',
            'as' => 'admin.settingrooms.create'
        ]);
        Route::post('/editSetting/{id}', [
            'uses' => 'RoomSettingController@update',
            'as' => 'admin.settingrooms.update'
        ]);
        Route::get('/dell/{id}', [
            'uses' => 'RoomSettingController@destroy',
            'as' => 'admin.settingrooms.destroy'
        ]);
    });
    });
Route::get('noaccess',function (){
    return view('403');
});
Route::get('google/redirect', 'Auth\LoginController@redirectToProviderGoogle');
Route::get('google/callback', 'Auth\LoginController@handleProviderCallbackGoogle');
