<?php
session_start();

include_once 'classes/Config.php';
include_once 'classes/Login.php';
include_once 'classes/Helper.php';

if(isset($_POST['txtLogin']) && isset($_POST['txtSenha'])){   
    
    $login = new Login();
    $mensagem = $login->Logar(addslashes($_POST['txtLogin']), addslashes($_POST['txtSenha']));             
    
    if($login->isSucesso()){        
        
        /* Define o limitador de cache para 'private' */
        session_cache_limiter('private');

        /* Define o limite de tempo do cache em 30 minutos */
        session_cache_expire(30);

        session_start();           
        $_SESSION['usuario'] = $login->getUserId();
        $_SESSION['usuario_nome'] = $login->getUserNome();
        $_SESSION['usuario_login'] = $login->getUserLogin();       
        $_SESSION['usuario_tipo'] = $login->getUserTipo();
        $_SESSION['usuario_semestre'] = $login->getUserSemestre();
        $_SESSION['exibir_msg'] = TRUE;
                         
        @header("location:index.php");     
    }    
}


?>
<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <title>Enchei-vos</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="">
      <meta name="author" content="">
      
      <!-- Le styles -->
      <link href="<?php echo Config::$UrlBase.'css/bootstrap-responsive.css' ?>" rel="stylesheet" />
      <link href="<?php echo Config::$UrlBase.'css/bootstrap.css' ?>" rel="stylesheet" />
      <link href="<?php echo Config::$UrlBase.'css/estilos.css' ?>" rel="stylesheet" type="text/css" />
      
      <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
      <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
    
<body>

<div class="boxLogin">
  <div class="topoBox">
    	<div class="logo"><img src="<?php echo Config::$UrlBase.'img/logo.jpg' ?>" width="208" height="64"></div>
        <div class="restrito">Acesso Restrito</div>
        <div class="cadeado"><img src="<?php echo Config::$UrlBase.'img/icone_cadeado.png' ?>" width="40" height="40"></div>
    </div>
    <div class="login">
        <form action="login.php" method="post">
            <label class="fontLogin">Login</label>
            <input type="text" name="txtLogin" class="span5" value="<?php if (isset($_POST['txtLogin'])) echo $_POST['txtLogin'] ;?>">
            <label class="fontLogin">Senha</label>
            <input type="password" name="txtSenha" class="span5">
        

            <input class="btn btn-primary btn-large " type="submit" value="Entrar »" />           
            </form>
        
            <?php 
                if(isset($mensagem) && $mensagem != ''){
                    
                    echo $mensagem;
                }
            ?>
        </div>
</div>
    
<script src="<?php echo Config::$UrlBase.'js/jquery.js ' ?>"></script>
<script src="<?php echo Config::$UrlBase.'js/bootstrap-transition.js' ?>"></script>
<script src="<?php echo Config::$UrlBase.'js/bootstrap-alert.js' ?>"></script>
<script src="<?php echo Config::$UrlBase.'js/bootstrap-modal.js' ?>"></script>
<script src="<?php echo Config::$UrlBase.'js/bootstrap-dropdown.js' ?>"></script>
<script src="<?php echo Config::$UrlBase.'js/bootstrap-scrollspy.js' ?>"></script>
<script src="<?php echo Config::$UrlBase.'js/bootstrap-tab.js' ?>"></script>
<script src="<?php echo Config::$UrlBase.'js/bootstrap-tooltip.js' ?>"></script>
<script src="<?php echo Config::$UrlBase.'js/bootstrap-popover.js' ?>"></script>
<script src="<?php echo Config::$UrlBase.'js/bootstrap-button.js' ?>"></script>
<script src="<?php echo Config::$UrlBase.'js/bootstrap-collapse.js' ?>"></script>
<script src="<?php echo Config::$UrlBase.'js/bootstrap-carousel.js' ?>"></script>
<script src="<?php echo Config::$UrlBase.'js/bootstrap-typeahead.js' ?>"></script>
    
</body>
</html>