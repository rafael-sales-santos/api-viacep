<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ViaCepService
{
    public static function buscarCep($cep)
    {
        $cep = preg_replace('/\D/', '', $cep);

        if (strlen($cep) !== 8) {
            return ['error' => 'Formato de CEP inválido'];
        }

        try {
            $response = Http::timeout(5)->get("https://viacep.com.br/ws/{$cep}/json/");

            if ($response->successful() && !isset($response->json()['erro'])) {
                return $response->json();
            }

            return ['error' => 'CEP não encontrado'];
        } catch (\Exception $e) {
            return ['error' => 'Erro ao buscar o CEP.'];
        }
    }
}
