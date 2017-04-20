<?php

session_start();

include_once '../../entities/Participante.php';
include_once '../../data/ParticipanteDAO.php';
include_once '../../classes/Conexao.php';
include_once '../../classes/Mensagem.php';
include_once '../../classes/Config.php';

$participante = new Participante();
$participante->setId(addslashes($_POST['id']));
$participante->setNome(addslashes($_POST['nome']));
$participante->setCpfCnpj(addslashes($_POST['cpf_cnpj']));
$participante->setDataNasc(addslashes($_POST['data_nasc']));
$participante->setSexo(addslashes($_POST['sexo']));
$participante->setEndereco(addslashes($_POST['endereco']));
$participante->setBairro(addslashes($_POST['bairro']));
$participante->setCep(addslashes($_POST['cep']));
$participante->setNumero(addslashes($_POST['numero']));
$participante->setCidade(addslashes($_POST['cidade']));
$participante->setEstado(addslashes($_POST['estado']));
$participante->setComplemento(addslashes($_POST['complemento']));
$participante->setTelefone(addslashes($_POST['telefone']));
$participante->setCelular1(addslashes($_POST['celular1']));
$participante->setCelular2(addslashes($_POST['celular2']));
$participante->setCelular3(addslashes($_POST['celular3']));
$participante->setEmail1(addslashes($_POST['email1']));
$participante->setEmail2(addslashes($_POST['email2']));
$participante->setNomeMae(addslashes($_POST['nome_mae_responsavel']));
$participante->setNomePai(addslashes($_POST['nome_pai_responsavel']));
$participante->setEstadoCivil(addslashes($_POST['estado_civil']));
$participante->setNomeConjugue(addslashes($_POST['nome_conjuge']));
$participante->setProfissao(addslashes($_POST['profissao']));
$participante->setInstituicaoNome(addslashes($_POST['instituicao_nome']));
$participante->setInstituicaoEndereco(addslashes($_POST['instituicao_endereco']));
$participante->setInstituicaoNumero(addslashes($_POST['instituicao_numero']));
$participante->setInstituicaoBairro(addslashes($_POST['instituicao_bairro']));
$participante->setInstituicaoCep(addslashes($_POST['instituicao_cep']));
$participante->setInstituicaoCidade(addslashes($_POST['instituicao_cidade']));
$participante->setInstituicaoEstado(addslashes($_POST['instituicao_estado']));
$participante->setInfoSacramento(addslashes($_POST['info_sacramento']));
$participante->setSetor(addslashes($_POST['setor']));
$participante->setVeiculo(addslashes($_POST['veiculo']));
$participante->setObservacoes(addslashes($_POST['observacoes']));
$participante->setSemestre($_SESSION['usuario_semestre']);
$participante->setDetentor($_SESSION['usuario']);

$dataAcessObject = new ParticipanteDAO();

$dataAcessObject->Salvar($participante);
?>

