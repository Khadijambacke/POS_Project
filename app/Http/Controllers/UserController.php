<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users=User::all();
        return view('user.index', compact('users'));

    }

    // Afficher le formulaire d'édition
    public function store(Request $request){
        $validated = $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|max:255',
      'password' => 'required|string',
      'role' => 'required|string',

  ]);
 
  User::create($validated);
  return redirect()
  ->route('personnels.index')
  ->with('success', 'utilisateurs créé avec succès');

  }
  public function edit($utilisateurs){
      $utilisateurs = User::findOrFail($utilisateurs);

      return view('user.edit', compact('utilisateurs'));
  
  }
  public function update(Request $request,$users)
{
  $users = User::findOrFail($users);
  $validated = $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|max:255',
      'password' => 'required|string',
      'role' => 'required|string',
  ]);
  $users->update($validated);
  return redirect()
      ->route('personnels.index')
      ->with('success', 'Utilisateurs  mis à jour avec succès');
    
}
public function  destroy(Request $request,$users){
  $users = User::findOrFail($users);
  $users->delete();
  return redirect()->route('personnels.index');
}
}
