<?php
/**
 * @file
 * Homepage template.
 */
?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <!-- Intro -->
  <div class="hp-intro-section">
    <div class="hp-intro-img">
      <img class="img-responsive m-auto" alt="<?php print $node->title; ?>" src="<?php print file_create_url($node->field_hp_intro_image[LANGUAGE_NONE][0]['uri']); ?>" />
    </div>
    <div class="hp-intro-description">
      <h1 class="hp-intro-title text-center uppercase"><?php print $node->field_hp_intro_title[LANGUAGE_NONE][0]['value']; ?></h1>
      <div class="content m-auto"><?php print $node->field_hp_intro_description[LANGUAGE_NONE][0]['value']; ?></div>
    </div>
  </div>

  <!-- Event -->
  <?php if (isset($node->field_hp_event[LANGUAGE_NONE][0]['node']->field_event_date[LANGUAGE_NONE][0]['value'])): ?>
    <div class="hp-event-section">
      <div class="container">
        <div class="wrapper-extra">
          <div class="content clearfix">
            <?php if (isset($node->field_hp_event[LANGUAGE_NONE][0]['node']->field_event_date[LANGUAGE_NONE][0]['value'])):
              $final_date = '';
              $start_date = $node->field_hp_event[LANGUAGE_NONE][0]['node']->field_event_date[LANGUAGE_NONE][0]['value'];
              $end_date = $node->field_hp_event[LANGUAGE_NONE][0]['node']->field_event_date[LANGUAGE_NONE][0]['value2'];

              // Transforming start date format.
              $start_date_updated = date("F d", strtotime($start_date)) .
                '<sup>' . date("S ", strtotime($start_date)) . '</sup>' .
                '<span class="date-separator">' . date("Y", strtotime($start_date)) . '</span>' .
                date(" G:i", strtotime($start_date));

              if (date("Y-m-d ", strtotime($start_date)) != date("Y-m-d ", strtotime($end_date))) {
                // Transforming end date format.
                $end_date_updated = date("F ", strtotime($end_date)) .
                  '<sup>' . date("dS ", strtotime($end_date)) . '</sup>' .
                  date("Y G:i", strtotime($end_date));
              }
              else {
                // Transforming end date format.
                $end_date_updated = date("G:i", strtotime($end_date));
              }

              $final_date = $start_date_updated . ' - ' . $end_date_updated;
              ?>
              <div class="pull-left"><span class="next-event">Next Event: </span>
                <?php print $final_date; ?>
                <p class="location">
                  <?php print $node->field_hp_event[LANGUAGE_NONE][0]['node']->field_event_location[LANGUAGE_NONE][0]['value']; ?>
                </p>
              </div>
            <?php
            endif;
            // Displaying Event registration button.
            if (isset($node->field_hp_event[LANGUAGE_NONE][0]['node']->field_event_register_link[LANGUAGE_NONE][0]['url'])): ?>
              <div class="event-register-link pull-right">
                <a class="block button-style-2" href="<?php print $node->field_hp_event[LANGUAGE_NONE][0]['node']->field_event_register_link[LANGUAGE_NONE][0]['url']; ?>">
                  <?php print $node->field_hp_event[LANGUAGE_NONE][0]['node']->field_event_register_link[LANGUAGE_NONE][0]['title']; ?>
                </a>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <!-- Grid -->
  <div class="hp-grid-sec">
    <div class="container">
      <div class="wrapper clearfix">
        <h3 class="text-center uppercase"><?php print $node->field_grid_section_title[LANGUAGE_NONE][0]['value']; ?></h3>
        <?php
        foreach ($node->field_hp_get_involved[LANGUAGE_NONE] as $section) {
          $data = entity_load('field_collection_item', array($section['value']));
          $data = array_shift($data);
          ?>
          <div class="sm-col-12 sm-col-4 pull-left text-center">
            <div class="col">
              <div class="img-wrap">
                <img alt="<?php print $data->field_get_involved_title[LANGUAGE_NONE][0]['value']; ?>" class="img-responsive m-auto" src="<?php print file_create_url($data->field_get_involved_image[LANGUAGE_NONE][0]['uri']); ?>" alt="<?php print $node->field_grid_section_title[LANGUAGE_NONE][0]['value']; ?>" />
              </div>
              <h4 class="uppercase"><?php print $data->field_get_involved_title[LANGUAGE_NONE][0]['value']; ?></h4>
              <p><?php print $data->field_get_involved_description[LANGUAGE_NONE][0]['value']; ?></p>
              <?php $target = (isset($data->field_get_involved_cta[LANGUAGE_NONE][0]['attributes']['target']) ? 'target="' . $data->field_get_involved_cta[LANGUAGE_NONE][0]['attributes']['target'] . '"': ''); ?>
              <a class="button button-style-1" href="<?php print $data->field_get_involved_cta[LANGUAGE_NONE][0]['url']; ?>" <?php print $target; ?>>
                <?php print $data->field_get_involved_cta[LANGUAGE_NONE][0]['title']; ?>
              </a>
            </div>
          </div>
          <?php } ?>
      </div>
    </div>
  </div>

  <!-- Our Mission -->
  <div class="hp-our-mission">
    <div class="container">
      <div class="wrapper">
        <h3 class="text-center uppercase"><?php print $node->field_hp_our_mission_title[LANGUAGE_NONE][0]['value']; ?></h3>
        <div class="description">
          <?php print $node->field_field_hp_our_mission_des[LANGUAGE_NONE][0]['value']; ?>
        </div>
        <div class="content clearfix">
          <?php
          $counter = 1;
          foreach ($node->field_hp_our_mission_sections[LANGUAGE_NONE] as $section) {
            $data = entity_load('field_collection_item', array($section['value']));
            $data = array_shift($data);
            $col_class = 'leaf';
            if ($counter == 1) {
              $col_class = 'first';
            }
            elseif ($counter == sizeof($node->field_hp_our_mission_sections[LANGUAGE_NONE])){
              $col_class = 'last';
            }
            ?>
            <div class="sm-col-12 md-col-4 pull-left text-center <?php print $col_class; ?>">
              <div class="col <?php print $col_class; ?>">
                <div class="img-wrap">
                  <img alt="<?php print $data->field_our_mission_title[LANGUAGE_NONE][0]['value']; ?><" class="img-responsive m-auto" src="<?php print file_create_url($data->field_our_mission_image[LANGUAGE_NONE][0]['uri']); ?>" alt="<?php print $node->field_grid_section_title[LANGUAGE_NONE][0]['value']; ?>" />
                </div>
                <h4><?php print $data->field_our_mission_title[LANGUAGE_NONE][0]['value']; ?></h4>
                <h5 class="text-center m-auto"><?php print $data->field_our_mission_description[LANGUAGE_NONE][0]['value']; ?></h5>
              </div>
            </div>
            <?php
            $counter++;
          }
          ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Our Members -->
  <div class="hp-members-sec">
    <div class="container">
      <div class="wrapper clearfix">
        <h3 class="text-center uppercase">Our Members</h3>
        <div id="carousel-indicators" class="carousel-type-1 carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators"></ol>
          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Blog -->
  <div class="hp-blog-sec">
    <div class="container">
      <div class="wrapper clearfix">
        <h3 class="text-center uppercase">Blog</h3>
        <div id="carousel-arrows" class="carousel-type-2 carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox"></div>
          <!-- Controllers --->
          <a class="left carousel-control" href="#carousel-arrows" role="button" data-slide="prev">
            <i class="fa fa-angle-left"></i>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#carousel-arrows" role="button" data-slide="next">
            <i class="fa fa-angle-right"></i>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
  </div>

</div>

<div id="slides-temp" class="slides hide">
  <?php
  $counter = 0;
  foreach ($node->field_hp_members[LANGUAGE_NONE] as $member) {
    ?>
      <img class="single-slide" id="img-slide-<?php print $counter; ?>" src="<?php print file_create_url($member['node']->field_member_image[LANGUAGE_NONE][0]['uri']); ?>" alt="<?php print $member['node']->title; ?>" />
    <?php
    $counter++;
  }
  ?>
</div>

<div class="blog-temp hide">
  <?php
  $c = 0;
  foreach ($node->field_hp_blogs[LANGUAGE_NONE] as $blog) {
    ?>
    <div class="single-blog-post" id="blog-post-<?php print $c; ?>">
      <h4><?php print substr($blog['node']->title, 0, 25) . '...'; ?></h4>
      <h5 class="description"><?php print substr(strip_tags($blog['node']->body[LANGUAGE_NONE][0]['value']), 0, 120); ?></h5>
      <h5 class="date"><?php print date("j M Y", $blog['node']->created); ?></h5>
    </div>
    <?php
    $c++;
  }
  ?>
</div>
