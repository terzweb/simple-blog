<!--
Blog Single
-->
<article class="blog-post">
        <div class="blog-post-image">
                <img src="{img_url}" alt="" class="" style="width: 100%;">
        </div>
        <div class="blog-post-body">
                <h2>{blog_title}</h2>
                <div class="post-meta">
                        <span><i class="fa fa-clock-o"></i>{blog_opendate_wareki}</span>
                        <div>
                                {blog_tags}
                                <a href="{taglink}" class="label label-default">{tagName}</a>
                                {/blog_tags}
                                
                        </div>
                </div>
                <div class="blog-post-text">
                {blog_entries}
                </div>
        </div>
</article>
