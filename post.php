<?php
	include_once('./php/classes.php');
	use simplerestclient\SimpleRestClient;
	use simplerestclient\SRCHeader;
?>

<?php
	$elasticSearch = getenv('ELASTIC_SEARCH');
	$client = new SimpleRestClient($elasticSearch, array(SRCHeader::CONTENT_TYPE_APPLICATION_JSON()));
	$object = new \stdClass();
	$object->id = random_int(1, 999);
	$object->value = 'Lorem Ipsum Dolor Sit Amet';
	$response = $client->post('objects/_doc?pretty', $object);
	$result = json_decode($response->contents());
?>

<link rel="stylesheet" href="css/css.css" />

<i>ElasticSearch base URL:</i> <?= $elasticSearch ?>
<br />
<ul>
	<li>status: <?= $response->status() ?></li>
	<li>
		headers:
		<?php if ($response->headers()) { ?>
			<ul>
				<?php foreach($response->headers() as $header) { ?>
					<li><?= $header->name() ?>: <?= $header->value() ?></li>
				<?php } ?>
			</ul>				
		<?php } else { ?>
			NULL
		<?php } ?>			
	</li>
</ul>
<ul>
	<li>
		raw response:
		<?php if ($response->contents()) { ?>
			<pre><?= $response->contents() ?></pre>
		<?php } else { ?>
			NULL
		<?php } ?>
	</li>
</ul>
<a href=".">home</a> | <a href="./post.php">post</a> | <a href="./get.php">get</a> | <a href="./delete.php">delete</a>
