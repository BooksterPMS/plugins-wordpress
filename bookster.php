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
    
    // Creating widget front-end 
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );

        $bookster_id = 0;
        if (!empty($instance['bookster_id']))
             $bookster_id = (int)$instance['bookster_id'];
$bookster_id=32246;
        if (empty($bookster_id))
            return;
     
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];
        
     
        // This is where you run the code and display the output
        ?>
            <script>(function(w,d,a){var b=(w.bookster=w.bookster||[]);b.push({calendar:a});var h=d.getElementsByTagName('head')[0];var j=d.createElement('script');j.type='text/javascript';j.async=true;j.src='https://cdn.booksterhq.com/widgets/v1/calendar.js';h.appendChild(j)})(window,document,{id:'bookster-calendar-widget-<?= $bookster_id ?>',property:<?= $bookster_id ?>,syndicate:67,theme:{}})</script>

            <div id="bookster-calendar-widget-<?= $bookster_id ?>" style="height:430px;"></div>
        <?php
        echo $args['after_widget'];
    }
     
    // Widget Backend
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title3', 'wpb_widget_domain' );
        }
        // Widget admin form
        ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'bookster_id' ); ?>"><?php _e( 'bookster_id:' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'bookster_id' ); ?>" name="<?php echo $this->get_field_name( 'bookster_id' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>
        <?php
    }
     
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['bookster_id'] = ( ! empty( $new_instance['bookster_id'] ) ) ? (int)$new_instance['bookster_id'] : '';
        return $instance;
    }
     
    // Class Bookster_widget ends here
} 
     
// Register and load the widget
function wpb_load_widget() {
    register_widget( 'Bookster_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );