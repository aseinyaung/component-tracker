<h2>Listing components</h2>

<table class="table table-striped table-hover table-condensed">
    <thead>
        <tr>
            <th>Name</th>
            <th>Quantity on hand</th>
            <th>Quantity on order</th>
            <th>Reorder level</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>        
        <?php foreach ($components as $component): ?>
            <tr>
                <td>
                    <a href="?<?= e($component['id']) ?>"><?= e($component['name']) ?></a>
                </td>
                <td><?= e($component['quantity_on_hand']) ?></td>
                <td><?= e($component['quantity_on_order']) ?></td>
                <td><?= e($component['reorder_level']) ?></td>
                <td>
                    <a href="?<?= e($component['id']) ?>&amp;edit" class="btn btn-small btn-primary">Edit</a>

                    <form action="?<?= e($component['id']) ?>" method="POST" class="action">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" value="Destroy" class="btn btn-small btn-danger">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>        
    </tbody>
</table>

<a href="?new">Add New Component</a>