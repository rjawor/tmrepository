<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Translation Memory'), ['action' => 'edit', $translationMemory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Translation Memory'), ['action' => 'delete', $translationMemory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $translationMemory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Translation Memories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Translation Memory'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Languages'), ['controller' => 'Languages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Language'), ['controller' => 'Languages', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tm Types'), ['controller' => 'TmTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tm Type'), ['controller' => 'TmTypes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="translationMemories view large-9 medium-8 columns content">
    <h3><?= h($translationMemory->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $translationMemory->has('user') ? $this->Html->link($translationMemory->user->id, ['controller' => 'Users', 'action' => 'view', $translationMemory->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Language') ?></th>
            <td><?= $translationMemory->has('language') ? $this->Html->link($translationMemory->language->name, ['controller' => 'Languages', 'action' => 'view', $translationMemory->language->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tm Type') ?></th>
            <td><?= $translationMemory->has('tm_type') ? $this->Html->link($translationMemory->tm_type->name, ['controller' => 'TmTypes', 'action' => 'view', $translationMemory->tm_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($translationMemory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Source Language Id') ?></th>
            <td><?= $this->Number->format($translationMemory->source_language_id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Title') ?></h4>
        <?= $this->Text->autoParagraph(h($translationMemory->title)); ?>
    </div>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($translationMemory->description)); ?>
    </div>
</div>
