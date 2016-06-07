<?php if ($this->data['page']['help_button']): ?>
    <?php $popUpUrl = $this->data['root'] .
        'vulnerabilities/view_help.php?id=' .
        $this->data['page']['help_button'] .
        '&security=' . $this->data['securityLevel'] ?>

    <input type="button" value="View Help" class="popup_button"
           onClick="javascript:popUp('<?= $popUpUrl ?>')">
<?php endif ?>

<?php if ($this->data['page']['source_button']): ?>
    <?php $popUpUrl = $this->data['root'] .
        'vulnerabilities/view_source.php?id=' .
        $this->data['page']['source_button'] .
        '&security=' . $this->data['securityLevel'] ?>

    <input type="button" value="View Source" class="popup_button"
           onClick="javascript:popUp('<?= $popUpUrl ?>')">
<?php endif ?>

