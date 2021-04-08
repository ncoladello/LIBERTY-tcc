<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="css/aulas_e_clientes.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <?php require "topo.php"; ?>
  <div id="caixa_preta">
  </div><!-- caixa_preta -->

  <div id="box">
    <h1>Abaixo mostra seu histórico de aulas e alunos!</h1>
    <?php
    $sql_1 = "SELECT * FROM treinos WHERE instrutor = '$code'";
    $result = mysqli_query($conexao, $sql_1);
    if (mysqli_num_rows($result) == '') {
      echo "Você não aplica nenhum treino!";
    } else {
      while ($res_1 = mysqli_fetch_assoc($result)) {
      //  $curso = $res_1['curso'];
    ?>
        <table width="955" border="0">
          <tr>
            <td width="400"><strong>Treinos:</strong> <?php echo $res_1['treino']; ?></td>
            <td width="300"><strong>Total de alunos neste treino:</strong>
              <?php
             // $sql_2 = "SELECT * FROM clientes WHERE aula = '$aula'";
              echo mysqli_num_rows(mysqli_query($conexao, $sql_2)); ?></td>
            <td width="123"><a href="fazer_chamada.php?curso=<?php echo base64_encode($res_1['treino']); ?>&dis=<?php echo base64_encode($res_1['treino']); ?>">Fazer Entrada</a></td>
          </tr>
        </table>
    <?php }
    } ?>
  </div><!-- box -->

  <?php require "rodape.php"; ?>
</body>

</html>