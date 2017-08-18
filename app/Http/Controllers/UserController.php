<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Image;

class UserController extends Controller
{
    public function index(){
        // exibe listagem de usuarios cadastrados ignorando o usuario logado
        $currUser = Auth::user();
        $users = \App\User::where('id', '!=', $currUser->id)->paginate(8);
        return view('users.index', compact('users'));
    }

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

    public function destroy($id) {

        $user = \App\User::find($id);
        
        // Apaga o arquivo da imgem
        $filename = public_path('/uploads/avatars/' . $user->avatar);
        
        if (file_exists($filename) && $user->avatar != 'default.jpg') {
            unlink($filename);
        }
        
        // deleta o registro
        $user->delete($id);
        return redirect( route('users') );
    }
}
