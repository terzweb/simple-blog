<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-thumbtack"></i> ブログ 追加
            <small>Add Blog</small>
        </h1>
    </section>

    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->

                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>

                <?php
                $this->load->helper('form');
                $error = $this->session->flashdata('error');
                if ($error) {
                ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php } ?>
                <?php
                $success = $this->session->flashdata('success');
                if ($success) {
                ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php } ?>


                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">内容を記載</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addBlog" action="<?php echo base_url(ADMINURL) ?>/posts/addnewpost" method="post" role="form" autocomplete="off">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fname">タイトル</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('title'); ?>" id="fname" name="title" maxlength="128">
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="url">URL slug</label>
                                        <input type="text" class="form-control required" id="url" value="<?php echo set_value('url'); ?>" name="url" maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="imgurl">Img URL 1980x1080</label>
                                        <input type="text" class="form-control" id="img-url" value="<?php echo set_value('img_url'); ?>" name="img_url">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="content">本投稿内容</label> <small>会員用投稿内容</small>
                                        <textarea name="content" class="textarea" placeholder="会員向け投稿スペース" id="editor1" rows="10" cols="80"><?php echo set_value('content'); ?></textarea>

                                    </div>

                                </div>
                                <!-- /.col-->

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="role">タグ</label>
                                        <?php
                                        echo form_dropdown('tag[]', $tags, null, array('class' => 'select2-tags form-control', 'multiple' => true));
                                        ?>
                                    </div>


                                </div>
                            </div>
                        
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role">ステータス</label>
                                    <?php echo form_dropdown('status', $status, set_value('statusID'), array('class' => 'form-control required')); ?>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="postdata">公開日時</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control required" id="opendate" value="<?php echo set_value('opendate'); ?>" name="opendate" data-inputmask="'alias': 'datetime'" data-mask>
                                    </div>
                                    <!-- /.input group -->

                                </div>
                            </div>
                        </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <input type="submit" class="btn btn-primary" value="投稿" />
                    <input type="reset" class="btn btn-default" value="リセット" />
                </div>
                </form>
            </div>
        </div>

</div>
</section>

</div>

<script type="text/javascript">
    $().ready(function() {

        //独自の検証ルールを設定
        var methods = {
            //電話番号
            alphanumeric: function(value, element) {
                return this.optional(element) || /^[a-zA-Z0-9!-/:-@¥[-`{-~]*$/.test(value);
            },
        };

        var addThisForm = $("#addBlog");

        var validator = addThisForm.validate({

            rules: {
                title: {
                    required: true
                },
                url: {
                    required: true,
                    remote: {
                        url: baseURL + "/checkUrlExists",
                        type: "post"
                    }
                },
            },
            messages: {
                title: {
                    required: "入力必須項目です"
                },
                url: {
                    required: "入力必須項目です",
                    remote: "登録済URLです"
                },
            }
        });
        $.each(methods, function(key) {
            $.validator.addMethod(key, this);
        });
        jQuery.validator.addMethod('selectcheck', function(value) {
            return (value != '0');
        });
    });
</script>


<script type="text/javascript">
    var now = new Date();

    var year = now.getYear(); // 年
    var month = now.getMonth() + 1; // 月
    var day = now.getDate(); // 日
    var hour = now.getHours(); // 時
    var min = now.getMinutes(); // 分
    var sec = now.getSeconds(); // 秒

    if (year < 2000) {
        year += 1900;
    }

    // 数値が1桁の場合、頭に0を付けて2桁で表示する指定
    if (month < 10) {
        month = "0" + month;
    }
    if (day < 10) {
        day = "0" + day;
    }
    if (hour < 10) {
        hour = "0" + hour;
    }
    if (min < 10) {
        min = "0" + min;
    }

    // 表示開始

    var pelem003 = year + '-' + month + '-' + day;
    var pelem004 = hour + ':' + min;
    document.getElementById("opendate").value = pelem003 + pelem004;
    // 表示終了

    // -->
</script>



<script src="<?php echo base_url(); ?>assets/js/editUser.js" type="text/javascript"></script>
<script src="https://cdn.ckeditor.com/4.5.6/standard/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/ckfinder/ckfinder.js"></script>

<script>
    $(function() {
        CKEDITOR.replace("editor1");
        CKEDITOR.config.height = "500px"; //高さ
        CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;

        CKEDITOR.config.allowedContent = true;
        CKEDITOR.config.filebrowserImageBrowseUrl = "<?php echo base_url(); ?>assets/plugins/kcfinder/browse.php?type=images";
        CKEDITOR.config.filebrowserImageUploadUrl = "<?php echo base_url(); ?>assets/plugins/kcfinder/upload.php?type=images";
        CKEDITOR.config.filebrowserBrowseUrl = "<?php echo base_url(); ?>assets/plugins/kcfinder/browse.php?type=files";
        CKEDITOR.config.filebrowserUploadUrl = "<?php echo base_url(); ?>assets/plugins/kcfinder/upload.php?type=files";
        CKEDITOR.config.contentsCss = ["https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.14.2/styles/monokai-sublime.min.css", "<?php echo base_url('assets/' . $theme); ?>/css/themestyle.css"];

        //bootstrap WYSIHTML5 - text editor
        CKEDITOR.stylesSet.add("default", [
            // Block Styles
            {
                name: "Callout warning",
                element: "div",
                attributes: {
                    "class": "bd-callout bd-callout-warning"
                }
            },
            {
                name: "Callout info",
                element: "div",
                attributes: {
                    "class": "bd-callout bd-callout-info"
                }
            },
            {
                name: "Callout danger",
                element: "div",
                attributes: {
                    "class": "bd-callout bd-callout-danger"
                }
            },

            {
                name: "Alert primary",
                element: "div",
                attributes: {
                    "class": "alert alert-primary"
                }
            },
            {
                name: "Alert success",
                element: "div",
                attributes: {
                    "class": "alert alert-success"
                }
            },
            {
                name: "Alert danger",
                element: "div",
                attributes: {
                    "class": "alert alert-danger"
                }
            },
            {
                name: "Alert success",
                element: "div",
                attributes: {
                    "class": "alert alert-success"
                }
            },
            {
                name: "Alert secondary",
                element: "div",
                attributes: {
                    "class": "alert alert-secondary"
                }
            },

            {
                name: "Graybox",
                element: "div",
                attributes: {
                    "class": "graybox"
                }
            },

            {
                name: "pre",
                element: "pre",
                attributes: {
                    "class": ""
                }
            },
            {
                name: "php code",
                element: "code",
                attributes: {
                    "class": "hljs php"
                }
            },
            {
                name: "JS code",
                element: "code",
                attributes: {
                    "class": "hljs javascript"
                }
            },

            // Inline Styles
            {
                name: "Marker: Yellow",
                element: "span",
                styles: {
                    "background-color": "Yellow"
                }
            },
            {
                name: "Marker: Green",
                element: "span",
                styles: {
                    "background-color": "Lime"
                }
            },

            // Object Styles
            {
                name: "Image on Left",
                element: "img",
                attributes: {
                    style: "padding: 5px; margin-right: 5px",
                    border: "2",
                    align: "left"
                }
            }
        ]);

    });
</script>