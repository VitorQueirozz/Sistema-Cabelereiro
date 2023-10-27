<?php 
//DELETAR OD DADOS DO CLIENTE "DELETE FROM" E PUXAR DADOS DO BANCO "SELECT

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

        $type = $_POST['type'];

        if($type === 'delete') {

            $data = $_POST;

            $cliente_id = $data['cliente_id'];   
            $hora_id = $data['horario_id'];
            $data_id = $data['data_id'];

            $deleteQuery = $conn->prepare('DELETE FROM agendamentos WHERE data_id = :data_id AND horario_id = :horario_id AND cliente_id = :cliente_id');

            $deleteQuery->bindParam(':data_id', $data_id);
            $deleteQuery->bindParam(':horario_id', $hora_id);
            $deleteQuery->bindParam(':cliente_id', $cliente_id);

            $deleteQuery->execute();

            $deleteQuery = $conn->prepare('DELETE FROM datas WHERE id = :data_id');

            $deleteQuery->bindParam(':data_id', $data_id);

            $deleteQuery->execute();

            $deleteQuery = $conn->prepare('DELETE FROM clientes WHERE id = :cliente_id');

            $deleteQuery->bindParam(':cliente_id', $cliente_id);

            $deleteQuery->execute();

            header('Location: ../dashboard.php');

        }
        
    }

?>  