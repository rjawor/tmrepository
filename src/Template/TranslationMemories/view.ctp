<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit translation memory info'), ['action' => 'edit', $translationMemory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete translation memory'), ['action' => 'delete', $translationMemory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $translationMemory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List my translation memories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Upload translation memory'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="translationMemories view large-9 medium-8 columns content">
    <h3><?= h($translationMemory->title) ?></h3>
	<pre>
	<?php print_r($units); ?>
	</pre>
</div>
