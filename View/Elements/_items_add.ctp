<div class="items-form">
<?php echo $this->Form->create('Item', array('action' => 'add')); ?>
	<?php echo $this->Form->input('content', array('class' => 'span12', 'placeholder' => 'What do you want to do today?', 'label' => false)); ?>
	<span class="help-block">Prepend M or H to set priority. E.g. H Buy eggs — Alternatively end your item with "." for medium or "!" for high priority.</span>

	<div class="save-and-sort">
		<input type="submit" class="btn btn-success" value="Add item" />

		<?php if(isset($items)): ?>
		<ul class="sort-controls">
			<li><a href="/items/?sort=priority" title="Sort TODO list by priority"><i class="icon-star"></i></a></li>
			<li><a href="/items/?sort=created" title="Sort TODO list by timestamp"><i class="icon-time"></i></a></li>
			<li><a href="/items/?sort=order" title="Sort TODO list by custom order"><i class="icon-th-list"></i></a></li>
		</ul>
		<?php endif; ?>
	</div>
</form>
</div>