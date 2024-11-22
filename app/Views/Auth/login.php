<?php
ob_start();
?>
<div class="login-page">
  <div class="form">
    <h2>Connexion</h2>
    <form class="login-form" action="" method="post">
      <input type="email" name="email" placeholder="Email"/>
      <input type="password" name="password" placeholder="Password"/>
      <button>Connexion</button>
      <p class="message">Vous n'avez pas de compte? <a href="/register">S'inscrire</a></p>
    </form>
  </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include __DIR__."/../layout.php" ?>