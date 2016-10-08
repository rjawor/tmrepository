<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit translation memory info'), ['action' => 'edit', $translationMemory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete translation memory'), ['action' => 'delete', $translationMemory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $translationMemory->id)]) ?> </li>
        <li><?= $this->Html->link(__('Upload translation memory'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Back to my translation memories'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="translationMemories view large-9 medium-8 columns content">
    <h3><?= h($translationMemory->title) ?></h3>
    <table>
		<tr>
 	  		<th scope="col">Source segment</th>
 	  		<th scope="col">Target segment</th>
 	  	</tr>
		<?php foreach ($units as $unit): ?>
		<tr>
			<td><?= $unit->source_segment ?></td>
			<td><?= $unit->target_segment ?></td>
		</tr>
		<?php endforeach; ?>
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
