<h2>Items</h2>
<?php echo $this->element("_items_add"); ?>
<ul id="items">
	<?php
	foreach ($items as $item): ?>
	<li class="priority <?php echo h($item['Item']['priority']); ?>" id="item-<?php echo h($item['Item']['id']); ?>">
		<label class="checkbox"> <input type="checkbox" value="<?php echo h($item['Item']['id']); ?>" /><?php echo h($item['Item']['content']); ?></label>
		<span class="created"><?php echo h($item['Item']['created']); ?></span>
	</li>
	<?php endforeach; ?>
</ul>