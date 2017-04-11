<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li>
            <a href="/tmrepository/domains/add" title="Create a new domain">
            <img src="/tmrepository/img/add.png" />
            &nbsp;New
            </a>
        </li>
    </ul>
</nav>
<div class="domains index large-9 medium-8 columns content">
    <h3><?= __('Domains') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($domains as $domain): ?>
            <tr>
                <td><?= $this->Number->format($domain->id) ?></td>
                <td><?= h($domain->name) ?></td>
                <td class="actions">
                    <a href="/tmrepository/domains/edit/<?= $domain->id ?>" title="Edit domain"><img src="/tmrepository/img/edit.png" /></a>

                    <form name="post_delete_<?= $domain->id ?>" style="display:none;" method="post" action="/tmrepository/domains/delete/<?= $domain->id ?>"><input type="hidden" name="_method" value="POST"></form>
                    <a href="#" title="Delete domain" onclick="if (confirm(&quot;Are you sure you want to delete this domain? Documents from this domain will have their domains set to (unspecified).&quot;)) { document.post_delete_<?= $domain->id ?>.submit(); } event.returnValue = false; return false;"><img src="/tmrepository/img/delete.png"/></a>
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
