<?php
	//include_once("verifica.php");

	$key = "PortalZ";

    $data = $_REQUEST;

    include_once("config.php");

    $conexao = db_connect();

    extract($data);
	//$senha = base64_encode($edtSenha . '::' . $key);
	$senha = $edtSenha;
	
	$resultado = "ERRO";	
	
	if( $op == "A")
	{
		$sql = "update usuario set usumail = :mail, usunome = :nome,
				usustatus = :status, usutipo = :tipo  
				where id_usu = :codigo ";

		$comando = $conexao->prepare($sql);

		$comando->bindParam(':codigo', 		$edtCodigo);
		$comando->bindParam(':mail', 		$edtMail);
		$comando->bindParam(':nome', 		$edtNome);
		$comando->bindParam(':status', 		$edtStatus);
		$comando->bindParam(':tipo', 		$edtTipo);

		$comando->execute();
	}
	else
	{
		$sql = "insert into usuario (usumail, ususenha, usunome, usustatus, usutipo)
				values(:mail, :senha, :nome, :status, :tipo) ";

		$comando = $conexao->prepare($sql);

		$comando->bindParam(':mail', 		$edtMail);
		$comando->bindParam(':senha', 		$senha);
		$comando->bindParam(':nome', 		$edtNome);
		$comando->bindParam(':status', 		$edtStatus);
		$comando->bindParam(':tipo', 		$edtTipo);


		$comando->execute();
	}

	header('location: usuario.php');
?>