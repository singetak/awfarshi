<?php echo CHtml::form(); ?>
    <div id="langdrop">
        <?php echo CHtml::dropDownList('_lang', $currentLang, array('en' => 'English', 'ar' => Yii::t('zii','Arabic')), array('submit' => '')); ?>
    </div>
<?php echo CHtml::endForm(); ?>