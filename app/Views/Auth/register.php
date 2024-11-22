<?php
ob_start();
?>
<div class="login-page">
  <div class="form">
    <form class="register-form" action="" method="post">
        <h2>S'inscrire</h2>
      <input type="text" name="username" placeholder="Username"/>
      <input type="email" name="email" placeholder="Email"/>
      <input type="password" name="password" placeholder="Password"/>
      <input type="password" name="confirm_password" placeholder="Confirm password"/>
      <button>S'inscrire</button>
      <p class="message">Vous avez un compte ? <a href="/login">Connexion</a></p>
    </form>
  </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include __DIR__."/../layout.php" ?>