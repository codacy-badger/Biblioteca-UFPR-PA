<?php
  session_start();

  include "../funcoesGerais.php";
  include "../cfg.php";

  if($_POST['alterarSenha_nova'] != $_POST['alterarSenha_conferir']){
    echo 0;
    exit;
  }

  $usuario = $_SESSION['usuario'];
  $senha = md5(preg_replace('/[^a-zA-Z0-9_]/', '',$_POST['alterarSenha_antiga']));
  $n_senha = md5(preg_replace('/[^a-zA-Z0-9_]/', '',$_POST['alterarSenha_nova']));

  $sql = mysqli_query($conectar, "SELECT * FROM usuarios WHERE usuario='{$usuario}' AND senha='{$senha}'");

  if(verificarSql($sql)){
    mysqli_query($conectar, "UPDATE usuarios SET senha='{$n_senha}' WHERE usuarios.usuario='{$usuario}'");
    gravar_log("Alterou sua própria senha * [#124#]");
    echo 1;
    exit;
  } else {
    echo 0;
    exit;
  }

?>
