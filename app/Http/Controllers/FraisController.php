<?php

namespace App\Http\Controllers;

use App\dao\FraisService;
use App\Models\Frais;
use App\Models\Visiteur;
use Illuminate\Http\Request;

class FraisController extends Controller
{
    public function listerFrais() {
        return response()->json(Frais::all());

    }
    public function ajoutFrais(Request $request){
        $fraisService = new FraisService();
        $frais=new Frais();
        $frais->id_etat=2;
        $frais->anneemois =$request->json('annemois');
        $frais->id_visiteur =$request->json('id_visiteur');
        $frais->nbjustificatifs =$request->json('nbjustificatifs');

        $Frais = $fraisService->saveFrais($frais)."Insertion réussi";

        return response()->json($Frais);


    }
    public function modif(Request $request)
    {
        $frais = new Frais();
        $frais->id_frais =$request->json('id_frais');
        $frais->anneemois =$request->json('annemois');
        $frais->id_visiteur =$request->json('id_visiteur');
        $frais->nbjustificatifs =$request->json('nbjustificatifs');
        $frais->montantvalide =$request->json('montantvalide');
        $frais->id_etat =$request->json('id_etat');

        $frais->save();



    }
    public function suppr(Request $request){
        $id_frais= $request->json('id_frais');
        $res=Frais::destroy($id_frais);
        if(!$res) {
            return response()->json(['Suppression réalisé',]);
        }
        else {
            return response()->json(['Suppression non réalisé',]);
        }


    }
    public function listerById($idVisiteur)
    {
        return response()->json(Visiteur::find($idVisiteur)->frais()->get());

    }
}
