<?php foreach ($this->data['menuBlocks'] as $menuBlock): ?>
<ul class="menuBlocks">
    <?php foreach ($menuBlock as $menuItem): ?>
    <li onclick="window.location='<?= $this->data['root'].$menuItem['url'] ?>'"
        class="<?= $menuItem['selected'] ? 'selected' : '' ?>">
        <a href="<?= $this->data['root'].$menuItem['url'] ?>"><?= $menuItem['name'] ?></a>
    </li>
    <?php endforeach ?>
</ul>
<?php endforeach ?>