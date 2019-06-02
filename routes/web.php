
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

Route::get('/test', function () {
    return view('name');
});




Route::get('/send/email', 'HomeController@mail');


Auth::routes(['verify' => true]);

Route::get('/home', 'PostController@index')->name('home');

Route::get('/logout', 'PostController@index')->name('logout');


Route::get('/dashboard', 'PostController@index')->name('get_post_index');
Route::post('/dashboard','PostController@index')->name('post_post_index');

Route::post('/dashboard/sort','PostController@sort')->name('post_post_sort_index');

Route::get('/dashboard/{username}','PostController@index_order_by_user')->name('get_post_order_by_user')->middleware("auth");

Route::get('/dashboard/type/{type}','PostController@index_order_by_type')->name('get_post_order_by_type')->middleware("auth");


Route::get('/user/edit', 'UserController@edit')->name('get_user_edit')->middleware("auth");
Route::post('/user/edit', 'UserController@edit')->name('post_user_edit')->middleware("auth");


Route::get('/post/add', 'PostController@add')->name('get_post_add')->middleware("auth");
Route::post('/post/add', 'PostController@add')->name('post_post_add')->middleware("auth");

Route::get('/post/{id}/detail', 'PostController@detail')->name('get_post_detail');

Route::get('/post/{id}/delete', 'PostController@delete')->name('get_post_delete')->middleware("auth");

Route::get('/post/{id}/edit', 'PostController@edit')->name('get_post_edit')->middleware("auth");
Route::post('post/{id}/edit', 'PostController@edit')->name('post_post_edit')->middleware("auth");

Route::get('/comment/{id}/add', 'CommentController@add')->name('get_comment_add')->middleware("auth");
Route::post('/comment/{id}/add', 'CommentController@add')->name('post_comment_add')->middleware("auth");

Route::get('/comment/{id}/index', 'CommentController@index')->name('get_comment_index')->middleware("auth");

Route::get('/comment/{id}/delete/{comment_id}', 'CommentController@delete')->name('get_comment_delete')->middleware("auth");

Route::get('/post/{id}/add/{like}/{place}/{username?}', 'Like_detailController@add')->name('get_like_detail_add')->middleware("auth");

Route::get('/comment/{id}/{like}/{comment_id}', 'Like_detailController@add_to_comment')->name('get_like_detail_add_to_comment')->middleware("auth");

Route::get('/message/{send_to_user_id}/add', 'MessageController@add')->name('get_message_add')->middleware("auth");
Route::post('/message/{send_to_user_id}/add', 'MessageController@add')->name('post_message_add')->middleware("auth");


Route::middleware("auth")->group(function ()
{
    Route::get('/message/inbox', 'MessageController@inbox')->name('get_message_inbox');
    Route::get('/message/sent', 'MessageController@sent')->name('get_message_sent');
    Route::get('/message/move_to_trash/{id}', 'MessageController@move_to_trash')->name('get_message_move_to_trash');
    Route::get('/message/trash', 'MessageController@trash')->name('get_message_trash');
});

Route::middleware("auth")->group(function ()
{
    Route::get('/friend/add/{id}', 'FriendController@add')->name('get_friend_add');
    Route::get('/friend/index', 'FriendController@index')->name('get_friend_index');
    Route::get('/message/accpet/{id}', 'FriendController@accpet')->name('get_friend_accpet');
    Route::get('/message/delete/{id}', 'FriendController@delete')->name('get_friend_delete');
    Route::get('/message/ignore/{id}', 'FriendController@ignore')->name('get_friend_ignore');

});
