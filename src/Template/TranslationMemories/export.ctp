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
            <a href="/tmrepository/translation-memories/view/<?= $translationMemory->id ?>" title="View this translation memory">
                <img src="/tmrepository/img/view.png" />
                &nbsp;View
            </a>
        </li>
        <li>
            <a href="/tmrepository/translation-memories/edit/<?= $translationMemory->id ?>" title="Edit translation memory info">
                <img src="/tmrepository/img/edit.png" />
                &nbsp;Edit
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
    <h3>Export units</h3>
    <p>
    Chosen translation memory: <b><?= $translationMemory->title ?> (id = <?= $translationMemory->id ?>)</b>
    </p>
    <?= $this->Form->create($translationMemory) ?>
    <?= $this->Form->radio(
							'export_format',
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
