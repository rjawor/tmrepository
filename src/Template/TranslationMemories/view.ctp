<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li>
            <a href="/tmrepository/translation-memories/add" title="Upload a new translation memory">
                <img src="/tmrepository/img/add.png" />
                &nbsp;New
            </a>
        </li>
        <li>
            <a href="/tmrepository/translation-memories/edit/<?= $translationMemory->id ?>" title="Edit translation memory info">
                <img src="/tmrepository/img/edit.png" />
                &nbsp;Edit
            </a>
        </li>
        <li>
            <a href="/tmrepository/translation-memories/expand/<?= $translationMemory->id ?>" title="Expand translation memory with new units">
                <img src="/tmrepository/img/expand.png" />
                &nbsp;Expand
            </a>
        </li>
        <li>
            <form name="post_58160c91e224b739866322" style="display:none;" method="post"                    action="/tmrepository/translation-memories/delete/<?= $translationMemory->id ?>"><input type="hidden" name="_method" value="POST"></form>
            <a href="#" title="Delete translation memory" onclick="if (confirm(&quot;Are you sure you want to delete this translation memory?&quot;)) { document.post_58160c91e224b739866322.submit(); } event.returnValue = false; return false;"><img src="/tmrepository/img/delete.png" />&nbsp;&nbsp;Delete</a>
        </li>
        <li>
            <a href="/tmrepository/translation-memories/export/<?= $translationMemory->id ?>" title="Export translation memory">
                <img src="/tmrepository/img/export.png" />
                &nbsp;Export
            </a>
        </li>
        <li>
            <a href="/tmrepository/translation-memories/index" title="Back to my translation memories">
                <img src="/tmrepository/img/list.png" />
                &nbsp;List
            </a>
        </li>
    </ul>
</nav>
<div class="translationMemories view large-9 medium-8 columns content">
    <h3><?= h($translationMemory->title) ?></h3>
    <p>
    <?= h($translationMemory->description) ?>
    </p>
    <table>
		<tr>
 	  		<th scope="col">Source segment</th>
 	  		<th scope="col">Target segment</th>
 	  	</tr>
		<?php foreach ($units as $unit): ?>
		<tr>
			<td><?= h($unit->source_segment) ?></td>
			<td><?= h($unit->target_segment) ?></td>
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
