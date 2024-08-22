$(document).ready(function () {
    // Carregar agendamentos ao carregar a página
    loadAgendamentos(); // Chama a função para carregar os agendamentos

    //setInterval(loadAgendamentos, 1000);
  
    // Manipulador de evento para o envio do formulário
    $("#agendamentoForm").on("submit", function (e) {
      e.preventDefault(); // Impede o envio padrão do formulário
      var formData = new FormData(this); // Cria um FormData com os dados do formulário

      $("#agendamentoForm")[0].reset();
  
      $.ajax({
        url: "../agendamento3/processa_agendamento.php", // URL para processar o agendamento
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
         // var mensagem = JSON.parse(response); // Analisa a resposta JSON
         // alert(mensagem.message); // Exibe a mensagem de sucesso  
          
          loadAgendamentos(); // Recarrega a lista de agendamentos
        },
        error: function (jqXHR, textStatus, errorThrown) {
          // Tratar erro
          alert("Erro ao processar agendamento: " + textStatus);
        },
      });
    });
  
    // Editar agendamento
    $("#agendamentoTable").on("click", ".edit-btn", function () {
      var id = $(this).data("id"); // Obtém o ID do agendamento a partir do botão
      $.get(
        "../agendamento3/get_agendamentos.php",
        { query: id }, // Passa o ID como parâmetro de consulta
        function (data) {
          if (data.length > 0) {
            var agendamento = data[0]; // Assume que a busca retorna um único item
            // Preenche o formulário com os dados do agendamento
            $("#agendamentoId").val(agendamento.bql);
            $("#nome_cadastrador").val(agendamento.nome_cadastrador);
            $("#status").val(agendamento.status || "");
            $("#agendamento_hora").val(agendamento.agendamento_hora || "");
            $("#agendamento_data").val(agendamento.agendamento_data || "");
            $("#observacao").val(agendamento.observacao || "");
            $("#bql").val(agendamento.bql);
          } else {
            alert("Agendamento não encontrado.");
          }
        },
        "json"
      );
    });
  
    // Remover agendamento
    $("#agendamentoTable").on("click", ".remove-btn", function () {
      var bql = $(this).data("id"); // Obtem o BQL do botão
      if (confirm("Deseja remover este agendamento?")) {
        $.post(
          "../agendamento3/remove_agendamento.php",
          { bql: bql }, // Envia o BQL para o servidor
          function (response) {
            alert(response.message); // Exibe a mensagem de sucesso
            loadAgendamentos(); // Atualiza a lista de agendamentos
          },
          "json"
        );
      }
    });
  
    // Função para carregar agendamentos
    function loadAgendamentos(query = "") {
      $.get(
        "../agendamento3/get_agendamentos.php",
        { query: query }, // Passa a consulta como parâmetro
        function (data) {
          var tbody = $("#agendamentoTable tbody");
          tbody.empty(); // Limpa o corpo da tabela
  
          if (Array.isArray(data) && data.length > 0) {
            $.each(data, function (index, agendamento) {
              // Adiciona uma nova linha para cada agendamento
              tbody.append(`
                <tr>
                  <td>${agendamento.bql || ""}</td>
                  <td>${agendamento.nome_cadastrador || ""}</td>
                  <td>${agendamento.status || ""}</td>
                  <td>${agendamento.agendamento_hora || ""}</td>
                  <td>${agendamento.agendamento_data || ""}</td>
                  <td>${agendamento.observacao || ""}</td>
                  <td>
                    <button class="btn btn-warning btn-sm edit-btn" data-id="${agendamento.bql || ""}">Editar</button>
                    <button class="btn btn-danger btn-sm remove-btn" data-id="${agendamento.bql || ""}">Remover</button>
                  </td>
                </tr>
              `);
            });
          } else {
            // Mensagem caso não haja agendamentos
            tbody.append('<tr><td colspan="7">Nenhum agendamento encontrado.</td></tr>');
          }
        },
        "json"
      );
    }
  
    // Buscar agendamentos pelo BQL
    $("#searchButton").on("click", function () {
      var searchQuery = $("#searchBQL").val(); // Obtém o valor da busca
      loadAgendamentos(searchQuery); // Recarrega a lista com a consulta de busca
    });
  });
  