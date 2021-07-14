<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('journal');
});

Route::get('/Справочник', '\App\Http\Controllers\JournalController@AllData')->name('journal');

Route::post('/journaldelete', '\App\Http\Controllers\JournalController@Delete')->name('journal.delete');

Route::post('/Добавление журнала', '\App\Http\Controllers\JournalController@Create')->name('journal.add');

Route::get('/Журнал/{id}', '\App\Http\Controllers\JournalController@EditPage')->name('journal.editpage');

Route::post('/edit', '\App\Http\Controllers\JournalController@Edit')->name('journal.edit');

Route::get('/Черновики', '\App\Http\Controllers\JournalController@AllNotPub')->name('journals.notpublicated');

Route::get('/deletenotcr', '\App\Http\Controllers\JournalController@DeleteNotCreated')->name('journals.roughcopy');

Route::post('/Delete', '\App\Http\Controllers\JournalController@DeleteAll')->name('deleteall');

Route::get('/Delete/{id}', '\App\Http\Controllers\JournalController@DeleteAuthorFromJ')->name('deletefromj');


Route::get('/Журналы автора/{id}', '\App\Http\Controllers\JournalController@AllAuthorJournal')->name('journals.authors');


Route::get('/Авторы', '\App\Http\Controllers\AuthorsController@AllData')->name('authors');

Route::post('/author', '\App\Http\Controllers\AuthorsController@Add')->name('author.add');

Route::post('/authordelete', '\App\Http\Controllers\AuthorsController@Delete')->name('author.delete');

Route::post('/authoredit', '\App\Http\Controllers\AuthorsController@Edit')->name('author.edit');

Route::get('/Авторы/{sortby}', '\App\Http\Controllers\AuthorsController@SortBy')->name('authors.sortby');