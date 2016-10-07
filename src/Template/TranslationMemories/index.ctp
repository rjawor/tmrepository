<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Translation Memory'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Languages'), ['controller' => 'Languages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Language'), ['controller' => 'Languages', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tm Types'), ['controller' => 'TmTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tm Type'), ['controller' => 'TmTypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="translationMemories index large-9 medium-8 columns content">
    <h3><?= __('Translation Memories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('source_language_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('target_language_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tm_type_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($translationMemories as $translationMemory): ?>
            <tr>
                <td><?= $this->Number->format($translationMemory->id) ?></td>
                <td><?= $translationMemory->has('user') ? $this->Html->link($translationMemory->user->id, ['controller' => 'Users', 'action' => 'view', $translationMemory->user->id]) : '' ?></td>
                <td><?= $this->Number->format($translationMemory->source_language_id) ?></td>
                <td><?= $translationMemory->has('language') ? $this->Html->link($translationMemory->language->name, ['controller' => 'Languages', 'action' => 'view', $translationMemory->language->id]) : '' ?></td>
                <td><?= $translationMemory->has('tm_type') ? $this->Html->link($translationMemory->tm_type->name, ['controller' => 'TmTypes', 'action' => 'view', $translationMemory->tm_type->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $translationMemory->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $translationMemory->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $translationMemory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $translationMemory->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
