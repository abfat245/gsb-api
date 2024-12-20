<?php

namespace App\dao;

use App\Models\Frais;
use http\Env\Request;

class FraisService
{
    public function getFraisById($idFrais)
    {
        return Frais::join('etat','frais.id_etat','=','etat.id_etat')
            ->select('frais.*','etat.lib_etat as etat')
            ->where('frais.id_frais',$idFrais)
            ->first();
    }
    public function createFrais(array $data)
    {
        $frais = new Frais();
        $frais->fill($data);
        $frais->save();

        return $frais;
    }
    public function saveFrais(Frais $frais)
    {
        $frais->save();
    }
    public function deleteFrais(Request $request)
    {
        try {
            $fraisService = new FraisService();
            $id_frais=$request->json("id_frais");
            $fraisService->deleteFrais($id_frais);
            return response()->json(['message' => 'Suppression réalisée', 'id_frais :' => $id_frais]);
        } catch (QueryException $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function getFraisByVisiteur($idVisiteur)
    {
        return Frais::where('id_visiteur', $idVisiteur)->get();
    }
}
