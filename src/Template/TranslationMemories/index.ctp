<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li>
            <a href="/tmrepository/translation-memories/add" title="Upload a new translation memory">
                <img src="/tmrepository/img/add.png" />
                &nbsp;New
            </a>
        </li>
    </ul>
</nav>
<div class="translationMemories index large-9 medium-8 columns content">
    <h3><?= __('My translation memories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col" width="50px">Id</th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tm_type_id') ?></th>
                <th scope="col" width="70px">Units</th>
                <th scope="col">Direction</th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($translationMemories as $translationMemory): ?>
            <tr>
                <td><?= $translationMemory->id ?></td>
                <td><?= $this->Html->link($translationMemory->title, ['action' => 'view', $translationMemory->id]) ?></td>
                <td><?= $translationMemory->tm_type->name ?></td>
                <td><?= isset($unitCounts[$translationMemory->id])?$unitCounts[$translationMemory->id]:0 ?></td>
                <td><?= $translationMemory->source_language->name ?>&nbsp;&rarr;&nbsp;<?= $translationMemory->target_language->name ?></td>
                <td class="actions">
                    <a href="/tmrepository/translation-memories/view/<?= $translationMemory->id ?>" title="View translation memory"><img src="/tmrepository/img/view.png" /></a>
                    <a href="/tmrepository/translation-memories/edit/<?= $translationMemory->id ?>" title="Edit translation memory info"><img src="/tmrepository/img/edit.png" /></a>

                    <form name="post_delete_<?= $translationMemory->id ?>" style="display:none;" method="post" action="/tmrepository/translation-memories/delete/<?= $translationMemory->id ?>"><input type="hidden" name="_method" value="POST"></form>
                    <a href="#" title="Delete translation memory" onclick="if (confirm(&quot;Are you sure you want to delete this translation memory?&quot;)) { document.post_delete_<?= $translationMemory->id ?>.submit(); } event.returnValue = false; return false;"><img src="/tmrepository/img/delete.png"/></a>

                    <a href="/tmrepository/translation-memories/export/<?= $translationMemory->id ?>" title="Export translation memory"><img src="/tmrepository/img/export.png" /></a>
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
