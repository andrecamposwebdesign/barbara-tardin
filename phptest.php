<?php

/*apenas dispara o envio da mensagem caso houver/existir $_POST['enviar']*/
if (isset($_POST['enviar']))

{
/*digite os destinatarios separados por virgula*/
$destinatarios = 'andrecampos.webdesign@gmail.com, andrecampospuc@hotmail.com';
/*usuario ou nome completo da conta criada em sua hospedagem, como por exemplo teste@seudominio*/
$usuario = 'andrecampos.webdesign@gmail.com';
/*senha da conta de email acima*/
$senha = '()()peart?';
/*nome do destinatario no qual receberá a mensagem*/
$nomeDestinatario = 'mensagem do site';

/*abaixo as veriaveis principais, que devem conter em seu formulario*/
$nomeRemetente = $_POST['nomeRemetente'];
$resposta = $_POST['email'];
$assunto = $_POST['assunto'];
$_POST['mensagem'] = nl2br($_POST['mensagem']);

/***********************************A PARTIR DAQUI NAO ALTERAR************************************/
foreach ($_POST as $dados['me1'] => $dados['me2'])

{

$dados['me3'][] = '<b>'.$dados['me1'].'</b>: '.$dados['me2'];

}

$dados['me3'] = '<hr><h4>Mensagem do site</h4>'.implode('<br>', $dados['me3']).'<hr>';

$dados['email'] = array('usuario' => $usuario, 'senha' => $senha, 'servidor' => 'smtp.'.substr(strstr($usuario, '@'), 1), 'nomeRemetente' => $nomeRemetente, 'nomeDestinatario' => $nomeDestinatario, 'resposta' => $resposta, 'assunto' => $assunto, 'mensagem' => $dados['me3']);

ini_set('php_flag mail_filter', 0);

$conexao = fsockopen($dados['email']['servidor'], 587, $errno, $errstr, 10);
fgets($conexao, 512);

$dados['destinatarios'] = explode(',', $destinatarios);

foreach ($dados['destinatarios'] as $dados['1'])

{

$dados['destinatarios']['RCPTTO'][] = '< '.$dados['1'].' >';
$dados['destinatarios']['TO'][] = $dados['1'];

}

$dados['cabecalho'] = array('EHLO ' => $dados['email']['servidor'], 'AUTH LOGIN', base64_encode($dados['email']['usuario']), base64_encode($dados['email']['senha']), 'MAIL FROM: ' => '< '.$dados['email']['usuario'].' >', 'RCPT TO:' => $dados['destinatarios']['RCPTTO'], 'DATA', 'MIME-Version: ' => '1.0', 'Content-Type: text/html; charset=iso-8859-1', 'Date: ' => date('r',time()), 'From: ' => array($dados['email']['nomeRemetente'].' ' => '< '.$dados['email']['usuario'].' >'), 'To:' => array($dados['email']['nomeDestinatario'].' ' => $dados['destinatarios']['TO']), 'Reply-To: ' => $dados['email']['resposta'],'Subject: ' => $dados['email']['assunto'], 'mensagem' => $dados['email']['mensagem'], 'QUIT');

foreach ($dados['cabecalho'] as $dados['2'] => $dados['3'])

{

if (is_array($dados['3']))

{

foreach ($dados['3'] as $dados['4'] => $dados['5'])

{

$dados['4'] = empty($dados['4']) ? '' : $dados['4'];
$dados['5'] = empty($dados['5']) ? '' : $dados['5'];

$dados['4'] = is_numeric($dados['4']) ? '' : $dados['4'];

if (is_array($dados['5']))

{

$dados['5'] = "< ".implode(', ', $dados['5'])." >";

}

fwrite($conexao, $dados['2'].$dados['4'].$dados['5']."\r\n", 512).'<br>';
fgets($conexao, 512);

}

}

else

{

$dados['2'] = empty($dados['2']) ? '' : $dados['2'];
$dados['3'] = empty($dados['3']) ? '' : $dados['3'];

$dados['2'] = is_numeric($dados['2']) ? '' : $dados['2'];

if ($dados['2'] == 'Subject: ')

{

fwrite($conexao, $dados['2'].$dados['3']."\r\n", 512).'<br>';
fwrite($conexao, "\r\n", 512).'<br>';
fgets($conexao, 512);

}

elseif ($dados['2'] == 'mensagem')

{

fwrite($conexao, $dados['3']."\r\n.\r\n").'<br>';
fgets($conexao);

}

else

{

fwrite($conexao, $dados['2'].$dados['3']."\r\n", 512).'<br>';
fgets($conexao, 512);

}

}

}

fclose($conexao);

}

?>
<!-- COMEÇA AQUI O FORMULARIO EM HTML -->
<!-- MAIS CAMPOS PODEM SER INSERIDOS NORMALMENTE ENTRE A TAG FORM -->
<html>
<head>
<title>Formulário de Contato</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<form method="post" action="">
<table width="401" bgcolor="#cccccc" border="1" cellspacing="0" cellpadding="0" align="center">
<tr>
<h1 align="center">
Formulario de teste
</h1>
<h5 align="center">
(smtp autenticado)
</h5>
<?php

if (isset($_POST['enviar']))

{

print "<h4 align=\"center\">A mensagem foi enviada!!!</h4>";

}

?>
</tr>
<tr>
<td valign="middle" nowrap>
<p>
<font color="#000">Nome:</font></p>
</td>
<td width="301">
<input type="text" name="nomeRemetente" size="34">
</td>
</tr>
<tr>
<td valign="middle" nowrap>
<p>
<font color="#000">E-mail:</font></p>
</td>
<td>
<input type="text" name="email" size="34">
</td>
</tr>
<tr>
<td valign="middle" nowrap>
<p><font color="#000">Assunto:</font></p>
</td>
<td>
<select name="assunto">
<option value="opnião" selected>opnião</option>
<option value="sugestão">sugestão</option>
<option value="parceria">Parceria</option>
<option value="outros">Outros</option>
</select>
</td>
</tr>
<tr>
<td valign="middle" nowrap align="center">
<p><font color="#000">Mensagem:</font></p>
</td>
<td>
<textarea name="mensagem" cols="34" rows="4"></textarea>
</td>
</tr>
<tr>
<td colspan="2" valign="middle">
<br>
<div align="center">
<input type="submit" name="enviar" value="enviar">
<input type="reset" name="limpar" value="limpar">
</div>
</td>
</tr>
</table>
</form>
</body>
</html>
<!-- TERMINA AQUI O FORMULARIO EM HTML -->