<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TABELA MYSQL</title>
    <link rel="stylesheet" href="style.css">  
</head>
<body>

<form method="POST" action="">
    <input type="text" name="filtro" placeholder="Filtrar por nome">
    <input type="submit" value="Filtrar">
</form>
    <section class="tabela">
        <?php
        // Configurações de conexão com o banco de dados
        $servername = "localhost";
        $username = "rodrigo";
        $password = "rudr1gu";
        $dbname = "etec";
        
        // Cria a conexão com o banco de dados
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Verifica se a conexão foi estabelecida com sucesso
        if ($conn->connect_error) {
            die("Falha na conexão com o banco de dados: " . $conn->connect_error);
        }
        
        // Filtrar informações
        if (isset($_POST['filtro'])) {
            $filtro = $_POST['filtro'];
            $sql = "SELECT * FROM aluno WHERE nome LIKE '%$filtro%'";
        } else {
            $sql = "SELECT * FROM aluno";
        }
        
        // Executa a consulta SQL
        $result = $conn->query($sql);
        
        // Verifica se há registros retornados
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<thead><tr><th>ID</th><th>Nome</th><th>Idade</th></tr></thead>";
        
            // Loop através dos registros retornados
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nome"] . "</td>";
                echo "<td>" . $row["idade"] . "</td>";
                echo "</tr>";
            }
        
            echo "</table>";
        } else {
            echo "Nenhum registro encontrado.";
        }
        
        // Fecha a conexão com o banco de dados
        $conn->close();
        ?>
    </section>
</body>
</html>