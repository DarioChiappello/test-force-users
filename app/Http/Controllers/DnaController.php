<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Test;


class DnaController extends Controller
{
    
    public function isForceUser(Request $request)
    {
        
        $force_user = false;
        $http = 403;
        $letters = ['A','C','G', 'T'];
        $string_to_array = json_decode($request->getContent(),true);
        $quantity = 0;
        $array_letters = array();
        
        foreach($string_to_array as $string => $value){
            
            foreach($value as $cadena){
                
                $caracters = str_split($cadena);
                array_push($array_letters,$caracters);
                for($i = 0; $i<count($caracters);$i++){
                    if(in_array($caracters[$i], $letters)){
                        continue;
                    }else{
                        //Devuelve error por algun caracter erroneo
                        return response()->json($force_user, $http);
                    }
                }

                
                foreach($letters as $letter){
                    //Busqueda por fila
                    if(preg_match('/'.$letter.'{4}/i', $cadena)){
                        $quantity++;
                    }
  
                }
    
            }
        }

        foreach($letters as $letter){
            
            //Busqueda por columna
            for($i = 0;$i<count($array_letters); $i++){
                $string = '';
                foreach($array_letters as $key){
                    $string .= $key[$i];
                }
                 
                if(preg_match('/'.$letter.'{4}/i', $string)){
                    $quantity++;
                }
            
            }

            //Busqueda diagonal
            $diagonal = 0;
            for($i = 0; $i < count($array_letters); $i++){

                if($array_letters[$i][$i] == $letter){
                    $diagonal ++;
                }
            }

            
            if($diagonal != 4){
                continue;
            }else{
                $quantity++;
            }
            

            
        }

        $test = new Test();
        $test->json = $request->getContent();
        $test->quantity = $quantity;

        if($quantity > 0){
            $force_user = true;
            $http = 200;
            $test->forceUser = true;
        }else{
            $test->forceUser = false;
        } 
        $test->save();
        
        return response()->json($force_user, $http);
        
    }

    public function stats()
    {
        $non_force_users_dna = Test::all();
        $force_users_dna = Test::where('forceUser',1)->get();

        $non_force_users_dna_quantity = count($non_force_users_dna);
        $force_users_dna_quantity = count($force_users_dna);
        $ratio = round($force_users_dna_quantity  / ($non_force_users_dna_quantity), 2);
        
        $data = [
            "force_user_dna"=> $force_users_dna_quantity,
            "non_force_user_dna"=> $non_force_users_dna_quantity,
            "ratio" => $ratio
        ];

        return response()->json($data, 200);
        
    }
}
