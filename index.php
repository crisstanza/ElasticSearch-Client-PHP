<?php
	include_once('./php/classes.php');
	use simplerestclient\SimpleRestClient;
	use simplerestclient\SRCHeader;
?>

<?php
	$elasticSearch = getenv('ELASTIC_SEARCH');
	$client = new SimpleRestClient($elasticSearch, array(SRCHeader::CONTENT_TYPE_APPLICATION_JSON()));
	$response = $client->get();
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
		parsed result:
		<?php if ($result) { ?>
			<ul>
				<li>name: <?= $result->name ?></li>
				<li>cluster_name: <?= $result->cluster_name ?></li>
				<li>cluster_uuid: <?= $result->cluster_uuid ?></li>
				<li>
					version:
					<ul>
						<li>number: <?= $result->version->number ?></li>
						<li>build_flavor: <?= $result->version->build_flavor ?></li>
						<li>build_type: <?= $result->version->build_type ?></li>
						<li>build_hash: <?= $result->version->build_hash ?></li>
						<li>build_date: <?= $result->version->build_date ?></li>
						<li>build_snapshot: <?= $result->version->build_snapshot ?></li>
						<li>lucene_version: <?= $result->version->lucene_version ?></li>
						<li>minimum_wire_compatibility_version: <?= $result->version->minimum_wire_compatibility_version ?></li>
						<li>minimum_index_compatibility_version: <?= $result->version->minimum_index_compatibility_version ?></li>
					</ul>
				</li>
				<li>tagline: <?= $result->tagline ?></li>
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
