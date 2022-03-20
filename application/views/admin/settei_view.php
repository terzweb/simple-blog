<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-gears"></i> 設定
            <small>Edit Config</small>
        </h1>
    </section>

    <section class="content">

        <?php
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
        <div class="col-md-12">
            <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
        </div>


        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-primary detail-trigger" data-toggle="collapse" href="#collapseExample" style="margin-bottom:10px">
                登録フォームを開く
                </a>
                <div class="collapse" id="collapseExample">
                    
                        <div class="box card-box">
                            <div class="box-header">
                                <header>設定値追加</header>
                            </div>
                            <div class="box-body" id="bar-parent2">
                                <form action="#" id="form_sample_2" class="form-horizontal">
                                    <div class="form-body">
                                        <div class="form-group row  margin-top-20">
                                            <label class="control-label col-md-3">configname
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="configname" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-md-3">説明
                                                <span class="required">  </span>
                                            </label>
                                            <div class="col-md-4">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="setname" />
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-md-3">設定値
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="value" />
                                                </div>

                                            </div>
                                        </div>


                                    </div>
                                    <div class="form-group">
                                        <div class="offset-md-3 col-md-9">
                                            <button type="submit" id="" class="btn btn-info m-r-20">追加</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    
                </div>

            </div>


        </div>

        <div class="row">

            <div class="col-md-12">

                <div class="box">
                    <div class="box-body p-1">

                        <div class="table-responsive">

                            <table class="table table-striped table-bordered" id="example9">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>説明</th>
                                        <th>設定値</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    #var_dump($pageRecords);
                                    if (!empty($record)) {
                                        foreach ($record as $record) {
                                    ?>
                                           <tr id="<?php echo $record->configid;?>">
                                               <td><?php echo $record->configid;?></td>
                                               <td><?php echo $record->setname?></td>
                                               <td><?php echo $record->value ?></td>
                                           </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>






    </section>
</div>

<script type="text/javascript">
    $(document).ready(function() {



        // Example #9
        $('#example9').Tabledit({
            deleteButton: false,
            url: '<?php echo base_url(ADMINURL . '/config/editupdate') ?>',
            columns: {
                identifier: [0, 'id'],
                editable: [
                    [2, 'value'],
                    [1, 'setname']
                ]
            },
            onDraw: function() {
                console.log('onDraw()');
            },
            onSuccess: function(data, textStatus, jqXHR) {
                console.log('onSuccess(data, textStatus, jqXHR)');
                console.log(data);
                console.log(textStatus);
                console.log(jqXHR);
                if (data.status == 'deletesuccess') {
                    location.reload();
                }

            },
            onFail: function(jqXHR, textStatus, errorThrown) {
                console.log('onFail(jqXHR, textStatus, errorThrown)');
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
           
            },
            onAlways: function() {
                console.log('onAlways()');
            },
            onAjax: function(action, serialize) {
                console.log('onAjax(action, serialize)');
                console.log(action);
                console.log(serialize);
            }
        });





    });
</script>



<script type="text/javascript">
    $(document).ready(function() {


        //独自の検証ルールを設定


        var addUserForm = $("#form_sample_2");

        var validator = addUserForm.validate({

            rules: {

                configname: {
                    required: true,
                    alphanumeric: true,
                    minlength: 1
                },
                value: {
                    required: true,
                    minlength: 1
                }
            },
            messages: {
                configname: {
                    required: "入力必須項目です",
                    minlength: "1文字以上",
                    alphanumeric: "半角英数字"
                },
                value: {
                    required: "入力必須項目です",
                    minlength: "1文字以上"
                }
            },

            submitHandler: function(addUserForm) {

                configname = $('input[name="configname"]').val();
                value = $('input[name="value"]').val();
                setname = $('input[name="setname"]').val();


                $.ajax({
                        url: '<?php echo base_url(ADMINURL . '/config/adding') ?>',
                        method: 'POST',
                        dataType: 'json',
                        cache: false,
                        data: {
                            configname: configname,
                            value: value,
                            setname: setname
                        },
                    })
                    .then(
                        // 通信成功時のコールバック
                        function(data) {

                            if (data.status === true) {
                                alert("登録しました。");
                                location.reload();
                            } else if (data.status === false) {
                                alert("登録エラーが発生しました。");
                            }

                        },
                        //通信失敗時のコールバック
                        function() {
                            alert("読み込み失敗");
                        }
                    );

            }

        });


        jQuery.validator.addMethod('alphanumeric', function(value, element) {
            return this.optional(element) || /^([a-zA-Z0-9_]+)$/.test(value);
        });
        jQuery.validator.addMethod("domain", function(value, element) {
            return this.optional(element) || /^http:\/\/mycorporatedomain.com/.test(value);
        }, "Please specify the correct domain for your documents");
        jQuery.validator.addMethod('selectcheck', function(value) {
            return (value != '0');
        });
        //nulブランクがエラーのとき利用
        jQuery.validator.addMethod('selectchecknull', function(value) {
            return (value != '');
        });
        jQuery.validator.addMethod("cdate", function(value, element) {
            r = value.match(/^(\d{4})[\/\-](\d{1,2})[\/\-](\d{1,2})$/);
            if (!r) {
                return false;
            }
            if (r[2] < 1 || r[2] > 12 || r[3] < 1) {
                return false;
            }
            if (r[2] == 2) {
                return r[3] <= (r[1] % 4 == 0 && r[1] % 100 != 0 || r[1] % 400 == 0 ? 29 : 28);
            }
            return r[3] <= (r[2] == 4 || r[2] == 6 || r[2] == 9 || r[2] == 11 ? 30 : 31);
        }, "日付形式で入力");

    });
</script>