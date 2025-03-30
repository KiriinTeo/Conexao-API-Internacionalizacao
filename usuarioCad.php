<?php
    include_once("config.php");
    require_once("verifica.php");

    $data = $_REQUEST;

    $conexao = db_connect();

    extract($data);
	//$op = $status;

    if ($op != "I") {
        $sql = "SELECT id_usu, usumail, ususenha, usunome, usustatus, usutipo, usudatacad
                FROM usuario
                WHERE id_usu = :codigo";

        $comando = $conexao->prepare($sql);
        $comando->bindParam(':codigo', $codigo, PDO::PARAM_INT);
        $comando->execute();

        $dados = $comando->fetch(PDO::FETCH_OBJ);
    } 
?>
<?php include_once("cabec.php"); ?>

<p>&nbsp;</p>

<h2 align="center"> <?php echo $lng['dadosUsuario']; ?></h2>

<form class="form-inline row justify-content-center col-lg-12" action="usuarioGrava.php" method="post">
    <input type="hidden" name="edtCodigo" value="<?php echo ($op != 'I') ? $dados->id_usu : '0'; ?>" />
    <input type="hidden" name="op" value="<?php echo $op; ?>" />
    
    <div class="form-group col-sm-12 col-lg-10">
        <div class="control-label col-sm-11">
            <p class="help-block" align="right"><h11>*</h11> <?php echo $lng['campObrigatorio']; ?> </p>
        </div>
    </div>
    
    <div class="form-group row my-2">
        <label for="edtMail" class="col-sm-2 col-form-label text-end"> <?php echo $lng['e_mail']; ?> &nbsp;<h11>*</h11>&nbsp;</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="edtMail" name="edtMail" placeholder="<?php echo $lng['e_mailUsuario']; ?>" value="<?php echo ($op != 'I') ? $dados->usumail : ''; ?>">
        </div>
    </div>  
    
    <div class="form-group row my-2">
        <label for="edtSenha" class="col-sm-2 col-form-label text-end"> <?php echo $lng['senha']; ?> &nbsp;<h11>*</h11>&nbsp;</label>
        <div class="col-sm-7">
            <input type="password" class="form-control" id="edtSenha" name="edtSenha" placeholder="<?php echo $lng['senhaUsuario']; ?>" value="<?php echo ($op != 'I') ? $dados->ususenha : ''; ?>">
        </div>
    </div>
    
    <div class="form-group row my-2">
        <label for="edtNome" class="col-sm-2 col-form-label text-end"> <?php echo $lng['nome']; ?> &nbsp;<h11>*</h11>&nbsp;</label>
        <div class="col-sm-7">
            <input type="text" class="form-control" id="edtNome" name="edtNome" placeholder="<?php echo $lng['nomeUsuario']; ?>" value="<?php echo ($op != 'I') ? $dados->usunome : ''; ?>">
        </div>
    </div>
    
    <div class="form-group row my-2">
        <label class="col-sm-2 col-form-label text-end"> <?php echo $lng['dataCad']; ?> &nbsp;</label>
        <label class="col-sm-7 col-form-label text-start"><?php echo ($op != 'I') ? $dados->usudatacad : ''; ?></label>
    </div>
    
    <div class="form-group row my-2">
        <label for="edtStatus" class="col-sm-2 col-form-label text-end"> <?php echo $lng['status']; ?> &nbsp;<h11>*</h11>&nbsp;</label>
        <div class="col-sm-7">
            <select required id="edtStatus" name="edtStatus" class="form-control col-md-8">
                <option value="A" <?php echo ($op != 'I' && $dados->usustatus == 'A') ? 'selected' : ''; ?>> <?php echo $lng['ativo']; ?></option>
                <option value="I" <?php echo ($op != 'I' && $dados->usustatus == 'I') ? 'selected' : ''; ?>> <?php echo $lng['inativo']; ?></option>
            </select>
        </div>
    </div>
    
    <div class="form-group row my-2">
        <label for="edtTipo" class="col-sm-2 col-form-label text-end"> <?php echo $lng['tipoUsuario']; ?> &nbsp;<h11>*</h11>&nbsp;</label>
        <div class="col-sm-7">
            <select required id="edtTipo" name="edtTipo" class="form-control col-md-8">
                <option value="M" <?php echo ($op != 'I' && $dados->usutipo == 'M') ? 'selected' : ''; ?>>Master</option>
                <option value="A" <?php echo ($op != 'I' && $dados->usutipo == 'A') ? 'selected' : ''; ?>>Admin</option>
                <option value="O" <?php echo ($op != 'I' && $dados->usutipo == 'O') ? 'selected' : ''; ?>>Operador</option>
            </select>
        </div>
    </div>
    
    <div class="col-md-12 my-3">
        <div class="form-group col-md-11">
            <label class="col-md-6">&nbsp;</label>
            <button type="button" class="btn btn-dark col-md-2" onClick="window.open('usuario.php', '_self')"> <?php echo $lng['sair']; ?></button>
            <label class="col-md-1">&nbsp;</label>
            <button type="submit" class="btn btn-dark col-md-2"> <?php echo $lng['salvar']; ?></button>
        </div>
    </div>
</form>

<p>&nbsp;</p>

<?php include_once("rodape.php"); ?>
