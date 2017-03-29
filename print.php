<?php
	require_once 'C:\xampp\htdocs\chkList_old\config.php';
	require_once PATH_CONTROLLER.'EmpresaController.php';
	$empresaController = new EmpresaController();

	$empresa =$empresaController->buscarEmpresa('04535461000110');
	//echo $empresa->getCnpj();
?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<style>
			table, th, td {
			    border: 1px solid black;
			    border-collapse: collapse;
			}
			th{
				 padding: 5px;
			    text-align: center; 
			}
			td {
			    padding: 5px;
			    text-align: left;    
			}
		</style>
	</head>
	<body>
		<table>
			<th colspan="6">Dados Empresa</th>
			<tr>
				<td>Empresa:</td>
				<td colspan="2"><?php echo $empresa->getEmpresa(); ?></td>
				<td>CNPJ:</td>
				<td colspan="2"><?php echo $empresa->getCnpj(); ?></td>
			</tr>
			<tr>
				<td>E-mail:</td>
				<td colspan="2"><?php echo $empresa->getEmail(); ?></td>
				<td>Tel.</td>
				<td colspan="2"><?php echo $empresa->getTelefone(); ?></td>
			</tr>
			<tr>
				<td>Responsavel</td>
				<td colspan="2"><?php echo $empresa->getRespSistema(); ?></td>
				<td>Numero de Usuários</td>
				<td colspan="2"><?php echo $empresa->getNUsuario(); ?></td>
			</tr>
			<tr>
				<td>Ramo:</td>
				<td><?php echo $empresa->getRamo(); ?></td>
				<td>Loja:</td>
				<td><?php echo $empresa->getLoja(); ?></td>
				<td>Possui Filial:</td>
				<td>
				<?php
					if($empresa->getFilial()) 
						echo $empresa->getFilial();
					else
						echo '0'; 
				?>					
				</td>
			</tr>
			<tr>
				<td>Regime:</td>
				<td>
					<?php
						if(strcmp($empresa->getRegime(), 'lPres') == 0)
							echo 'Lucro Presumido';
						if(strcmp($empresa->getRegime(), 'lReal') == 0)
							echo 'Lucro Real';
						if(strcmp($empresa->getRegime(), 'SN') == 0)
							echo 'Simples Nacional';
					 ?>					
				</td>
				<td>Fiscal:</td>
				<td >
					<?php 
					//Fiscal, Pis/Cofins
						$fiscal = '';
						if($empresa->getSintegra() == 1){
							$fiscal .= 'Sintegra';
						}
						if($empresa->getSpedFiscal() == 1){
							if(!empty($fiscal)){
								$fiscal .= ', ';
							}
							$fiscal .= 'Fiscal';
						}
						if($empresa->getSpedPis() == 1){
							if(!empty($fiscal)){
								$fiscal .= ', ';
							}
							$fiscal .= 'Contribuições';
						}

						echo $fiscal;
					
					?>
				</td>
				<td>100% Fiscal</td>
				<td>
					<?php
					if($empresa->getNFiscal()) 
						echo $empresa->getNFiscal();
					else
						echo '0'; 
					?>				
				</td>
			</tr>

		</table>
		<br /><br /><br />
		<table>
			<th colspan="9">Computadores</th>
			<tr>
				<th>Qtde</th>
				<th>Descrição</th>
				<th>Sist. OP</th>
				<th>HD</th>
				<th>Memoria</th>
				<th>Serial</th>
				<th>Serv.</th>
				<th>Term.</th>
				<th>Caixa</th>		
			</tr>
			<tr>
				<td>1</td>
				<td>DELL i7</td>
				<td>Win 7</td>
				<td>16 tb</td>
				<td>4 gb</td>
				<td>S</td>
				<td>S</td>
				<td>N</td>
				<td>N</td>
			</tr>
			<tr>
				<td>2</td>
				<td>RC 8100</td>
				<td>Win 7</td>
				<td>1 tb</td>
				<td>2 gb</td>
				<td>S</td>
				<td>N</td>
				<td>S</td>
				<td>S</td>
			</tr>

			<h4>Outras Informações</h4>
			<table>
				<tr>
					<td>Cert. Digital: </td>
					<td>$outrasInf->getCertDigital()</td>
					<td>Internet:</td>
					<td>Fibra Optica</td>
					<td>Impressora:</td>
					<td>S</td>						
					<td>Col. de Dados:</td>
					<td>S</td>
				</tr>
				<tr>
					<td colspan ="2">Busca Preço:</td>
					<td colspan ="2">$outrasInf->getBuscaPreco()</td>
					<td colspan = "2">Imp de Etiqueta:</td>
					<td colspan ="2">$outrasInf->getImpEtiqueta()</td>					
				</tr>
				<tr>
					<th colspan =\"8\">TEF<th>
				<tr >
						<th colspan =\"4\">Marca</th>
						<th colspan =\"4\">Tipo</th>
					</tr>
					";
					$retorno.="
					<tr>
						<td colspan =\"4\">".$outrasInf->getMarcaTef()."</td>
						<td colspan =\"\">".$outrasInf->getTipoTef()."</td>					
					</tr>
					";
				}
				$retorno.="
				</tr>
				";
			$retorno.="
				</tr>
			</table>
			";

		</table>
	</body>
</html>