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
     
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];
        
     
        // This is where you run the code and display the output
        ?>
            <script>(function(w,d,a){var b=(w.bookster=w.bookster||[]);b.push({calendar:a});var h=d.getElementsByTagName('head')[0];var j=d.createElement('script');j.type='text/javascript';j.async=true;j.src='https://cdn.booksterhq.com/widgets/v1/calendar.js';h.appendChild(j)})(window,document,{id:'bookster-calendar-widget-32246',property:32246,syndicate:67,theme:{}})</script>

            <div id="bookster-calendar-widget-32246" style="height:430px;"></div>
        <?php
        echo $args['after_widget'];
    }
     
    // Widget Backend
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'wpb_widget_domain' );
        }
        // Widget admin form
        ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>
        <?php
    }
     
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
     
    // Class wpb_widget ends here
} 
     
// Register and load the widget
function wpb_load_widget() {
    register_widget( 'Bookster_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );