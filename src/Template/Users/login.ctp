<div class="users form">
<?= $this->Flash->render('auth') ?>
<?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please input the username and password.') ?></legend>
        <?= $this->Form->input('username', ['label' => 'Username']) ?>
        <?= $this->Form->input('password', ['label' => 'Password']) ?>
    </fieldset>
<?= $this->Form->button(__('Login')); ?>
<?= $this->Form->end() ?>
</div>
