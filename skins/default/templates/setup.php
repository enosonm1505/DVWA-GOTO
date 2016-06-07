<?php $this->layout('sections/base', $this->data) ?>

<div class="body_padded">
	<h1>Database Setup <img src="<?= $this->data['templateRoot'] ?>images/spanner.png"/></h1>

	<p>Click on the 'Create / Reset Database' button below to create or reset your database.<br />
	If you get an error make sure you have the correct user credentials in: <em><?= $this->data['configPath'] ?></em></p>

	<p>If the database already exists, <em>it will be cleared and the data will be reset</em>.<br />
	You can also use this to reset the administrator credentials ("<em>admin</em> // <em>password</em>") at any stage.</p>
	<hr />
	<br />

	<h2>Setup Check</h2>

	<?= $this->data['DVWAOS'] ?><br />
	Backend database: <em><?= $this->data['DBMS'] ?></em><br />
	PHP version: <em><?= phpversion() ?></em><br />
	<br />
	<?= $this->data['SERVER_NAME'] ?><br />
	<br />
	<?= $this->data['phpDisplayErrors'] ?><br />
	<?= $this->data['phpSafeMode'] ?><br/ >
	<?= $this->data['phpURLInclude'] ?><br/ >
	<?= $this->data['phpURLFopen'] ?><br />
	<?= $this->data['phpMagicQuotes'] ?><br />
	<?= $this->data['phpGD'] ?><br />
	<?= $this->data['phpMySQL'] ?><br />
	<?= $this->data['phpPDO'] ?><br />
	<br />
	<?= $this->data['MYSQL_USER'] ?><br />
	<?= $this->data['MYSQL_PASS'] ?><br />
	<?= $this->data['MYSQL_DB'] ?><br />
	<?= $this->data['MYSQL_SERVER'] ?><br />
	<br />
	<?= $this->data['DVWARecaptcha'] ?><br />
	<br />
	<?= $this->data['DVWAUploadsWrite'] ?><br />
	<?= $this->data['DVWAPHPWrite'] ?><br />
	<br />
	<i><span class="failure">Status in red</span>, indicate there will be an issue when trying to complete some modules.</i><br />
	<br /><br /><br />

	<!-- Create db button -->
	<form action="#" method="post">
		<input name="create_db" type="submit" value="Create / Reset Database">
		<?= $this->data['tokenField'] ?>
	</form>
	<br />
	<hr />
</div>