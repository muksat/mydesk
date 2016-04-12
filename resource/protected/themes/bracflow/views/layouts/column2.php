<?php $this->beginContent('//layouts/column1'); ?>
<div class="ui page grid">
    <div class="column">
    </div>
</div>
<div class="ui page stackable grid">
    <div class="ui three wide column">

        <a href="<?php echo Yii::app()->createUrl('//fleet/transport/create') ?>" class="ui green fluid labeled icon button" style="padding-left: 3em!important; padding-right: 0em!important; font-size: .9em">
            <i class="add sign icon"></i>
            New Requisition
        </a>

        <div class="ui vertical menu teal inverted" style="width: auto">
            <div class="header item">
                <i class="list layout icon"></i>
                Navigation
            </div>
            <?php foreach ($this->menu as $item) { ?>
                <?php if ($item['visible']) { ?>
                    <?php if ($item['visible'] === "separator") { ?>
                     <div class="header item">
                     <i class="globe icon"></i>
                        Navigation
                    </div>
                    <?php } else { ?>
                        <a class="teal item <?php echo $item['active'] ?>" href="<?php echo $this->createUrl($item['url'][0]) ?>">
                            <?php echo $item['label']; ?>
                            <?php if (isset($item['itemOptions']['teal'])) { ?><div class="ui orange label">
                            <?php echo $item['itemOptions']['teal'] ?></div><?php } ?></a>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
            </div>

        </div>

        <div class="thirteen wide column">
            <?php
            foreach (Yii::app()->user->getFlashes() as $key => $message) {
                echo '<div style="border: 1px solid" class="ui message ' . $key . '">' . $message . "</div>";
            }
            ?>
            <?php echo $content; ?>
        </div>

    </div>
    <?php $this->endContent(); ?>