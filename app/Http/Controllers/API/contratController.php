<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\contrat;
use App\Models\employe;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class contratController extends Controller
{
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      #validation des champs saisir

        $request->validate([
            'detail_contrat' => 'required|string',
            'employe_id' => ['required', Rule::exists('employes', 'id')],
            'post_id' => ['required', Rule::exists('postes', 'id')],
          ]);
        

          $employe= employe::find($request->employe_id);

#dd($employe->contrat()->exists());

          if($employe->contrat()->exists()){

            return response()->json([
                'message' => 'Cet employé a deja un contrat',
                'statut' => false,
                
              ],400);

          } 
#creation dans la base de donnees 
          $contrat = contrat::create([
            'detail_contrat' => $request->detail_contrat,
            'employe_id' => $request->employe_id,
            'post_id' => $request->post_id, 
           ]);

            return response()->json([
                'message' => 'Contrat créé avec succés!',
                'success' => true,
                'contrats' => $contrat
              ],201);
            
         
    }

       
}
