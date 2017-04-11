<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li>
            <a href="/tmrepository/translation-memories/index" title="Back to my translation memories">
                <img src="/tmrepository/img/list.png" />
                &nbsp;List
            </a>
        </li>
    </ul>
</nav>
<div class="translationMemories form large-9 medium-8 columns content">
    <?= $this->Form->create($translationMemory, ['type' => 'file']) ?>
    <input type="hidden" name="id" value="<?= $translationMemory->id ?>" />
    <input type="hidden" name="source_language_id" value="<?= $translationMemory->source_language_id ?>" />
    <input type="hidden" name="target_language_id" value="<?= $translationMemory->target_language_id ?>" />
    <fieldset>
        <legend><?= __('Expand the translation memory') ?>: <?=$translationMemory->title ?></legend>
        <label for="upload-format">File format</label>
		<input id="upload-format" type="radio" name="import_format" value="txt"  onclick="showTargetFile()" checked>TXT - two .txt files, one sentence per line, equal number of lines in the files<br>
		<input type="radio" name="import_format" value="doc" onclick="showTargetFile()">DOC/DOCX - two word documents<br>
		<input type="radio" name="import_format" value="tmx" onclick="hideTargetFile()">TMX - a .tmx file<br><br>

        <?php
            echo $this->Form->input('source_file', ['label' => 'Source file', 'type'=>'file']);
        ?>
			<div class="input file" id="target-file-div"><label for="target-file">Target file</label><input type="file" name="target_file" id="target-file"></div>
    </fieldset>
    <?= $this->Form->button(__('Upload')) ?>
    <?= $this->Form->end() ?>
</div>
