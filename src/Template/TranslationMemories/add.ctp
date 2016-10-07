<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Translation Memories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Languages'), ['controller' => 'Languages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Language'), ['controller' => 'Languages', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tm Types'), ['controller' => 'TmTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tm Type'), ['controller' => 'TmTypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="translationMemories form large-9 medium-8 columns content">
    <?= $this->Form->create($translationMemory) ?>
    <fieldset>
        <legend><?= __('Add Translation Memory') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('description');
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('source_language_id');
            echo $this->Form->input('target_language_id', ['options' => $languages]);
            echo $this->Form->input('tm_type_id', ['options' => $tmTypes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
