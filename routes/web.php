<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

// Route Parameters
// Route::get('/user/{id}', [UserController::class, 'show']);

// Route Model Binding
Route::get('/user/{user}', [UserController::class, 'fancyShow']);
// Route::get('/user/{snowflake}', [UserController::class, 'weirdShow']);

// Route::post('user/{user}', [UserController::class, 'update']);






// Scopes
Route::get('/allUsers', function(){
    return User::all();
});

Route::get('/activeUsers', function(){
    return User::good()->get()
});

Route::get('/inactiveUsers', function(){
    return User::bad()->get();
});

Route::get('/statusUsers', function(){
    return User::status('active')->get();
});






$notes = [
    [
        'date' => now()->subDay(),
        'note' => 'Hey there',
    ],
    [
        'date' => now(),
        'note' => 'Other Note',
    ],
];

$details = [
    "timezone" => "America/Los_Angeles",
    "gender" => "Male",
    "ice_cream" => "cookie dough",
];

// Casts
Route::get('withoutCasts', function() use ($notes, $details){
    $user = User::first();

    $user->notes = json_encode($notes);
    $user->details = json_encode($details);
    $user->save();

    ////....

    $user = User::first();

    foreach(json_decode($user->notes, true) as $note) {
        echo '[<b>' . $note['date'] . '</b>] ' . $note['note'] . '<br />';
    }

    echo '<br /><br />';

    foreach(json_decode($user->details, true) as $detail => $value) {
        echo '[<b>' . $detail . '</b>] ' . $value . '<br />';
    }
});

Route::get('withCasts', function() use ($notes, $details){
    $user = User::first();

    $user->notes = $notes;
    $user->details = $details;
    $user->save();

    ////....

    $user = User::first();

    foreach($user->notes as $note) {
        echo '[<b>' . $note['date'] . '</b>] ' . $note['note'] . '<br />';
    }

    echo '<br /><br />';

    foreach($user->details as $detail => $value) {
        echo '[<b>' . $detail . '</b>] ' . $value . '<br />';
    }
});

Route::get('ssnCast', function(){
    $user = User::first();
    $user->ssn = rand(100000000, 999999999);
    $user->save();

    return $user;
});

Route::get('implicitArrays', function(){
    // casted notes as AsArrayObject::class
    $user = User::first();

    $user->notes['date'] = now();

    $user->save();

    return $user;
});










// Query Builder vs Collections
Route::get('builder', function(){
    $user = User::first();

    // Collection
    dump(
        $user->ideas->where('votes', '>', 25)
    );

    // Query Builder
    // dump(
    //     $user->ideas()->where('votes', '>', 25)->first()->voters()->count()
    // );


    // Collection
    // dump(
    //     $user->ideas->where('votes', '>', 25)->count()
    // );

    // Query Builder
    dump(
        $user->ideas()->where('votes', '>', 25)->count()
    );
});







// Query Log && Eager Loading
Route::get('queryLog', function(){
    // DB::enableQueryLog();

    $user = User::first();
    // $user = User::with('ideas.voters')->first();

    foreach($user->ideas as $idea) {
        foreach($idea->voters as $voter) {
            // do something
        }
    }

    echo 'done';

    // dump(DB::getQueryLog());
});










// request() vs $request
Route::get('create', [UserController::class, 'create'])->name('create');
Route::post('post', [UserController::class, 'store'])->name('save');
