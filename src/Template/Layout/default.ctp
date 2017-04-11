<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
      Translation Memory Repository
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('tmrepository.css') ?>

    <?= $this->Html->script('jquery-3.1.0.min.js') ?>
    <?= $this->Html->script('tmrepository.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="left">
                <li><a href="/tmrepository">Home</a></li>
                <li><a href="/tmrepository/translation-memories">My translation memories</a></li>
                <li><a href="/tmrepository/translation-memories/ranking">Ranking</a></li>
                <?php
                if (isset($user) && $user['role_id'] == 1) {
                ?>
                <li><a href="/tmrepository/translation-memories/adminindex">All translation memories</a></li>
                <li><a href="/tmrepository/config">Configuration</a></li>
                <?php
                }
                ?>
            </ul>
            <ul class="right">
              <li>
                <?php
                if (isset($user)) {
                ?>
                <li><a href="#">Logged in as: <?= $user['username'] ?></a></li>
                <li><a href="/tmrepository/users/edit/<?= $user['id'] ?>">My profile</a></li>
                <li><a href="/tmrepository/users/logout">Log out</a></li>
                <?php
                } else {
                ?>
                <li><a href="/tmrepository/users/login">Log in</a></li>
                <li><a href="/tmrepository/users/add">Register</a></li>
                <?php
                }
                ?>
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
