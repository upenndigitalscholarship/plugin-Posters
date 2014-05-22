<?php

$pageTitle = 'Poster: &quot;' . html_escape($poster->title) . '&quot;';
echo queue_css_file('jquery.bxslider');
echo queue_css_file('poster');
echo queue_js_file('jquery.bxslider');
echo head(array('title'=>$pageTitle));

?>

<div id="primary">
    <h1><?php echo $pageTitle; ?></h1>

	<div id="poster">
		<div id="poster-info">
		<?php echo $poster->description; ?>
		</div>

        <?php //set_items_for_loop($poster->Items); ?>
        <ul class="poster-items">
        <?php foreach($poster->Items as $posterItem): ?>
        <?php    echo "<li>";
                echo "<h3>".metadata($posterItem, array('Dublin Core','Title'))."</h3>";
            if(metadata($posterItem, 'has files')){
                foreach($posterItem->Files as $itemFile) {
                    if($itemFile->hasThumbnail()){
                        echo "<div class='item-file'>"
                            .link_to_item(file_image('square_thumbnail', array(),  $itemFile), array('class' =>'item-thumbnail'), 'show', $posterItem)
                            ."</div>"
                            ."<div class='poster-item-annotation'>"
                            .$posterItem->caption
                            ."</div>";
                        break;
                    }
                }
            }
            echo "</li>"
?>
        <?php endforeach; ?>
         </ul>

		<?php 
         $disclaimer = get_option('poster_disclaimer');
		 if (!empty($disclaimer)): 
		?>
		<div id="poster-disclaimer">
			<h2 id="poster-disclaimer-title">Disclaimer</h2>
			<?php echo html_escape($disclaimer); ?>
		</div>
        <?php endif; ?>
        <?php if ($this->currentUser): ?>
            <div class="edit-link">
                <a href="<?php echo html_escape(url(array('action' => 'edit','id' => $poster->id), get_option('poster_page_path'))); ?>" class="edit-poster-link">Edit</a>
                <a href="<?php echo html_escape(url(array('action'=>'print','id' => $poster->id), get_option('poster_page_path'))); ?>" class="print" media="print" >Print</a>
            </div>
        <?php endif; ?>
	</div>
</div> <!-- end primary div -->
<script type="text/javascript"> 
             var n = jQuery('.poster-items li').length;

         if (n > 1) {
             jQuery('.poster-items').bxSlider({
                auto: true,
                autoControls: true,
                height: "100%",
             });
         }

</script>
<?php echo foot(); ?>
