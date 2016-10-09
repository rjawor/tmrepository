<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List my translation memories'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="translationMemories form large-9 medium-8 columns content">
    <?= $this->Form->create($translationMemory) ?>
    <fieldset>
        <legend><?= __('Upload a new translation memory') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('description');
            echo $this->Form->input('source_language_id', ['options' => $languages, 'default' => 1]);
            echo $this->Form->input('target_language_id', ['options' => $languages, 'default' => 2]);
            echo $this->Form->input('tm_type_id', ['options' => $tmTypes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Upload')) ?>
    <?= $this->Form->end() ?>
</div>
