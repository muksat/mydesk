<div class="column1-page-wrapper">
    <?php $this->pageTitle=Yii::app()->name. ' Home';?>
    <div class="ui page grid">
        <div class="column">
            <h2 class="ui header">Services</h2>
        </div>
    </div>
    <div class="ui page grid">
        <div class="column">
            <div class="ui stackable items">
                <?php foreach($modules as $app) { ?>
                    <div onclick="window.location='<?php echo Yii::app()->baseUrl . '/' .$app->id;  ?>';" class="item">
                        <div class="image">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/custom/css/images/<?php echo $app->image ?>">
                            <a class="star ui blue corner label">
                                <!--<i class="star icon"></i>-->
                            </a>
                        </div>
                        <div class="content">
                            <div class="ui header name"><?php echo $app->name ?></div>
                            <!--<p class="description"><?php /*echo $app->description; */?></p>-->
                        </div>
                    </div>
                <?php } ?>
                <div class="item" style="background: #ddd">
                    <div class="content">
                        <div class="ui header name">Free</div>
                        <p class="description">Reserved for future apps</p>
                    </div>
                </div>
                <div class="item" style="background: #ddd">
                    <div class="content">
                        <div class="ui header name">Free</div>
                        <p class="description">Reserved for future apps</p>
                    </div>
                </div>
                <div class="item" style="background: #ddd">
                    <div class="content">
                        <div class="ui header name">Free</div>
                        <p class="description">Reserved for future apps</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.desk-wrapper span.desk').transition('pulse');
</script>