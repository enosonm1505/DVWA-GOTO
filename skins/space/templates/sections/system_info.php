<?php if ($this->data['userLoggedIn']): ?>
<div class="row">
    <div class="col-md-4 text-center">
        <h6><b>Username:</b> <?= $this->data['userInfo'] ?></h6>
    </div>
    <div class="col-md-4 text-center">
        <h6><b>Security Level:</b> <?= $this->data['securityLevel'] ?></h6>
    </div>
    <div class="col-md-4 text-center">
        <h6><b>PHPIDS:</b> <?= ($this->data['phpIdsEnabled'] ? 'enabled' : 'disabled') ?></h6>
    </div>
</div>
<?php endif ?>