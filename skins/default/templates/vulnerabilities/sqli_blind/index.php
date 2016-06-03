<?php $this->layout($this->data['themeName'].'/templates/base', $this->data) ?>
<div class="body_padded">
    <h1>Vulnerability: SQL Injection (Blind)</h1>

    <?php if ($this->data['magicQuotesEnabled']): ?>
    <div class="warning">The PHP function "<em>Magic Quotes</em>" is enabled.</div>
    <?php endif ?>
    
    <?php if ($this->data['safeModeEnabled']): ?>
    <div class="warning">The PHP function "<em>Safe mode</em>" is enabled.</div>
    <?php endif ?>

    <div class="vulnerable_code_area">
        <?php if ($this->data['vulnerabilityFile'] == 'high.php'): ?>
        Click <a href="#" onClick="javascript:popUp('cookie-input.php');return false;">here to change your ID</a>.
            
        <?php else: ?>
            
        <form action="#" method="<?= $this->data['method'] ?>">
            <p>
                User ID:
                <?php if ($this->data['vulnerabilityFile'] == 'medium.php'): ?>
                <select name="id">
                    <?php foreach ($this->data['options'] as $i): ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                    <?php endforeach ?>
                </select>
                <?php else: ?>
                <input type="text" size="15" name="id">
                <?php endif ?>
                <input type="submit" name="Submit" value="Submit">
            </p>

            <?php if ($this->data['vulnerabilityFile'] == 'impossible.php'): ?>
            <?= $this->data['tokenField'] ?>
            <?php endif ?>
        </form>
        <?php endif ?>
        
        <?= $this->data['html'] ?>
    </div>

    <h2>More Information</h2>
    <ul>
        <li><?= $this->externalLink('http://www.securiteam.com/securityreviews/5DP0N1P76E.html') ?></li>
        <li><?= $this->externalLink('https://en.wikipedia.org/wiki/SQL_injection') ?></li>
        <li><?= $this->externalLink('http://ferruh.mavituna.com/sql-injection-cheatsheet-oku/') ?></li>
        <li><?= $this->externalLink('http://pentestmonkey.net/cheat-sheet/sql-injection/mysql-sql-injection-cheat-sheet') ?></li>
        <li><?= $this->externalLink('https://www.owasp.org/index.php/Blind_SQL_Injection') ?></li>
        <li><?= $this->externalLink('http://bobby-tables.com/') ?></li>
    </ul>
</div>