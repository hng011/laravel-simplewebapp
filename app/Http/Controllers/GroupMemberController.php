<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroupMember;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

function convToUpper(Request $req){
    return [
        'npm'=> strtoupper($req->npm),
        'name'=> strtoupper($req->name),
        'class'=> strtoupper($req->class),
    ];
}

function getNews($q){;
    $endpoint='https://api.nytimes.com/svc/search/v2/articlesearch.json';
    $response = Http::get($endpoint, [
        'q'=> $q,
        'api-key'=> 'fg4QJl2i1kLgrymVqMVeDUnIImO1pPgP',
        'fq'=>'new_desk("general")',
    ]);

    return json_decode($response->getBody(), true);
}

class GroupMemberController extends Controller
{
    public function index(){

        $val = Session::get('setNewsVal');
        $userSearch = Session::get('userSearchNews');
        
        $userSearch = ($userSearch == '' || $userSearch == null) ? 'technology' : $userSearch;
        
        // Deleting userSearchNews session
        Session::forget('userSearchNews');
        
        try {
            $newsArr = getNews($userSearch);
            $newsLen = sizeof($newsArr['response']['docs']);

            if($newsLen < $val){
                $val = $newsLen;
            }

            $data_news = $newsArr['response']['docs'];
            shuffle($data_news); //shuffle array value

            return view('index', [
                'data'=>GroupMember::all(), 
                'news'=>$data_news, 
                'flag'=>0, 
                'setNews'=>($val != 0 || $val != null) ? $val : 5,
                'searchKeyword'=>$userSearch,
            ]);

        } catch (\Exception $e) {
            return view('index')->with(['data'=>GroupMember::all(), 'news'=>0]);
        }
    }

    public function searchNews(Request $req){
        $req->validate([
            'searchNews'=> 'required',
        ]);
        Session::put('userSearchNews', $req->searchNews);
       
        return redirect()->to('/'.'#news')->with(['toNews'=> '']);
    }

    public function dashboard(){
        return view('admin.dashboard', ['data'=>GroupMember::all(), 'newsVal'=>Session::get('setNewsVal')]);
    }

    public function addMember(){
        return view('admin.addMember');
    }

    public function storeMember(Request $req, GroupMember $data){
        $d = $req->validate([
            'npm'=>'required|min:8|max:8|unique:group_members,npm',
            'name'=> 'required',
            'class'=>'required|min:5|max:5',
        ]);
    
        $d = convToUpper($req);

        $data->create($d);
        return redirect(route('admin.addMember'))->with('msg','Successfully Added Member');
    }

    public function deleteMember(GroupMember $data){
        $data->delete();

        return redirect(route('admin.dashboard'))->with('msg','The data have been deleted');
    }

    public function editMember(GroupMember $data){
        return view('admin.editMember', ['data'=>$data]);
    }

    public function updateMember(Request $req, GroupMember $data){
        $d = $req->validate([
            'npm'=>'required|min:8|max:8'.($req->npm == $data->npm ? '' : '|unique:group_members,npm'),
            'name'=> 'required',
            'class'=>'required|min:5|max:5',
        ]);
        $d = convToUpper($req);
        
        $data->update($d);
        return redirect(route('admin.dashboard'))->with('msg','The changes have been saved');
    }

    public function setNews(Request $req){
        $d = $req->validate([
            'setNews' => 'numeric|min:3|max:10'
        ]);

        Session::put('setNewsVal', $req->setNews);
        
        return redirect(route('admin.dashboard'))->with('msg','Succesfully Set the Number of News!');
    }
}