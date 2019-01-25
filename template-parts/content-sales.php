 <div class="event-summary">
          <a class="event-summary__date t-center" href="#">
            <span class="event-summary__month">
            <?php 
                $saleDate = DateTime :: createFromFormat('d/m/Y', get_field('sales'));
                  echo $saleDate->format('M'); 
             ?>
             </span>
            <span class="event-summary__day"><?php echo $saleDate->format('d') ?></span>  
          </a>
          <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
            <!-- If an event has an excerpt or not, show-->
            <p><?php if(has_excerpt()) {
             echo get_the_excerpt();
              } else {
                echo wp_trim_words(get_the_content(), 18);
              }
              ?>  <a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
          </div>
        </div>