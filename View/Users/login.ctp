<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend>Log in</legend>
	<?php
		echo $this->Form->input('email', array('class' => 'input-xlarge'));
		echo $this->Form->input('password', array('class' => 'input-xlarge'));
	?>
	</fieldset>
	<input type="submit" class="btn btn-success" value="Log in" />
</form>