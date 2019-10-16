<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('max_execution_time', 180000000000);
ini_set('memory_limit','800000M');
$sitemap = new Sitemap(SITE_PATH);
$sitemap->setPath(SITE_FS_PATH.'/');
$sitemap->setFilename('sitemap');
$sitemap->addItem("", '0.8', 'weekly', 'Today');
$sitemap->addItem("our-partner", '0.8', 'weekly', 'Today');
$sitemap->addItem("careers", '0.8', 'weekly', 'Today');
$sitemap->addItem("contact", '0.8', 'weekly', 'Today');
$sitemap->addItem("services", '0.8', 'weekly', 'Today');
$mqry=$PDO->db_query("select * from #_services where status='1' and subpage_id='0' order by heading ASC ");
while($mrs=$PDO->db_fetch_array($mqry)){
	$sitemap->addItem('services/'.$mrs['url'], '0.8', 'weekly', 'Today');	
}
$mqry2=$PDO->db_query("select * from #_site_pages where status='1' order by heading ASC ");
while($mrs2=$PDO->db_fetch_array($mqry2)){
	$sitemap->addItem(''.$mrs2['url'], '0.8', 'weekly', 'Today');	
}
$sitemap->endSitemap();
$xml = simplexml_load_file(SITE_PATH.'sitemap.xml');
?>
<table class="table table-bordered table-hover">
<thead>
<tr><th>URL</th><th>Priority</th><th>Change Frequency</th><th>Lastmod</th></tr>
</thead>
<tbody>
<?php
foreach($xml as $xm){?>
<tr><td><a href="<?=$xm->loc?>" target="_blank"><?=$xm->loc?></a></td><td><?=$xm->priority?></td><td><?=$xm->changefreq?></td><td><?=$xm->lastmod?></td></tr>
<?php	}
?>
</tbody>