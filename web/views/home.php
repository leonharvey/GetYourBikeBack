
<header>
    <img src="/img/logo.jpg">
    <h1>Get your bike back</h1>
</header>

<hr>
<?php if (!empty($_SESSION['msg'])) { ?>
<h3 class="success-msg"><?=helper::getMsg()?></h3>
<?php } ?>
<div class="col-1-3 mobile-1-1 push-1-5 home-forms">
    <h1>Register your chip</h1>
    <form action="/" method="POST" enctype="multipart/form-data">
        <label>Full name *</label>
        <input type="text" name="full_name"  placeholder="Enter full name">
        
        <label>Email *</label>
        <input type="email" name="email" placeholder="Enter email">
        
        <label>Mobile number *</label>
        <input type="tel" name="mobile" placeholder="Enter mobile number">
        
        <label>Chip number *</label>
        <input type="text" name="chip_number" placeholder="Enter chip number">
        
        <label>Upload image</label>
        <input type="file" name="image">
        <br>
        <input type="hidden" name="request_type" value="register_bike">
        <input type="hidden" name="token" value="<?=$this->token?>">
        <br>
        <input type="submit">
    </form>
</div>

<div class="col-1-3 mobile-1-1 home-forms">
    <h1>Report stolen bike</h1>
    <form action="/" method="POST">
        <input type="text" name="chip_number" placeholder="Enter chip number">
        <label class="checkbox">Auto-share to GYBB twitter</label>
        <input type="checkbox" name="twitter_share" value="true">
        <input type="hidden" name="request_type" value="report_stolen">
        <input type="hidden" name="token" value="<?=$this->token?>">
        <br>
        <input type="submit">
    </form>
</div>