<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
    </ul>
</nav>
<div class="reviews index large-9 medium-8 columns content">
    <h3><?= __('Reviews') ?></h3>
    <form class="form" method="POST" action="/tmrepository/reviews/add">
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col">Source segment</th>
                    <th scope="col">Target segment</th>
                    <th width="10%" scope="col" class="actions"><?= __('Review') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($units as $unit):
                    if ($unit['source_language_id'] < $unit['target_language_id']) {
                        $sourceSegment = $unit['source_segment'];
                        $targetSegment = $unit['target_segment'];
                    } else {
                        $sourceSegment = $unit['target_segment'];
                        $targetSegment = $unit['source_segment'];
                    }
                ?>
                <tr>
                    <td><?= h($sourceSegment) ?></td>
                    <td><?= h($targetSegment) ?></td>
                    <td class="review-area" onclick="toggleDecision(<?= $unit['id']?>)">
                        <input type="hidden" name="ids[]" value="<?= $unit['id']?>" />
                        <input id="decision-<?= $unit['id']?>" type="hidden" name="decisions[]" value="1" />
                        <img id="image-<?= $unit['id']?>" src="/tmrepository/webroot/img/tick.png" />
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button type="submit">Submit review</button>
    </form>
</div>
