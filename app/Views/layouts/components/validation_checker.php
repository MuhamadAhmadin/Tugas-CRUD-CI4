<?php if(session('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach(session('errors') as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<?php if(session('error')): ?>
    <div class="alert alert-danger">
        <?= session('error'); ?>
    </div>
<?php endif; ?>
<?php if(session('success')): ?>
    <div class="alert alert-success">
        <?= session('success'); ?>
    </div>
<?php endif; ?>