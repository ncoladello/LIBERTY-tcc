<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Adminstração</title>
    <link href="css/aulas_e_treinos.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <?php require "topo.php"; ?>


    <!CADASTRAR O AULA>

        <div id="caixa_preta">
        </div><!-- caixa_preta -->

        <?php if (@$_GET['pg'] == 'aula') { ?>
            <div id="box_aula">
                <br /><br />
                <a class="a2" href="aulas_e_treinos.php?pg=aula&cadastra=sim">Cadastrar Aula</a>
                <?php if (@$_GET['cadastra'] == 'sim') { ?>
                    <br /><br />
                    <h1>Cadastrar aula</h1>
                    <?php if (isset($_POST['cadastra'])) {

                        $aula = $_POST['aula'];

                        $sql = "INSERT INTO aulas (aula) VALUES ('$aula')";

                        $cad = mysqli_query($conexao, $sql);

                        if ($cad == '') {
                            echo "<script language='javascript'> window.alert('Erro ao Cadastrar, Aula já Cadastrada!');</script>";
                        } else {

                            echo "<script language='javascript'> window.alert('Cadastro Realizado com sucesso!!');</script>";
                            echo "<script language='javascript'>window.location='aulas_e_treinos.php?pg=aula';</script>";
                        }
                    } ?>
                    <form name="form1" method="post" action="">
                        <table width="900" border="0">
                            <tr>
                                <td width="134">Aula</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="aula" id="textfield"></td>
                                <td><input class="input" type="submit" name="cadastra" id="button" value="Cadastrar"></td>
                            </tr>
                        </table>
                    </form>
                    <br />
                <?php die;
                } ?>



                <!VISUALIZAR OS AULAS CADASTRADOS>

                    <?php
                    $sql_1 = "SELECT * FROM aulas";
                    $result = mysqli_query($conexao, $sql_1);
                    if (mysqli_num_rows($result) <= 0) {
                        echo "<br><br>No momento não existe nenhum aula cadastrado!<br><br>";
                    } else {
                    ?>
                        <br /><br />
                        <h1>Aulas</h1>
                        <table width="900" border="0">
                            <tr>
                                <td><strong>Aula:</strong></td>
                                <td><strong>Total de treinos deste aula:</strong></td>
                                <td>&nbsp;</td>
                            </tr>
                            <?php while ($res_1 = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td>
                                        <h3><?php echo $aula = $res_1['aula']; ?></h3>
                                    </td>
                                    <td>
                                        <h3><?php $sql_2 = "SELECT * FROM treinos WHERE aula = '$aula'";
                                            $result2 = mysqli_query($conexao, $sql_2);
                                            echo mysqli_num_rows($result2); ?></h3>
                                    </td>
                                    <td><a class="a" href="aulas_e_treinos.php?pg=aula&deleta=cur&id=<?php echo @$res_1['id']; ?>"><img title="Excluir aula" src="img/deleta.jpg" width="18" height="18" border="0"></a></td>
                                </tr>
                            <?php } ?>
                        </table>

                    <?php } ?>
                    <br />


                    <!DELEÇÃO DOS AULAS>

                        <?php if (@$_GET['deleta'] == 'cur') {

                            $id = $_GET['id'];

                            $sql_3 = "DELETE FROM aulas WHERE id = '$id'";
                            mysqli_query($conexao, $sql_3);

                            echo "<script language='javascript'>window.location='aulas_e_treinos.php?pg=aula';</script>";
                        } ?>
            </div><!-- box_aula -->
        <?php  } ?>





        <!CADASTRAR TREINOS>

            <?php if (@$_GET['pg'] == 'treino') { ?>

                <div id="box_treinos">
                    <a class="a2" href="aulas_e_treinos.php?pg=treino&cadastra=sim">
                        Cadastrar Treino</a>
                    <?php if (@$_GET['cadastra'] == 'sim') { ?>
                        <h1>Cadastrar nova treino</h1>

                        <?php if (isset($_POST['cadastra'])) {

                            $aula = $_POST['aula'];
                            $treino = $_POST['treino'];
                            $instrutor = $_POST['instrutor'];
                            $sala = $_POST['sala'];
                            $turno = $_POST['turno'];

                            if ($treino == '') {
                                echo "<script language='javascript'>window.alert('Digite o nome da treino');</script>";
                            } else if ($sala == '') {
                                echo "<script language='javascript'>window.alert('Digite o nº da sala');</script>";
                            } else {
                                $sql_cad_disc = "INSERT INTO treinos (aula, treino, instrutor, sala, turno) VALUES ('$aula', '$treino', '$instrutor', '$sala', '$turno')";
                                $cad_disc = mysqli_query($conexao, $sql_cad_disc);
                                if ($cad_disc == '') {
                                    echo "<script language='javascript'>window.alert('Ocorreu um erro!');</script>";
                                } else {
                                    echo "<script language='javascript'>window.alert('Treino cadastrada com sucesso!');window.location='aulas_e_treinos.php?pg=treino';</script>";
                                    echo "<script language='javascript'>window.location='aulas_e_treinos.php?pg=treino';</script>";
                                }
                            }
                        } ?>

                        <form name="form1" method="post" action="">
                            <table width="900" border="0">
                                <tr>
                                    <td width="134">Aula:</td>
                                    <td width="213">Treino:</td>
                                    <td>Instrutor:</td>
                                    <td width="128">Sala: <em>Apenas o número</em></td>
                                    <td width="128">Turno:</td>
                                    <td width="126">&nbsp;</td>
                                    <td width="0" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="aula">
                                            <?php
                                            $sql_rec_aula = "SELECT * FROM aulas";
                                            $result_rec_aula = mysqli_query($conexao, $sql_rec_aula);

                                            while ($r2 = mysqli_fetch_assoc($result_rec_aula)) {
                                            ?>
                                                <option value="<?php echo $r2['aula']; ?>"><?php echo $r2['aula']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="treino" id="textfield"></td>
                                    <td width="143">
                                        <select name="instrutor">
                                            <?php
                                            $sql_result_instrutor = "SELECT * FROM instrutores WHERE nome != ''";
                                            $result_rec_instrutor = mysqli_query($conexao,  $sql_result_instrutor);
                                            while ($r3 = mysqli_fetch_assoc($result_rec_instrutor)) {
                                            ?>
                                                <option value="<?php echo $r3['code']; ?>"><?php echo $r3['nome']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="sala" id="textfield"></td>
                                    <td>
                                        <select name="turno" size="1" id="turno">
                                            <option value="Manhã">Manhã</option>
                                            <option value="Tarde">Tarde</option>
                                            <option value="Noite">Noite</option>
                                        </select></td>
                                    <td width="126"><input class="input" type="submit" name="cadastra" id="button" value="Cadastrar"></td>
                                </tr>
                            </table>
                        </form>

                    <?php die;
                    } ?>






                    <!MOSTRAR AS TREINOS NA TABELA>


                        <br /><br />




                        <h1>Treinos</h1>
                        <?php
                        $sql_buscar_disc = "SELECT * FROM treinos";
                        $result_buscar_disc = mysqli_query($conexao,  $sql_buscar_disc);
                        if (mysqli_num_rows($result_buscar_disc) == '') {
                            echo "<h2>No momento não existe nenhuma treino cadastrada!</h2><br><br>";
                        } else {
                        ?>
                            <table width="900" border="0">
                                <tr>
                                    <td><strong>Aula:</strong></td>
                                    <td><strong>Treino:</strong></td>
                                    <td><strong>Instrutor:</strong></td>
                                    <td><strong>Sala:</strong></td>
                                    <td><strong>Turno:</strong></td>
                                </tr>
                                <?php while ($res_busca = mysqli_fetch_assoc($result_buscar_disc)) { ?>
                                    <tr>
                                        <td>
                                            <h3><?php echo $res_busca['aula']; ?></h3>
                                        </td>
                                        <td>
                                            <h3><?php echo $res_busca['treino']; ?></h3>
                                        </td>
                                        <td>
                                            <h3>
                                                <?php
                                                $instrutor = $res_busca['instrutor'];

                                                $sql_busca_instrutor = "SELECT * FROM instrutores WHERE code = '$instrutor'";
                                                $result_buscar_instrutor = mysqli_query($conexao,  $sql_busca_instrutor);
                                                while ($res_busca2 = mysqli_fetch_assoc($result_buscar_instrutor)) {
                                                    echo $res_busca2['nome'];
                                                    echo " - ";
                                                    echo $res_busca['instrutor'];
                                                }

                                                ?>
                                            </h3>
                                        </td>
                                        <td>
                                            <h3><?php echo $res_busca['sala']; ?></h3>
                                        </td>
                                        <td>
                                            <h3><?php echo $res_busca['turno']; ?></h3>
                                        </td>
                                        <td><a class="a" href="aulas_e_treinos.php?pg=treino&deleta=sim&id=<?php echo $res_busca['id']; ?>"><img title="Excluir Treino" src="img/deleta.jpg" width="18" height="18" border="0"></a></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        <?php } ?>






                        <!EXCLUSÃO DAS TREINOS>

                            <?php if (@$_GET['deleta'] == 'sim') {

                                $id = $_GET['id'];

                                $sql_delete_disc = "DELETE FROM treinos WHERE id = '$id'";
                                mysqli_query($conexao,  $sql_delete_disc);

                                echo "<script language='javascript'>window.location='aulas_e_treinos.php?pg=treino';</script>";
                            } ?>
                </div><!-- box_treinos -->
            <?php } ?>






            <!MOSTRAR OS AULAS E AS TREINOS>


                <?php if (@$_GET['pg'] == 'aulasetreinos') { ?>
                    <div id="box_aula_e_treinos">
                        <h1>Aulas e Treinos</h1>

                        <?php
                        $sql_ced = "SELECT * FROM aulas";
                        $result_ced = mysqli_query($conexao,  $sql_ced);
                        if (mysqli_num_rows($result_ced) == '') {
                            echo "Não existe nenhuma aula cadastrada no momento!";
                        } else {
                        ?>
                            <table width="620" border="0">
                                <?php while ($rs_ced = mysqli_fetch_assoc($result_ced)) { ?>
                                    <tr>
                                        <td width="614">Aula: <?php echo $aula = $rs_ced['aula']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <textarea disabled="disabled" name="textarea" id="textarea" cols="100" rows="5">
    <?php
                                    $sql_ced_instrutor = "SELECT * FROM treinos WHERE aula = '$aula'";
                                    $result_ced_instrutor = mysqli_query($conexao,  $sql_ced_instrutor);
                                    while ($rs_ced2 = mysqli_fetch_assoc($result_ced_instrutor)) {

                                        $instrutor = $rs_ced2['instrutor'];

                                        echo $rs_ced2['treino'];
                                        echo " - ";
                                        $sql_ced_cod = "SELECT * FROM instrutores WHERE code = '$instrutor'";
                                        $result_ced_cod = mysqli_query($conexao,  $sql_ced_cod);
                                        while ($rs_ced3 = mysqli_fetch_assoc($result_ced_cod)) {
                                            echo $rs_ced3['nome'];
                                            echo " - ";
                                            echo $rs_ced3['code'];
                                            
                                        }  ?>
		
		<?php }

        ?>
    </textarea>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                            <br />
                        <?php } ?>

                    </div><!-- box_aula_e_treinos -->
                <?php } ?>



                </div>
                <?php require "rodape.php"; ?>
</body>

</html>