<?php 

/* Template Name: Community Template */

if (!is_user_logged_in()) {
$redirect_to = home_url('');
header('Location: '.$redirect_to.'');
}else{
get_header(); 
$current_user = wp_get_current_user();
$roles=$current_user?->roles ?? [];
?>
<section class="community-centre">
<?php 
if( have_rows('community_module') ): 
while( have_rows('community_module') ): the_row(); 
if( get_row_layout() == 'header_module' ):
?>
<div class="community_banner">
<h2><?= get_sub_field('header_title'); ?></h2>
</div>
<?php endif;
endwhile;
endif; ?>

<div class="community-center-section">
<div class="community-left-sidebar">
    <div class="community-left">
        <?php
        if(in_array('sales',$roles) || in_array('administrator',$roles)){  ?>
            <div class="community-left-each">
            <div class="title-icon-new">
            <div class="title-icon-imgg">
                 <img src="<?= get_site_url(); ?>/wp-content/uploads/2023/10/ff1.png" alt="">
            </div>
                <h3>Sales</h3>
            </div>  
 <ul>
    <?php 
         $args = 
         [
            'post_type' => 'community_sales',
            'post_status'=> 'publish',
            'order'    => 'ASC',
            'posts_per_page'=>-1
         ];
         $query = new WP_Query($args);
         if($query->have_posts()){
            while($query->have_posts()){
            $query->the_post(); 
            $id = get_the_ID();
            if (have_rows('post_type_content')) :
                while (have_rows('post_type_content')) : the_row();
            if( get_row_layout() == 'post_type_pdf' ):
           ?>
        <li> 
        <?php $pdf = get_sub_field('pdf_url', $id ); ?>
        <a href="<?= (!empty($pdf)) ? esc_url($pdf['url']) : '#'; ?>" target="_blank">
        <div class="pdf-img">
        <?php $icon = get_sub_field('file_icon', $id );
        if($icon){ ?>                          
          <img src="<?= $icon; ?>" alt="">
      <?php } ?>
        </div>
            <span><?= get_the_title(); ?></span>
        </a>
        </li>

    <?php
    elseif( get_row_layout() == 'post_board_reports' ):
    ?>
    <li>
        <a href="#" data-toggle="modal" data-target="#exampleModal-<?= $id; ?>">
            <div class="pdf-img">
             <img src="<?= get_site_url(); ?>/wp-content/uploads/2023/10/folder.png" alt="">
            </div>
            <span><?= get_the_title(); ?></span>
        </a>
    </li>
    <div class="modal fade" id="exampleModal-<?= $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= (!empty(get_sub_field('board_title', $id ))) ? get_sub_field('board_title', $id ) : '';  ?></h5>
                    <div class="back-new">
                        <h6>Back</h6>
                    </div>
                    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <div class="modal-body-custom">
                    <h2><?= get_sub_field('board_subtitle', $id ) ?? ''; ?></h2>
                    <div class="row"> 
                <?php 
                $p=0;
                $item = get_sub_field('board_report_item', $id );
                //print_r($item);
                if(!empty($item)){ 
                   foreach($item as $itemrow){ 
                    $p++;
                    $filetype = $itemrow['attach_file_type'];
                   if($filetype == 0){
                    ?>                      
                <div class="col-md-3">
                    <div class="modal-boxes">
                        <div class="report-modal-imgg" model="Modal_new_folder_<?= $p; ?>"> 
                            <div> 
                                <img src="<?= get_site_url(); ?>/wp-content/uploads/2023/10/folder.png" alt="" class="custom_img">
                            </div>
                            <div class="modal-boxes-info">
                            <h4><?= $itemrow['board_plan'] ?? ''; ?></h4>
                            </div>
                        </div>  
                    </div>
                </div> 
    <?php 
    $internal = $itemrow['internal_folder'];
    if($internal==1){
    $popdata = $itemrow['internal_popup'];
    ?>
    <div class="modal fade" id="Modal_new_folder_<?= $p; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header second-model">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <div class="back-new">
                        <h6>Back</h6>
                    </div>
                    <button type="button" class="close close_current_modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>

                  </div>
                <div class="modal-body">
                <div class="modal-body-custom">
                    <div class="row">
                        <?php 
                        $in =0;
                        if(!empty($popdata)){ 
                            foreach($popdata as $popitem){
                            $in++;
                            $interfolder = $popitem['second_file_type'];
                            if($interfolder ==0){
                            ?>               
                        <div class="col-md-3">
                            <div class="modal-boxes">
                        <div class="report-modal-imgg" model="Modal_internal_folder_<?= $in; ?>"> 
                             <div> 
                                <img src="<?= get_site_url(); ?>/wp-content/uploads/2023/10/folder.png" alt="" class="custom_img">
                            </div>
                            <div class="modal-boxes-info">
                            <h4><?= $popitem['folder_name'] ?? ''; ?></h4>
                            </div>
                        </div>
                    </div>
                    </div> 
        <?php 
        $thirdpopup = $popitem['third_internal_folder'];
        if($thirdpopup==1){
            $thirdpopdata = $popitem['third_popup_data'];
        ?>
         <div class="modal fade" id="Modal_internal_folder_<?= $in; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header second-model">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <div class="back-new">
                        <h6>Back</h6>
                    </div>
                    <button type="button" class="close close_current_modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <div class="modal-body">
                <div class="modal-body-custom">
                    <div class="row"> 
        <?php 
        if($thirdpopdata){
            foreach($thirdpopdata as $thirdpopupitem){
        ?>                       
        <div class="col-md-3">
        <div class="modal-boxes for_pdf_box">
            <div class="report-modal-imgg for-icon"> 
               <div class="iconss">
               <?php $tfile = $thirdpopupitem['third_popup_file'];
               //print_r($file); 
               $turl = "";
               $tname = "";
               $ticon = "";
               $tthumbnail ="";
                if($tfile){ 
                    $turl = esc_url($tfile['url']); 
                    $tname = implode(" ", array_slice(explode(" ", str_replace('-', ' ', esc_html($tfile['name']))), 0, 3));
                    $ticon = $tfile['icon'];
                    if($tfile['type']=='image'){
                    $tthumbnail = $tfile['sizes']['thumbnail'];
                    }
                    ?> 
               <?php } ?>
                <div>
                <?php if(!empty($tthumbnail)){ ?>
                   <a href="<?= $turl; ?>" target="_blank">
                   <img src="<?= $tthumbnail; ?>" alt=""> 
                   </a> 
               <?php }else{ ?>
                <a href="<?= $turl; ?>" target="_blank">
                   <img src="<?= $ticon; ?>" alt="">
                   </a>  
               <?php } ?>
               </div> 
               </div> 
            </div>
            <div class="modal-boxes-info">
                <a href="<?= $turl; ?>" target="_blank">
                <h4><?= (!empty($tname)) ? $tname.'...' : ''; ?></h4>
                </a>
            </div>
            <div class="drop-list">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </div>
        <div class="dropdown-custom">
            <ul class="share-frst">
                <li>
                    <a href="#">
                    <i class="fa fa-share-alt" aria-hidden="true"></i>

                        <span>Share</span>
                    </a>
                    <ul class="share-inner">
                        <li>
                        <a href="https://www.pinterest.com/pin/create/button/?url=urlencode(<?= $turl ?>)">
                            <i class="fa-brands fa-pinterest"></i>
                                <span>Pinterest</span>
                            </a>
                        </li>
                        <li>
                        <a href='https://api.whatsapp.com/send?text=<?php echo urlencode("Nvcentralservices:" .$turl) ?>' target="_blank">
                            <i class="fa-brands fa-whatsapp"></i>
                                <span>whatsapp</span>
                            </a>
                        </li>  
                    </ul>
                </li>
                <li>
                    <a href="<?= $turl ?>" download="">
                    <i class="fa fa-download" aria-hidden="true"></i>
                        <span>Download</span>
                    </a>
                </li>
            </ul>
        </div>
        </div>
    </div>    
<?php } } ?>
</div>
</div>
</div>
</div>
</div>
</div>
<?php }
 }else{ ?>
    <div class="col-md-3">
        <div class="modal-boxes for_pdf_box">
            <div class="report-modal-imgg for-icon"> 
               <div class="iconss">
               <?php $sfile = $popitem['second_popup_file'];
               //print_r($file); 
               $surl = "";
               $sname = "";
               $sicon = "";
               $sthumbnail ="";
                if($sfile){ 
                    $surl = esc_url($sfile['url']); 
                    $sname = implode(" ", array_slice(explode(" ", str_replace('-', ' ', esc_html($sfile['name']))), 0, 3));
                    $sicon = $sfile['icon'];
                    if($sfile['type']=='image'){
                    $sthumbnail = $sfile['sizes']['thumbnail'];
                    }
                    ?> 
               <?php } ?>
                <div>
                <?php if(!empty($sthumbnail)){ ?>
                   <a href="<?= $surl; ?>" target="_blank">
                   <img src="<?= $sthumbnail; ?>" alt=""> 
                   </a> 
               <?php }else{ ?>
                <a href="<?= $surl; ?>" target="_blank">
                    <img src="<?= $sicon; ?>" alt="">  
                </a>
               <?php } ?>
               </div> 
               </div> 
            </div>
            <div class="modal-boxes-info">
            <a href="<?= $surl; ?>" target="_blank">
                <h4><?= (!empty($sname)) ? $sname.'...' : ''; ?></h4>
            </a>
            </div>
            <div class="drop-list">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </div>
        <div class="dropdown-custom">
            <ul class="share-frst">
                <li>
                    <a href="#">
                    <i class="fa fa-share-alt" aria-hidden="true"></i>

                        <span>Share</span>
                    </a>
                    <ul class="share-inner">
                        <li>
                        <a href="https://www.pinterest.com/pin/create/button/?url=urlencode(<?= $surl ?>)">
                            <i class="fa-brands fa-pinterest"></i>
                                <span>Pinterest</span>
                            </a>
                        </li>
                        <li>
                        <a href='https://api.whatsapp.com/send?text=<?php echo urlencode("Nvcentralservices:" .$surl) ?>' target="_blank">
                            <i class="fa-brands fa-whatsapp"></i>
                                <span>whatsapp</span>
                            </a>
                        </li>  
                    </ul>
                </li>
                <li>
                    <a href="<?= $surl ?>" download="">
                    <i class="fa fa-download" aria-hidden="true"></i>
                        <span>Download</span>
                    </a>
                </li>
            </ul>
        </div>
        </div>
    </div>
             <?php }
            } 
                    }
                ?>                     
                    </div>
                </div>
                </div>
                </div>
              </div>
            </div>
    <?php 
            }
            }else{ ?>
    <div class="col-md-3">
        <div class="modal-boxes for_pdf_box">
            <div class="report-modal-imgg for-icon"> 
               <div class="iconss">
               <?php 
               $file = $itemrow['choose_your_file'];
               $url = "";
               $name = "";
               $icon = "";
               $thumbnail ="";
                if($file){ 
                    $url = esc_url($file['url']); 
                    $name = implode(" ", array_slice(explode(" ", str_replace('-', ' ', esc_html($file['name']))), 0, 3));
                    $icon = $file['icon'];
                    if($file['type']=='image'){
                    $thumbnail = $file['sizes']['thumbnail'];
                    }
                    ?> 
               <?php } ?>
                <div>
                <?php if(!empty($thumbnail)){ ?>
                    <a href="<?= $url; ?>" target="_blank">
                    <img src="<?= $thumbnail; ?>" alt="">  
                    </a>
                <?php }else{ ?>
                    <a href="<?= $url; ?>" target="_blank">
                    <img src="<?= $icon; ?>" alt="">
                    </a>  
               <?php } ?>
               </div> 
               </div> 
            </div>
            <div class="modal-boxes-info">
                <a href="<?= $url; ?>" target="_blank">
                <h4><?= (!empty($name)) ? $name.'...' : ''; ?></h4>
                </a>
            </div>
            <div class="drop-list">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </div>
        <div class="dropdown-custom">
            <ul class="share-frst">
                <li>
                    <a href="#">
                    <i class="fa fa-share-alt" aria-hidden="true"></i>
                        <span>Share</span>
                    </a>
                    <ul class="share-inner">
                        <li>
                        <a href="https://www.pinterest.com/pin/create/button/?url=urlencode(<?= $url ?>)">
                            <i class="fa-brands fa-pinterest"></i>
                                <span>Pinterest</span>
                            </a>
                        </li>
                        <li>
                        <a href='https://api.whatsapp.com/send?text=<?php echo urlencode("Nvcentralservices:" .$url) ?>' target="_blank">
                            <i class="fa-brands fa-whatsapp"></i>
                                <span>whatsapp</span>
                            </a>
                        </li>                        
                    </ul>
                </li>
                <li>
                    <a href="<?= $url ?>" download="">
                    <i class="fa fa-download" aria-hidden="true"></i>
                        <span>Download</span>
                    </a>
                </li>
            </ul>
        </div>
        </div>
    </div>
<?php
    }
 }  
} 
?> 
</div>
</div>
</div>
</div>
</div>
</div>
<?php elseif( get_row_layout() == 'post_google_maps' ): ?>
    <li>
        <a href="#" data-toggle="modal" data-target="#exampleModal-2">
            <div class="pdf-img">
            <?php $m_icon = get_sub_field('maps_icon', $id );
                if(!empty($m_icon)){  ?>
                <img src="<?= $m_icon; ?>" alt="">
            <?php } ?>
            </div>
            <span><?= get_the_title(); ?></span>
        </a>
    </li>
    <div class="modal fade" id="exampleModal-2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= get_sub_field('maps_title', $id) ?? ''; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body-custom">
                   <h2><?= get_sub_field('maps_subtitle', $id) ?? ''; ?></h2>
                       <?= get_sub_field('Maps', $id) ?? ''; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php elseif( get_row_layout() == 'board_of_directors' ): ?>
        <li>
            <a href="#" data-toggle="modal" data-target="#exampleModal3">
                <div class="pdf-img">
            <?php $b_icon = get_sub_field('board_icon', $id);
                if(!empty($b_icon)){  ?>
                <img src="<?= $b_icon; ?>" alt="">
            <?php } ?>
                </div>
                <span><?= get_the_title(); ?></span>
            </a>
        </li>
    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= get_sub_field('board_title', $id) ?? ''; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body-custom">
                        <?= get_sub_field('board_description', $id) ?? ''; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <?php
     endif; 
   endwhile;
endif;

    }
}
    wp_reset_postdata();
    ?> 
</ul>
</div>
<?php  }

if(in_array('marketing',$roles) || in_array('administrator',$roles)){ ?>
<div class="community-left-each">
    <div class="title-icon-new">
        <div class="title-icon-imgg">
            <img src="<?= get_site_url(); ?>/wp-content/uploads/2023/10/ff5.png" alt="">
        </div>
        <h3>Marketing</h3>
    </div>
    <ul>
<?php 
 $args = ['post_type' => 'community_marketing',
          'post_status'=> 'publish',
          'order'    => 'ASC',
          'posts_per_page'=>-1
         ];
     $query = new WP_Query($args);
     if($query->have_posts()){
        while($query->have_posts()){
        $query->the_post(); 
        $mid = get_the_ID();
        if (have_rows('post_type_content')) :
                while (have_rows('post_type_content')) : the_row();
            if( get_row_layout() == 'post_type_pdf' ):
           ?>
        <li> 
        <?php $pdf = get_sub_field('pdf_url', $mid); ?>
        <a href="<?= (!empty($pdf)) ? esc_url($pdf['url']) : '#'; ?>" target="_blank">
        <div class="pdf-img">
        <?php $icon = get_sub_field('file_icon', $mid);
        if($icon){ ?>                          
          <img src="<?= $icon; ?>" alt="">
      <?php } ?>
        </div>
            <span><?= get_the_title(); ?></span>
        </a>
        </li>

    <?php
    elseif( get_row_layout() == 'post_board_reports' ):
    ?>
    <li>
        <a href="#" data-toggle="modal" data-target="#exampleModal-m<?= $id; ?>">
            <div class="pdf-img">
             <img src="<?= get_site_url(); ?>/wp-content/uploads/2023/10/folder.png" alt="">
            </div>
            <span><?= get_the_title(); ?></span>
        </a>
    </li>
    <div class="modal fade" id="exampleModal-m<?= $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= (!empty(get_sub_field('board_title', $mid))) ? get_sub_field('board_title', $mid) : '';  ?></h5>
                    <div class="back-new">
                        <h6>Back</h6>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <div class="modal-body-custom">
                    <h2><?= get_sub_field('board_subtitle', $mid) ?? ''; ?></h2>
                    <div class="row"> 
                <?php 
                $p=0;
                $item = get_sub_field('board_report_item', $mid);
                //print_r($item);
                if(!empty($item)){ 
                   foreach($item as $itemrow){ 
                    $p++;
                    $filetype = $itemrow['attach_file_type'];
                   if($filetype == 0){
                    ?>                      
                <div class="col-md-3">
                    <div class="modal-boxes">
                        <div class="report-modal-imgg" model="Modal_new_folder_m<?= $p; ?>"> 
                            <div> 
                                <img src="<?= get_site_url(); ?>/wp-content/uploads/2023/10/folder.png" alt="" class="custom_img">
                            </div>
                            <div class="modal-boxes-info">
                            <h4><?= $itemrow['board_plan'] ?? ''; ?></h4>
                            </div>
                        </div>  
                    </div>
                </div> 
    <?php 
    $internal = $itemrow['internal_folder'];
    if($internal==1){
    $popdata = $itemrow['internal_popup'];
    ?>
    <div class="modal fade" id="Modal_new_folder_m<?= $p; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header second-model">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <div class="back-new">
                        <h6>Back</h6>
                    </div>
                    <button type="button" class="close close_current_modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <div class="modal-body">
                <div class="modal-body-custom">
                    <div class="row">
                        <?php 
                        $in =0;
                        if(!empty($popdata)){ 
                            foreach($popdata as $popitem){
                            $in++;
                            $interfolder = $popitem['second_file_type'];
                            if($interfolder ==0){
                            ?>               
                        <div class="col-md-3">
                            <div class="modal-boxes">
                        <div class="report-modal-imgg" model="Modal_internal_folder_m<?= $in; ?>"> 
                             <div> 
                                <img src="<?= get_site_url(); ?>/wp-content/uploads/2023/10/folder.png" alt="" class="custom_img">
                            </div>
                            <div class="modal-boxes-info">
                            <h4><?= $popitem['folder_name'] ?? ''; ?></h4>
                            </div>
                        </div>
                    </div>
                    </div> 
        <?php 
        $thirdpopup = $popitem['third_internal_folder'];
        if($thirdpopup==1){
            $thirdpopdata = $popitem['third_popup_data'];
        ?>
         <div class="modal fade" id="Modal_internal_folder_m<?= $in; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header second-model">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <div class="back-new">
                        <h6>Back</h6>
                    </div>
                    <button type="button" class="close close_current_modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <div class="modal-body">
                <div class="modal-body-custom">
                    <div class="row"> 
        <?php 
        if($thirdpopdata){
            foreach($thirdpopdata as $thirdpopupitem){
        ?>                       
        <div class="col-md-3">
        <div class="modal-boxes for_pdf_box">
            <div class="report-modal-imgg for-icon"> 
               <div class="iconss">
               <?php $tfile = $thirdpopupitem['third_popup_file'];
               //print_r($file); 
               $turl = "";
               $tname = "";
               $ticon = "";
               $tthumbnail ="";
                if($tfile){ 
                    $turl = esc_url($tfile['url']); 
                    $tname = implode(" ", array_slice(explode(" ", str_replace('-', ' ', esc_html($tfile['name']))), 0, 3));
                    $ticon = $tfile['icon'];
                    if($tfile['type']=='image'){
                    $tthumbnail = $tfile['sizes']['thumbnail'];
                    }
                    ?> 
               <?php } ?>
                <div>
                <?php if(!empty($tthumbnail)){ ?>
                   <a href="<?= $turl; ?>" target="_blank">
                   <img src="<?= $tthumbnail; ?>" alt=""> 
                   </a> 
               <?php }else{ ?>
                <a href="<?= $turl; ?>" target="_blank">
                   <img src="<?= $ticon; ?>" alt="">
                   </a>  
               <?php } ?>
               </div> 
               </div> 
            </div>
            <div class="modal-boxes-info">
                <a href="<?= $turl; ?>" target="_blank">
                <h4><?= (!empty($tname)) ? $tname.'...' : ''; ?></h4>
                </a>
            </div>
            <div class="drop-list">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </div>
        <div class="dropdown-custom">
            <ul class="share-frst">
                <li>
                    <a href="#">
                    <i class="fa fa-share-alt" aria-hidden="true"></i>

                        <span>Share</span>
                    </a>
                    <ul class="share-inner">
                        <li>
                        <a href="https://www.pinterest.com/pin/create/button/?url=urlencode(<?= $turl ?>)">
                            <i class="fa-brands fa-pinterest"></i>
                                <span>Pinterest</span>
                            </a>
                        </li>
                        <li>
                        <a href='https://api.whatsapp.com/send?text=<?php echo urlencode("Nvcentralservices:" .$turl) ?>' target="_blank">
                            <i class="fa-brands fa-whatsapp"></i>
                                <span>whatsapp</span>
                            </a>
                        </li>  
                    </ul>
                </li>
                <li>
                    <a href="<?= $turl ?>" download="">
                    <i class="fa fa-download" aria-hidden="true"></i>
                        <span>Download</span>
                    </a>
                </li>
            </ul>
        </div>
        </div>
    </div>    
<?php } } ?>
</div>
</div>
</div>
</div>
</div>
</div>
<?php }
 }else{ ?>
    <div class="col-md-3">
        <div class="modal-boxes for_pdf_box">
            <div class="report-modal-imgg for-icon"> 
               <div class="iconss">
               <?php $sfile = $popitem['second_popup_file'];
               //print_r($file); 
               $surl = "";
               $sname = "";
               $sicon = "";
               $sthumbnail ="";
                if($sfile){ 
                    $surl = esc_url($sfile['url']); 
                    $sname = implode(" ", array_slice(explode(" ", str_replace('-', ' ', esc_html($sfile['name']))), 0, 3));
                    $sicon = $sfile['icon'];
                    if($sfile['type']=='image'){
                    $sthumbnail = $sfile['sizes']['thumbnail'];
                    }
                    ?> 
               <?php } ?>
                <div>
                <?php if(!empty($sthumbnail)){ ?>
                   <a href="<?= $surl; ?>" target="_blank">
                   <img src="<?= $sthumbnail; ?>" alt=""> 
                   </a> 
               <?php }else{ ?>
                <a href="<?= $surl; ?>" target="_blank">
                    <img src="<?= $sicon; ?>" alt="">  
                </a>
               <?php } ?>
               </div> 
               </div> 
            </div>
            <div class="modal-boxes-info">
            <a href="<?= $surl; ?>" target="_blank">
                <h4><?= (!empty($sname)) ? $sname.'...' : ''; ?></h4>
            </a>
            </div>
            <div class="drop-list">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </div>
        <div class="dropdown-custom">
            <ul class="share-frst">
                <li>
                    <a href="#">
                    <i class="fa fa-share-alt" aria-hidden="true"></i>

                        <span>Share</span>
                    </a>
                    <ul class="share-inner">
                        <li>
                        <a href="https://www.pinterest.com/pin/create/button/?url=urlencode(<?= $surl ?>)">
                            <i class="fa-brands fa-pinterest"></i>
                                <span>Pinterest</span>
                            </a>
                        </li>
                        <li>
                        <a href='https://api.whatsapp.com/send?text=<?php echo urlencode("Nvcentralservices:" .$surl) ?>' target="_blank">
                            <i class="fa-brands fa-whatsapp"></i>
                                <span>whatsapp</span>
                            </a>
                        </li>  
                    </ul>
                </li>
                <li>
                    <a href="<?= $surl ?>" download="">
                    <i class="fa fa-download" aria-hidden="true"></i>
                        <span>Download</span>
                    </a>
                </li>
            </ul>
        </div>
        </div>
    </div>
             <?php }
            } 
                    }
                ?>                     
                    </div>
                </div>
                </div>
                </div>
              </div>
            </div>
    <?php 
            }
            }else{ ?>
    <div class="col-md-3">
        <div class="modal-boxes for_pdf_box">
            <div class="report-modal-imgg for-icon"> 
               <div class="iconss">
               <?php 
               $file = $itemrow['choose_your_file'];
               $url = "";
               $name = "";
               $icon = "";
               $thumbnail ="";
                if($file){ 
                    $url = esc_url($file['url']); 
                    $name = implode(" ", array_slice(explode(" ", str_replace('-', ' ', esc_html($file['name']))), 0, 3));
                    $icon = $file['icon'];
                    if($file['type']=='image'){
                    $thumbnail = $file['sizes']['thumbnail'];
                    }
                    ?> 
               <?php } ?>
                <div>
                <?php if(!empty($thumbnail)){ ?>
                    <a href="<?= $url; ?>" target="_blank">
                    <img src="<?= $thumbnail; ?>" alt="">  
                    </a>
                <?php }else{ ?>
                    <a href="<?= $url; ?>" target="_blank">
                    <img src="<?= $icon; ?>" alt="">
                    </a>  
               <?php } ?>
               </div> 
               </div> 
            </div>
            <div class="modal-boxes-info">
                <a href="<?= $url; ?>" target="_blank">
                <h4><?= (!empty($name)) ? $name.'...' : ''; ?></h4>
                </a>
            </div>
            <div class="drop-list">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </div>
        <div class="dropdown-custom">
            <ul class="share-frst">
                <li>
                    <a href="#">
                    <i class="fa fa-share-alt" aria-hidden="true"></i>
                        <span>Share</span>
                    </a>
                    <ul class="share-inner">
                        <li>
                        <a href="https://www.pinterest.com/pin/create/button/?url=urlencode(<?= $url ?>)">
                            <i class="fa-brands fa-pinterest"></i>
                                <span>Pinterest</span>
                            </a>
                        </li>
                        <li>
                        <a href='https://api.whatsapp.com/send?text=<?php echo urlencode("Nvcentralservices:" .$url) ?>' target="_blank">
                            <i class="fa-brands fa-whatsapp"></i>
                                <span>whatsapp</span>
                            </a>
                        </li>                        
                    </ul>
                </li>
                <li>
                    <a href="<?= $url ?>" download="">
                    <i class="fa fa-download" aria-hidden="true"></i>
                        <span>Download</span>
                    </a>
                </li>
            </ul>
        </div>
        </div>
    </div>
<?php
    }
 }  
} 
?> 
</div>
</div>
</div>
</div>
</div>
</div>
<?php elseif( get_row_layout() == 'post_google_maps' ): ?>
    <li>
        <a href="#" data-toggle="modal" data-target="#exampleModal-m2">
            <div class="pdf-img">
            <?php $m_icon = get_sub_field('maps_icon', $mid);
                if(!empty($m_icon)){  ?>
                <img src="<?= $m_icon; ?>" alt="">
            <?php } ?>
            </div>
            <span><?= get_the_title(); ?></span>
        </a>
    </li>
    <div class="modal fade" id="exampleModal-m2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= get_sub_field('maps_title', $mid) ?? ''; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body-custom">
                   <h2><?= get_sub_field('maps_subtitle', $mid) ?? ''; ?></h2>
                       <?= get_sub_field('Maps', $mid) ?? ''; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php elseif( get_row_layout() == 'board_of_directors' ): ?>
        <li>
            <a href="#" data-toggle="modal" data-target="#exampleModalm3">
                <div class="pdf-img">
            <?php $b_icon = get_sub_field('board_icon', $mid);
                if(!empty($b_icon)){  ?>
                <img src="<?= $b_icon; ?>" alt="">
            <?php } ?>
                </div>
                <span><?= get_the_title(); ?></span>
            </a>
        </li>
    <div class="modal fade" id="exampleModalm3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= get_sub_field('board_title', $mid) ?? ''; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body-custom">
                        <?= get_sub_field('board_description', $mid) ?? ''; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <?php
     endif; 
   endwhile;
endif;
         }
     }
    wp_reset_postdata();
?> 
</ul>
</div>
<?php  } if(in_array('events',$roles) || in_array('administrator',$roles)){ ?>
<div class="community-left-each">
<div class="title-icon-new">
<div class="title-icon-imgg">
<img src="<?= get_site_url(); ?>/wp-content/uploads/2023/10/ff2.png" alt="">
</div>
<h3>Events</h3>
</div>
<ul>
<?php 
$args = 
[
'post_type' => 'community_events',
'post_status'=> 'publish',
'order'    => 'ASC',
'posts_per_page'=>-1
];
$query = new WP_Query($args);
if($query->have_posts()){
while($query->have_posts()){
$query->the_post();
$id = get_the_ID();
if (have_rows('post_type_content')) :
                while (have_rows('post_type_content')) : the_row();
            if( get_row_layout() == 'post_type_pdf' ):
           ?>
        <li> 
        <?php $pdf = get_sub_field('pdf_url', $id ); ?>
        <a href="<?= (!empty($pdf)) ? esc_url($pdf['url']) : '#'; ?>" target="_blank">
        <div class="pdf-img">
        <?php $icon = get_sub_field('file_icon', $id );
        if($icon){ ?>                          
          <img src="<?= $icon; ?>" alt="">
      <?php } ?>
        </div>
            <span><?= get_the_title(); ?></span>
        </a>
        </li>

    <?php
    elseif( get_row_layout() == 'post_board_reports' ):
    ?>
    <li>
        <a href="#" data-toggle="modal" data-target="#exampleModal-e<?= $id; ?>">
            <div class="pdf-img">
             <img src="<?= get_site_url(); ?>/wp-content/uploads/2023/10/folder.png" alt="">
            </div>
            <span><?= get_the_title(); ?></span>
        </a>
    </li>
    <div class="modal fade" id="exampleModal-e<?= $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= (!empty(get_sub_field('board_title', $id ))) ? get_sub_field('board_title', $id ) : '';  ?></h5>
                    <div class="back-new">
                        <h6>Back</h6>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <div class="modal-body-custom">
                    <h2><?= get_sub_field('board_subtitle', $id ) ?? ''; ?></h2>
                    <div class="row"> 
                <?php 
                $p=0;
                $item = get_sub_field('board_report_item', $id );
                //print_r($item);
                if(!empty($item)){ 
                   foreach($item as $itemrow){ 
                    $p++;
                    $filetype = $itemrow['attach_file_type'];
                   if($filetype == 0){
                    ?>                      
                <div class="col-md-3">
                    <div class="modal-boxes">
                        <div class="report-modal-imgg" model="Modal_new_folder_e<?= $p; ?>"> 
                            <div> 
                                <img src="<?= get_site_url(); ?>/wp-content/uploads/2023/10/folder.png" alt="" class="custom_img">
                            </div>
                            <div class="modal-boxes-info">
                            <h4><?= $itemrow['board_plan'] ?? ''; ?></h4>
                            </div>
                        </div>  
                    </div>
                </div> 
    <?php 
    $internal = $itemrow['internal_folder'];
    if($internal==1){
    $popdata = $itemrow['internal_popup'];
    ?>
    <div class="modal fade" id="Modal_new_folder_e<?= $p; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header second-model">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <div class="back-new">
                        <h6>Back</h6>
                    </div>
                    <button type="button" class="close close_current_modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <div class="modal-body">
                <div class="modal-body-custom">
                    <div class="row">
                        <?php 
                        $in =0;
                        if(!empty($popdata)){ 
                            foreach($popdata as $popitem){
                            $in++;
                            $interfolder = $popitem['second_file_type'];
                            if($interfolder ==0){
                            ?>               
                        <div class="col-md-3">
                            <div class="modal-boxes">
                        <div class="report-modal-imgg" model="Modal_internal_folder_e<?= $in; ?>"> 
                             <div> 
                                <img src="<?= get_site_url(); ?>/wp-content/uploads/2023/10/folder.png" alt="" class="custom_img">
                            </div>
                            <div class="modal-boxes-info">
                            <h4><?= $popitem['folder_name'] ?? ''; ?></h4>
                            </div>
                        </div>
                    </div>
                    </div> 
        <?php 
        $thirdpopup = $popitem['third_internal_folder'];
        if($thirdpopup==1){
            $thirdpopdata = $popitem['third_popup_data'];
        ?>
         <div class="modal fade" id="Modal_internal_folder_e<?= $in; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header second-model">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <div class="back-new">
                        <h6>Back</h6>
                    </div>
                    <button type="button" class="close close_current_modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <div class="modal-body">
                <div class="modal-body-custom">
                    <div class="row"> 
        <?php 
        if($thirdpopdata){
            foreach($thirdpopdata as $thirdpopupitem){
        ?>                       
        <div class="col-md-3">
        <div class="modal-boxes for_pdf_box">
            <div class="report-modal-imgg for-icon"> 
               <div class="iconss">
               <?php $tfile = $thirdpopupitem['third_popup_file'];
               //print_r($file); 
               $turl = "";
               $tname = "";
               $ticon = "";
               $tthumbnail ="";
                if($tfile){ 
                    $turl = esc_url($tfile['url']); 
                    $tname = implode(" ", array_slice(explode(" ", str_replace('-', ' ', esc_html($tfile['name']))), 0, 3));
                    $ticon = $tfile['icon'];
                    if($tfile['type']=='image'){
                    $tthumbnail = $tfile['sizes']['thumbnail'];
                    }
                    ?> 
               <?php } ?>
                <div>
                <?php if(!empty($tthumbnail)){ ?>
                   <a href="<?= $turl; ?>" target="_blank">
                   <img src="<?= $tthumbnail; ?>" alt=""> 
                   </a> 
               <?php }else{ ?>
                <a href="<?= $turl; ?>" target="_blank">
                   <img src="<?= $ticon; ?>" alt="">
                   </a>  
               <?php } ?>
               </div> 
               </div> 
            </div>
            <div class="modal-boxes-info">
                <a href="<?= $turl; ?>" target="_blank">
                <h4><?= (!empty($tname)) ? $tname.'...' : ''; ?></h4>
                </a>
            </div>
            <div class="drop-list">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </div>
        <div class="dropdown-custom">
            <ul class="share-frst">
                <li>
                    <a href="#">
                    <i class="fa fa-share-alt" aria-hidden="true"></i>

                        <span>Share</span>
                    </a>
                    <ul class="share-inner">
                        <li>
                        <a href="https://www.pinterest.com/pin/create/button/?url=urlencode(<?= $turl ?>)">
                            <i class="fa-brands fa-pinterest"></i>
                                <span>Pinterest</span>
                            </a>
                        </li>
                        <li>
                        <a href='https://api.whatsapp.com/send?text=<?php echo urlencode("Nvcentralservices:" .$turl) ?>' target="_blank">
                            <i class="fa-brands fa-whatsapp"></i>
                                <span>whatsapp</span>
                            </a>
                        </li>  
                    </ul>
                </li>
                <li>
                    <a href="<?= $turl ?>" download="">
                    <i class="fa fa-download" aria-hidden="true"></i>
                        <span>Download</span>
                    </a>
                </li>
            </ul>
        </div>
        </div>
    </div>    
<?php } } ?>
</div>
</div>
</div>
</div>
</div>
</div>
<?php }
 }else{ ?>
    <div class="col-md-3">
        <div class="modal-boxes for_pdf_box">
            <div class="report-modal-imgg for-icon"> 
               <div class="iconss">
               <?php $sfile = $popitem['second_popup_file'];
               //print_r($file); 
               $surl = "";
               $sname = "";
               $sicon = "";
               $sthumbnail ="";
                if($sfile){ 
                    $surl = esc_url($sfile['url']); 
                    $sname = implode(" ", array_slice(explode(" ", str_replace('-', ' ', esc_html($sfile['name']))), 0, 3));
                    $sicon = $sfile['icon'];
                    if($sfile['type']=='image'){
                    $sthumbnail = $sfile['sizes']['thumbnail'];
                    }
                    ?> 
               <?php } ?>
                <div>
                <?php if(!empty($sthumbnail)){ ?>
                   <a href="<?= $surl; ?>" target="_blank">
                   <img src="<?= $sthumbnail; ?>" alt=""> 
                   </a> 
               <?php }else{ ?>
                <a href="<?= $surl; ?>" target="_blank">
                    <img src="<?= $sicon; ?>" alt="">  
                </a>
               <?php } ?>
               </div> 
               </div> 
            </div>
            <div class="modal-boxes-info">
            <a href="<?= $surl; ?>" target="_blank">
                <h4><?= (!empty($sname)) ? $sname.'...' : ''; ?></h4>
            </a>
            </div>
            <div class="drop-list">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </div>
        <div class="dropdown-custom">
            <ul class="share-frst">
                <li>
                    <a href="#">
                    <i class="fa fa-share-alt" aria-hidden="true"></i>

                        <span>Share</span>
                    </a>
                    <ul class="share-inner">
                        <li>
                        <a href="https://www.pinterest.com/pin/create/button/?url=urlencode(<?= $surl ?>)">
                            <i class="fa-brands fa-pinterest"></i>
                                <span>Pinterest</span>
                            </a>
                        </li>
                        <li>
                        <a href='https://api.whatsapp.com/send?text=<?php echo urlencode("Nvcentralservices:" .$surl) ?>' target="_blank">
                            <i class="fa-brands fa-whatsapp"></i>
                                <span>whatsapp</span>
                            </a>
                        </li>  
                    </ul>
                </li>
                <li>
                    <a href="<?= $surl ?>" download="">
                    <i class="fa fa-download" aria-hidden="true"></i>
                        <span>Download</span>
                    </a>
                </li>
            </ul>
        </div>
        </div>
    </div>
             <?php }
            } 
                    }
                ?>                     
                    </div>
                </div>
                </div>
                </div>
              </div>
            </div>
    <?php 
            }
            }else{ ?>
    <div class="col-md-3">
        <div class="modal-boxes for_pdf_box">
            <div class="report-modal-imgg for-icon"> 
               <div class="iconss">
               <?php 
               $file = $itemrow['choose_your_file'];
               $url = "";
               $name = "";
               $icon = "";
               $thumbnail ="";
                if($file){ 
                    $url = esc_url($file['url']); 
                    $name = implode(" ", array_slice(explode(" ", str_replace('-', ' ', esc_html($file['name']))), 0, 3));
                    $icon = $file['icon'];
                    if($file['type']=='image'){
                    $thumbnail = $file['sizes']['thumbnail'];
                    }
                    ?> 
               <?php } ?>
                <div>
                <?php if(!empty($thumbnail)){ ?>
                    <a href="<?= $url; ?>" target="_blank">
                    <img src="<?= $thumbnail; ?>" alt="">  
                    </a>
                <?php }else{ ?>
                    <a href="<?= $url; ?>" target="_blank">
                    <img src="<?= $icon; ?>" alt="">
                    </a>  
               <?php } ?>
               </div> 
               </div> 
            </div>
            <div class="modal-boxes-info">
                <a href="<?= $url; ?>" target="_blank">
                <h4><?= (!empty($name)) ? $name.'...' : ''; ?></h4>
                </a>
            </div>
            <div class="drop-list">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </div>
        <div class="dropdown-custom">
            <ul class="share-frst">
                <li>
                    <a href="#">
                    <i class="fa fa-share-alt" aria-hidden="true"></i>
                        <span>Share</span>
                    </a>
                    <ul class="share-inner">
                        <li>
                        <a href="https://www.pinterest.com/pin/create/button/?url=urlencode(<?= $url ?>)">
                            <i class="fa-brands fa-pinterest"></i>
                                <span>Pinterest</span>
                            </a>
                        </li>
                        <li>
                        <a href='https://api.whatsapp.com/send?text=<?php echo urlencode("Nvcentralservices:" .$url) ?>' target="_blank">
                            <i class="fa-brands fa-whatsapp"></i>
                                <span>whatsapp</span>
                            </a>
                        </li>                        
                    </ul>
                </li>
                <li>
                    <a href="<?= $url ?>" download="">
                    <i class="fa fa-download" aria-hidden="true"></i>
                        <span>Download</span>
                    </a>
                </li>
            </ul>
        </div>
        </div>
    </div>
<?php
    }
 }  
} 
?> 
</div>
</div>
</div>
</div>
</div>
</div>
<?php elseif( get_row_layout() == 'post_google_maps' ): ?>
    <li>
        <a href="#" data-toggle="modal" data-target="#exampleModal-e2">
            <div class="pdf-img">
            <?php $m_icon = get_sub_field('maps_icon', $id );
                if(!empty($m_icon)){  ?>
                <img src="<?= $m_icon; ?>" alt="">
            <?php } ?>
            </div>
            <span><?= get_the_title(); ?></span>
        </a>
    </li>
    <div class="modal fade" id="exampleModal-e2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= get_sub_field('maps_title', $id) ?? ''; ?></h5>
                    <div class="back-new">
                        <h6>Back</h6>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body-custom">
                   <h2><?= get_sub_field('maps_subtitle', $id) ?? ''; ?></h2>
                       <?= get_sub_field('Maps', $id) ?? ''; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php elseif( get_row_layout() == 'board_of_directors' ): ?>
        <li>
            <a href="#" data-toggle="modal" data-target="#exampleModale3">
                <div class="pdf-img">
            <?php $b_icon = get_sub_field('board_icon', $id);
                if(!empty($b_icon)){  ?>
                <img src="<?= $b_icon; ?>" alt="">
            <?php } ?>
                </div>
                <span><?= get_the_title(); ?></span>
            </a>
        </li>
    <div class="modal fade" id="exampleModale3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= get_sub_field('board_title', $id) ?? ''; ?></h5>
                    <div class="back-new">
                        <h6>Back</h6>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body-custom">
                        <?= get_sub_field('board_description', $id) ?? ''; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <?php
     endif; 
   endwhile;
endif;
     }
   }
wp_reset_postdata();
?> 
</ul>
</div>
<?php  } if(in_array('hr_role',$roles) || in_array('administrator',$roles)){ ?>
<div class="community-left-each">
<div class="title-icon-new">
<div class="title-icon-imgg">
<img src="<?= get_site_url(); ?>/wp-content/uploads/2023/10/ff3.png" alt="">
</div>
<h3>HR</h3>
</div>
<ul>
<?php 
$args = [  'post_type' => 'community_hr',
           'post_status'=> 'publish',
           'order'    => 'ASC',
           'posts_per_page'=>-1
        ];
$query = new WP_Query($args);
if($query->have_posts()){
while($query->have_posts()){
$query->the_post();   
$id = get_the_ID();
if (have_rows('post_type_content')) :
                while (have_rows('post_type_content')) : the_row();
            if( get_row_layout() == 'post_type_pdf' ):
           ?>
        <li> 
        <?php $pdf = get_sub_field('pdf_url', $id ); ?>
        <a href="<?= (!empty($pdf)) ? esc_url($pdf['url']) : '#'; ?>" target="_blank">
        <div class="pdf-img">
        <?php $icon = get_sub_field('file_icon', $id );
        if($icon){ ?>                          
          <img src="<?= $icon; ?>" alt="">
      <?php } ?>
        </div>
            <span><?= get_the_title(); ?></span>
        </a>
        </li>

    <?php
    elseif( get_row_layout() == 'post_board_reports' ):
    ?>
    <li>
        <a href="#" data-toggle="modal" data-target="#exampleModal-h<?= $id; ?>">
            <div class="pdf-img">
             <img src="<?= get_site_url(); ?>/wp-content/uploads/2023/10/folder.png" alt="">
            </div>
            <span><?= get_the_title(); ?></span>
        </a>
    </li>
    <div class="modal fade" id="exampleModal-h<?= $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= (!empty(get_sub_field('board_title', $id ))) ? get_sub_field('board_title', $id ) : '';  ?></h5>
                    <div class="back-new">
                        <h6>Back</h6>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <div class="modal-body-custom">
                    <h2><?= get_sub_field('board_subtitle', $id ) ?? ''; ?></h2>
                    <div class="row"> 
                <?php 
                $p=0;
                $item = get_sub_field('board_report_item', $id );
                //print_r($item);
                if(!empty($item)){ 
                   foreach($item as $itemrow){ 
                    $p++;
                    $filetype = $itemrow['attach_file_type'];
                   if($filetype == 0){
                    ?>                      
                <div class="col-md-3">
                    <div class="modal-boxes">
                        <div class="report-modal-imgg" model="Modal_new_folder_h<?= $p; ?>"> 
                            <div> 
                                <img src="<?= get_site_url(); ?>/wp-content/uploads/2023/10/folder.png" alt="" class="custom_img">
                            </div>
                            <div class="modal-boxes-info">
                            <h4><?= $itemrow['board_plan'] ?? ''; ?></h4>
                            </div>
                        </div>  
                    </div>
                </div> 
    <?php 
    $internal = $itemrow['internal_folder'];
    if($internal==1){
    $popdata = $itemrow['internal_popup'];
    ?>
    <div class="modal fade" id="Modal_new_folder_h<?= $p; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header second-model">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close close_current_modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <div class="modal-body">
                <div class="modal-body-custom">
                    <div class="row">
                        <?php 
                        $in =0;
                        if(!empty($popdata)){ 
                            foreach($popdata as $popitem){
                            $in++;
                            $interfolder = $popitem['second_file_type'];
                            if($interfolder ==0){
                            ?>               
                        <div class="col-md-3">
                            <div class="modal-boxes">
                        <div class="report-modal-imgg" model="Modal_internal_folder_h<?= $in; ?>"> 
                             <div> 
                                <img src="<?= get_site_url(); ?>/wp-content/uploads/2023/10/folder.png" alt="" class="custom_img">
                            </div>
                            <div class="modal-boxes-info">
                            <h4><?= $popitem['folder_name'] ?? ''; ?></h4>
                            </div>
                        </div>
                    </div>
                    </div> 
        <?php 
        $thirdpopup = $popitem['third_internal_folder'];
        if($thirdpopup==1){
            $thirdpopdata = $popitem['third_popup_data'];
        ?>
         <div class="modal fade" id="Modal_internal_folder_h<?= $in; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header second-model">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close close_current_modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <div class="modal-body">
                <div class="modal-body-custom">
                    <div class="row"> 
        <?php 
        if($thirdpopdata){
            foreach($thirdpopdata as $thirdpopupitem){
        ?>                       
        <div class="col-md-3">
        <div class="modal-boxes for_pdf_box">
            <div class="report-modal-imgg for-icon"> 
               <div class="iconss">
               <?php $tfile = $thirdpopupitem['third_popup_file'];
               //print_r($file); 
               $turl = "";
               $tname = "";
               $ticon = "";
               $tthumbnail ="";
                if($tfile){ 
                    $turl = esc_url($tfile['url']); 
                    $tname = implode(" ", array_slice(explode(" ", str_replace('-', ' ', esc_html($tfile['name']))), 0, 3));
                    $ticon = $tfile['icon'];
                    if($tfile['type']=='image'){
                    $tthumbnail = $tfile['sizes']['thumbnail'];
                    }
                    ?> 
               <?php } ?>
                <div>
                <?php if(!empty($tthumbnail)){ ?>
                   <a href="<?= $turl; ?>" target="_blank">
                   <img src="<?= $tthumbnail; ?>" alt=""> 
                   </a> 
               <?php }else{ ?>
                <a href="<?= $turl; ?>" target="_blank">
                   <img src="<?= $ticon; ?>" alt="">
                   </a>  
               <?php } ?>
               </div> 
               </div> 
            </div>
            <div class="modal-boxes-info">
                <a href="<?= $turl; ?>" target="_blank">
                <h4><?= (!empty($tname)) ? $tname.'...' : ''; ?></h4>
                </a>
            </div>
            <div class="drop-list">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </div>
        <div class="dropdown-custom">
            <ul class="share-frst">
                <li>
                    <a href="#">
                    <i class="fa fa-share-alt" aria-hidden="true"></i>

                        <span>Share</span>
                    </a>
                    <ul class="share-inner">
                        <li>
                        <a href="https://www.pinterest.com/pin/create/button/?url=urlencode(<?= $turl ?>)">
                            <i class="fa-brands fa-pinterest"></i>
                                <span>Pinterest</span>
                            </a>
                        </li>
                        <li>
                        <a href='https://api.whatsapp.com/send?text=<?php echo urlencode("Nvcentralservices:" .$turl) ?>' target="_blank">
                            <i class="fa-brands fa-whatsapp"></i>
                                <span>whatsapp</span>
                            </a>
                        </li>  
                    </ul>
                </li>
                <li>
                    <a href="<?= $turl ?>" download="">
                    <i class="fa fa-download" aria-hidden="true"></i>
                        <span>Download</span>
                    </a>
                </li>
            </ul>
        </div>
        </div>
    </div>    
<?php } } ?>
</div>
</div>
</div>
</div>
</div>
</div>
<?php }
 }else{ ?>
    <div class="col-md-3">
        <div class="modal-boxes for_pdf_box">
            <div class="report-modal-imgg for-icon"> 
               <div class="iconss">
               <?php $sfile = $popitem['second_popup_file'];
               //print_r($file); 
               $surl = "";
               $sname = "";
               $sicon = "";
               $sthumbnail ="";
                if($sfile){ 
                    $surl = esc_url($sfile['url']); 
                    $sname = implode(" ", array_slice(explode(" ", str_replace('-', ' ', esc_html($sfile['name']))), 0, 3));
                    $sicon = $sfile['icon'];
                    if($sfile['type']=='image'){
                    $sthumbnail = $sfile['sizes']['thumbnail'];
                    }
                    ?> 
               <?php } ?>
                <div>
                <?php if(!empty($sthumbnail)){ ?>
                   <a href="<?= $surl; ?>" target="_blank">
                   <img src="<?= $sthumbnail; ?>" alt=""> 
                   </a> 
               <?php }else{ ?>
                <a href="<?= $surl; ?>" target="_blank">
                    <img src="<?= $sicon; ?>" alt="">  
                </a>
               <?php } ?>
               </div> 
               </div> 
            </div>
            <div class="modal-boxes-info">
            <a href="<?= $surl; ?>" target="_blank">
                <h4><?= (!empty($sname)) ? $sname.'...' : ''; ?></h4>
            </a>
            </div>
            <div class="drop-list">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </div>
        <div class="dropdown-custom">
            <ul class="share-frst">
                <li>
                    <a href="#">
                    <i class="fa fa-share-alt" aria-hidden="true"></i>

                        <span>Share</span>
                    </a>
                    <ul class="share-inner">
                        <li>
                        <a href="https://www.pinterest.com/pin/create/button/?url=urlencode(<?= $surl ?>)">
                            <i class="fa-brands fa-pinterest"></i>
                                <span>Pinterest</span>
                            </a>
                        </li>
                        <li>
                        <a href='https://api.whatsapp.com/send?text=<?php echo urlencode("Nvcentralservices:" .$surl) ?>' target="_blank">
                            <i class="fa-brands fa-whatsapp"></i>
                                <span>whatsapp</span>
                            </a>
                        </li>  
                    </ul>
                </li>
                <li>
                    <a href="<?= $surl ?>" download="">
                    <i class="fa fa-download" aria-hidden="true"></i>
                        <span>Download</span>
                    </a>
                </li>
            </ul>
        </div>
        </div>
    </div>
             <?php }
            } 
                    }
                ?>                     
                    </div>
                </div>
                </div>
                </div>
              </div>
            </div>
    <?php 
            }
            }else{ ?>
    <div class="col-md-3">
        <div class="modal-boxes for_pdf_box">
            <div class="report-modal-imgg for-icon"> 
               <div class="iconss">
               <?php 
               $file = $itemrow['choose_your_file'];
               $url = "";
               $name = "";
               $icon = "";
               $thumbnail ="";
                if($file){ 
                    $url = esc_url($file['url']); 
                    $name = implode(" ", array_slice(explode(" ", str_replace('-', ' ', esc_html($file['name']))), 0, 3));
                    $icon = $file['icon'];
                    if($file['type']=='image'){
                    $thumbnail = $file['sizes']['thumbnail'];
                    }
                    ?> 
               <?php } ?>
                <div>
                <?php if(!empty($thumbnail)){ ?>
                    <a href="<?= $url; ?>" target="_blank">
                    <img src="<?= $thumbnail; ?>" alt="">  
                    </a>
                <?php }else{ ?>
                    <a href="<?= $url; ?>" target="_blank">
                    <img src="<?= $icon; ?>" alt="">
                    </a>  
               <?php } ?>
               </div> 
               </div> 
            </div>
            <div class="modal-boxes-info">
                <a href="<?= $url; ?>" target="_blank">
                <h4><?= (!empty($name)) ? $name.'...' : ''; ?></h4>
                </a>
            </div>
            <div class="drop-list">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </div>
        <div class="dropdown-custom">
            <ul class="share-frst">
                <li>
                    <a href="#">
                    <i class="fa fa-share-alt" aria-hidden="true"></i>
                        <span>Share</span>
                    </a>
                    <ul class="share-inner">
                        <li>
                        <a href="https://www.pinterest.com/pin/create/button/?url=urlencode(<?= $url ?>)">
                            <i class="fa-brands fa-pinterest"></i>
                                <span>Pinterest</span>
                            </a>
                        </li>
                        <li>
                        <a href='https://api.whatsapp.com/send?text=<?php echo urlencode("Nvcentralservices:" .$url) ?>' target="_blank">
                            <i class="fa-brands fa-whatsapp"></i>
                                <span>whatsapp</span>
                            </a>
                        </li>                        
                    </ul>
                </li>
                <li>
                    <a href="<?= $url ?>" download="">
                    <i class="fa fa-download" aria-hidden="true"></i>
                        <span>Download</span>
                    </a>
                </li>
            </ul>
        </div>
        </div>
    </div>
<?php
    }
 }  
} 
?> 
</div>
</div>
</div>
</div>
</div>
</div>
<?php elseif( get_row_layout() == 'post_google_maps' ): ?>
    <li>
        <a href="#" data-toggle="modal" data-target="#exampleModal-h2">
            <div class="pdf-img">
            <?php $m_icon = get_sub_field('maps_icon', $id );
                if(!empty($m_icon)){  ?>
                <img src="<?= $m_icon; ?>" alt="">
            <?php } ?>
            </div>
            <span><?= get_the_title(); ?></span>
        </a>
    </li>
    <div class="modal fade" id="exampleModal-h2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= get_sub_field('maps_title', $id) ?? ''; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body-custom">
                   <h2><?= get_sub_field('maps_subtitle', $id) ?? ''; ?></h2>
                       <?= get_sub_field('Maps', $id) ?? ''; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php elseif( get_row_layout() == 'board_of_directors' ): ?>
        <li>
            <a href="#" data-toggle="modal" data-target="#exampleModalh3">
                <div class="pdf-img">
            <?php $b_icon = get_sub_field('board_icon', $id);
                if(!empty($b_icon)){  ?>
                <img src="<?= $b_icon; ?>" alt="">
            <?php } ?>
                </div>
                <span><?= get_the_title(); ?></span>
            </a>
        </li>
    <div class="modal fade" id="exampleModalh3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= get_sub_field('board_title', $id) ?? ''; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body-custom">
                        <?= get_sub_field('board_description', $id) ?? ''; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <?php
     endif; 
   endwhile;
endif;

    }
}
 wp_reset_postdata();
?> 
</ul>
</div>
<?php  } if(in_array('compliance',$roles) || in_array('administrator',$roles)){ ?>
<div class="community-left-each">
<div class="title-icon-new">
<div class="title-icon-imgg">
<img src="<?= get_site_url(); ?>/wp-content/uploads/2023/10/ff6-1.png" alt="">
</div>
<h3>Compliance</h3>
</div>
<ul>
<?php 
    $args = [
                'post_type' => 'community_compliance',
                'post_status'=> 'publish',
                'order'    => 'ASC',
                'posts_per_page'=>-1
            ];
$query = new WP_Query($args);
if($query->have_posts()){
while($query->have_posts()){
$query->the_post(); 
$id = get_the_ID();
if (have_rows('post_type_content')) :
                while (have_rows('post_type_content')) : the_row();
            if( get_row_layout() == 'post_type_pdf' ):
           ?>
        <li> 
        <?php $pdf = get_sub_field('pdf_url', $id ); ?>
        <a href="<?= (!empty($pdf)) ? esc_url($pdf['url']) : '#'; ?>" target="_blank">
        <div class="pdf-img">
        <?php $icon = get_sub_field('file_icon', $id );
        if($icon){ ?>                          
          <img src="<?= $icon; ?>" alt="">
      <?php } ?>
        </div>
            <span><?= get_the_title(); ?></span>
        </a>
        </li>

    <?php
    elseif( get_row_layout() == 'post_board_reports' ):
    ?>
    <li>
        <a href="#" data-toggle="modal" data-target="#exampleModal-c<?= $id; ?>">
            <div class="pdf-img">
             <img src="<?= get_site_url(); ?>/wp-content/uploads/2023/10/folder.png" alt="">
            </div>
            <span><?= get_the_title(); ?></span>
        </a>
    </li>
    <div class="modal fade" id="exampleModal-c<?= $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= (!empty(get_sub_field('board_title', $id ))) ? get_sub_field('board_title', $id ) : '';  ?></h5>
                    <div class="back-new">
                        <h6>Back</h6>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <div class="modal-body-custom">
                    <h2><?= get_sub_field('board_subtitle', $id ) ?? ''; ?></h2>
                    <div class="row"> 
                <?php 
                $p=0;
                $item = get_sub_field('board_report_item', $id );
                //print_r($item);
                if(!empty($item)){ 
                   foreach($item as $itemrow){ 
                    $p++;
                    $filetype = $itemrow['attach_file_type'];
                   if($filetype == 0){
                    ?>                      
                <div class="col-md-3">
                    <div class="modal-boxes">
                        <div class="report-modal-imgg" model="Modal_new_folder_c<?= $p; ?>"> 
                            <div> 
                                <img src="<?= get_site_url(); ?>/wp-content/uploads/2023/10/folder.png" alt="" class="custom_img">
                            </div>
                            <div class="modal-boxes-info">
                            <h4><?= $itemrow['board_plan'] ?? ''; ?></h4>
                            </div>
                        </div>  
                    </div>
                </div> 
    <?php 
    $internal = $itemrow['internal_folder'];
    if($internal==1){
    $popdata = $itemrow['internal_popup'];
    ?>
    <div class="modal fade" id="Modal_new_folder_c<?= $p; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header second-model">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <div class="back-new">
                        <h6>Back</h6>
                    </div>
                    <button type="button" class="close close_current_modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <div class="modal-body">
                <div class="modal-body-custom">
                    <div class="row">
                        <?php 
                        $in =0;
                        if(!empty($popdata)){ 
                            foreach($popdata as $popitem){
                            $in++;
                            $interfolder = $popitem['second_file_type'];
                            if($interfolder ==0){
                            ?>               
                        <div class="col-md-3">
                            <div class="modal-boxes">
                        <div class="report-modal-imgg" model="Modal_internal_folder_c<?= $in; ?>"> 
                             <div> 
                                <img src="<?= get_site_url(); ?>/wp-content/uploads/2023/10/folder.png" alt="" class="custom_img">
                            </div>
                            <div class="modal-boxes-info">
                            <h4><?= $popitem['folder_name'] ?? ''; ?></h4>
                            </div>
                        </div>
                    </div>
                    </div> 
        <?php 
        $thirdpopup = $popitem['third_internal_folder'];
        if($thirdpopup==1){
            $thirdpopdata = $popitem['third_popup_data'];
        ?>
         <div class="modal fade" id="Modal_internal_folder_c<?= $in; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header second-model">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <div class="back-new">
                        <h6>Back</h6>
                    </div>
                    <button type="button" class="close close_current_modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <div class="modal-body">
                <div class="modal-body-custom">
                    <div class="row"> 
        <?php 
        if($thirdpopdata){
            foreach($thirdpopdata as $thirdpopupitem){
        ?>                       
        <div class="col-md-3">
        <div class="modal-boxes for_pdf_box">
            <div class="report-modal-imgg for-icon"> 
               <div class="iconss">
               <?php $tfile = $thirdpopupitem['third_popup_file'];
               //print_r($file); 
               $turl = "";
               $tname = "";
               $ticon = "";
               $tthumbnail ="";
                if($tfile){ 
                    $turl = esc_url($tfile['url']); 
                    $tname = implode(" ", array_slice(explode(" ", str_replace('-', ' ', esc_html($tfile['name']))), 0, 3));
                    $ticon = $tfile['icon'];
                    if($tfile['type']=='image'){
                    $tthumbnail = $tfile['sizes']['thumbnail'];
                    }
                    ?> 
               <?php } ?>
                <div>
                <?php if(!empty($tthumbnail)){ ?>
                   <a href="<?= $turl; ?>" target="_blank">
                   <img src="<?= $tthumbnail; ?>" alt=""> 
                   </a> 
               <?php }else{ ?>
                <a href="<?= $turl; ?>" target="_blank">
                   <img src="<?= $ticon; ?>" alt="">
                   </a>  
               <?php } ?>
               </div> 
               </div> 
            </div>
            <div class="modal-boxes-info">
                <a href="<?= $turl; ?>" target="_blank">
                <h4><?= (!empty($tname)) ? $tname.'...' : ''; ?></h4>
                </a>
            </div>
            <div class="drop-list">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </div>
        <div class="dropdown-custom">
            <ul class="share-frst">
                <li>
                    <a href="#">
                    <i class="fa fa-share-alt" aria-hidden="true"></i>

                        <span>Share</span>
                    </a>
                    <ul class="share-inner">
                        <li>
                        <a href="https://www.pinterest.com/pin/create/button/?url=urlencode(<?= $turl ?>)">
                            <i class="fa-brands fa-pinterest"></i>
                                <span>Pinterest</span>
                            </a>
                        </li>
                        <li>
                        <a href='https://api.whatsapp.com/send?text=<?php echo urlencode("Nvcentralservices:" .$turl) ?>' target="_blank">
                            <i class="fa-brands fa-whatsapp"></i>
                                <span>whatsapp</span>
                            </a>
                        </li>  
                    </ul>
                </li>
                <li>
                    <a href="<?= $turl ?>" download="">
                    <i class="fa fa-download" aria-hidden="true"></i>
                        <span>Download</span>
                    </a>
                </li>
            </ul>
        </div>
        </div>
    </div>    
<?php } } ?>
</div>
</div>
</div>
</div>
</div>
</div>
<?php }
 }else{ ?>
    <div class="col-md-3">
        <div class="modal-boxes for_pdf_box">
            <div class="report-modal-imgg for-icon"> 
               <div class="iconss">
               <?php $sfile = $popitem['second_popup_file'];
               //print_r($file); 
               $surl = "";
               $sname = "";
               $sicon = "";
               $sthumbnail ="";
                if($sfile){ 
                    $surl = esc_url($sfile['url']); 
                    $sname = implode(" ", array_slice(explode(" ", str_replace('-', ' ', esc_html($sfile['name']))), 0, 3));
                    $sicon = $sfile['icon'];
                    if($sfile['type']=='image'){
                    $sthumbnail = $sfile['sizes']['thumbnail'];
                    }
                    ?> 
               <?php } ?>
                <div>
                <?php if(!empty($sthumbnail)){ ?>
                   <a href="<?= $surl; ?>" target="_blank">
                   <img src="<?= $sthumbnail; ?>" alt=""> 
                   </a> 
               <?php }else{ ?>
                <a href="<?= $surl; ?>" target="_blank">
                    <img src="<?= $sicon; ?>" alt="">  
                </a>
               <?php } ?>
               </div> 
               </div> 
            </div>
            <div class="modal-boxes-info">
            <a href="<?= $surl; ?>" target="_blank">
                <h4><?= (!empty($sname)) ? $sname.'...' : ''; ?></h4>
            </a>
            </div>
            <div class="drop-list">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </div>
        <div class="dropdown-custom">
            <ul class="share-frst">
                <li>
                    <a href="#">
                    <i class="fa fa-share-alt" aria-hidden="true"></i>

                        <span>Share</span>
                    </a>
                    <ul class="share-inner">
                        <li>
                        <a href="https://www.pinterest.com/pin/create/button/?url=urlencode(<?= $surl ?>)">
                            <i class="fa-brands fa-pinterest"></i>
                                <span>Pinterest</span>
                            </a>
                        </li>
                        <li>
                        <a href='https://api.whatsapp.com/send?text=<?php echo urlencode("Nvcentralservices:" .$surl) ?>' target="_blank">
                            <i class="fa-brands fa-whatsapp"></i>
                                <span>whatsapp</span>
                            </a>
                        </li>  
                    </ul>
                </li>
                <li>
                    <a href="<?= $surl ?>" download="">
                    <i class="fa fa-download" aria-hidden="true"></i>
                        <span>Download</span>
                    </a>
                </li>
            </ul>
        </div>
        </div>
    </div>
             <?php }
            } 
                    }
                ?>                     
                    </div>
                </div>
                </div>
                </div>
              </div>
            </div>
    <?php 
            }
            }else{ ?>
    <div class="col-md-3">
        <div class="modal-boxes for_pdf_box">
            <div class="report-modal-imgg for-icon"> 
               <div class="iconss">
               <?php 
               $file = $itemrow['choose_your_file'];
               $url = "";
               $name = "";
               $icon = "";
               $thumbnail ="";
                if($file){ 
                    $url = esc_url($file['url']); 
                    $name = implode(" ", array_slice(explode(" ", str_replace('-', ' ', esc_html($file['name']))), 0, 3));
                    $icon = $file['icon'];
                    if($file['type']=='image'){
                    $thumbnail = $file['sizes']['thumbnail'];
                    }
                    ?> 
               <?php } ?>
                <div>
                <?php if(!empty($thumbnail)){ ?>
                    <a href="<?= $url; ?>" target="_blank">
                    <img src="<?= $thumbnail; ?>" alt="">  
                    </a>
                <?php }else{ ?>
                    <a href="<?= $url; ?>" target="_blank">
                    <img src="<?= $icon; ?>" alt="">
                    </a>  
               <?php } ?>
               </div> 
               </div> 
            </div>
            <div class="modal-boxes-info">
                <a href="<?= $url; ?>" target="_blank">
                <h4><?= (!empty($name)) ? $name.'...' : ''; ?></h4>
                </a>
            </div>
            <div class="drop-list">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </div>
        <div class="dropdown-custom">
            <ul class="share-frst">
                <li>
                    <a href="#">
                    <i class="fa fa-share-alt" aria-hidden="true"></i>
                        <span>Share</span>
                    </a>
                    <ul class="share-inner">
                        <li>
                        <a href="https://www.pinterest.com/pin/create/button/?url=urlencode(<?= $url ?>)">
                            <i class="fa-brands fa-pinterest"></i>
                                <span>Pinterest</span>
                            </a>
                        </li>
                        <li>
                        <a href='https://api.whatsapp.com/send?text=<?php echo urlencode("Nvcentralservices:" .$url) ?>' target="_blank">
                            <i class="fa-brands fa-whatsapp"></i>
                                <span>whatsapp</span>
                            </a>
                        </li>                        
                    </ul>
                </li>
                <li>
                    <a href="<?= $url ?>" download="">
                    <i class="fa fa-download" aria-hidden="true"></i>
                        <span>Download</span>
                    </a>
                </li>
            </ul>
        </div>
        </div>
    </div>
<?php
    }
 }  
} 
?> 
</div>
</div>
</div>
</div>
</div>
</div>
<?php elseif( get_row_layout() == 'post_google_maps' ): ?>
    <li>
        <a href="#" data-toggle="modal" data-target="#exampleModal-c2">
            <div class="pdf-img">
            <?php $m_icon = get_sub_field('maps_icon', $id );
                if(!empty($m_icon)){  ?>
                <img src="<?= $m_icon; ?>" alt="">
            <?php } ?>
            </div>
            <span><?= get_the_title(); ?></span>
        </a>
    </li>
    <div class="modal fade" id="exampleModal-c2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= get_sub_field('maps_title', $id) ?? ''; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body-custom">
                   <h2><?= get_sub_field('maps_subtitle', $id) ?? ''; ?></h2>
                       <?= get_sub_field('Maps', $id) ?? ''; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php elseif( get_row_layout() == 'board_of_directors' ): ?>
        <li>
            <a href="#" data-toggle="modal" data-target="#exampleModalc3">
                <div class="pdf-img">
            <?php $b_icon = get_sub_field('board_icon', $id);
                if(!empty($b_icon)){  ?>
                <img src="<?= $b_icon; ?>" alt="">
            <?php } ?>
                </div>
                <span><?= get_the_title(); ?></span>
            </a>
        </li>
    <div class="modal fade" id="exampleModalc3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= get_sub_field('board_title', $id) ?? ''; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body-custom">
                        <?= get_sub_field('board_description', $id) ?? ''; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <?php
     endif; 
   endwhile;
endif;

     }

 }
wp_reset_postdata();
    ?> 
</ul>
</div>
<?php  } if(in_array('it_depart',$roles) || in_array('administrator',$roles)){ ?>  
<div class="community-left-each">
<div class="title-icon-new">
<div class="title-icon-imgg">
<img src="<?= get_site_url(); ?>/wp-content/uploads/2023/10/ff7.png" alt="">
</div>
<h3>IT</h3>
</div>
<ul>
<?php 
$args = [
            'post_type' => 'community_it',
            'post_status'=> 'publish',
            'order'    => 'ASC',
            'posts_per_page'=>-1
        ];
$query = new WP_Query($args);
if($query->have_posts()){
while($query->have_posts()){
$query->the_post();   
$id = get_the_ID();
if (have_rows('post_type_content')) :
                while (have_rows('post_type_content')) : the_row();
            if( get_row_layout() == 'post_type_pdf' ):
           ?>
        <li> 
        <?php $pdf = get_sub_field('pdf_url', $id ); ?>
        <a href="<?= (!empty($pdf)) ? esc_url($pdf['url']) : '#'; ?>" target="_blank">
        <div class="pdf-img">
        <?php $icon = get_sub_field('file_icon', $id );
        if($icon){ ?>                          
          <img src="<?= $icon; ?>" alt="">
      <?php } ?>
        </div>
            <span><?= get_the_title(); ?></span>
        </a>
        </li>

    <?php
    elseif( get_row_layout() == 'post_board_reports' ):
    ?>
    <li>
        <a href="#" data-toggle="modal" data-target="#exampleModal-i<?= $id; ?>">
            <div class="pdf-img">
             <img src="<?= get_site_url(); ?>/wp-content/uploads/2023/10/folder.png" alt="">
            </div>
            <span><?= get_the_title(); ?></span>
        </a>
    </li>
    <div class="modal fade" id="exampleModal-i<?= $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= (!empty(get_sub_field('board_title', $id ))) ? get_sub_field('board_title', $id ) : '';  ?></h5>
                    <div class="back-new">
                        <h6>Back</h6>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <div class="modal-body-custom">
                    <h2><?= get_sub_field('board_subtitle', $id ) ?? ''; ?></h2>
                    <div class="row"> 
                <?php 
                $p=0;
                $item = get_sub_field('board_report_item', $id );
                //print_r($item);
                if(!empty($item)){ 
                   foreach($item as $itemrow){ 
                    $p++;
                    $filetype = $itemrow['attach_file_type'];
                   if($filetype == 0){
                    ?>                      
                <div class="col-md-3">
                    <div class="modal-boxes">
                        <div class="report-modal-imgg" model="Modal_new_folder_i<?= $p; ?>"> 
                            <div> 
                                <img src="<?= get_site_url(); ?>/wp-content/uploads/2023/10/folder.png" alt="" class="custom_img">
                            </div>
                            <div class="modal-boxes-info">
                            <h4><?= $itemrow['board_plan'] ?? ''; ?></h4>
                            </div>
                        </div>  
                    </div>
                </div> 
    <?php 
    $internal = $itemrow['internal_folder'];
    if($internal==1){
    $popdata = $itemrow['internal_popup'];
    ?>
    <div class="modal fade" id="Modal_new_folder_i<?= $p; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header second-model">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <div class="back-new">
                        <h6>Back</h6>
                    </div>
                    <button type="button" class="close close_current_modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <div class="modal-body">
                <div class="modal-body-custom">
                    <div class="row">
                        <?php 
                        $in =0;
                        if(!empty($popdata)){ 
                            foreach($popdata as $popitem){
                            $in++;
                            $interfolder = $popitem['second_file_type'];
                            if($interfolder ==0){
                            ?>               
                        <div class="col-md-3">
                            <div class="modal-boxes">
                        <div class="report-modal-imgg" model="Modal_internal_folder_i<?= $in; ?>"> 
                             <div> 
                                <img src="<?= get_site_url(); ?>/wp-content/uploads/2023/10/folder.png" alt="" class="custom_img">
                            </div>
                            <div class="modal-boxes-info">
                            <h4><?= $popitem['folder_name'] ?? ''; ?></h4>
                            </div>
                        </div>
                    </div>
                    </div> 
        <?php 
        $thirdpopup = $popitem['third_internal_folder'];
        if($thirdpopup==1){
            $thirdpopdata = $popitem['third_popup_data'];
        ?>
         <div class="modal fade" id="Modal_internal_folder_i<?= $in; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header second-model">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <div class="back-new">
                        <h6>Back</h6>
                    </div>
                    <button type="button" class="close close_current_modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <div class="modal-body">
                <div class="modal-body-custom">
                    <div class="row"> 
        <?php 
        if($thirdpopdata){
            foreach($thirdpopdata as $thirdpopupitem){
        ?>                       
        <div class="col-md-3">
        <div class="modal-boxes for_pdf_box">
            <div class="report-modal-imgg for-icon"> 
               <div class="iconss">
               <?php $tfile = $thirdpopupitem['third_popup_file'];
               //print_r($file); 
               $turl = "";
               $tname = "";
               $ticon = "";
               $tthumbnail ="";
                if($tfile){ 
                    $turl = esc_url($tfile['url']); 
                    $tname = implode(" ", array_slice(explode(" ", str_replace('-', ' ', esc_html($tfile['name']))), 0, 3));
                    $ticon = $tfile['icon'];
                    if($tfile['type']=='image'){
                    $tthumbnail = $tfile['sizes']['thumbnail'];
                    }
                    ?> 
               <?php } ?>
                <div>
                <?php if(!empty($tthumbnail)){ ?>
                   <a href="<?= $turl; ?>" target="_blank">
                   <img src="<?= $tthumbnail; ?>" alt=""> 
                   </a> 
               <?php }else{ ?>
                <a href="<?= $turl; ?>" target="_blank">
                   <img src="<?= $ticon; ?>" alt="">
                   </a>  
               <?php } ?>
               </div> 
               </div> 
            </div>
            <div class="modal-boxes-info">
                <a href="<?= $turl; ?>" target="_blank">
                <h4><?= (!empty($tname)) ? $tname.'...' : ''; ?></h4>
                </a>
            </div>
            <div class="drop-list">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </div>
        <div class="dropdown-custom">
            <ul class="share-frst">
                <li>
                    <a href="#">
                    <i class="fa fa-share-alt" aria-hidden="true"></i>

                        <span>Share</span>
                    </a>
                    <ul class="share-inner">
                        <li>
                        <a href="https://www.pinterest.com/pin/create/button/?url=urlencode(<?= $turl ?>)">
                            <i class="fa-brands fa-pinterest"></i>
                                <span>Pinterest</span>
                            </a>
                        </li>
                        <li>
                        <a href='https://api.whatsapp.com/send?text=<?php echo urlencode("Nvcentralservices:" .$turl) ?>' target="_blank">
                            <i class="fa-brands fa-whatsapp"></i>
                                <span>whatsapp</span>
                            </a>
                        </li>  
                    </ul>
                </li>
                <li>
                    <a href="<?= $turl ?>" download="">
                    <i class="fa fa-download" aria-hidden="true"></i>
                        <span>Download</span>
                    </a>
                </li>
            </ul>
        </div>
        </div>
    </div>    
<?php } } ?>
</div>
</div>
</div>
</div>
</div>
</div>
<?php }
 }else{ ?>
    <div class="col-md-3">
        <div class="modal-boxes for_pdf_box">
            <div class="report-modal-imgg for-icon"> 
               <div class="iconss">
               <?php $sfile = $popitem['second_popup_file'];
               //print_r($file); 
               $surl = "";
               $sname = "";
               $sicon = "";
               $sthumbnail ="";
                if($sfile){ 
                    $surl = esc_url($sfile['url']); 
                    $sname = implode(" ", array_slice(explode(" ", str_replace('-', ' ', esc_html($sfile['name']))), 0, 3));
                    $sicon = $sfile['icon'];
                    if($sfile['type']=='image'){
                    $sthumbnail = $sfile['sizes']['thumbnail'];
                    }
                    ?> 
               <?php } ?>
                <div>
                <?php if(!empty($sthumbnail)){ ?>
                   <a href="<?= $surl; ?>" target="_blank">
                   <img src="<?= $sthumbnail; ?>" alt=""> 
                   </a> 
               <?php }else{ ?>
                <a href="<?= $surl; ?>" target="_blank">
                    <img src="<?= $sicon; ?>" alt="">  
                </a>
               <?php } ?>
               </div> 
               </div> 
            </div>
            <div class="modal-boxes-info">
            <a href="<?= $surl; ?>" target="_blank">
                <h4><?= (!empty($sname)) ? $sname.'...' : ''; ?></h4>
            </a>
            </div>
            <div class="drop-list">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </div>
        <div class="dropdown-custom">
            <ul class="share-frst">
                <li>
                    <a href="#">
                    <i class="fa fa-share-alt" aria-hidden="true"></i>

                        <span>Share</span>
                    </a>
                    <ul class="share-inner">
                        <li>
                        <a href="https://www.pinterest.com/pin/create/button/?url=urlencode(<?= $surl ?>)">
                            <i class="fa-brands fa-pinterest"></i>
                                <span>Pinterest</span>
                            </a>
                        </li>
                        <li>
                        <a href='https://api.whatsapp.com/send?text=<?php echo urlencode("Nvcentralservices:" .$surl) ?>' target="_blank">
                            <i class="fa-brands fa-whatsapp"></i>
                                <span>whatsapp</span>
                            </a>
                        </li>  
                    </ul>
                </li>
                <li>
                    <a href="<?= $surl ?>" download="">
                    <i class="fa fa-download" aria-hidden="true"></i>
                        <span>Download</span>
                    </a>
                </li>
            </ul>
        </div>
        </div>
    </div>
             <?php }
            } 
                    }
                ?>                     
                    </div>
                </div>
                </div>
                </div>
              </div>
            </div>
    <?php 
            }
            }else{ ?>
    <div class="col-md-3">
        <div class="modal-boxes for_pdf_box">
            <div class="report-modal-imgg for-icon"> 
               <div class="iconss">
               <?php 
               $file = $itemrow['choose_your_file'];
               $url = "";
               $name = "";
               $icon = "";
               $thumbnail ="";
                if($file){ 
                    $url = esc_url($file['url']); 
                    $name = implode(" ", array_slice(explode(" ", str_replace('-', ' ', esc_html($file['name']))), 0, 3));
                    $icon = $file['icon'];
                    if($file['type']=='image'){
                    $thumbnail = $file['sizes']['thumbnail'];
                    }
                    ?> 
               <?php } ?>
                <div>
                <?php if(!empty($thumbnail)){ ?>
                    <a href="<?= $url; ?>" target="_blank">
                    <img src="<?= $thumbnail; ?>" alt="">  
                    </a>
                <?php }else{ ?>
                    <a href="<?= $url; ?>" target="_blank">
                    <img src="<?= $icon; ?>" alt="">
                    </a>  
               <?php } ?>
               </div> 
               </div> 
            </div>
            <div class="modal-boxes-info">
                <a href="<?= $url; ?>" target="_blank">
                <h4><?= (!empty($name)) ? $name.'...' : ''; ?></h4>
                </a>
            </div>
            <div class="drop-list">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </div>
        <div class="dropdown-custom">
            <ul class="share-frst">
                <li>
                    <a href="#">
                    <i class="fa fa-share-alt" aria-hidden="true"></i>
                        <span>Share</span>
                    </a>
                    <ul class="share-inner">
                        <li>
                        <a href="https://www.pinterest.com/pin/create/button/?url=urlencode(<?= $url ?>)">
                            <i class="fa-brands fa-pinterest"></i>
                                <span>Pinterest</span>
                            </a>
                        </li>
                        <li>
                        <a href='https://api.whatsapp.com/send?text=<?php echo urlencode("Nvcentralservices:" .$url) ?>' target="_blank">
                            <i class="fa-brands fa-whatsapp"></i>
                                <span>whatsapp</span>
                            </a>
                        </li>                        
                    </ul>
                </li>
                <li>
                    <a href="<?= $url ?>" download="">
                    <i class="fa fa-download" aria-hidden="true"></i>
                        <span>Download</span>
                    </a>
                </li>
            </ul>
        </div>
        </div>
    </div>
<?php
    }
 }  
} 
?> 
</div>
</div>
</div>
</div>
</div>
</div>
<?php elseif( get_row_layout() == 'post_google_maps' ): ?>
    <li>
        <a href="#" data-toggle="modal" data-target="#exampleModal-i2">
            <div class="pdf-img">
            <?php $m_icon = get_sub_field('maps_icon', $id );
                if(!empty($m_icon)){  ?>
                <img src="<?= $m_icon; ?>" alt="">
            <?php } ?>
            </div>
            <span><?= get_the_title(); ?></span>
        </a>
    </li>
    <div class="modal fade" id="exampleModal-i2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= get_sub_field('maps_title', $id) ?? ''; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body-custom">
                   <h2><?= get_sub_field('maps_subtitle', $id) ?? ''; ?></h2>
                       <?= get_sub_field('Maps', $id) ?? ''; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php elseif( get_row_layout() == 'board_of_directors' ): ?>
        <li>
            <a href="#" data-toggle="modal" data-target="#exampleModali3">
                <div class="pdf-img">
            <?php $b_icon = get_sub_field('board_icon', $id);
                if(!empty($b_icon)){  ?>
                <img src="<?= $b_icon; ?>" alt="">
            <?php } ?>
                </div>
                <span><?= get_the_title(); ?></span>
            </a>
        </li>
    <div class="modal fade" id="exampleModali3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= get_sub_field('board_title', $id) ?? ''; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body-custom">
                        <?= get_sub_field('board_description', $id) ?? ''; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <?php
     endif; 
   endwhile;
endif;

    }
}
wp_reset_postdata();
?> 
</ul>
</div>
<?php  } ?>  
</div>
</div>
<div class="community-main-sec">
<?php 
if (have_rows('community_module')) {
    while (have_rows('community_module')) {
    the_row();

if (get_row_layout() === 'notice_layout') { ?>

    <div class="notice-badge-main">

        <h5><?= (!empty(get_sub_field('notice_title'))) ? get_sub_field('notice_title') : ''; ?></h5>

        <p><?= (!empty(get_sub_field('notice_description'))) ? get_sub_field('notice_description') : ''; ?></p>

    </div>

<?php } 

if (get_row_layout() === 'register_layout') {

?>

    <div class="comunity-main-each-box register-boat" data-label="<?= (!empty(get_sub_field('action'))) ? get_sub_field('action') : ''; ?>">

        <div class="row">

            <div class="col-md-7">

                <h4><?= (!empty(get_sub_field('register_title'))) ? get_sub_field('register_title') : ''; ?></h4>

                <?= (!empty(get_sub_field('register_description'))) ? get_sub_field('register_description') : ''; ?>

            </div>

            <div class="col-md-5">

                <div class="frst-bt-img">

                    <?php 

                    $image = get_sub_field('register_image');

                    if(!empty($image)){

                     ?>

                    <img src="<?= $image; ?>"

                        alt="">

                    <?php } ?>

                </div>



            </div>

        </div>

    </div>

<?php } 

if (get_row_layout() === 'recently_uploaded_documents') {

?>



    <div class="comunity-main-each-box">

        <div class="row">

            <div class="col-md-12">

                <h4><?= (!empty(get_sub_field('recently_title'))) ? get_sub_field('recently_title') : ''; ?></h4>

                <?= (!empty(get_sub_field('recently_description'))) ? get_sub_field('recently_description') : ''; ?>

                <div class="document-list-new">

                    <ul>

                    <?php 

                    $list = get_sub_field('document_list');

                    if(!empty($list)){

                        foreach($list as $listitem){

                        $item = $listitem['doc_item'];

                        $title = esc_html($item['title']);

                        $name = ucwords(str_replace('-', ' ', esc_html($item['name'])));

                       ?>

                        <li>

                            <a href="<?= esc_url($item['url']); ?>"

                                target="_blank">

                                <div class="pdf-img">

                                    <img src="https://html.localserverpro.com/NV_Community/assets/images/pdf.png"

                                        alt="">

                                </div>



                                <span><?= (!empty($title)) ? $title : $name; ?></span>

                            </a>

                        </li>

                    <?php } } ?> 

                </ul>

                    </div>

                <div class="all-document">

                    <?php 

                    $btn = get_sub_field('view_all_documents');

                    if($btn){

                    ?>

                    <a href="<?= esc_url($btn['url']); ?>">

                        <div class="pdf-img">

                            <img src="<?= get_site_url(); ?>/wp-content/uploads/2023/10/folder.png"

                                alt="">

                        </div>

                        <span><?= esc_html($btn['title']); ?></span>

                    </a>

                <?php } ?>

                </div>



            </div>



        </div>

    </div>

<?php } if (get_row_layout() === 'flushable_layout') { ?>

    <div class="comunity-main-each-box register-boat hot-pics" data-label="<?= (!empty(get_sub_field('hot_topics'))) ? get_sub_field('hot_topics') : ''; ?>">

        <div class="row">

            <div class="col-md-12">

                <h4><?= (!empty(get_sub_field('flushable_title'))) ? get_sub_field('flushable_title') : ''; ?></h4>

                <?= (!empty(get_sub_field('flushable_description'))) ? get_sub_field('flushable_description') : ''; ?>

                <div class="dummy-vdo">

                <?= (!empty(get_sub_field('flushable_video'))) ? get_sub_field('flushable_video') : ''; ?>

                </div>

            </div>

        </div>

    </div>

<?php } if (get_row_layout() === 'news_layout') {  ?>

<div class="comunity-main-each-box register-boat and-more" data-label="<?= (!empty(get_sub_field('and_more'))) ? get_sub_field('and_more') : ''; ?>">

        <div class="row">

            <div class="col-md-12">

                <h4><?= (!empty(get_sub_field('news_title'))) ? get_sub_field('news_title') : ''; ?></h4>

                <div class="row">

                <?php 

                $i=0;

                $box = get_sub_field('news_box');

                if($box){

                    foreach($box as $boxitem){

                        $i++;

                ?>

                    <div class="col-md-6">

                        <div class="news-boxes">

                            <p><?= $boxitem['box_title']; ?></p>

                            <a href="#" data-toggle="modal" data-target="#exampleModal<?= $i; ?>">

                                <div class="pdf-img">

                                    <?php 

                                    $img =  $boxitem['box_icon']; 

                                    if($img){

                                    ?>

                                    <img src="<?= $img; ?>"

                                        alt="">

                                    <?php } ?>

                                </div>

                                <span><?= $boxitem['box_icon_title']; ?></span>

                            </a>

                        </div>

                    </div>

<div class="modal fade" id="exampleModal<?= $i; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

 <div class="modal-dialog">

 <div class="modal-content">

    <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel"><?= $boxitem['model_title']; ?></h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span>

        </button>

    </div>

    <div class="modal-body">

        <div class="modal-body-custom">

            <?= $boxitem['model_body']; ?>

        </div>

    </div>

</div>

</div>

</div>

<?php } } ?>

</div>

</div>

</div>

</div>

<?php } } } ?> 

</div>       

</div>

</section>

<?php } get_footer(); ?>