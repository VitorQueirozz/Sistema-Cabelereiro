
<?php 
    include_once('process/orders.php');
?>
<?php 
    require_once('templates/header.php');
?>
    <main>
        <form action="process/orders.php" method="POST" class="form-cabelo">
            <table>
                <tbody>
                    <tr class="dash-titulos">
                        <td>Nome</td>
                        <td>Sobrenome</td>
                        <td>Telefone</td>
                        <td>Dia</td>
                        <td>Horário</td>
                    </tr>
                    <?php foreach($dados as $dado): ?>
                    <tr class="dash-salvos">
                        <td><?= $dado['nome']; ?></td>
                        <td><?= $dado['sobrenome']; ?></td>
                        <td><?= $dado['telefone']; ?></td>
                        <td><?= $dado['dia']; ?></td>
                        <td><?= $dado['hora']; ?></td>
                        <td>
                            <input type="hidden" name="type" value="delete">
                            <input type="hidden" name="cliente_id" value="<?= $dado['cliente_id'];?>">
                            <input type="hidden" name="data_id" value="<?= $dado['data_id'];?>">
                            <input type="hidden" name="horario_id" value="<?= $dado['horario_id'];?>">
                            <button type="submit">X</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>
    </main>
<?php 
    require_once('templates/footer.php');
?>