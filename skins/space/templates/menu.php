<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
        <?php foreach ($this->data['menuBlocks'] as $blockName => $menuBlock): ?>
        <?php if ($blockName == 'vulnerabilities'): ?>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Vulnerabilities <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <?php foreach ($menuBlock as $menuItem): ?>
                <li class="<?= $menuItem['selected'] ? 'active' : '' ?>">
                    <a href="<?= $this->data['root'].$menuItem['url'] ?>">
                        <?= $menuItem['name'] ?>
                    </a>
                </li>
                <?php endforeach ?>
            </ul>
        </li>
        <?php else: ?>
        <?php foreach ($menuBlock as $menuItem): ?>
        <li class="<?= $menuItem['selected'] ? 'active' : '' ?>">
            <a href="<?= $this->data['root'].$menuItem['url'] ?>">
                <?= $menuItem['name'] ?>
            </a>
        </li>
        <?php endforeach ?>
        <?php endif ?>
        <?php endforeach ?>
    </ul>
</div>
