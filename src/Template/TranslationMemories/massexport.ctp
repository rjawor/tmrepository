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
            <a href="/tmrepository/translation-memories/adminindex" title="Back to all translation memories">
                <img src="/tmrepository/img/list.png" />
                &nbsp;List
            </a>
        </li>
    </ul>
</nav>
<div class="translationMemories view large-9 medium-8 columns content">
    <h3>Export multiple translation memories</h3>
    <?= $this->Form->create() ?>
    <h5>Filter translation memories by direction</h5>
    <?php
    echo $this->Form->input('source_language_id', ['options' => $languages, 'default' => 1]);
    echo $this->Form->input('target_language_id', ['options' => $languages, 'default' => 2]);
    echo $this->Form->input('reversed', ['type' => 'checkbox', 'checked'=>true, 'label' => 'Allow translation memories in the reversed direction' ]);
    ?>
    <h5>Filter translation memories by type</h5>
    <div class="input select">
        <label for="tm_types"></label>
        <input type="hidden" name="tm_types" value=""/>
        <?php foreach (array_keys($tmTypes->toArray()) as $typeId) { ?>
        <div class="checkbox">
            <label for="tm_types-<?= $typeId ?>">
                <input type="checkbox" checked="checked" name="tm_types[]" value="<?= $typeId ?>" id="tm_types-<?= $typeId ?>"><?= $tmTypes->toArray()[$typeId]?>
            </label>
        </div>
        <?php }?>
    </div>
    <h5>Filter translation memories by domain</h5>
        <div class="input select">
            <label for="domains"></label>
            <input type="hidden" name="domains" value=""/>
            <?php foreach (array_keys($domains->toArray()) as $domainId) { ?>
            <div class="checkbox">
                <label for="domains-<?= $domainId ?>">
                    <input type="checkbox" checked="checked" name="domains[]" value="<?= $domainId ?>" id="domains-<?= $domainId ?>"><?= $domains->toArray()[$domainId]?>
                </label>
            </div>
            <?php }?>
        </div>

    <h5>Export format</h5>
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
