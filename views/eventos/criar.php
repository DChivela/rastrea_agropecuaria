<?php
$loteId = (int)($_GET['lote_id'] ?? 0);
if (!$loteId) exit('Lote inválido');
?>
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<title>Novo Evento</title>
</head>
<body>

<h2>Novo Evento</h2>

<form method="post" action="salvar.php">

<input type="hidden" name="lote_id" value="<?= $loteId ?>">

<label>Tipo</label><br>
<select name="tipo_evento">
    <option value="producao">Produção</option>
    <option value="colheita">Colheita</option>
    <option value="abate">Abate</option>
    <option value="processamento">Processamento</option>
    <option value="armazenamento">Armazenamento</option>
    <option value="transporte">Transporte</option>
    <option value="venda">Venda</option>
</select><br><br>

<label>Descrição</label><br>
<textarea name="descricao"></textarea><br><br>

<label>Localização</label><br>
<input type="text" name="localizacao"><br><br>

<label>Temperatura</label><br>
<input type="number" step="0.01" name="temperatura"><br><br>

<label>Umidade</label><br>
<input type="number" step="0.01" name="umidade"><br><br>

<label>Responsável</label><br>
<input type="text" name="responsavel"><br><br>

<button type="submit">Salvar</button>
</form>

<a href="index.php?lote_id=<?= $loteId ?>">Voltar</a>

</body>
</html>

