<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend>Register</legend>
	<?php
		echo $this->Form->input('email', array('class' => 'input-xlarge'));
		echo $this->Form->input('password', array('class' => 'input-xlarge'));
	?>
	</fieldset>
	<input type="submit" class="btn btn-success" value="Create my account" />
</form>