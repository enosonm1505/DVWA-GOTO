<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?= $this->data['title'] ?></title>

    <link href="<?= $this->data['templateRoot'] ?>external/flat-ui/dist/css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $this->data['templateRoot'] ?>external/flat-ui/dist/css/flat-ui.min.css" rel="stylesheet">

    <script src="<?= $this->data['templateRoot'] ?>external/flat-ui/dist/js/vendor/html5shiv.js"></script>
    <script src="<?= $this->data['templateRoot'] ?>external/flat-ui/dist/js/vendor/respond.min.js"></script>
    <script type="text/javascript" src="<?= $this->data['templateRoot'] ?>../default/js/dvwaPage.js"></script>

    <link rel="stylesheet" type="text/css" href="<?= $this->data['templateRoot'] ?>css/main.css" />
    <link rel="icon" type="image/ico" href="<?= $this->data['root'] ?>favicon.ico" />
</head>
<body class="home">
    <div class="space-container">

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        <!--<img src="<?= $this->data['root'] ?>dvwa/images/logo.png" alt="Damn Vulnerable Web Application" />-->
                        SPACE HACKERS
                    </a>
                </div>
                <?= $this->insert('sections/menu', $this->data) ?>
            </div>
        </nav>
    
        <div class="content-container">

            <?= $this->section('content') ?>
            <br /><br />
            <?= $this->insert('default::sections/messages', $this->data) ?>
    
        </div>
    
        <div class="clear">
        </div>
    
        <div id="system_info">
            <?= $this->insert('default::sections/system_info', $this->data) ?>
        </div>
    
        <div id="footer">
    
            <p>Damn Vulnerable Web Application (DVWA) v<?= $this->data['version'] ?></p>
    
        </div>
    
    </div>
    <script src="<?= $this->data['templateRoot'] ?>external/flat-ui/dist/js/vendor/jquery.min.js"></script>
    <script src="<?= $this->data['templateRoot'] ?>external/flat-ui/dist/js/vendor/video.js"></script>
    <script src="<?= $this->data['templateRoot'] ?>external/flat-ui/dist/js/flat-ui.min.js"></script
</body>
</html>