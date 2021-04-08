<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Clientes</title>
  <link rel="stylesheet" type="text/css" href="css/clientes.css" />
</head>

<body>
  <?php require "topo.php"; ?>

  <!BUSCANDO CLIENTES NO BANCO>

    <div id="caixa_preta">
    </div><!-- caixa_preta -->
    <?php if (@$_GET['pg'] == 'todos') { ?>
      <div id="box_cliente">
        <br /><br />
        <a class="a2" href="clientes.php?pg=cadastra&bloco=1">Cadastrar novo cliente</a>
        <h1>Clientes que estão cadastrados</h1>

        <?php
        $sql_1 = "SELECT * FROM clientes WHERE nome != ''";
        $consulta = mysqli_query($conexao, $sql_1);
        if (mysqli_num_rows($consulta) == '') {
          echo "<h2>Não existe nenhum cliente cadastrado no momento</h2>";
        } else {
        ?>

          <table width="900" border="0">
            <tr>
              <td><strong>Status:</strong></td>
              <td><strong>Código:</strong></td>
              <td><strong>Nome:</strong></td>
              <td><strong>Telefone:</strong></td>
              <td><strong>Mensalidade:</strong></td>
              <td></td>
            </tr>
            <?php while ($res_1 = mysqli_fetch_assoc($consulta)) { ?>
              <tr>
                <td>
                  <h3><?php echo $res_1['status']; ?></h3>
                </td>
                <td>
                  <h3><?php echo $res_1['code']; ?></h3>
                </td>
                <td>
                  <h3><?php echo $res_1['nome']; ?></h3>
                </td>
                <td>
                  <h3><?php echo $res_1['telefone']; ?></h3>
                </td>
                <td>
                  <h3>R$ <?php echo $res_1['mensalidade']; ?></h3>
                </td>
                <td></td>
                <td>
                  <a class="a" href="clientes.php?pg=todos&func=deleta&id=<?php echo $res_1['id']; ?>&code=<?php echo $res_1['code']; ?>"><img title="Excluir Cliente(a)" src="img/deleta.jpg" width="18" height="18" border="0"></a>
                  <?php if ($res_1['status'] == 'Inativo') { ?>
                    <a class="a" href="clientes.php?pg=todos&func=ativa&id=<?php echo $res_1['id']; ?>&code=<?php echo $res_1['code']; ?>"><img title="Ativar novamente Cliente(a)" src="../img/correto.jpg" width="20" height="20" border="0"></a>
                  <?php } ?>
                  <?php if ($res_1['status'] == 'Ativo') { ?>
                    <a class="a" href="clientes.php?pg=todos&func=inativa&id=<?php echo $res_1['id']; ?>&code=<?php echo $res_1['code']; ?>"><img title="Inativar Cliente(a)" src="../img/ico_bloqueado.png" width="18" height="18" border="0"></a>
                  <?php } ?>
                  <a class="a" rel='superbox[iframe][800x600]' href="mostrar_resultado.php?q=<?php echo $res_1['code']; ?>&s=cliente&treino=<?php echo $res_1['aula']; ?>"><img title="Informações detalhada deste cliente(a)" src="../img/visualizar16.gif" width="18" height="18" border="0"></a>
                </td>
              </tr>
            <?php } ?>
          </table>
          <br />
        <?php } // aqui fecha a consulta 
        ?>
      </div><!-- box_cliente -->







      <! Exclusão, ativação e Desativação>

        <?php if (@$_GET['func'] == 'deleta') {

          $id = $_GET['id'];
          $code = $_GET['code'];

          $sql_del = "DELETE FROM clientes WHERE id = '$id'";
          $sql_del2 = "DELETE FROM login WHERE code = '$code'";
          mysqli_query($conexao, $sql_del);
          mysqli_query($conexao, $sql_del2);

          echo "<script language='javascript'>
window.location='clientes.php?pg=todos';</script>";
        } ?>


        <?php if (@$_GET['func'] == 'ativa') {

          $id = $_GET['id'];
          $code = $_GET['code'];

          $sql_editar = "UPDATE clientes SET status = 'Ativo' WHERE id = '$id'";
          $sql_editar2 = "UPDATE login SET status = 'Ativo' WHERE code = '$code'";
          mysqli_query($conexao, $sql_editar);
          mysqli_query($conexao, $sql_editar2);

          echo "<script language='javascript'>window.location='clientes.php?pg=todos';</script>";
        } ?>


        <?php if (@$_GET['func'] == 'inativa') {

          $id = $_GET['id'];
          $code = $_GET['code'];

          $sql_editar = "UPDATE clientes SET status = 'Inativo' WHERE id = '$id'";
          $sql_editar2 = "UPDATE login SET status = 'Inativo' WHERE code = '$code'";
          mysqli_query($conexao, $sql_editar);
          mysqli_query($conexao, $sql_editar2);

          echo "<script language='javascript'>window.location='clientes.php?pg=todos';</script>";
        } ?>


      <?php } // aqui fecha a PG todos 
      ?>





      <!CADASTRO DOS CLIENTES - ETAPA 1>


        <?php if (@$_GET['pg'] == 'cadastra') { ?>
          <?php if (@$_GET['bloco'] == '1') { ?>
            <div id="cadastra_cliente">
              <h1>1º Passo - Cadastre os dados pessoais</h1>

              <?php if (isset($_POST['button'])) {

                $code = $_POST['code'];
                $nome = $_POST['nome'];
                $cpf = $_POST['cpf'];
                $rg = $_POST['rg'];
                $nascimento = $_POST['nascimento'];

                $endereco = $_POST['endereco'];

                $telefone = $_POST['telefone'];



                $sql_2 = "INSERT INTO clientes (code, status, nome, cpf, rg, nascimento, endereco, telefone) VALUES ('$code', 'Ativo', '$nome', '$cpf', '$rg', '$nascimento', '$endereco','$telefone')";

                $sql_login = "INSERT INTO login (status, code, senha, nome, painel) VALUES ('Ativo', '$code', '$cpf', '$nome', 'Cliente')";

                $cadastra = mysqli_query($conexao, $sql_2);
                $cadastra_login = mysqli_query($conexao, $sql_login);

                echo "<script language='javascript'>window.alert('Dados cadastrados com sucesso! Click em OK para avançar');window.location='clientes.php?pg=cadastra&bloco=2&code=$code';</script>";
              } ?>

              <form name="form1" method="post" action="">
                <table width="900" border="0">
                  <tr>
                    <td></td>
                    <td colspan="2"><strong>Foi criado um código único para este cliente</strong></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <?php
                    $sql_1 = "SELECT * FROM clientes ORDER BY id DESC LIMIT 1";
                    $con_est = mysqli_query($conexao, $sql_1);
                    if (mysqli_num_rows($con_est) == '') {
                      $novo_code = "587418";
                    ?>
                      <td><input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $novo_code; ?>"></td>
                      <input type="hidden" name="code" value="<?php echo $novo_code; ?>" />
                      <?php
                    } else {

                      while ($res_1 = mysqli_fetch_assoc($con_est)) {
                        $novo_code = $res_1['code'] + 741 + $res_1['id'];
                      ?>
                        <td><input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $novo_code; ?>"></td>
                        <input type="hidden" name="code" value="<?php echo $novo_code; ?>" />
                    <?php }
                    } ?>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Nome:</td>
                    <td>CPF:</td>
                    <td>RG:</td>
                  </tr>
                  <td><label for="celular"></label>
                    <input type="text" name="nome" id="textfield2"></td>
                  <td><label for="tel_amigo"></label>
                    <input type="text" name="cpf" id="textfield3"></td>
                  <td><label for="tel_amigo"></label>
                    <input type="text" name="rg" id="textfield3"></td>
                  </tr>
                  <tr>


                  </tr>
                  <tr>


                  </tr>
                  <tr>

                  </tr>
                  <tr>

                  </tr>
                  <tr>
                    <td>Data de nascimento:</td>
                    <td>Telefone:</td>
                    <td>Endereço:</td>

                  </tr>
                  <tr>
                    <td><label for="nascimento"></label>
                      <input type="text" name="nascimento" id="textfield4"></td>

                    <td><input type="text" name="telefone" id="textfield9"></td>
                    <td><input type="text" name="endereco" id="textfield8"></td>


                  </tr>
                  <tr>


                  </tr>
                  <tr>


                  </tr>
                  <tr>
                    <td><input class="input" type="submit" name="button" id="button" value="Avançar"></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
              </form>
              <br />

            </div><!-- cadastra_cliente -->

          <?php } // aqui fecha o bloco 1 
          ?>




          <!CADASTRO DOS CLIENTES - ETAPA 2>

            <?php if (@$_GET['bloco'] == '2') { ?>
              <div id="cadastra_cliente">
                <h1>2º Passo - Finalizar preenchimento de dados</h1>

                <?php if (isset($_POST['button'])) {

                  $code = $_GET['code'];
                  $peso = $_POST['peso'];
                  $altura = $_POST['altura'];

                  $mensalidade = $_POST['mensalidade'];
                  $vencimento = $_POST['vencimento'];

                  $obs = $_POST['obs'];

                  $sql_3 = "UPDATE clientes SET peso = '$peso',altura ='$altura',  mensalidade = '$mensalidade', vencimento = '$vencimento', obs = '$obs'  WHERE code = '$code'";

                  mysqli_query($conexao, $sql_3);

                  $d = date("d");
                  $m = date("m");
                  $a = date("Y");
                  $code_cobranca = $code * 2;

                  $sql_mensal = "INSERT INTO mensalidades (code, matricula, d_cobranca, vencimento, valor, status, dia, mes, ano) VALUES ('$code_cobranca', '$code', '$d/$m/$a', '$vencimento/$m/$a', '$mensalidade', 'Aguarda Pagamento', '$d', '$m', '$a')";

                  mysqli_query($conexao, $sql_mensal);

                  echo "<script language='javascript'>window.location='clientes.php?pg=cadastra&bloco=3';</script>";
                } ?>

                <form name="form1" method="post" action="">
                  <table width="900" border="0">
                    <tr>
                      <td width="350">Peso:</td>
                      <td width="332">Altura:</td>
                      
                    </tr>
                    <tr>
                      <td>
                        <label for="peso"></label>
                        <input type="text" name="peso" id="peso">
                      </td>
                      <td><label for="altura"></label>
                        <input type="text" name="altura" id="altura"></td>
                      
                    </tr>
                    <tr>
                      <td>Valor da mensalidade:</td>
                      <td>Data de vencimento:</td>
                      
                    </tr>
                    <tr>
                      <td><label for="mensalidade"></label>
                        <input type="text" name="mensalidade" id="mensalidade"></td>
                      <td><label for="vencimento"></label>
                        <input type="text" name="vencimento" id="vencimento"></td>
                     
                    </tr>
                    <tr>
                      <td>Observações para este(a) cliente(a)</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3"><label for="obs"></label>
                        <textarea name="obs" id="obs" cols="45" rows="5"></textarea></td>
                    </tr>
                    <tr>
                      <td><input class="input" type="submit" name="button" id="button" value="Finalizar"></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                </form>
                <br />

              </div><!-- cadastra_cliente -->
                  echo $sql_2;

            <?php } // aqui fecha o bloco 2 
            ?>


            <?php if (@$_GET['bloco'] == '3') { ?>
              <div id="cadastra_cliente">
                <h1>3º Passo - Mensagem de confirmação</h1>
                <table>
                  <tr>
                    <td>
                      <h4>Este(a) Cliente foi cadastrado perfeitamente no sistema!
                        <ul>
                          <li>Mensalmente será gerado a cobrança no valor informado!</li>
                          <li>Este cliente já tem acesso ao sistema usando seu código e seu CPF como senha!</li>
                        </ul>
                        <a href="clientes.php?pg=todos">Clique aqui para voltar para página inicial</a>
                      </h4>
                    </td>
                  </tr>
                </table>
                <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
              </div><!-- cadastra_cliente -->


            <?php } // aqui fecha o bloco 3 
            ?>


          <?php } // aqui fecha a PG cadastra 
          ?>




          <?php require "rodape.php"; ?>
</body>

</html>