<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('View translation memory'), ['action' => 'view', $translationMemory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete translation memory'), ['action' => 'delete', $translationMemory->id], ['confirm' => 'Are you sure you want to delete this translation memory?']) ?> </li>
        <li><?= $this->Html->link(__('Upload a new translation memory'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Back to my translation memories'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="translationMemories form large-9 medium-8 columns content">
    <?= $this->Form->create($translationMemory) ?>
    <fieldset>
        <legend><?= __('Edit Translation Memory') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('description');
            echo $this->Form->input('source_language_id', ['options' => $languages]);
            echo $this->Form->input('target_language_id', ['options' => $languages]);
            echo $this->Form->input('tm_type_id', ['options' => $tmTypes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
