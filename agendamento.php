<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Agendamento</title>
    <!-- Link para o CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <h1 class="mb-4">Agendamento</h1>

        <div class="row h-100">
            <!-- Formulário de Adição/Alteração -->
            <div class="col-md-6 form-container">
                <form id="agendamentoForm">
                    <input type="hidden" name="id" id="agendamentoId" value="">

                    <div class="mb-3">
                        <label for="nome_cadastrador" class="form-label">Nome do Cadastrador:</label>
                        <input type="text" id="nome_cadastrador" name="nome_cadastrador" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status:</label>
                        <input type="text" id="status" name="status" class="form-control" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="agendamento_hora" class="form-label">Hora do Agendamento:</label>
                        <input type="time" id="agendamento_hora" name="agendamento_hora" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="agendamento_data" class="form-label">Data do Agendamento:</label>
                        <input type="date" id="agendamento_data" name="agendamento_data" class="form-control" required min="2024-08-16">
                    </div>

                    


                    <div class="mb-3">
                        <label for="observacao" class="form-label">Observação:</label>
                        <textarea id="observacao" name="observacao" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="bql" class="form-label">BQL:</label>
                        <input type="text" id="bql" name="bql" class="form-control" readonly>
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
                <script>
                            document.addEventListener('DOMContentLoaded', function () {
                            const today = new Date().toISOString().split('T')[0];
                            document.getElementById('agendamento_data').setAttribute('min', today);
                            });
                </script>
            </div>

            <!-- Lista de Agendamentos e Campo de Busca -->
            <div class="col-md-6 list-container">
                <div class="mb-3">
                    <label for="searchBQL" class="form-label">Buscar pelo BQL:</label>
                    <div class="d-flex">
                        <input type="text" id="searchBQL" class="form-control me-2" placeholder="Digite o BQL">
                        <button id="searchButton" class="btn btn-primary">Buscar</button>
                    </div>
                </div>

                <table class="table table-striped" id="agendamentoTable">
                    <thead>
                        <tr>
                            <th>BQL</th>
                            <th>Nome do Cadastrador</th>
                            <th>Status</th>
                            <th>Hora do Agendamento</th>
                            <th>Data do Agendamento</th>
                            <th>Observação</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Os dados serão carregados aqui via AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Scripts do Bootstrap e jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./Js/ajax.js"></script>
</body>

</html>


</html>