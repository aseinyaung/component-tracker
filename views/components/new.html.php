<h2>New component</h2>

<?php if(isset($errors)): ?>
    <div class="error">
        <?php foreach($errors as $error): ?>
            <p><?= $error ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?= open('.', null, ['class' => 'form-horizontal']) ?>

<div class="control-group">
    <?= label('name', null, ['class' => 'control-label'] ) ?>
    <div class="controls">
        <?= text('name', $name) ?>
    </div>
</div>

<div class="control-group">
    <?= label('description', null, ['class' => 'control-label'] ) ?>
    <div class="controls">
        <?= textarea('description', $description, ['rows' => 10]) ?>
    </div>
</div>

<div class="control-group">
    <?= label('notes', null, ['class' => 'control-label'] ) ?>
    <div class="controls">
        <?= textarea('notes', $notes, ['rows' => 10]) ?>
    </div>
</div>

<div class="control-group">
    <?= label('quantity_on_hand', null, ['class' => 'control-label'] ) ?>
    <div class="controls">
        <?= number('quantity_on_hand', $quantity_on_hand) ?>
    </div>
</div>

<div class="control-group">
    <?= label('quantity_on_order', null, ['class' => 'control-label'] ) ?>
    <div class="controls">
        <?= number('quantity_on_order', $quantity_on_order) ?>
    </div>
</div>

<div class="control-group">
    <?= label('reorder_level', null, ['class' => 'control-label'] ) ?>
    <div class="controls">
        <?= number('reorder_level', $reorder_level) ?>
    </div>
</div>

<div class="form-actions">
  <?= submit('Create Component', null, ['class' => 'btn btn-primary']) ?>
</div>

<?= close() ?>