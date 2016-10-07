<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Change password') ?></legend>
        <?php
            echo $this->Form->input('newpassword', ['label'=>'New password', 'type' => 'password']);
            echo $this->Form->input('newpassword2', ['label'=>'Confirm new password', 'type' => 'password']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
