<?php $this->layout($this->data['themeName'].'/templates/vulnerabilities/fi/index', $this->data) ?>
<div class="body_padded">
    <h1>Vulnerability: File Inclusion</h1>
    <div class="vulnerable_code_area">
        <h3>File 3</h3>
        <hr />
        Welcome back <em><?= $this->data['currentUser'] ?></em><br />
        Your IP address is: <em><?= $this->data['forwardedFor'] ?></em><br />
        Your user-agent address is: <em><?= $this->data['userAgent'] ?></em><br />
        You came form: <em><?= $this->data['referer'] ?></em><br />
        I'm hosted at: <em><?= $this->data['host'] ?></em><br /><br />
        [<em><a href="?page=include.php">back</a></em>]
    </div>

    <h2>More info</h2>
    <ul>
        <li><?= $this->externalLink('https://en.wikipedia.org/wiki/Remote_File_Inclusion') ?></li>
        <li><?= $this->externalLink('https://www.owasp.org/index.php/Top_10_2007-A3') ?></li>
    </ul>
</div>