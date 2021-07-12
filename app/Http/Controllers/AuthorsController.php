<?php

namespace App\Http\Controllers;
use App\Models\Authors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthorsController extends Controller
{

    function AllData() {
        return view('authors', ['data' => DB::table('author_view')->orderBy('id','desc')->get()]);
    }

    function Add(Request $req) {

        $validation = $req->validate([
            'firstname'=>'required',          
            'surname'=>'required|min:3',
        ]);

        if($validation) {

            $author = new Authors();
            $author->name = $req->input('firstname');
            $author->surname = $req->input('surname');
            $author->patronymic = $req->input('patronymic');
            $author->save();

        }
        return redirect()->route('authors');

    }

    function Edit(Request $req) {

        $validation = $req->validate([
            'firstname'=>'required',          
            'surname'=>'required|min:3',
        ]);

        if($validation) {
            Authors::where('id', $req->input('id'))->update(array('name' => $req->input('firstname'), 'surname' => $req->input('surname'), 'patronymic' => $req->input('patronymic')));                
        }

        return redirect()->route('authors');

    }


    public function Delete(Request $req) {

        $admin = Authors::findOrFail($req->input('id'));
        $admin->delete();
        return back();
        
    }

    function SortBy($sortby) {

        if($sortby == 'asc') {
            $sort = Authors::orderBy('surname', 'asc')->get();
        } elseif($sortby == 'desc') {
            $sort = Authors::orderBy('surname', 'desc')->get();
        } else {
            $sort = Authors::all();
        }
        

        return view('authors', ['data' => $sort]);
    }


}
