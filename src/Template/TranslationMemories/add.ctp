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
    <fieldset>
        <legend><?= __('Upload a new translation memory') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('description');
            echo $this->Form->input('source_language_id', ['options' => $languages, 'default' => 1]);
            echo $this->Form->input('target_language_id', ['options' => $languages, 'default' => 2]);
            echo $this->Form->input('tm_type_id', ['options' => $tmTypes]);
        ?>
        <label for="upload-format">Translation memory format</label>
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
