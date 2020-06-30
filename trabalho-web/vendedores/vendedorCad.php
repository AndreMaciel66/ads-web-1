<!DOCTYPE html>
<html lang="en">
<head>
<title>Cadastro do Vendedor</title>
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
		var nomeCliente = $("#txtNomeVendedor").val();
		var cpf = $("#txtComissao").val();
  
		//Validação de dados
		if (nomeVendedor == ''){
			alert("Vendedor não foi digitado");
			$("#txtNomeVendedor").focus();
			exit;
		}
		
		if (cpf == ''){
			alert("Por favor informe a comissao");
			$("#txtComissao").focus();
			exit;
		}

		//Gravação do vendedor
		gravaVendedor(nomeVendedor,comissao);
	})
	
	function gravaVendedor(nomeVendedor,comissao){
		$.ajax({
			type:"POST",
			url:"vendedorAction.php?acao=adiciona&nomeVendedor="+nomeVendedor+"&comissao="+comissao,
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
<input type="hidden" id="idVendedor">
<h1><font color="blue">Cadastro de Vendedor</font></h1>
<hr>
<table>
	<tr><td>Nome do Vendedor</td>
	    <td><input type="text" id="txtNomeVendedor"></td>
	</tr>
	<tr><td>CPF</td>
	    <td><input type="text" id="txtComissao"></td>
	</tr>
	<tr><td><input type="button" id="btnSalvar" value="Salvar"></td>
	    <td><input type="button" id="btnLimpar" value="Limpar"></td>
	</tr>
</table>
<hr>
<div id="retorno"></div>
</body>
</html>





