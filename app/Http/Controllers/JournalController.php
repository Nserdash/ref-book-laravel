<?php

namespace App\Http\Controllers;
use App\Models\Journal;
use App\Models\Authors;
use App\Models\Authors2Journals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class JournalController extends Controller
{
    function AllData() {
        return view('journals', [

            'data' => Journal::where('publicated','=', 1)->orderBy('id', 'desc')->get(),
            
            'readyauthors'=>DB::table('authors')
            ->join('authors2_journals','authors.id', '=', 'authors2_journals.author_id')            
            ->get(),

        ]);
    }

    function AllNotPub() {
        return view('journals', [
            
            'data' => Journal::where('publicated','=', 0)->orderBy('id', 'desc')->get(),

            'readyauthors'=>DB::table('authors')
            ->join('authors2_journals','authors.id', '=', 'authors2_journals.author_id')            
            ->get(),

        ]);
    }

    function AllAuthorJournal($id) {
        return view('journals', [
            
            'data' => DB::select('CALL authors_journals_procedure(?)',[$id]),

            'readyauthors'=>DB::table('authors')
            ->join('authors2_journals','authors.id', '=', 'authors2_journals.author_id')            
            ->get(),

            'authornames' => Authors::all()->where('id', '=', $id)

        ]);
    }

    function Create() {                
        $id = Journal::insertGetId(array('publicated' => 0));            
        return redirect()->route('journal.editpage' , ['id' => $id]);
    }

    function EditPage($id) {

        return view('journaledit', [

            'data'=>Journal::all()
            ->where('id','=', $id),
            
            'authors'=>DB::table('authors')
            ->join('authors2_journals','authors.id', '=', 'authors2_journals.author_id')
            ->where('journal_id','=',$id)
            ->get(),

            'allauthors'=>Authors::all(),
            
        ]);

    }

    function Edit(Request $req) {
                
        if(isset($_POST['idauthor'])) {
            $validation = $req->validate([                
                'img' => 'max:2000',
                'idauthor' => 'required',
            ]);    
        } elseif(isset($_POST['save'])) {
            $validation = true;
        }
         else {
            $validation = $req->validate([
                'name'=>'required',          
                'checkauthors'=>'required|numeric|min:1',
                'img' => 'max:2000'
            ]);    
        }        

        if($validation) {
            
            if($req->input('date') != NULL) {
                $date = date("Y.m.d.",strtotime($req->input('date')));
            } else {
                $date = NULL;
            }
            

            if($req->file('img')) {
                
                $img = uniqid();
                $file = $req->file('img');
                $upload_folder = 'public/images';
                $filename = $img; 
    
                Storage::putFileAs($upload_folder, $file, $filename);

                Journal::where('id', $req->input('idjournal'))->update(array('name' => $req->input('name'), 'desc' => $req->input('desc'), 'img' =>$img, 'date_of_publication' => $date));        
            } else {
                Journal::where('id', $req->input('idjournal'))->update(array('name' => $req->input('name'), 'desc' => $req->input('desc'), 'date_of_publication' => $date));        
            }

            
            if(isset($_POST['idauthor'])) {                
                DB::statement('CALL authors_journals_insert_procedure(:a, :j);',
                array(
                    'a' => $req->input('idauthor'),
                    'j' => $req->input('idjournal'),            
                ));         
            }

            if(isset($_POST['publicate'])) {
                Journal::where('id', $req->input('idjournal'))->update(array('publicated' => 1));        
                return redirect()->route('journal');
            } else {
               return redirect()->route('journal.editpage' , ['id' => $req->input('idjournal')]);
            }               

        
        }


        


    }

    function Delete(Request $req) {

        $admin = Journal::findOrFail($req->input('id'));
        $admin->delete();

        if(isset($_POST['dontsave'])) {
            return redirect()->route('journal');
        } else {
            return back();
        }
                
    }

    function DeleteAll(Request $req) {

        DB::table('journals')
        ->where('publicated','=', 0)
        ->delete();
        return back();

    }

    function DeleteAuthorFromJ($id) {

        $admin = Authors2Journals::findOrFail($id);
        $admin->delete();
        return back();
        

    }    

}