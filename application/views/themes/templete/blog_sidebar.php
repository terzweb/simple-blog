<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<aside>
    <!-- sidebar-widget -->
    <div class="sidebar-widget">
        <h3 class="sidebar-title">検索</h3>
        <div class="widget-container widget-about">
            <form id="searchform" action="{base_url}">
                <div class="input-group mb-3">
                    <div class="input-group">
                        <input class="form-control" name="q" id="q">
                        <div class="input-group-btn">
                            <button class="btn btn-default" id="searchbtn" type="button">検索</button>
                        </div>
                    </div>
                </div>
            </form>
            <p></p>
        </div>
    </div>
    <!-- sidebar-widget -->
    <div class="sidebar-widget">
        <h3 class="sidebar-title">About Me</h3>
        <div class="widget-container widget-about">
            <a href="post.html"><img src="images/author.jpg" alt=""></a>
            <h4>Jamie Mooz</h4>
            <div class="author-title">Designer</div>
            <p>While everyone’s eyes are glued to the runway, it’s hard to ignore that there are major fashion moments on the front row too.</p>
        </div>
    </div>
    <!-- sidebar-widget -->
    <div class="sidebar-widget">
        <h3 class="sidebar-title">Featured Posts</h3>
        <div class="widget-container">
            {blog_newlist}
            <article class="widget-post">
                <div class="post-image">
                    <a href="{url}"><img src="{img_url}" alt=""></a>
                </div>
                <div class="post-body">
                    <h2><a href="{url}">{title}</a></h2>
                    <div class="post-meta">
                        <span><i class="fa fa-clock-o"></i> {opendate_wareki}</span>
                    </div>
                </div>
            </article>

            {/blog_newlist}
        </div>
    </div>
    <!-- sidebar-widget -->
    <div class="sidebar-widget">
        <h3 class="sidebar-title">Socials</h3>
        <div class="widget-container">
            <div class="widget-socials">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-google-plus"></i></a>
                <a href="#"><i class="fa fa-dribbble"></i></a>
                <a href="#"><i class="fa fa-reddit"></i></a>
            </div>
        </div>
    </div>
    <!-- sidebar-widget -->
    <div class="sidebar-widget">
        <h3 class="sidebar-title">tag</h3>
        <div class="widget-container">
           
                {tags_list}
               <a href="{taglink}" class="label label-default">{tagName}</a>
                {/tags_list}                
          
        </div>
    </div>

</aside>