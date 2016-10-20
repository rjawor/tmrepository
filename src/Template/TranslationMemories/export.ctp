<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('View translation memory'), ['action' => 'view', $translationMemory->id]) ?> </li>
        <li><?= $this->Html->link(__('Edit translation memory info'), ['action' => 'edit', $translationMemory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete translation memory'), ['action' => 'delete', $translationMemory->id], ['confirm' => 'Are you sure you want to delete this translation memory?']) ?> </li>
        <li><?= $this->Html->link(__('Upload a new translation memory'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Back to my translation memories'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="translationMemories view large-9 medium-8 columns content">
    <h3>Export units</h3>
    <p>
    Chosen translation memory: <b><?= $translationMemory->title ?> (id = <?= $translationMemory->id ?>)</b>
    </p>
    <?= $this->Form->create($translationMemory) ?>
    <?= $this->Form->radio(
							'export_type', 
							[
								['value' => 'txt', 'text' => 'TXT - a pair of zipped .txt files. One sentence - one line.'],
								['value' => 'tmx', 'text' => 'TMX - a Translation Memory eXchange file.'],
							],
							[ 'value' => 'txt']
						);
    ?>
    <?= $this->Form->button(__('Export')) ?>
    <?= $this->Form->end() ?>


</div>
