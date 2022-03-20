<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-paint-brush"></i> ブログ管理
      <small>Add, Edit, Delete</small>
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12 text-right">
        <div class="form-group">
          <a class="btn btn-primary" href="<?php echo base_url(ADMINURL); ?>/posts/addNew"><i class="fa fa-plus"></i> 新規ブログ作成</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">ブログリスト</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tr>
                <th>URL slug</th>
                <th>タイトル</th>
                <th>ステータス</th>
                <th>公開日時</th>
                <th>最終更新日</th>
                <th class="text-center">操作</th>
              </tr>
              <?php
              if (!empty($postsRecords)) {
                $this->load->helper(array('form', 'url'));
                foreach ($postsRecords as $record) {
              ?>
                  <tr>
                    <td><?php echo urldecode($record->url); ?></td>
                    <td><?php echo $record->title ?></td>
                    <td><?php echo $status[$record->status]; ?></td>
                    <td><?php echo $record->opendate ?></td>
                    <td><?php echo $record->postdata ?></td>
                    <td class="text-center">
                      <a class="btn btn-sm btn-info" href="<?php echo base_url(ADMINURL) . '/posts/editOld/' . $record->id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                      <a class="btn btn-sm btn-danger deletePost" href="#" data-postid="<?php echo $record->id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
              <?php
                }
              }
              ?>
            </table>

          </div><!-- /.box-body -->
          <div class="box-footer clearfix">
            <?php echo $this->pagination->create_links(); ?>
          </div>
        </div><!-- /.box -->
      </div>
    </div>
  </section>
</div>


<script>
  $(function() {

    $(document).on("click", ".deletePost", function() {
      var postId = $(this).data("postid"),
        hitURL = baseURL + "/posts/deletePost",
        currentRow = $(this);

      var confirmation = confirm("この投稿を削除してもよいですか？");

      if (confirmation) {
        jQuery.ajax({
          type: "POST",
          dataType: "json",
          url: hitURL,
          data: {
            postId: postId
          }
        }).done(function(data) {
          console.log(data);
          currentRow.parents('tr').remove();
          if (data.status = true) {
            alert("投稿を削除しました");
          } else if (data.status = false) {
            alert("投稿削除失敗しました");
          } else {
            alert("接続できん・・・");
          }
        });
      }
    });

  });
</script>