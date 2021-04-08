<? $painel_atual = "admin";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <? require "../config.php"; ?>
    <link href="css/topo.css" rel="stylesheet" type="text/css" />
    <script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
    <script src="../js/lightbox.js"></script>
    <link href="../css/lightbox.css" rel="stylesheet" />


    <link rel="stylesheet" href="../jquery.superbox.css" type="text/css" media="all" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

    <script type="text/javascript" src="../jquery.superbox-min.js"></script>
    <script type="text/javascript">
        $(function() {

            $.superbox.settings = {

                closeTxt: "Fechar",

                loadTxt: "Carregando...",

                nextTxt: "Next",

                prevTxt: "Previous"

            };

            $.superbox();

        });
    </script>
    <?php require "../conexao.php"; ?>
</head>

<body>
    <div id="box_topo">

        <div id="logo">
            <img src="../img/logo.png" width="240" />
        </div><!-- logo -->

        <div id="campo_busca">

            <form name="" method="post" action="" enctype="multipart/form-data">
                <input type="text" name="key" /><input class="input" type="submit" name="search" value="" />
            </form>
        </div><!-- campo_busca -->

        <div id="mostra_login">
            <h1><strong>Seja Bem Vindo - Seu código de acesso é:
                    <? echo @$code; ?></strong> <strong><a href="../config.php?pg=sair">Sair</a></strong></h1>
        </div><!-- mostra_login -->
    </div><!-- box_topo -->

    <div id="box_menu">

        <div id="menu_topo">
            <ul>
                <img src="img/separador_menu.png" />
                <li><a href="index.php">HOME</a></li>
                <img src="img/separador_menu.png" />
                <li><a href="">Aulas e Treinos</a>
                    <ul>
                        <li><a href="aulas_e_treinos.php?pg=aula">Cadastrar Aula</a></li>
                        <li><a href="aulas_e_treinos.php?pg=treino">Cadastrar Treino</a></li>
                        <li><a href="aulas_e_treinos.php?pg=aulasetreinos">Aulas & Treinos</a></li>
                    </ul>
                </li>
                <img src="img/separador_menu.png" />
                <li><a href="instrutores.php?pg=todos">INSTRUTORES</a></li>
                <img src="img/separador_menu.png" />
                <li><a href="clientes.php?pg=todos">Clientes</a></li>
                <img src="img/separador_menu.png" />
                <li><a href="setor_financeiro.php">SETOR FINANCEIRO</a></li>
                <img src="img/separador_menu.png" />
                <li><a href="../tesouraria/index.php">PAGAR MENSALIDADE</a></li>
                <img src="img/separador_menu.png" />
                <li><a href="">RELATÓRIOS</a>
                    <ul>
                        <li><a href="relatorios.php?tipo=clientes&s=<?php echo base64_encode("SELECT * FROM clientes WHERE nome != ''"); ?>">Clientes</a></li>
                        
                        <li><a href="fluxo_de_caixa.php?&s=<?php echo base64_encode("WHERE m = " . date("m") . " AND a = " . date("Y") . ""); ?>">Fluxo de caixa</a></li>
                    </ul>
                </li>
                <!-- <img src="img/separador_menu.png" />
                <li><a href="suporte_tecnico.php">SUPORTE TECNICO</a></li>
                <img src="img/separador_menu.png" />
                <li><a href="">EXTRAS</a>
                    <ul>
                        <li><a href="funcionarios.php?pg=todos">Funcionários</a></li>
                    </ul>
                </li>
                <img src="img/separador_menu.png" />
            </ul> 
        -->
        </div><!-- menu_topo -->

    </div><!-- box_menu -->
</body>

</html>