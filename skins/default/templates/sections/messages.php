<?php if ($this->data['messages']): ?>
<div class="body_padded">
    <?php foreach ($this->data['messages'] as $message): ?>
    <div class="message"><?= $message ?></div>
    <?php endforeach ?>
</div>
<?php endif ?>
