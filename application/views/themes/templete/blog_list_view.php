{blog_entries}
<!-- article -->
<article class="blog-post">
        <div class="blog-post-image">
                <a href="{url}"><img src="{img_url}" alt=""></a>
        </div>
        <div class="blog-post-body">
                <h2><a href="{url}">{title}</a></h2>
                <div class="post-meta"><span><i class="fa fa-clock-o"></i>{opendate_wareki}</span></div>
                <p>{contents}</p>
                <div class="read-more"><a href="{url}">Continue Reading</a></div>
        </div>
</article>
{/blog_entries}



<div class="pager">
        <?php echo $this->pagination->create_links(); ?>
        </div>