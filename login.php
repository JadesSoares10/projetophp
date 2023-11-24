<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_academico";
// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);
// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['submit'])) {
    echo "ENTROU!";
    logar($conn);
}

// Fecha a conexão com o banco de dados
echo "Conexão bem-sucedida com o banco de dados!";
$conn->close();


function logar($conn)
{
    // Obtém os dados do formulário
    $matricula = $_GET["matricula"];
    $senha = $_GET["senha"];

    $sql = "SELECT * FROM login WHERE matricula = '$matricula'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "Usuário encontrado com sucesso!";
        header("Location: exibir-dados.php?matricula=$matricula");
    } else {
        echo "Usuário não cadastrado";
        return;
    }

    return $result;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário | GN</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(45deg, purple, black);
        }

        .box {
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.6);
            padding: 15px;
            border-radius: 15px;
            width: 20%;
        }

        fieldset {
            border: 3px solid purple;
        }

        legend {
            border: 1px solid purple;
            padding: 10px;
            text-align: center;
            background-color: purple;
            border-radius: 8px;
        }

        .inputBox {
            position: relative;
        }

        .inputUser {
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
            font-size: 15px;
            width: 100%;
            letter-spacing: 2px;
        }

        .labelInput {
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: .5s;
        }

        .inputUser:focus~.labelInput,
        .inputUser:valid~.labelInput {
            top: -20px;
            font-size: 12px;
            color: purple;
        }

        #submit {
            background-image: linear-gradient(to right, rgb(125, 20, 238), rgb(34, 2, 92));
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }

        #submit:hover {
            background-image: linear-gradient(to right, rgb(58, 13, 118), rgb(9, 1, 24));
        }
    </style>
</head>

<body>
    <div class="box">
        <form method="get" action="login.php">
            <fieldset>
                <legend><b>Fórmulário de Alunos</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="matricula" id="matricula" class="inputUser" required>
                    <label for="matricula" class="labelInput">Matrícula</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="senha" id="senha" class="inputUser" required>
                    <label for="senha" class="labelInput">Senha</label>
                </div>
                <br><br>
                <br><br>
                <input type="submit" name="submit" id="submit">
            </fieldset>
        </form>
    </div>
</body>

</html>