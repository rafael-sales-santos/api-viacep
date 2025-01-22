<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de CEP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Consulta de CEP</h1>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="cep" class="form-label">Digite o CEP</label>
                    <input type="text" class="form-control" id="cep" placeholder="Ex: 01001000">
                </div>
                <button id="buscar-cep" class="btn btn-primary w-100">Buscar CEP</button>
            </div>
        </div>

        <div id="resultado" class="mt-4" style="display:none;">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h4>Endereço Encontrado</h4>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Logradouro:</strong> <span id="logradouro"></span></li>
                        <li class="list-group-item"><strong>Bairro:</strong> <span id="bairro"></span></li>
                        <li class="list-group-item"><strong>Cidade:</strong> <span id="cidade"></span></li>
                        <li class="list-group-item"><strong>Estado:</strong> <span id="estado"></span></li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="erro" class="alert alert-danger mt-4" style="display:none;">
            <strong>Erro!</strong> CEP não encontrado ou inválido.
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#buscar-cep').click(function() {
                var cep = $('#cep').val().replace(/\D/g, ''); // Remover tudo o que não for número

                if (cep.length === 8) {
                    $('#erro').hide(); // Esconde a mensagem de erro
                    $('#resultado').hide(); // Esconde o resultado anterior
                    buscarCep(cep);
                } else {
                    alert("Por favor, insira um CEP válido.");
                }
            });

            function buscarCep(cep) {
                $.ajax({
                    url: `/buscar-cep/${cep}`, // A rota que chama o controller
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        if (data.error) {
                            $('#erro').text(data.error).show(); // Exibe a mensagem de erro
                        } else {
                            // Preencher os campos com os dados do CEP
                            $('#logradouro').text(data.logradouro);
                            $('#bairro').text(data.bairro);
                            $('#cidade').text(data.localidade);
                            $('#estado').text(data.uf);

                            // Exibir o resultado
                            $('#resultado').show();
                        }
                    },
                    error: function() {
                        $('#erro').text('Erro ao buscar o CEP').show(); // Exibe a mensagem de erro
                    }
                });
            }
        });
    </script>
</body>
</html>
