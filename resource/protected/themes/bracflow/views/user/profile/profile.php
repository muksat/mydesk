<?php
$this->layout = '//layouts/column1';
$this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Profile");
$hrdata = new HrdService;
$model1 = $hrdata->getHrUser(Yii::app()->user->name);

?>
<div class="ui page grid">
    <div class="column login-page-wrapper" style="background-position: 0px 35px; background-size: 30%">
        <h2 class="ui dividing header"><?php echo UserModule::t('Profile'); ?> <a class="ui blue label">HRD</a></h2>

        <?php if (Yii::app()->user->hasFlash('profileMessage')): ?>
            <div class="success">
                <?php echo Yii::app()->user->getFlash('profileMessage'); ?>
            </div>
        <?php endif; ?>

        <div class="ui profile-view" style="margin: 0 auto; padding: 15px; background: rgba(0, 0, 0, 0.08); border-radius: 10px">
            <span style="width: 100px;
display: block;
height: 10px;
background: #fafaf9;
border-radius: 5px;
margin: auto;
margin-bottom: 10px;
border: 1px solid #ddd;"></span>
            <table class="ui basic table" style="background: #fff">
                <tr>
                    <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('PIN')); ?></th>
                    <td><?php echo CHtml::encode($model->username); ?></td>
                </tr>
                <tr>
                    <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('Name')); ?></th>
                    <td><?php echo $model1[0]['Fname'] . " " . $model1[0]['Mname'] . " " . $model1[0]['Lname']; ?></td>
                </tr>
                <tr>
                    <th class="label"><?php echo "Designation"; ?></th>
                    <td><?php echo $model1[0]['Designation']; ?></td>
                </tr>
                <tr>
                    <th class="label"><?php echo "NationalID"; ?></th>
                    <td><?php echo $model1[0]['NationalID']; ?></td>
                </tr>
                <tr>
                    <th class="label"><?php echo "BloodGroup"; ?></th>
                    <td><?php echo $model1[0]['BloodGroup']; ?></td>
                </tr>
                <tr>
                    <th class="label"><?php echo "Sex"; ?></th>
                    <td><?php echo $model1[0]['Sex']; ?></td>
                </tr>
                <tr>
                    <th class="label"><?php echo "DOB"; ?></th>
                    <td><?php /*$date_field = str_replace("/Date(", "", str_replace(")/","",$model1[0]['DOB']));   echo $model1[0]['DOB'] ; */ ?></td>
                </tr>
                <tr>
                    <th class="label"><?php echo "Religion"; ?></th>
                    <td><?php echo $model1[0]['Religion']; ?></td>
                </tr>
                <tr>
                    <th class="label"><?php echo "Marital Status"; ?></th>
                    <td><?php echo $model1[0]['MaritalStatus']; ?></td>
                </tr>
                <tr>
                    <th class="label"><?php echo "Level"; ?></th>
                    <td><?php echo $model1[0]['Level']; ?></td>
                </tr>
                <tr>
                    <th class="label"><?php echo "Address"; ?></th>
                    <td><?php echo $model1[0]['ContactAddress']; ?></td>
                </tr>
                <tr>
                    <th class="label"><?php echo "Mobile"; ?></th>
                    <td><?php echo $model1[0]['Mobile']; ?></td>
                </tr>
                <tr>
                    <th class="label"><?php echo "Program"; ?></th>
                    <td><?php echo $model1[0]['Program']; ?></td>
                </tr>
                <tr>
                    <th class="label"><?php echo "Project"; ?></th>
                    <td><?php echo $model1[0]['Project']; ?></td>
                </tr>
                <tr>
                    <th class="label"><?php echo "Fathers Name"; ?></th>
                    <td><?php echo $model1[0]['FathersName']; ?></td>
                </tr>
                <tr>
                    <th class="label"><?php echo "Mothers Name"; ?></th>
                    <td><?php echo $model1[0]['MothersName']; ?></td>
                </tr>

                <?php
                $profileFields = ProfileField::model()->forOwner()->sort()->findAll();
                if ($profileFields) {
                    foreach ($profileFields as $field) {
                        //echo "<pre>"; print_r($profile); die();
                        ?>
                        <!--<tr>
		<th class="label"><?php /*// echo CHtml::encode(UserModule::t($field->title)); */ ?></th>
    	<td><?php /*// echo (($field->widgetView($profile))?$field->widgetView($profile):CHtml::encode((($field->range)?Profile::range($field->range,$profile->getAttribute($field->varname)):$profile->getAttribute($field->varname)))); */ ?></td>
	</tr>-->
                    <?php
                    }
                    //$profile->getAttribute($field->varname)
                }
                ?>
                <tr>
                    <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('email')); ?></th>
                    <td><?php echo CHtml::encode($model->email); ?></td>
                </tr>
                <!--<tr>
		<th class="label"><?php /*echo CHtml::encode($model->getAttributeLabel('create_at')); */ ?></th>
    	<td><?php /*echo $model->create_at; */ ?></td>
	</tr>-->
                <tr>
                    <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('lastvisit_at')); ?></th>
                    <td><?php echo $model->lastvisit_at; ?></td>
                </tr>
                <tr>
                    <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('status')); ?></th>
                    <td><?php echo CHtml::encode(User::itemAlias("UserStatus", $model->status)); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>