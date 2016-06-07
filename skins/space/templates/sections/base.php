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

    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300,100' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="<?= $this->data['templateRoot'] ?>css/main.css" />
    <link rel="icon" type="image/ico" href="/favicon.ico" />
</head>
<body class="home">
    <div class="space-container">

        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        <!--<img src="<?= $this->data['templateRoot'] ?>../default/images/logo.png" alt="Damn Vulnerable Web Application">-->
                        GOTO COMPETITION
                    </a>
                </div>
                <?= $this->insert('sections/menu', $this->data) ?>
            </div>
        </nav>

        <main>
            <div class="spaceship">
                <img src="<?= $this->data['templateRoot'] ?>images/spaceship.png">
            </div>

            <div class="astronaut">
                <img src="<?= $this->data['templateRoot'] ?>images/astronaut.png">
            </div>

            <div class="planet-1">
                <img src="<?= $this->data['templateRoot'] ?>images/planet-1.png">
            </div>

            <div class="planet-2">
                <img src="<?= $this->data['templateRoot'] ?>images/planet-2.png">
            </div>

            <?= $this->section('content') ?>
            <br /><br />
            <?= $this->insert('default::sections/messages', $this->data) ?>
    
            <div class="info">
                <?= $this->insert('sections/page_buttons', $this->data) ?>
            </div>
            
        </main>

        <footer>
            <div class="inner-container container-fluid">
                <?= $this->insert('sections/system_info', $this->data) ?>

                <div class="row">
                    <div class="col-md-12 text-center">
                        <small>Damn Vulnerable Web Application (DVWA) v<?= $this->data['version'] ?></small>
                    </div>
                </div>
            </div>
        </footer>
    
    </div>
    <script src="<?= $this->data['templateRoot'] ?>external/flat-ui/dist/js/vendor/jquery.min.js"></script>
    <script src="<?= $this->data['templateRoot'] ?>external/flat-ui/dist/js/vendor/video.js"></script>
    <script src="<?= $this->data['templateRoot'] ?>external/flat-ui/dist/js/flat-ui.min.js"></script
</body>
</html>