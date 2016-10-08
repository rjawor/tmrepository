<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Unit'), ['action' => 'edit', $unit->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Unit'), ['action' => 'delete', $unit->id], ['confirm' => __('Are you sure you want to delete # {0}?', $unit->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Units'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Unit'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Translation Memories'), ['controller' => 'TranslationMemories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Translation Memory'), ['controller' => 'TranslationMemories', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="units view large-9 medium-8 columns content">
    <h3><?= h($unit->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Translation Memory') ?></th>
            <td><?= $unit->has('translation_memory') ? $this->Html->link($unit->translation_memory->title, ['controller' => 'TranslationMemories', 'action' => 'view', $unit->translation_memory->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($unit->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Source Segment') ?></h4>
        <?= $this->Text->autoParagraph(h($unit->source_segment)); ?>
    </div>
    <div class="row">
        <h4><?= __('Target Segment') ?></h4>
        <?= $this->Text->autoParagraph(h($unit->target_segment)); ?>
    </div>
</div>
