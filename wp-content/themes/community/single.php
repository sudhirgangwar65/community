<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

?>
<style type="text/css">
.articles-slide h6 {
    font-weight: 400;
    text-align: justify;
    font-size: 14px;
}
	.articles-slide h2 {
    color: #000000 !important;
    text-align: justify !important;
    padding: 10px 0px;
        font-size: 37px;
}
.articles-new button.slick-next.slick-arrow {
    opacity: 0;
}
.articles-new .slick-dots {
    display: inline-flex;
    justify-content: flex-start;
    align-items: center;
    width: 100%;
    padding: 0px;
}

.articles-new button.slick-prev.slick-arrow{
	display: none !important;
}
.articles-new .slick-dots li {
    margin: 0px 10px 0px 0px;
}

.articles_img img {
    width: 100%;
}

.articles_images .people-new-slider-sec {
    padding-top: 0px;
}

.Search_btn button.button.wp-element-button {
    float: inherit;
    font-size: 100%;
    margin: 0;
    line-height: 1;
    cursor: pointer;
    position: relative;
    text-decoration: none;
    overflow: visible;
    padding: 0.6em 1em;
    border-radius: 0px 3px 3px 0px;
    left: auto;
    border: 0;
    display: inline-block;
    background-image: none;
    box-shadow: none;
    text-shadow: none;
    color: #ffffff !important;
    background-color: #8e1212 !important;
    font-family: 'Poppins' !important;
    font-weight: 500 !important;
}
.Search_btn {
    margin-top: 25px;
}

.Search_btn .input_table_responsive {
    float: left !important;
    box-sizing: border-box;
    border: none;
    padding: 6px 20px 5px;
    outline: 0;
    margin-bottom: 5px !important;
    box-shadow: 0px 3px 31px #00000029;
}
.row.multi {
    padding-top: 30px;
}

.row.multi .people-new-slider-sec {
    padding: 0px 0px 0px 0px;
}

.row.multi .articles-slide .top_text {
    font-weight: 400;
    text-align: justify;
    font-size: 14px;
    font-family: 'Montserrat', sans-serif;
    letter-spacing: 3px;
}
@media (max-width:768px){
	.Search_btn .input_table_responsive {
    width: 100%;
}
.sec-head h2 {
    font-size: 18px !important;
    padding-bottom: 20px;
}
.blog_data {
    box-shadow: 0px 3px 31px #00000029;
    margin-bottom: 10px;
}
.row.multi .articles_img img {
    width: 100% !important;
}
.Search_btn button.button.wp-element-button {
    width: 100%;
}
.row.multi .articles_img img {
    width: 100%;
    height: auto !important;
}
.data_blog {
    padding: 15px !important;
}
.data_blog ul li p {
    font-family: 'Montserrat', sans-serif;
    letter-spacing: 1px;
    font-size: 12px !important;
    margin-left: 6px;
}
.data_blog ul li i.fa {
    display: flex !important;
    font-size: 14px !important;
}
.details_data img {
    height: 400px;
    object-fit: cover;
    margin-bottom: 10px;
}
}

.row.multi .articles_img img {
    width: 85%;
    height: 230px;
    object-fit: cover;
}
.row.multi .articles_img {
    text-align: right;
}


.target_page {
    float: inherit;
    margin-top: 20px !important;
    font-size: 100%;
    margin: 0;
    line-height: 1;
    cursor: pointer;
    position: relative;
    text-decoration: none;
    overflow: visible;
    padding: 0.6em 1em;
    border-radius: 0px 3px 3px 0px;
    left: auto;
    border: 0;
    display: inline-block;
    background-image: none;
    box-shadow: none;
    text-shadow: none;
    color: #ffffff !important;
    background-color: #8e1212 !important;
    font-family: 'Poppins' !important;
    font-weight: 500 !important;
}

.row.multi h6 a {
    color: #AA1B1B;
}  

.row.multi h6 a:hover {
    color: #AA1B1B;
}

.blog_data {
    box-shadow: 0px 3px 31px #00000029;
}
.blog_data img {
    width: 100%;
}
.data_blog ul {
    padding: 0px;
    list-style-type: none;
    width: 100%;
}
.data_blog ul li {
    float: left;
    width: 50%;
}
.data_blog ul li {
    float: left;
    width: 50%;
    color: #000000;
    font-size: 15px;
}

.blog_data img {
    width: 100%;
    height: 290px;
    object-fit: cover;
}
.data_blog ul li i.fa {
    display: flex;
}
.data_blog {
    padding: 30px;
}

.data_blog ul li p {
    font-family: 'Montserrat', sans-serif;
    letter-spacing: 1px;
    margin-left: 6px;
}

.data_blog a {
    color: #AA1B1B;
}
.data_blog h5 {
    margin: 25px 0px;
    display: block;
}
.bottom_blog {
    margin-bottom: 50px;
}
.details_data img {
    height: 400px;
    object-fit: cover;
}
</style>
<?php 
$postid = get_the_id();
//echo $postid;
?>
<section class="media-all-sec_puja articles_images">
	<div class="container-fluid">
      <div class="sec-head medias_sec_head">
            <h2><?= (!empty(get_field('header_title', 'option'))) ? get_field('header_title', 'option') : ''; ?> </h2>
            <h6><?= (!empty(get_field('header_subtitle', 'option'))) ? get_field('header_subtitle', 'option') : ''; ?></h6><h6>
               <div class="brd_main">
               </div>
	      	</h6>
	  </div>
	  <br>
	  <br>
      

      <div class="row multi">
      	<div class="col-md-12">
      		<div class="people-new-slider-sec">	
    	        <div class="articles-slide">
    	            <div class="sec-head medias_sec_head">
    	            	<?php 
    	            	if(has_post_thumbnail()){
    	            		$image = wp_get_attachment_image_src(get_post_thumbnail_id($postid), 'single-post-thumbnail');
    	            		echo '<img width="100%" src="'.$image[0].'" alt="'.get_the_title().'">';
    	            	}
    	            	?>                        
                        <br>
                        <br>
                        <br>
					<?= get_the_content(); ?>                              
    				</div>
    	        </div>
    		</div>
      	</div>
      </div>
      <div class="row multi">
        <div class="col-md-12">

            <div class="people-new-slider-sec"> 
                <div class="articles-slide">
                    <div class="sec-head medias_sec_head">
                        <div class="row">
                       <?php $image = get_field('media_image', $postid); 
                       if(!empty($image)){
                       	foreach($image as $imagerow){ ?>
                       		<div class="col-md-4">
                            <div class="details_data">
                                <img width="100%" src="<?= $imagerow['media_attachment']; ?>">
                            </div>
                        </div>
                       <?php
                        }
                          }
                       ?>
                         
                        </div>
                        <br>
                        <br>
                        <br>

                       <?= (!empty(get_field('second_content', $postid))) ? get_field('second_content', $postid) : ''; ?>

                    </div>
                </div>

            </div>

        </div>
      </div>
      <!-- ------------------------------- -->
      <br>
      <div class="row multi">
      	<div class="col-md-6">

  		<div class="people-new-slider-sec bottom_blog">	
			        <div class="articles-slide">
			            <div class="sec-head medias_sec_head">
				            <h2><?= (!empty(get_field('latest_post_title', 'option'))) ? get_field('latest_post_title', 'option') : ''; ?> </h2>
				            <h6><?= (!empty(get_field('latest_post_subheading', 'option'))) ? get_field('latest_post_subheading     ', 'option') : ''; ?> </h6>
						</div>
			        </div>

		</div>

      	</div>
      </div>

      <div class="row">
      	<!-- ----------------------- -->
      	<?php 
      	$args = [
      		'post_type' => 'post',
      		'post_status' => 'publish',
      		'orderby' => 'rand',
      		'posts_per_page' => 3,
      		'post__not_in' => array($postid)
      	];
      	$query = new WP_Query($args);
      	if($query->have_posts()){
      		while($query->have_posts()){
      			$query->the_post();
      			$id = get_the_id();
      	?>
      <div class="col-md-4">
      	<div class="blog_data">
      		<?php 
    	      if(has_post_thumbnail()){
        		$img = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'single-post-thumbnail');
        		echo '<img width="100%" src="'.$img[0].'" alt="'.get_the_title().'">';
        	}
        	?>
      		<div class="data_blog">
      			<ul>
	      			<li><i class="fa fa-calendar"><p><?= get_the_date("d M Y"); ?></p></i></li>
	      			<li><i class="fa fa-user"><p><?= get_the_author(); ?></p></i></li>
	      		</ul>
	      		<h5><?= get_the_title(); ?></h5>
	      		<a href="<?= get_the_permalink(); ?>">Read More</a>
	      		</div>
      	</div>
      </div>
      <?php 	
  			}
      	}
      	?>
      <!-- ----------------------- -->
      </div>


    </div>
</section>

<?php get_footer(); ?>