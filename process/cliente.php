<?php 
// INSERIR OS DADOS DO CLIENTE "INSERT INTO" E PUXAR DADOS DO BANCO "SELECT

    include_once('conn.php');
?>

<?php 

    $method = $_SERVER['REQUEST_METHOD'];

    if($method === "GET") {

        $horarioQuery = $conn->query('SELECT * FROM horario');

        $horarios = $horarioQuery->fetchAll();

        $dadosQuery = $conn->query('SELECT clientes.id, clientes.nome, clientes.sobrenome, clientes.telefone, horario.hora, datas.dia, agendamentos.cliente_id, agendamentos.horario_id, agendamentos.data_id FROM clientes JOIN agendamentos ON clientes.id = agendamentos.cliente_id JOIN datas ON datas.id = agendamentos.data_id JOIN horario ON horario.id = agendamentos.horario_id');

        $dados = $dadosQuery->fetchAll();

    } else if ($method === "POST") {

        $data = $_POST;

        $nome = $data['nome'];
        $sobrenome = $data['sobrenome'];
        $telefone = $data['telefone'];
        $dia = $data['dia'];
        $hora_id = $data['horario_id'];

        $stmt = $conn->prepare('INSERT INTO datas (dia) VALUES (:dia)');

        $stmt->bindParam(':dia', $dia);

        $stmt->execute();

        $data_id = $conn->lastInsertId();

        $stmt = $conn->prepare('INSERT INTO clientes (nome, sobrenome, telefone) VALUES (:nome, :sobrenome, :telefone)');

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':sobrenome', $sobrenome);
        $stmt->bindParam(':telefone', $telefone);

        $stmt->execute();

        $cliente_id = $conn->lastInsertId();     
        $hora_id = $data['horario_id'];

        $stmt = $conn->prepare('INSERT INTO agendamentos (cliente_id, data_id, horario_id) VALUES (:cliente_id, :data_id, :horario_id)');

        $stmt->bindParam(':cliente_id', $cliente_id);
        $stmt->bindParam(':data_id', $data_id);
        $stmt->bindParam(':horario_id', $hora_id);

        $stmt->execute();

        header('Location: ../dashboard.php');
    }

?>