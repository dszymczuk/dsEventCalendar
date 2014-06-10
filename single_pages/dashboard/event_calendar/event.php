<?php defined('C5_EXECUTE') or die('Access denied.');
?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Event Calendar')); ?>
    <h3><?php echo t('Add / edit event') ?></h3>


    <form method="get" action="<?php  echo $this->action('view')?>" id="ccm-multilingual-page-report-form" class="form-stacked">
        <div class="row">
            <fieldset class="span4">
                <legend><?php  echo t('Choose Source')?></legend>
                <div class="clearfix">
                    <div class="input" style="margin-top: 15px;">
                        <?php  echo $form->select('sectionIDSelect', $sections, $sectionID)?>
                    </div>
                </div>
            </fieldset>
            <fieldset class="span4">
                <legend><?php  echo t('Choose Targets')?></legend>
                <div class="clearfix">
                    <?php   foreach($sectionList as $sc) { ?>
                        <?php   $args = array('style' => 'vertical-align: middle');
                        if ($sectionID == $sc->getCollectionID()) {
                            $args['disabled'] = 'disabled';
                        }
                        ?>
                        <div class="input">
                            <ul class="inputs-list">
                                <li>
                                    <label>
                                        <?php  echo $form->checkbox('targets[' . $sc->getCollectionID() . ']', $sc->getCollectionID(), in_array($sc->getCollectionID(), $targets), $args)?>
                                        <span>
										<?php  echo $fh->getSectionFlagIcon($sc)?>
                                        <?php  echo $sc->getLanguageText(). " (".$sc->getLocale().")"; ?>
									</span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    <?php   } ?>
                </div>
            </fieldset>
            <fieldset class="span4">
                <legend><?php  echo t('Display')?></legend>
                <div class="clearfix">
                    <div class="input">
                        <ul class="inputs-list">
                            <li>
                                <label>
                                    <?php  echo $form->radio('showAllPages', 0, 0)?>
                                    <span><?php   echo t('Only Missing Pages')?></span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <?php  echo $form->radio('showAllPages', 1, false)?>
                                    <span><?php   echo t('All Pages') ?></span>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
            </fieldset>
            <fieldset class="span2">
                <div class="clearfix">
                    <div class="input" style="margin-top: 10px;">
                        <?php  echo $form->submit('submitForm', t('Go'))?>
                        <?php  echo $form->hidden('sectionID', $sectionID); ?>
                    </div>
                </div>
            </fieldset>
        </div>
    </form>


<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(); ?>