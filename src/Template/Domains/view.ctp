<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Domain'), ['action' => 'edit', $domain->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Domain'), ['action' => 'delete', $domain->id], ['confirm' => __('Are you sure you want to delete # {0}?', $domain->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Domains'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Domain'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Translation Memories'), ['controller' => 'TranslationMemories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Translation Memory'), ['controller' => 'TranslationMemories', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="domains view large-9 medium-8 columns content">
    <h3><?= h($domain->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($domain->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($domain->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Translation Memories') ?></h4>
        <?php if (!empty($domain->translation_memories)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Source Language Id') ?></th>
                <th scope="col"><?= __('Target Language Id') ?></th>
                <th scope="col"><?= __('Tm Type Id') ?></th>
                <th scope="col"><?= __('Domain Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($domain->translation_memories as $translationMemories): ?>
            <tr>
                <td><?= h($translationMemories->id) ?></td>
                <td><?= h($translationMemories->title) ?></td>
                <td><?= h($translationMemories->description) ?></td>
                <td><?= h($translationMemories->user_id) ?></td>
                <td><?= h($translationMemories->source_language_id) ?></td>
                <td><?= h($translationMemories->target_language_id) ?></td>
                <td><?= h($translationMemories->tm_type_id) ?></td>
                <td><?= h($translationMemories->domain_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TranslationMemories', 'action' => 'view', $translationMemories->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TranslationMemories', 'action' => 'edit', $translationMemories->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TranslationMemories', 'action' => 'delete', $translationMemories->id], ['confirm' => __('Are you sure you want to delete # {0}?', $translationMemories->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
