<?php $this->beginContent('//layouts/main'); ?>
    <div class="ui page three stackable column grid middle aligned">
        <div class="bottom aligned row" style="border-bottom: 1px solid #ddd; box-shadow: 0px 1px 0px #fff">
            <div class="column">
                <div class="vertical fluid">
                    <div class="header item brac-logo">
                        BRAC
                    </div>
                </div>
            </div>
            <div class="column computer only">

            </div>
            <div class="column" style="padding-right: 0">
                <div class="vertical fluid" style="text-align: right">
                    <div class="ui header item mydesk-logo">
                        <h2 style="margin-bottom: -18px;"><span class="desk-wrapper"><span class="desk a">my</span><span class="desk b">Desk</span></span></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ui page grid ">
        <div class="column">
            <?php echo $content; ?>
        </div>
    </div>
<?php $this->endContent(); ?>