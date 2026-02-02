<?php 
/** Default configurations */
$modal_id = !empty($modal['id']) ? $modal['id'] : 'modal_'.uniqid();
$modal_size = !empty($modal['size']) ? $modal['size']: '';
$button_dict = array(
    'close' => ['class' => ' btn-outline-primary', 'attribute' => 'data-bs-dismiss="modal"', 'icon' => '<i class="bi bi-x-lg icon-lg"></i>', 'label' => 'Close', 'aksi' => 'mdl_close'],
    'save' => ['class' => 'btn-primary', 'attribute' => '', 'icon' => '<i class="bi bi-floppy2 icon-lg"></i>', 'label' => 'Save Change', 'aksi' => 'mdl_save'],
);
?>
<div class="modal fade text-left" id="<?php echo $modal_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-scrollable <?php echo $modal_size; ?>" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close"><i data-feather="x"></i></button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <?php if(!empty($modal['buttons']) && is_array($modal['buttons'])) foreach($modal['buttons'] as $button){
                    $dict = $button_dict[$button];
                    echo '<button type="button" class="btn '.$dict['class'].'" '.$dict['attribute'].' data-aksi="'.$dict['aksi'].'">
                        '.$dict['icon'].'
                        <span class="">'.$dict['label'].'</span>
                    </button>';
                }?>
            </div>
        </div>
    </div>
</div>