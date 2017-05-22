<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li>
            <a href="/tmrepository/reviews/add" title="Submit a new review">
            <img src="/tmrepository/img/add.png" />
            &nbsp;New review
            </a>
        </li>
    </ul>
</nav>
<div class="reviews index large-9 medium-8 columns content">
    <h3><?= __('My reviews') ?></h3>
    <p>
    Reviews submitted by me: <?= $reviewsCount ?>, total number of units reviewed: <?= $unitsChecked ?>, review points: <?=$reviewPoints?>.
    </p>
    <p>
    Submit a <a href="/tmrepository/reviews/add" title="Submit a new review">new review</a>.
    </p>
</div>
