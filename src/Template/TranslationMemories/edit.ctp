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
<div class="translationMemories form large-9 medium-8 columns content">
    <?= $this->Form->create($translationMemory) ?>
    <fieldset>
        <legend><?= __('Edit Translation Memory') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('description');
            echo $this->Form->input('source_language_id', ['options' => $languages]);
            echo $this->Form->input('target_language_id', ['options' => $languages]);
            echo $this->Form->input('tm_type_id', ['options' => $tmTypes]);
            echo $this->Form->input('domain_id', ['options' => $domains]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
