<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;
use App\Profile2History;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function add()
    {
        return view('admin.profile.create');
    }
    
    public function create(Request $request)
    {
        $this->validate($request, Profile::$rules);
        
        $profiles = new Profile;
        $form = $request->all();
        
        unset($form['_token']);
        
        $profiles->fill($form);
        $profiles->save();
        
        return redirect('admin/profile');
    }
    
    public function edit(Request $request)
    {
        $profiles = Profile::find($request->id);
        
        if (empty($profiles)) {
            abort(404);
        }
        
        return view('admin.profile.edit', ['profile_form' => $profiles]);
    }
    
    public function update(Request $request)
    {
        $this->validate($request, Profile::$rules);
        $profiles = Profile::find($request->id);
        $profile_form = $request->all();
        
        unset($profile_form['_token']);
        
        $profiles->fill($profile_form)->save();
        
        $profile2history = new Profile2History;
        $profile2history->profile_id = $profiles->id;
        $profile2history->edited_at = Carbon::now();
        $profile2history->save();
        
        return redirect('admin/profile');
    }
    
    public function index(Request $request)
    {
        $cond_name = $request->cond_name;
        
        if ($cond_name != "") {
            $posts = Profile::where('name', $cond_name)->get();
        } else {
            $posts = Profile::all();
        }
        
        return view('admin.profile.index', ['posts' => $posts, 'cond_name' => $cond_name]);
    }
    
    public function delete(Request $request)
    {
        $profiles = Profile::find($request->id);
        $profiles->delete();
        
        return redirect('admin/profile');
    }
}
