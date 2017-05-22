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
    <h3><?= __('Ranking of best contributing users') ?></h3>
        <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col" width="50px">Rank</th>
                <th scope="col">User</th>
                <th scope="col">Units count</th>
                <th scope="col">Review points</th>
                <th scope="col">Total score</th>
                <th scope="col" width="50%">TM titles</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($ranking as $rankingRow):
            $i++;
            $trClass = "";
            if ($i == 1) {
                $trClass = "class=\"gold-medal\"";
            } else if ($i == 2) {
                $trClass = "class=\"silver-medal\"";
            } else if ($i == 3) {
                $trClass = "class=\"bronze-medal\"";
            }

            ?>
            <tr <?= $trClass ?> >
                <td style="text-align:center">
                <?php
                    if ($i == 1) {
                        echo '<img src="/tmrepository/img/gold.png" />';
                    } else if ($i == 2) {
                        echo '<img src="/tmrepository/img/silver.png" />';
                    } else if ($i == 3) {
                        echo '<img src="/tmrepository/img/bronze.png" />';
                    } else {
                        echo $i;
                    }
                ?>
                </td>
                <td><?= $rankingRow['username'] ?></td>
                <td><?= number_format($rankingRow['unit_count'], 0, '.', ' ') ?></td>
                <td><?= number_format($rankingRow['review_points'], 0, '.', ' ') ?></td>
                <td><?= number_format($rankingRow['unit_count']+$rankingRow['review_points'], 0, '.', ' ') ?></td>
                <td><?= $rankingRow['titles'] ?></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
