<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\CourseController;
use App\Models\course;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/user", function () {
    return "jkjjkj";
});
Route::get("/config", function () {
    return response()->json(array("delete"=>"no"), 200);
});
Route::post("/user", function () {

    $course = course::find(1);
    return response()->json($course->name, 401);
});
Route::post("client/store", [ClientController::class, "store"]);
Route::post("student/store/{id}", [StudentController::class, "index"]);
Route::get("course/show/{id}", [CourseController::class, "getCoursesByStudent"]);