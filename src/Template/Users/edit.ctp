<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li>
            <a href="/tmrepository/users/changepassword/<?= $user['id'] ?>" title="Change password">
                <img src="/tmrepository/img/lock.png" />
                &nbsp;Change password
            </a>
        </li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->input('firstname', ['label'=>'First name']);
            echo $this->Form->input('lastname', ['label'=>'Last name']);
            echo $this->Form->input('email', ['label'=>'e-mail']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
