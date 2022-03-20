

<script src="https://www.google.com/recaptcha/api.js?render={site_key}"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('{site_key}', {
            action: 'homepage'
        }).then(function(token) {
            var recaptchaResponse = document.getElementById('recaptchaResponse');
            recaptchaResponse.value = token;
        });
    });
</script>

<div class="row">

    <div class="col-sm-12">
        <h3 class="text-uppercase custom-title mb-0 ft-wt-600 pb-3">お問い合わせはお気軽にどうぞ</h3>
        
    </div>
</div>
<div class="row">

    <div class="col-sm-12">
        <?php
        $this->load->helper('form');
        $error = $this->session->flashdata('error');
        if ($error) {
        ?>
            <div class="alert alert-danger alert-dismissable">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php } ?>
        <?php
        $success = $this->session->flashdata('success');
        if ($success) {
        ?>
            <div class="alert alert-success alert-dismissable">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php } ?>

        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' </div>'); ?>
    </div>

    <form method="post" action="{base_url}contact/validation" target="_top" class="contactForm">
        <input type="hidden" name="recaptchaResponse" id="recaptchaResponse">


        <div class="col-sm-12 mb-2">
            <input type="text" name="name" value="" class="form-control" placeholder="お名前" minlength="2" required="" aria-required="true" required>
        </div>
        <div class="col-sm-12">
            <input type="email" name="email" value="" class="form-control" placeholder="メールアドレス" required="" aria-required="true" required>
        </div>

        <div class="col-sm-12">
            <textarea name="naiyou" class="form-control" placeholder="お問い合わせ内容" rows="10" required="" aria-required="true" required><?php echo set_value('naiyou'); ?></textarea>
            <button type="submit" class="btn btn-primary">送信</button>
        </div>



    </form>



</div>