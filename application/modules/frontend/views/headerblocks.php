<div style="height: 18px">
    <div class="currency-block">
        <a href="javascript:void(0);" class="current"><?=$this->session->userdata('currency')?> <i class="fa fa-angle-down"></i></a>
        <div class="currency-block-others-wrapper">
            <div class="currency-block-others">
                <a href="<?= base_url('Currency') ?>/EUR">EUR</a>
                <a href="<?= base_url('Currency') ?>/GBP">GBP</a>
                <a href="<?= base_url('Currency') ?>/USD">USD</a>
                <a href="<?= base_url('Currency') ?>/CAD">CAD</a>
            </div>
        </div>
    </div>
    <div class="lang-block">
        <a class="btn" href="<?= base_url('Lang') ?>">
            <img style="position: relative;top:-1px"
                 src="<?= base_url('assets/img') ?>/<?= $this->session->userdata('lang') == 'es' ? 'us' : 'es' ?>.png"/> <?= $this->lang->line('lang') ?>
        </a>
    </div>
    <div class="cart-block">
        <div class="cart-info">
            <a href="javascript:void(0);"
               class="cart-info-count"><span data-bind="text: kocartlength"></span> <?= $this->lang->line('items') ?>
            </a>
            <a href="javascript:void(0);" class="cart-info-value"><span data-bind="tomoney: kocarttotal, Currency:'', Rate: rate"></span></a>
        </div>
        <i class="ion-android-cart"></i>
        <div class="cart-content-wrapper">
            <div class="cart-content">
                <ul class="scroller" style="height: 250px;" data-bind="foreach: kocart">
                    <li>
                        <img class="img-circle"
                             data-bind="attr: {src: '<?= base_url() ?>/assets/img/options/'+Type+'.jpg'}" width="37"
                             height="34">
                        <strong data-bind="text: Name"></strong>
                        <em data-bind="tomoney: Price, Currency:'', Rate: $parent.rate"></em>
                        <a href="javascript:void(0);" class="del-goods cart-remove" data-bind="click: App.removeCart"><i
                                    class="ion-size ion-android-delete"></i></a>
                    </li>
                </ul>
                <hr>
                <div class="text-center">
                    <a href="javascript:void(0);" class="btn btn-ict"
                       data-bind="click: App.checkout"><?= $this->lang->line('checkout') ?></a>
                </div>
            </div>
        </div>
    </div>
</div>