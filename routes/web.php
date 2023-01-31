<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\StudentProfileController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return  redirect("login");
})->middleware('auth');

Route::get("/home", function () {

    if (Auth::user()->role == 1) {
        return redirect("dashboard/home");
    } else {

        return redirect("student-dashboard/profile");
    }
});
Auth::routes();



Route::group(['middleware' => 'auth'], function () {

    Route::group(['middleware' => 'profile'], function () {




        Route::get('/dashboard/home', [HomeController::class, 'index'])->name('dashboard')->middleware('admin');

        Route::get("/student-dashboard/profile", [StudentProfileController::class, 'index'])->name("student-profile")->middleware('profile');

        Route::get("/student-profile-course/course", [StudentProfileController::class, 'course'])->name("student-profile-course");

        Route::get("/quiz/student-profile-quiz", [StudentProfileController::class, 'quiz'])->name("student-profile-quiz");


        Route::get("/quiz/student-profile-result", [StudentProfileController::class, 'quiz_select'])->name("student-profile-result");
        Route::post("/quiz/student-profile-result", [StudentProfileController::class, 'quiz_result'])->name("quiz-select-for-student-profile-result");


        Route::post("/quiz/student-response", [StudentProfileController::class, 'student_response'])->name("student-response");

        Route::get("/quiz/student-profile-result/{id}", [StudentProfileController::class, 'quiz_result'])->name("student-profile-result-with-quiz-id");

        Route::get("/student-profile-transaction", [StudentProfileController::class, 'transaction'])->name("student-profile-transaction");

        Route::post("/quiz/quiz-select-for-student-profile-answer", [StudentProfileController::class, "quiz_select_for_quiz"])->name("quiz-select-for-student-profile-answer");


        Route::group(['middleware' => 'admin'], function () {


            Route::group(['prefix' => 'student'], function () {
                Route::get('/add-form', [App\Http\Controllers\StudentController::class, 'index'])->name('student-form');
                Route::get('/edit-form/{id}', [App\Http\Controllers\StudentController::class, 'index'])->name('student-edit-form');
                Route::post('/ssave', [StudentController::class, "store"])->name("ssave");
                Route::get("/slist", [StudentController::class, 'list'])->name("slist");
                Route::get("/active-student-list", [StudentController::class, 'active_student_list'])->name("active-student-list");
                Route::get("/scourse", [StudentController::class, 'scourse'])->name("scourse");
                Route::post("/add-student-course", [StudentController::class, 'scourse_add'])->name("add-student-course");
                Route::get("/sfees", [StudentController::class, 'sfees'])->name("sfees");
                Route::get("/show-course/{id}", [StudentController::class, 'show_student_course'])->name("show-student-course");

                Route::post("/add-student-fees", [StudentController::class, 'sfees_add'])->name("add-student-fees");
                Route::get("/sfees-list", [StudentController::class, 'student_fees_list'])->name("sfees-list");


                Route::get("/sdelete/{id}", [ClientController::class, 'destroy'])->name("cdelete");
                Route::get("/sedit/{id}", [ClientController::class, 'cedit'])->name("cedit");
                Route::post("/supdate/{id}", [ClientController::class, 'cupdate'])->name("cupdate");
            });



            Route::group(['prefix' => '/subject'], function () {

                Route::get("/add-subject", [StudentController::class, "subject"])->name("subject");
                Route::post("/addsubject", [StudentController::class, "addsubject"])->name("add-subject");
                Route::get("/subject-delete/{id}", [StudentController::class, "deletesubject"])->name("subject-delete");
            });


            Route::group(['prefix' => '/course'], function () {
                Route::get("/course-form", [CourseController::class, "index"])->name("course-form");
                Route::post("/addcourse", [CourseController::class, "addcourse"])->name("add-course");
                Route::get("/deletecourse/{id}", [CourseController::class, "destroy"])->name("delete-course");
                Route::get("/edit/{id}", [CourseController::class, "edit"])->name("edit-course");

                Route::get("/course-subject", [CourseController::class, "course_subject"])->name("course-subject");
                Route::post("/course-subject", [CourseController::class, "add_course_subject"])->name("add-course-subject");
            });


            Route::group(['prefix' => '/quiz'], function () {

                Route::get("/addquiz", [QuizController::class, "index"])->name("quiz");
                Route::post("/addquiz", [QuizController::class, "add_quiz"])->name("add-quiz");
                Route::get("/questions", [QuizController::class, "question"])->name("questions");
                Route::post("/add-question", [QuizController::class, "add_question"])->name("add-question");

                Route::get("/answer", [QuizController::class, "answer"])->name("answer");
                Route::post("/add-answer", [QuizController::class, "add_answer"])->name("add-answer");

                Route::post("/quiz-select", [QuizController::class, "quiz_select"])->name("quiz-select");

                Route::post("/quiz-select-for-answer", [QuizController::class, "quiz_select_for_answer"])->name("quiz-select-for-answer");

                Route::get("/delete/{id}", [QuizController::class, "delete_quiz"])->name("delete-quiz");


                Route::get("/delete-question/{id}", [QuizController::class, "delete_question"])->name("delete-question");
            });
        });  // end admin middle ware


    }); //profile middleware end

}); //auth middleware end

//ajax testing route
Route::get("/getfees", [CourseController::class, "getfees"]);
//end




Route::group(['prefix' => 'batch'], function () {
    Route::get("/batch-page", [BatchController::class, "index"])->name("batch");
    Route::post("/add-batch", [BatchController::class, "store"])->name("add-batch");
    Route::get("/delete-batch/{id}", [BatchController::class, "destroy"])->name("delete-batch");
});



//city route

Route::group(['prefix' => '/city'], function () {
    Route::get("/add-city", [CityController::class, "index"])->name("city-form");
    Route::post("/addcity", [CityController::class, "addcity"])->name("add-city");
    Route::get("/deletecity/{id}", [CityController::class, "destroy"])->name("delete-city");
    Route::get("/edit/{id}", [CityController::class, "edit"])->name("edit-city");
});
//city end
Route::group(['prefix' => 'user'], function () {
    Route::get("/user-list", [UserController::class, "index"])->name("user-list");
});
