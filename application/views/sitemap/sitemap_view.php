<?php echo'<?xml version="1.0" encoding="UTF-8" ?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9"> 
    <url>
        <loc><?= base_url();?></loc>
        <priority>1.0</priority>
    </url>
    <url>
        <loc><?= base_url('about');?></loc>
        <priority>1.0</priority>
    </url>
    <url>
        <loc><?= base_url('account/signup');?></loc>
        <priority>1.0</priority>
    </url>
    <url>
        <loc><?= base_url('membership');?></loc>
        <priority>1.0</priority>
    </url>
    <url>
        <loc><?= base_url('login');?></loc>
        <priority>1.0</priority>
    </url>
    <url>
        <loc><?= base_url('cart');?></loc>
        <priority>1.0</priority>
    </url>
    <?php foreach ($this->products_model->sitemapProducts() as $p){ ?>
    <url>
        <loc><?=base_url('product/').$p['url']?></loc>
        <priority>1.0</priority>
    </url>
   <?php } ?>
   <?php foreach ($this->products_model->sitemapProductCategory() as $p){ ?>
    <url>
        <loc><?=base_url('product/category/').$p['url']?></loc>
        <priority>1.0</priority>
    </url>
   <?php } ?>
    
</urlset>