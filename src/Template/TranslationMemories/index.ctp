<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Upload Translation Memory'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="translationMemories index large-9 medium-8 columns content">
    <h3><?= __('My translation memories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tm_type_id') ?></th>
                <th scope="col">Unit count</th>                
                <th scope="col">Description</th>
                <th scope="col">Direction</th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($translationMemories as $translationMemory): ?>
            <tr>
                <td><?= $this->Html->link($translationMemory->title, ['action' => 'view', $translationMemory->id]) ?></td>
                <td><?= $translationMemory->tm_type->name ?></td>
                <td><?= $unitCounts[$translationMemory->id] ?></td>
                <td><?= $translationMemory->description ?></td>
                <td><?= $translationMemory->source_language->name ?>&nbsp;&rarr;&nbsp;<?= $translationMemory->target_language->name ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit info'), ['action' => 'edit', $translationMemory->id]) ?>&nbsp;&nbsp;
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
