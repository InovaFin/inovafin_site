<?php
include "protectAdm.php";
include "conexao.php";

$contatos = array();

$modoExibicao = isset($_GET['mode']) ? $_GET['mode'] : 'naoRespondidas';

$paragrafoText = ($modoExibicao === 'respondidas') ? 'Mensagens Respondidas' : 'Mensagens a serem respondidas';

try {
	// Atualize a consulta SQL com base no modo de exibição selecionado
	if ($modoExibicao === 'naoRespondidas') {
		$query = "SELECT * FROM TB_FALECONOSCO WHERE RESP_CONTATO IS NULL OR RESP_CONTATO = ''";
	} else {
		$query = "SELECT * FROM TB_FALECONOSCO WHERE RESP_CONTATO IS NOT NULL AND RESP_CONTATO != '';";
	}

	$stmt = $conexao->prepare($query);

	if ($stmt->execute()) {
		$result = $stmt->get_result();

		while ($row = $result->fetch_assoc()) {
			$contatos[] = $row;
		}
	} else {
		echo '<script>alert("Erro na preparação da consulta SQL.");</script>';
	}

	$stmt->close();
} catch (Exception $e) {
	echo '<script>alert("Erro: ' . $e->getMessage() . '");</script>';
}

mysqli_close($conexao);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Painel ADM - InovaFin</title>
	<link rel="stylesheet" href="/inovafin_site/css/styleFC.css">
</head>

<body class="fundoPainelAdm">
	<header>
		<div class="logo">
			<a href="/inovafin_site/index.html"><img src="/inovafin_site/img/InovaFin.png" alt="logoInovafin"></a>
		</div>
		<div class="painelAdm">
			<img src="/inovafin_site/img/iconPainelAdm.png" alt="">
			<p>Painel ADM</p>
		</div>
		<div class="btnSair">
			<button>
				<a href="logout.php"><img src="/inovafin_site/img/iconBtnSair.png" alt="logout">Sair</a>
			</button>
		</div>
	</header>

	<section class="main-painelAdm">
		<div class="container-adm">
			<div class="container-menuAdm">
				<p>Bem Vindo <?php echo $_SESSION['nomeAdm'] ?></p>
				<?php
				// Verifique o modo de exibição atual e mostre o link apropriado
				if ($modoExibicao === 'naoRespondidas') {
					echo '<a class="btnMsg" href="painelAdm.php?mode=respondidas" title="Mensagens respondidas">
							<img src="/inovafin_site/img/iconMsgOk.png">
						  </a>';
				} else {
					echo '<a class="btnMsg" href="painelAdm.php?mode=naoRespondidas" title="Mensagens a serem respondidas">
							<img class="msgNo" src="/inovafin_site/img/iconRespFC.png">
						  </a>';
				}
				?>
			</div>

			<div class="container-table">
				<p><?php echo $paragrafoText; ?></p>
				<div class="content-table">
					<?php if (empty($contatos)) { ?>
						<div class='sem-mensagem'>
							<p>Não existem mensagens</p>
							<img src='/inovafin_site/img/iconSem-msg.png' alt='Sem Mensagens'>
						</div>
					<?php } else { ?>
						<table>
							<thead>
								<tr>
									<th class='id'>ID</th>
									<th class='nome'>Nome</th>
									<th class='email'>Email</th>
									<th class='mensagem'>Mensagem</th>
									<?php if ($modoExibicao === 'respondidas') { ?>
										<th class='responder'>Resposta</th>
									<?php } else { ?>
										<th class='responder'>Responder</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($contatos as $contato) { ?>
									<tr>
										<td class='id'><?php echo $contato['ID_CONTATO']; ?></td>
										<td class='nome'><?php echo $contato['NOME_CONTATO']; ?></td>
										<td class='email'><?php echo $contato['EMAIL_CONTATO']; ?></td>
										<td class='mensagem'><?php echo $contato['MSG_CONTATO']; ?></td>
										<?php if ($modoExibicao === 'respondidas') { ?>
											<td class='responder'>
												<?php echo $contato['RESP_CONTATO']; ?>
											</td>
										<?php } ?>
										<?php if ($modoExibicao === 'naoRespondidas') { ?>
											<td class='responder'>
												<form method="post" action="painelAdmResp.php">
													<input type="hidden" name="id_contato" value="<?php echo $contato['ID_CONTATO']; ?>">
													<button type="submit" class='btnRespFC'>
														<img src='/inovafin_site/img/iconRespFC.png' alt='Responder'>
													</button>
												</form>
											</td>
										<?php } ?>
									</tr>
								<?php } ?>
							</tbody>
						</table>

					<?php } ?>
				</div>
			</div>
		</div>
	</section>
</body>

</html>