<?php
	$key = "PortalZ";

    $data=$_REQUEST;

    include_once("config.php");

    $conexao = db_connect();

    extract($data);
	$email = $edtMail;
	//$senha = base64_encode($edtSenha . '::' . $key);
	$senha = $edtSenha;
	$status = "A";

	$resultado = "ERRO";
	
	$sql = "select id_usu, usunome from usuario where usumail = :mail and ususenha = :senha and usustatus = :status ";

    $comando = $conexao->prepare($sql);

    $comando->bindParam(':mail', $email);
	$comando->bindParam(':senha', $senha);
	$comando->bindParam(':status', $status);

    $comando->execute();

	if( $comando->rowCount() > 0)
	{
		$dados = $comando->fetch(PDO::FETCH_OBJ);
		
		$id_usu  = $dados->id_usu;
		$usunome = $dados->usunome;
		
		session_start();
		
		$_SESSION['logged_in'] = true;
		$_SESSION['id_usu'] = $id_usu;
		$_SESSION['usunome'] = $usunome;
		$_SESSION['TEMPO'] = time();
		
		header('location: .');
	}
	else
	{
		header('location: login_invalido.php');
	}
?>