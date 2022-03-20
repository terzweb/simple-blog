<?php echo'<?xml version="1.0" encoding="UTF-8" ?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?php echo base_url();?></loc>
        <priority>1.0</priority>
        <changefreq>hourly</changefreq>
    </url> 
    <!-- Sitemap //post page -->
    <?php foreach($posts as $item) { ?>
    <url>
        <loc><?php echo base_url()."post/".$item['url']; ?></loc>
        <lastmod><?php echo date('c',strtotime($item['opendate']));?></lastmod>
        
    </url>
    <?php } ?>
        
    <!-- Sitemap //page -->
    <?php foreach($pages as $item) { ?>
    <url>
        <loc><?php echo base_url()."".$item['url']; ?></loc>
        <changefreq>monthly</changefreq>
    </url>
    <?php } ?>

    <!-- Sitemap //contact -->
    <url>
        <loc><?php echo base_url();?>contact</loc>
        <changefreq>monthly</changefreq>
    </url>
</urlset>
