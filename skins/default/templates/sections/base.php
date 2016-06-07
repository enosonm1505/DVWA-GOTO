<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?= $this->data['title'] ?></title>

    <link rel="stylesheet" type="text/css" href="<?= $this->data['templateRoot'] ?>css/main.css" />
    <link rel="icon" type="image/ico" href="/favicon.ico" />

    <script type="text/javascript" src="<?= $this->data['templateRoot'] ?>js/dvwaPage.js"></script>
</head>
<body class="home">
    <div id="container">
    
        <div id="header">
    
            <img src="<?= $this->data['templateRoot'] ?>images/logo.png" alt="Damn Vulnerable Web Application" />
    
        </div>
    
        <div id="main_menu">
    
            <div id="main_menu_padded">
                <?= $this->insert('sections/menu', $this->data) ?>
            </div>
    
        </div>
    
        <div id="main_body">

            <?= $this->section('content') ?>
            <br /><br />
            <?= $this->insert('sections/messages', $this->data) ?>
    
        </div>
    
        <div class="clear">
        </div>
    
        <div id="system_info">
            <?= $this->insert('sections/system_info', $this->data) ?>
        </div>
    
        <div id="footer">
    
            <p>Damn Vulnerable Web Application (DVWA) v<?= $this->data['version'] ?></p>
    
        </div>
    
    </div>
</body>
</html>