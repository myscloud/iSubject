<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'LoginController@index');
Route::get('courseDetail/{course_id}','CourseController@showCourseDetail');
Route::get('search','StudentController@search');
Route::get('addComment/{course_id}','CommentController@studentComment');
Route::get('viewComment','StudentController@viewComment');
Route::get('viewAlumnusComment','StudentController@viewAlumnusComment');
Route::get('viewAlumnusComment/{course_id}', 'CommentController@getAlumnusComment');
Route::get('courseList','CourseController@showCurrentCourseList');
Route::get('login', 'AdminController@login');
Route::get('admin','AdminController@admin');
Route::get('addUser','AdminController@adminAdd');
Route::get('addStudent','AdminController@addStudent');
Route::get('addCourse','AdminController@addCourse');
Route::get('addSection','AdminController@addSection');
Route::get('updateSection','AdminController@updateSection');
Route::get('profileA','AdminController@profile');
Route::get('showAllStudiedCourse','RegistrationController@showAllStudiedCourse');
Route::get('showStudyingCourse','RegistrationController@showStudyingCourse');
Route::get('showTeachingCourse','RegistrationController@showTeachingCourse');
Route::get('showAllTaughtCourse','RegistrationController@showAllTaughtCourse');
Route::post('addStudentToCourse','RegistrationController@addStudentToCourse');
Route::post('addTeacherToCourse','RegistrationController@addTeacherToCourse');
Route::post('editStudentInCourse','RegistrationController@editStudentInCourse');
Route::post('authenticate', 'Auth\AuthController@authenticate');

Route::post('addCourse','CourseController@addCourse');
Route::post('addSection','CourseController@addSection');
Route::post('searchCourseById', 'CourseController@searchCourseById');
Route::post('searchCourseByName', 'CourseController@searchCourseByName');
Route::get('profile','UserController@showProfile');
Route::post('addUser','UserController@addUser');
Route::get('addEvent','AdminController@addEvent');
Route::get('addEventU','StudentController@addEvent');
Route::get('sectionDetail','StudentController@sectionDetail');
Route::get('calendar', 'EventController@showCurrentCalendar');

Route::get('addUser/{user_type}', 'UserController@addUserByType');
Route::get('updateStatus','AdminController@updateStatus');
Route::post('addUser/student', 'UserController@addStudent');
Route::post('addUser/teacher', 'UserController@addTeacher');
Route::post('addUser/admin', 'UserController@addAdmin');
Route::post('updateStatus','UserController@updateUserStatus');
Route::post('addEventAdmin', 'EventController@addEventAdmin');
Route::get('courseList/all', 'CourseController@showAllRegisteredCourse');
Route::get('courseList/fav', 'CourseController@showFavCourse');

Route::get('changePassword', 'UserController@showChangePassword');
Route::post('changePassword', 'UserController@changePassword');
Route::get('eventDetail', 'EventController@showEvent');

Route::get('sectionDetail/{course_id}/{sec}/{sem}/{year}', 'CourseController@showSectionDetail');
Route::get('addEvent/{course_id}/{sec}/{sem}/{year}', 'EventController@showAddEvent');

Route::get('alumnusIndex', 'UserController@showAlumnusIndex');
Route::get('addCommentAlumnus/{course_id}', 'CommentController@alumnusComment');
Route::post('addAlumnusComment', 'CommentController@addAlumnusComment');
Route::get('occupationVote/{course_id}', 'CommentController@showOccupationVote');
Route::post('occupationVote', 'CommentController@voteOccupation');
Route::post('addComment', 'CommentController@addStudentComment');
Route::post('viewComment/{course_id}', 'CommentController@searchComment');
Route::get('viewComment/{course_id}', 'CommentController@showComment');

Route::get('editDescription/{course_id}','CourseController@showEditDescription');
Route::post('editDescription', 'CourseController@updateDescription');
Route::post('addUserEvent', 'EventController@addUserEvent');
Route::get('eventDetail/{event_id}', 'EventController@showEventDetail');
Route::get('calendar/{year}/{month}', 'EventController@showCalendar');
Route::get('favourite/{course_id}', 'CourseController@favourite');
Route::get('editEvent/{event_id}', 'EventController@showEditEvent');
Route::post('editEvent', 'EventController@editEvent');
Route::post('deleteEvent', 'EventController@deleteEvent');