<?php
ob_start();
?>
<div class="login-page">
  <div class="form">
    <form class="register-form" action="/register" method="post">
        <h2>S'inscrire</h2>
        <p class="error" ><?=$msg ?? ''?></p>
      <input type="text" name="username" placeholder="Username"/>
      <input type="email" name="email" placeholder="Email"/>
      <input type="password" name="password" placeholder="Password"/>
      <button>S'inscrire</button>
      <p class="message">Vous avez un compte ? <a href="/login">Connexion</a></p>
    </form>
  </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include __DIR__."/../layout.php" ?>