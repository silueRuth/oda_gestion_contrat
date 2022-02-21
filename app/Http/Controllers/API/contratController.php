<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\contrat;
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
        $request->validate([
            'detail_contrat' => 'required|string',
            'employe_id' => ['required', Rule::exists('employes', 'id')],
            'post_id' => ['required', Rule::exists('postes', 'id')],
          ]);
        
          $contrat = contrat::create([
              'detail_contrat' => $request->detail_contrat,
              'employe_id' => $request->employe_id,
              'post_id' => $request->post_id,

          ]);
          if($contrat){

            return response()->json([
                'message' => 'Contrat crée avec succes!',
                'success' => true,
                'contrats' => $contrat
              ], 201);

          } else{
              
            return response()->json([
                'message' => 'Impossible de créer le contrat!',
                'erreur' => erreur,
                
              ]);
            
          }
         
    }

       
}
