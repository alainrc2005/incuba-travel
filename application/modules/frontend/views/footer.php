<footer>
    <div class="container">
        <div class="col-md-3">
            <br>
            <img src="<?=base_url()?>assets/img/quicklogo.png"/>
        </div>
        <div class="col-md-3">
            <h3><?= $this->lang->line('footer_opt') ?></h3>
            <ul>
                <li><a href="<?= base_url('Home') ?>"><i class="ion-home"></i> <?=$this->lang->line('mn_home')?></a></li>
                <li><a href="<?= base_url('Policies') ?>"><i class="ion-hammer"></i> <?=$this->lang->line('mn_policies')?></a></li>
                <li><a href="<?= base_url('ContactUs') ?>"><i class="ion-email"></i> <?=$this->lang->line('mn_contactus')?></a></li>
                <li><a href="<?= base_url('AboutUs') ?>"><i class="ion-android-people"></i> <?=$this->lang->line('mn_aboutus')?></a></li>
            </ul>
        </div>
        <div class="col-md-3">
            <h3><?= $this->lang->line('footer_soc') ?></h3>
            <ul>
                <li><a href="#">Tripadvisor</a></li>
                <li><a href="https://www.facebook.com/InCubaTravel"><i class="ion-social-facebook"></i> Facebook</a></li>
                <li><a href="#"><i class="ion-social-youtube"></i> YouTube</a></li>
                <li><a href="#"><i class="ion-social-linkedin"></i> LinkedIn</a></li>
                <li><a href="#"><i class="ion-social-twitter"></i> Twitter</a></li>
            </ul>
        </div>
        <div class="col-md-3">
            <h3><?= $this->lang->line('footer_con') ?></h3>
            <address><i class="ion-android-locate"></i> ******** ******** *** ***** ******.<br>
                <i class="ion-ios-telephone"></i> <?= $this->lang->line('footer_tel') ?>: +53********, +53********<br>
                <i class="ion-email"></i> Email: info@********
            </address>
        </div>
    </div>
</footer>