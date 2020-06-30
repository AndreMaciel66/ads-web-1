<!DOCTYPE html>
<html lang="en">
<head>
<title>.:: Clientes ::.</title>
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
	jQuery("#clientesGrid").jqGrid({
			url:'clienteAction.php',
            datatype:'json',
            mtype:'GET',
            jsonReader:
				{'repeatitems':false},
            pager:'#clientesPagerGrid',
            rowNum:10,
            rowList:
				[10,20,30,40,50,60,70,80,90,100],
            sortable:true,
            viewrecords:true,
            gridview:true,
            autowidth:true,
            height:370,
            shrinkToFit:true,
            forceFit:true,
            hidegrid:false,
            sortname:'nomeVendedor',
            sortorder:'asc',
			caption: "Vendedores",
            colModel:[
                {label:'Cód.',width:60,align:'left',name:'idCliente'},
				{label:'Nome do Vendedor',width:200,align:'left',name:'nomeVendedor'},
				{label:'Comissão',width:100,align:'center',name:'comissao'}
            ] 
        });
	jQuery("#vendedorGrid").jqGrid('navGrid', '#vendedorPagerGrid', {del:false,add:false,edit:false,search:false,refresh:true} );
	
	//cadastro de cliente
	$("#btnCadastrar").click(function(){
		window.location = "vendedorCad.php";				   
	})
	
	//edição de cliente
	$("#btnEditar").click(function(){
	    //Captura a linha selecionada na Grid
		var linhaSelecionada = jQuery("#vendedorGrid").getGridParam('selrow');
		//Captura o ID na linha selecionada (célula da coluna 0 - zero)
		var id = jQuery("#vendedorGrid").getCell(linhaSelecionada,0);
		
		if(id != null){
			window.location = "vendedorEdit.php?id="+id;				
		}else{
		    alert("Selecione um registro");
		}	   
	})
	
	//exclusão de cliente
	$("#btnDeletar").click(function(){
	    //Captura a linha selecionada na Grid
		var linhaSelecionada = jQuery("#vendedorGrid").getGridParam('selrow');
		//Captura o ID na linha selecionada (célula da coluna 0 - zero)
		var id = jQuery("#vendedorGrid").getCell(linhaSelecionada,0);
		
		if(linhaSelecionada != null){
			
			if (confirm("Confirma a exclusão?") == true){
			
				deletaVendedor(id);

   			    jQuery("#vendedorGrid").jqGrid('setGridParam',{url:'vendedorActionf.php',page:1}).trigger('reloadGrid');
			}	
		}else{
			alert("Selecione um Registro");
		}			   
	})
	
	function deletaVendedor(id){
		$.ajax({
			type:"POST",
			url:"vendedorAction.php?acao=deleta&idVendedor="+id,
			dataType:"json",
			data:{},
			success: function(data, textStatus, request){
			    var retorno = data['retorno'];
			}	
		});
	}
	
	jQuery("#btnPesquisar").click(function(){
		var nomeVendedor = $('#txtNomeVendedor').val();	
		
		jQuery("#vendedorGrid").jqGrid('setGridParam',{url:'vendedorAction.php?nomeVendedor='+nomeVendedor ,page:1}).trigger('reloadGrid');	
	})
	
	jQuery("#btnLimpar").click(function(){	
		$('#txtNomeVendedor').val('');	
		
		jQuery("#vendedorGrid").jqGrid('setGridParam',{url:'vendedorAction.php',page:1}).trigger('reloadGrid');		
	})
	
});
</script>
</head>
<body>
<div>
    Cliente: <input type="text" id="txtNomeCliente" name="txtNomeCliente"/> 
	<input type="button" id="btnPesquisar" value="Pesquisar"/>  
    <input type="button" id="btnLimpar" value="Limpar"/>       
</div>
<hr>
<div id="botoes" style="padding:4px 4px 4px 4px; color:#666; font-size:12px; font-weight:bold;">
    <input type="button" id="btnCadastrar" value="Cadastrar"/>
    <input type="button" id="btnEditar" value="Editar"/>
    <input type="button" id="btnDeletar" value="Deletar"/>
</div> 
<hr>
<table id="clientesGrid" ></table>
<div id="clientesPagerGrid"></div>
</body>
</html>





