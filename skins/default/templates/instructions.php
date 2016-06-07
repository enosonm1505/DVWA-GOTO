<?php $this->layout('sections/base', $this->data) ?>

<div class="body_padded">
    <h1>Instructions</h1>

    <div class="submenu">
        <?php foreach (array_keys($this->data['docs']) as $docId): ?>
        <?php $selectedClass = ($docId == $this->data['selectedDocId']) ? ' selected' : ''; ?>
        <span class="submenu_item<?= $selectedClass ?>"><a href="?doc=<?= $docId ?>"><?= $this->data['docs'][$docId]['legend'] ?></a></span>
        <?php endforeach ?>
    </div>

	<span class="fixed">
		<?= $this->data['instructions'] ?>
	</span>
</div>