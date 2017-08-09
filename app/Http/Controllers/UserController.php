<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Image;

class UserController extends Controller
{
    
    public function profile() {
    	$user = Auth::user();	
    	return view('profile', compact('user'));
    }

    public function update_avatar(Request $request) {

    	if($request->hasFile('avatar')) {
    		
    		// Salva o arquivo de imagem no diretorio /public/uploads/avatars
    		$avatar = $request->file('avatar');
    		$filename = 'profile-'. $request->id .".". $avatar->getClientOriginalExtension();
    		Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ));

    		// Salva o caminho da imagem no banco de dados
    		$user = Auth::user();
    		$user->avatar = $filename;
    		$user->save();
    	}

    	return view('profile', compact('user'));
    }
}
