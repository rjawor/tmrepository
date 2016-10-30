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
    echo $this->Form->input('reversed', ['type' => 'checkbox', 'label' => 'Allow translation memories in the reversed direction' ]);
    ?>
    <h5>Filter translation memories by type</h5>
    <?php
    echo $this->Form->input('tm_types', ['label'=>'','multiple'=> 'checkbox', 'options' => $tmTypes, 'default' => [1, 2, 3, 4]]);
    ?>
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
