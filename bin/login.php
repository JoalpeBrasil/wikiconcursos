<?php
// (A) PROCESS LOGIN ON SUBMIT
session_start();
if (isset($_POST['email'])) {
  require "credencials-lib.php";

  if (isset($_POST['do_create'])) {
    $USR->save($_POST['email'], $_POST['password']);
  } else {
    $USR->login($_POST['email'], $_POST['password']);
  }
}
 
// (B) REDIRECT USER IF SIGNED IN
if (isset($_SESSION['user'])) {
  header("Location: index.php?contest=".$_GET['contest']."&page=triage");
  exit();
}
 
// (C) SHOW LOGIN FORM OTHERWISE 
if (isset($_POST['do_login'])) {
  echo "<script>alert('E-mail/senha inválidos');</script>";
} elseif (isset($_POST['do_create'])) {
  echo "<script>alert('Usuário registrado. Solicite autorização.');</script>";
}


//Coleta informações do concurso
require "data.php";
?>

<!DOCTYPE html>
<html>
 <title><?php echo $contest['name']; ?></title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="./bin/w3.css">
 <body>
  <header class=<?php echo("\"w3-container w3-".$contest['theme']."\"");?>>
   <h1> <?php echo $contest['name']; ?> </h1>
  </header>
  <div class="w3-container">
   <button 
   	onclick="document.getElementById('id01').style.display='block'" class="w3-button <?php echo("w3-".$contest['theme']);?> w3-large" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">Clique aqui para entrar</button>
   <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
     <div class="w3-center">
      <br>
      <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
      <svg width="240" height="240" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
       <path d="M7 18V17C7 14.2386 9.23858 12 12 12V12C14.7614 12 17 14.2386 17 17V18" stroke="currentColor" stroke-linecap="round" />
       <path d="M12 12C13.6569 12 15 10.6569 15 9C15 7.34315 13.6569 6 12 6C10.3431 6 9 7.34315 9 9C9 10.6569 10.3431 12 12 12Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
       <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" />
      </svg>
     </div>
     <form class="w3-container" id="login" method="post">
      <div class="w3-section">
       <label><b>E-mail</b></label>
       <input class="w3-input w3-border w3-margin-bottom" type="email" placeholder="Insira seu e-mail" name="email" required>
       <label><b>Senha</b></label>
       <input class="w3-input w3-border" type="password" placeholder="Insira sua senha" name="password" required>
       <button class="w3-button w3-block <?php echo("w3-".$contest['theme']);?> w3-section w3-padding" name="do_login" type="submit">Entrar </button>
      </div>
     </form>
     <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
      <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancelar</button>
      <button class="w3-right w3-button w3-blue" type="submit" form="login" name="do_create">Cadastrar</button>
     </div>
    </div>
   </div>
  </div>
 </body>
</html>