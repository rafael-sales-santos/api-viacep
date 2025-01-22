<?php

namespace App\Http\Controllers;

use App\Services\ViaCepService;

class CepController extends Controller
{
    /**
     * Buscar informações de um CEP.
     *
     * Endpoint para consultar informações de um CEP usando a API ViaCEP.
     *
     * @param string $cep O CEP no formato 12345678 ou 12345-678
     * @return \Illuminate\Http\JsonResponse
     */
    public function buscarCep($cep)
    {
        // Chama o serviço de busca de CEP
        $result = ViaCepService::buscarCep($cep);

        // Retorna erro ou resultado
        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']], 400);
        }

        return response()->json($result);
    }
}