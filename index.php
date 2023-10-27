<?php 
    include_once('process/cliente.php');
?>
<?php 
    require_once('templates/header.php');
?>
    <main>
        <form action="process/cliente.php" method="POST" class="form-cabelo">
            <div>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome">
                <label for="sobrenome">Sobrenome:</label>
                <input type="text" name="sobrenome" id="sobrenome">
            </div>
            <div>
                <label for="telefone">Telefone:</label>
                <input type="text" name="telefone" id="telefone">
                <label for="dia">Dia:</label>
                <input type="text" name="dia" id="dia">
            </div>
            <div>
                <label for="horario">Horário:</label>
                <select name="horario_id" id="horario">
                    <?php foreach($horarios as $horario): ?>
                    <option value="<?= $horario['id'];?>"><?= $horario['hora'];?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn-marcar">Marcar</button>
        </form>
    </main>
<?php 
    require_once('templates/footer.php');
?>