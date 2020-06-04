
<form action="<?php echo url("registratie.verwerk")?>" method="POST">
  <div class="container">
    <h1>Registreren</h1>
    <p>Vul uw gegevens in om uzelf te registreren</p>
    <hr>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Vul uw email in" name="email" id="email" value="<?php echo input('email')?>" required>
    <?php if ( isset( $errors['email'] ) ): ?>
    <?php echo $errors['email'] ?>
    <?php endif; ?>  

    <label for="ww"><b>Wachtwoord</b></label>
    <input type="password" placeholder="Wachtwoord invullen" name="wachtwoord" id="ww" required>
    <?php if ( isset( $errors['wachtwoord'] ) ): ?>
    <?php echo $errors['wachtwoord'] ?>
    <?php endif; ?>  


    <button type="submit" class="registerbtn">Registreren</button>
  </div>
  