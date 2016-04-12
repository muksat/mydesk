<?php $this->beginContent('//layouts/column1'); ?>
<div class="ui page grid">
    <div class="column">
    </div>
</div>
<div class="ui page stackable grid" >
    <div class="ui three wide column menu-buttons">

        <?php foreach ($this->menuButton as $item) { ?>
            <?php if ($item['visible']) { ?>
            <a href="<?php echo $item['url'][0]; ?>" class="<?php echo ($item['class']) ? $item['class'] : 'ui fluid labeled icon small button' ?>" style="padding-left: 3em!important; padding-right: 0em!important; font-size: .9em">
                    <i class="<?php echo ($item['icon']) ? $item['icon'] : 'icon list' ?>"></i>
                    <?php echo $item['label']; ?>
                </a>
            <?php } ?>
        <?php } ?>
        
        
        <div class="ui vertical menu teal inverted" style="width: auto; ">
            <?php foreach ($this->menu as $item) { ?>
                <?php if ($item['visible']) { ?>
                    <?php if ($item['visible'] === "separator") { ?>
                     <div class="header item">
                     <i class="list icon"></i>
                        <?php echo $item['label']; ?>
                    </div>
                    <?php } else {  ?>                        
                        <?php if($item['url'][0] == "#") { ?>            
                            
                            <div class="teal item <?php echo $item['active'] ?>" href="<?php echo $this->createUrl($item['url'][0]) ?>">
                                <?php echo $item['label']; ?>
                                <?php if($item['icon']) echo $item['icon'] ?>

                                <?php if (isset($item['itemOptions']['teal'])) { ?><div class="ui orange label"><?php echo $item['itemOptions']['teal'] ?></div><?php } ?>

                                <?php if($item['items']) { ?>
                                    <div class="menu">
                                    <?php foreach ($item['items'] as $subItem) { ?>                                
                                        <a href="<?php echo $this->createUrl($subItem['url'][0]) ?>" class="item"><?php echo $subItem['label']; ?></a>
                                    <?php }?>                                        
                                    </div>        
                                <?php } ?>
                            </div>
                        
                        <?php } else { ?>
                            <a class="teal item <?php echo $item['active'] ?>" href="<?php echo $this->createUrl($item['url'][0]) ?>">
                            <?php echo $item['label']; ?>
                            <?php if (isset($item['itemOptions']['teal'])) { ?><div class="ui orange label"><?php echo $item['itemOptions']['teal'] ?></div><?php } ?>                                                                                    
                            <?php if($item['icon']) echo $item['icon'] ?>
                            </a>
                        <?php } ?>                        
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