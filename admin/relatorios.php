<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="css/relatorios.css" rel="stylesheet" type="text/css" />
  <title>Administração</title>
</head>

<body>
  <?php require "topo.php"; ?>
  <div id="caixa_preta">
  </div><!-- caixa_preta -->

  <div id="box">
    <?php if (@$_GET['tipo'] == 'clientes') { ?>
      <h1>Relatório de clientes</h1>
      <?php if (isset($_POST['button'])) {

        $tipo = $_POST['tipo'];


        $s = base64_encode("SELECT * FROM clientes WHERE status = '$tipo'");

        echo "<script language='javascript'>window.location='relatorios.php?tipo=clientes&s=$s';</script>";
      } ?>
      <form name="button" method="post" action="" enctype="multipart/form-data">
        <table width="950" border="0">
          <tr>
            <td width="267"><strong>Status</strong></td>

            <td width="180">&nbsp;</td>
          </tr>
          <tr>
            <td><select name="tipo" size="1" id="select">
                <option value="Ativo">Clientes Ativos</option>
                <option value="Inativo">Clientes Inativos</option>
              </select></td>

            <td><input class="input" type="submit" name="button" id="button" value="Filtrar"></td>
          </tr>
        </table>
      </form>

      <?php
      $s = base64_decode($_GET['s']);
      $sql_1 = mysqli_query($conexao, $s);
      if (mysqli_num_rows($sql_1) == '') {
        echo "Não existe resultados para o filtro selecionado";
      } else {
      ?>
        <table width="950" border="0">
          <tr>
            <td width="200"><strong>Nome:</strong></td>
            <td width="130"><strong>Nº de matricula:</strong></td>

            <td width="194"><strong>Mensalidades pagas:</strong></td>
            <td width="149"><strong>Mensalidade devedoras:</strong></td>
          </tr>
          <?php while ($res_1 = mysqli_fetch_assoc($sql_1)) { ?>
            <tr>
              <td><?php echo $res_1['nome']; ?></td>
              <td><?php echo $res_1['code']; ?></td>

              <td><?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM mensalidades WHERE matricula = " . $res_1['code'] . " AND status = 'Pagamento Confirmado'")); ?></td>
              <td><?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM mensalidades WHERE matricula = " . $res_1['code'] . " AND status = 'Aguarda Pagamento'")); ?></td>
            </tr>
            <tr>
              <td colspan="5">
                <hr>
              </td>
            </tr>
          <?php } ?>
          <tr>
            <td align="center" colspan="5"><a target="_blank" href="clientes_pg_impressao.php?s=<?php echo $_GET['s']; ?>">Imprimir relação completa do cliente</a></td>
          </tr>
        </table>
      <?php } ?>



    <?php } // aqui fecha a pg clientes 
    ?>



    




  </div><!-- box -->





  <?php require "rodape.php"; ?>
</body>

</html>