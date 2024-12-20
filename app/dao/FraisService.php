<?php

namespace App\dao;

use App\Models\Frais;
use http\Env\Request;
use function Laravel\Prompts\select;


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

        return $frais;
    }
    public function deleteFrais($id_frais)
    {
        $id_frais->select('frais.*')->where('id_frais',$id_frais);
        $res=Frais::destroy($id_frais);
        if(!$res) {
            return response()->json(['Suppression réalisé',]);
        }
        else {
            return response()->json(['Suppression non réalisé',]);
        }

    }
    public function getFraisByVisiteur($idVisiteur)
    {
        return Frais::where('id_visiteur', $idVisiteur)->get();
    }
}
