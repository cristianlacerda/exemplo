<?php	
require_once '..\cabecalho_geral.php';
require_once 'cabecalho.php';
$mensagem= "";

if (isset($_POST['Salvar'])) {
    $gru_codigo= isset($_POST['gru_codigo'])?$_POST['gru_codigo']:null;
    $gru_descricao= isset($_POST['gru_descricao'])?$_POST['gru_descricao']:null;
    $gru_ativo= isset($_POST['gru_ativo'])?$_POST['gru_ativo']:null;
    
    $grupo= new Grupo();
    $grupo->setGru_codigo($gru_codigo);
    $grupo->setGru_descricao($gru_descricao);
    $grupo->setGru_ativo($gru_ativo);
    $resultado= $grupo->alterar();
    
    if (is_array($resultado))
        $mensagem= "Erro: ".$resultado[0].$resultado[2];
    else
        header('location: listar.php');
}	

$gru_codigo= isset($_GET['codigo'])?$_GET['codigo']:null;
$resultado= Grupo::listar($gru_codigo);
$gru_descricao= isset($resultado[0]["gru_descricao"])?$resultado[0]["gru_descricao"]:null;
$gru_ativo= isset($resultado[0]["gru_ativo"])?$resultado[0]["gru_ativo"]:null;
?>    

<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 order-md-1">

    		<div class="mb-4">
    			<h4>Alterar</h4><hr />
    		</div>
    	
    		<form method='POST'>
        		<input type='hidden' name='gru_codigo' id='gru_codigo' value="<?= $gru_codigo ?>"><br />
        		            
           		<div class="row mb-2">
               		<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-1">
        				<label for="gru_descricao">Descrição</label>
        			</div>
          	    	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-1">
        				<input type='text' name='gru_descricao' id='gru_descricao' value='<?= $gru_descricao ?>' class="form-control" required='required'>
        			</div>
        		</div>
                    	
           		<div class="row mb-2">
               		<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-1">
        	    		<label for="gru_ativo">Ativo</label>
        	    	</div>	
          	    	<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-1">
                		<select name='gru_ativo' id='gru_ativo' class="form-control">
                			<option value='S' <?php if ($gru_ativo=='S') echo 'SELECTED'; ?>>Sim</option>
                			<option value='N' <?php if ($gru_ativo=='N') echo 'SELECTED'; ?>>Não</option>
                		</select>
                	</div>	
        		</div>
        
        		<div class='alert-danger' id='mensagem'>
        			<?= $mensagem ?>
        		</div>
        	
        		<div class="row">
            		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4 mb-2">
            			<button  type='submit' name='Salvar' value='Salvar' class="btn btn-dark">Salvar</button>
        				<button class="btn btn-dark" type="button" onclick='javascript:location.href="listar.php";'>Cancelar</button>
        			</div>
        		</div>
		
			</form>
		</div>
	</div>
</div>

<?php require_once '..\rodape_geral.php'; 
