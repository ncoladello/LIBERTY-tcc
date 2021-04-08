<?php $painel_atual = "portaria"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portaria</title>
    
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    <?php require "../config.php"; ?>
</head>

<body>

    <div id="box">

        <div id="porteiro">
            <h1><strong><i><?php echo $nome ?> </i> - Seu código é:</strong> <?php echo $code ?> <a href="../config.php?acao=quebra">

                    <a href="../config.php?acao=quebra"><strong>SAIR</strong></a></h1>
        </div><!-- porteiro -->

        <div id="logo">
            <img src="../img/logo.png" width="250px" />
        </div><!-- logo -->

        <div id="campo_busca">
            <form name="" method="post" action="" enctype="multipart/form-data">
                <input type="text" name="cpf" value="" /><input class="input" type="submit" name="send" value="" />
            </form>


            <?php
            if (isset($_POST['send'])) {

                $_GET['pg'] = '';
                $cpf = $_POST['cpf'];


                if ($cpf == '') {
                    echo "<script language='javascript'> window.alert('Por favor, digite o número de matrícula ou CPF!');</script>";
                } else {
                    $sql = "SELECT * FROM clientes WHERE code = '$cpf' OR nome = '$cpf' OR cpf = '$cpf' OR rg = '$cpf' ";

                    $result = mysqli_query($conexao, $sql);
                    if (mysqli_num_rows($result) <= 0) {
                        echo "<br><br><br><br><h2> Cliente não Encontrado, verifique a informação inserida! </h2>";
                    } else {
                        while ($res_1 = mysqli_fetch_assoc($result)) {
                            $nome = $res_1['nome'];
                            $code = $res_1['code'];
                            $rg = $res_1['rg'];


            ?>



                            <br><br><br><br>
                            <h3><strong>
                                    Cliente:</strong> <?php echo $nome ?> <strong>
                                    Nº de matricula:</strong> <?php echo $code; ?> <strong>
                                    RG:</strong> <?php echo $rg; ?>

                                <a href="index.php?pg=confirma&code_c=<?php echo $code; ?>"><img src="../img/confirma.png" title="Confirmar"  width="22px" /></a>

                                <a href="index.php"><img src="../img/deleta.png" title="Cancelar" width="22px" /></a> </h3>

                            <input type="hidden" name="codes" value="" />

            <?php     }
                    }
                }
            } ?>


            <?php
            if (@$_GET['pg'] == 'confirma') {
                $data = date("d/m/Y H:i:s");
                $date = date("d/m/Y");

                $code_c = $_GET['code_c'];

                $sql = "INSERT INTO confirma_entrada_de_clientes (diaehora, data_hoje, porteiro, code_cliente) VALUES ('$data', '$date', '$code', '$code_c')";

                mysqli_query($conexao, $sql);

                echo "<script language='javascript'> window.alert('A entrada do cliente foi confirmada!');</script>";
            }
            ?>


        </div><!-- campo_busca -->
        <br><br><br>
    </div><!-- box -->
</body>

</html>