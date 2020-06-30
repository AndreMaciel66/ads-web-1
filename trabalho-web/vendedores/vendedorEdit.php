<!DOCTYPE html>
<?php
	include('../conexao.php');
		
	//Captura do "id"	
	$idVendedor = $_REQUEST[id];
	
	//Pesquisar o Cliente referente ao "id" passado pela JqGrid
	$rs = mysql_query("select * from vendedor where idVendedor=$idVendedor");
	$reg = mysql_fetch_object($rs);
?>

<html lang="en">
<head>
<title>.:: Edição do Cliente ::.</title>
<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>  

<script type="text/javascript" src="../js/jquery-ui-1.8.17.custom/js/jquery-1.7.1.min.js"></script>

<link rel="stylesheet" href="../js/jquery-ui-1.8.17.custom/css/smoothness/jquery-ui-1.8.17.custom.css">
<script src="../js/jquery-ui-1.8.17.custom/development-bundle/ui/jquery.ui.core.js" type="text/javascript"></script>
<script src="../js/jquery-ui-1.8.17.custom/development-bundle/ui/jquery.ui.widget.js" type="text/javascript"></script> 
<script src="../js/jquery-ui-1.8.17.custom/development-bundle/ui/jquery.ui.button.js" type="text/javascript"></script>
<script src="../js/jquery-ui-1.8.17.custom/development-bundle/ui/jquery.ui.datepicker.js" type="text/javascript"></script> 

<script type="text/javascript" src="../js/jquery.form.js"></script>

<script src="../js/jquery.jqGrid-3.8.2/js/i18n/grid.locale-pt-br.js" type="text/javascript"></script>
<script src="../js/jquery.jqGrid-3.8.2/js/jquery.jqGrid.min.js" type="text/javascript"></script>
<link href="../js/jquery.jqGrid-3.8.2/css/ui.jqgrid.css" rel="stylesheet" type="text/css"/>


<script>
$(function() {

	jQuery("#btnLimpar").click(function(){	
		$('#txtNomeVendedor').val('');
		$('#txtComissao').val('');
	})
	
	jQuery("#btnSalvar").click(function(){
		//Captura dados do formulario
		var id = $("#idVendedor").val();
		var nomeCliente = $("#txtNomeVendedor").val();
		var comissao = $("#txtComissao").val();
  
		//Validação de dados
		if (nomeVendedor == ''){
			alert("Vendedor não foi digitado");
			$("#txtNomeVendedor").focus();
			exit;
		}
		
		if (comissao == ''){
			alert("Por favor informe o comissao");
			$("#txtComissao").focus();
			exit;
		}

		//Gravação do cliente
		atualizaVendedor(id,nomeVendedor,comissao);
	})
	
	function atualizaVendedor(id,nomeVendedor,comissao){
		$.ajax({
			type:"POST",
			url:"vendedorAction.php?acao=atualiza&idVendedor="+id+"&nomeVendedor="+nomeVendedor+"&comissao="+comissao,
			dataType:"json",
			data:{},
			success: function(data, textStatus, request){
				$("#retorno").val(data['retorno']);	
			}	
		});
	}

});
</script>

</head>

<body>
<input type="hidden" id="idVendedor" value="<?=$idVendedor?>">
<h1><font color="blue">Edição de Vendedor</font></h1>
<hr>
<table>
	<tr><td>Nome do Vendedor</td>
	    <td><input type="text" id="txtNomeVendedor" value="<?=$reg->nomeVendedor?>"></td>
	</tr>
	<tr><td>CPF</td>
	    <td><input type="text" id="txtComissao" value="<?=$reg->comissao?>"></td>
	</tr>
	<tr><td colspan="2" align="center"><input type="button" id="btnSalvar" value="Salvar"></td>
	</tr>
</table>
<hr>
<div id="retorno"></div>
</body>
</html>





