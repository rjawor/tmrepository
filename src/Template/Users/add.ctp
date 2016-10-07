<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('New user registration') ?></legend>
        <p><i>Obligatory fields are marked with an asterisk.</i></p>
        <?php
            echo $this->Form->input('username', ['maxlength'=>45, 'type'=>'text']);
            echo $this->Form->input('firstname', ['label'=>'First name']);
            echo $this->Form->input('lastname', ['label'=>'Last name']);
            echo $this->Form->input('email', ['label'=>'e-mail']);
            echo $this->Form->input('password');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Register')) ?>
    <?= $this->Form->end() ?>
</div>
