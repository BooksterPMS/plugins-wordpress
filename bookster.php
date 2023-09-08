<?php
/*
Plugin Name: Bookster Plugin
Plugin URI: 
Description: This plugin adds a bookster calendar widget.
Version: 1.0
Author: Zoe Sztandke
Author URI: 
License:
*/

// Creating the widget
class Bookster_widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            // Base ID of your widget
            'Bookster_widget', 
    
            // Widget name will appear in UI
            __('Bookster widget', 'wpb_widget_domain'), 
     
            // Widget description
            array( 'description' => __( 'Sample widget based on WPBeginner Tutorial', 'wpb_widget_domain' ), )
        );
    }
    // <?php
    // Creating widget front-end 
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );

        $bookster_id = 0;
        if (!empty($instance['bookster_id']))
            $bookster_id = (int)$instance['bookster_id'];

        if (empty($bookster_id))
            return;

        $colour = '';
        if (!empty($instance['colour']))
            $colour = $instance['colour'];
        
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];

        echo $args['before_widget'];
        if (!empty($colour))
            echo $args['before_colour'] . $colour . $args['after_colour'];

        // This is where you run the code and display the output
        $dom_id = 'bookster-calendar-widget-'.$bookster_id;
        $params = [
            'id' => $dom_id,
            'property' => $bookster_id,
            'syndicate' => 67,
            'theme' => (object)[
                    'background' => $colour,
                    
                ],
            ];
        ?>


        <div id="<?= $dom_id ?>" style="height:430px;"></div>

        <script>(function(w,d){var b=(w.bookster=w.bookster||[]);var h=d.getElementsByTagName('head')[0];var j=d.createElement('script');j.async=true;j.src='https://cdn.booksterhq.com/widgets/v1/calendar.js';h.appendChild(j)})(window,document)</script>

        <script>bookster.push({calendar: <?= json_encode($params) ?>});</script>

        <?php
        echo $args['after_widget'];
    }
     
    // Widget Backend
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Title', 'wpb_widget_domain' );
        }

        if (isset($instance['bookster_id'])) {
            $bookster_id = $instance['bookster_id'];
        }
        else {
            $bookster_id = __('Bookster ID', 'wpb_widget_domain');
        }

        if (isset($instance['colour'])) {
            $colour = $instance['colour'];
        }
        else {
            $colour = __('Colour', 'wpb_widget_domain');
        }
        // Widget admin form
        ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'bookster_id' ); ?>"><?php _e( 'Bookster ID:' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'bookster_id' ); ?>" name="<?php echo $this->get_field_name( 'bookster_id' ); ?>" type="text" value="<?php echo esc_attr( $bookster_id ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'colour' ); ?>"><?php _e( 'Colour:' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'colour' ); ?>" name="<?php echo $this->get_field_name( 'colour' ); ?>" type="text" value="<?php echo esc_attr( $colour ); ?>" />
            </p>
        <?php
    }
     
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['bookster_id'] = ( ! empty( $new_instance['bookster_id'] ) ) ? (int)$new_instance['bookster_id'] : '';
        $instance['colour'] = (!empty($new_instance['colour'])) ? $new_instance['colour'] : '';
        return $instance;
    }
     
    // Class Bookster_widget ends here
} 
     
// Register and load the widget
function wpb_load_widget() {
    register_widget( 'Bookster_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );