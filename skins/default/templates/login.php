<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <title>Login :: Damn Vulnerable Web Application (DVWA) v<?= $this->data['dvwaVersion'] ?></title>
  <link rel="stylesheet" type="text/css" href="<?= $this->data['root'] ?>dvwa/css/login.css"/>
</head>

<body>
<div id="wrapper">
  <div id="header">
    <br/>
    <p><img src="<?= $this->data['templateRoot'] ?>images/login_logo.png"/></p>
    <br/>
  </div>

  <div id="content">
    <form action="login.php" method="post">
      <fieldset>
        <label for="user">Username</label> <input type="text" class="loginInput" size="20" name="username"><br/>
        <label for="pass">Password</label> <input type="password" class="loginInput" AUTOCOMPLETE="off"
                                                  size="20" name="password"><br/>
        <br/>
        <p class="submit"><input type="submit" value="Login" name="Login"></p>
      </fieldset>

      <?= $this->data['tokenField'] ?>

    </form>
    <br/>
    <?= $this->insert('sections/messages', $this->data) ?>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
  </div>

  <div id="footer">
    <p><?= $this->externalLink('http://www.dvwa.co.uk/', 'Damn Vulnerable Web Application (DVWA)') ?> is a
      RandomStorm OpenSource project.</p>
  </div>

</div>
</body>
</html>
