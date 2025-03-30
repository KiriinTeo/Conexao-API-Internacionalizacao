<?php 
require_once("verifica.php");
include_once("cabec.php"); 
include_once("pesquisaCEP.php");
?>

<body>
    <h1 align="center">Consultar CEP</h1>
    <form method="POST" action="pesquisaCEP.php" id="cepForm" align="center">
        <label for="cep">Informe o CEP:</label>
        <input type="text" id="cep" name="cep" required>
        <button type="submit">Buscar</button>
    </form>

    <div class="container"id="resultado" style="margin-top: 20px;" align="center"></div>

    <script>
    document.getElementById('cepForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var cep = document.getElementById('cep').value;

        fetch('pesquisaCEP.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({ cep: cep }) 
        })
        .then(response => response.json())
        .then(data => {
            if (data.erro) {
                document.getElementById('resultado').innerHTML = '<p>' + data.mensagem + '</p>';
            } else {
                document.getElementById('resultado').innerHTML = `
                    <p><strong>CEP:</strong> ${data.cep}</p>
                    <p><strong>Logradouro:</strong> ${data.logradouro}</p>
                    <p><strong>Complemento:</strong> ${data.complemento}</p>
                    <p><strong>Bairro:</strong> ${data.bairro}</p>
                    <p><strong>Localidade:</strong> ${data.localidade}</p>
                    <p><strong>UF:</strong> ${data.uf}</p>
                    <p><strong>IBGE:</strong> ${data.ibge}</p>
                `;
            }
        })
        .catch(error => {
            document.getElementById('resultado').innerHTML = '<p>Erro ao buscar o CEP.</p>';
            console.error('Erro ao buscar o CEP:', error);
        });
    });
</script>

</body>

