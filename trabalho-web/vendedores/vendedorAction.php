<?
	include("../conexao.php");
	
	//Captura do parтmetro de aчуo
	$acao = $_REQUEST['acao'];
	
	//Se nуo for passado parтmetro 'aчуo' assume por default 'lista'
	if (! isset($acao)){
		$acao = 'lista';
	}
	
	//Action para gravar o vendedor
	if ($acao == 'adiciona'){
		//Captura dos dados enviados pelo formulсrio
		$nomeCliente = $_REQUEST['nomeVendedor'];
		$cpf         = $_REQUEST['comissao'];
		$sql="insert into vendedor(nomeVendedor, comissao)
			  values('$nomeVendedor', '$comissao')";
		mysql_query($sql) or die("erro na gravaчуo");	  
		echo json_encode(array('retorno'=>mysql_insert_id()));	
	}
    //Exemplo de chamada da Action como uma API:
	//http://127.0.0.1:8024/unisys/clientes/clienteAction.php?acao=adiciona&nomeCliente=Abel&cpf=02616652834&telefone=999912312&sexo=M
	
	//Action para atualizar dados do cliente
	if ($acao == 'atualiza'){
		//Captura dos dados enviados pelo formulсrio
		$idVendedor   = $_REQUEST['idVendedor'];
		$nomeVendedor = $_REQUEST['nomeVendedor'];
		$cpf         = $_REQUEST['comissao'];
		$sql="update vendedor set 
		        nomeVendedor = '$nomeVendedor',
				comissao     = '$comissao'
				where idVendedor = $idVendedor";

		mysql_query($sql) or die("erro na gravaчуo");	
        $retorno = 1;		
		echo json_encode(array('retorno'=>$retorno));	
	}
    //Exemplo de chamada da Action como uma API:
	//http://127.0.0.1:8024/unisys/clientes/clienteAction.php?acao=atualiza&idCliente=4&nomeCliente=Abel&cpf=02616652834&telefone=999912312&sexo=M
	
	//Action para deletar o cliente
	if ($acao == 'deleta'){
		
		$idVendedor = $_REQUEST['idVendedor'];
			
		$sql="delete from vendedor where idVendedor = $idVendedor";
		mysql_query($sql) or die("erro na gravaчуo");		  

		$retorno = 1;	
		echo json_encode(array('retorno'=>$retorno));	
	}
	//Exemplo de chamada da Action como uma API:
	//http://127.0.0.1:8024/unisys/clientes/clienteAction.php?acao=deleta&idCliente=5
	
	//Action para listar o(s) cliente(s)
    if ($acao == 'lista'){
	
		$page  = $_GET['page']; 
		$limit = $_GET['rows']; 
		$sidx  = $_GET['sidx']; 
		$sord  = $_GET['sord'];
	
		//Captura dos parтmetros passados na chamada GET
		$nomeVendedor = $_GET['nomeVendedor'];
	
   	    $where = " WHERE 1 = 1 ";
	
	    if( $nomeVendedor != "" ){	 	
		   $where .= " AND nomeVendedor LIKE '%".$nomeVendedor."%' ";		
	    }

		$queryCount = "SELECT count(*) total FROM vendedor $where";

	    $resultSetCount = mysql_query($queryCount);			 
				 
	    $rowCount = mysql_fetch_array($resultSetCount);
	    $count = $rowCount['total'];
	
	    if( $count>0 ){
		   $total_pages = ceil($count/$limit);	
	    }else{
		   $total_pages = 0;
	    }
	
	    if ($page > $total_pages) $page=$total_pages;
	    $start = $limit*$page - $limit;
	
	
        $query = "SELECT idVendedor, nomeVendedor, comissao
			      FROM vendedor
				  $where
			      ORDER BY $sidx $sord 
			      LIMIT $start , $limit";				 
	
        $resultSet = mysql_query($query);
	
    	$response->page = $page;
	    $response->total = $total_pages;
	    $response->records = $count;
	    $i=0;
	
	    while ( $row = mysql_fetch_array($resultSet) ){
						
			$response->rows[$i]['idVendedor']=$row['idVendedor'];
			$response->rows[$i]['nomeCliente']=$row['nomeVendedor'];
			$response->rows[$i]['comissao']=$row['comissao'];

			$i++;

		} 
	
		echo json_encode($response);	
	}
	//Exemplo de chamada da Action como uma API:
	//http://127.0.0.1:8024/unisys/clientes/clienteAction.php?page=1&rows=10&sidx=nomeCliente&sord=asc
	
?>