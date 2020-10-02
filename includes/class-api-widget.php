<?php
/**
 * Elementor Vehicle Search Widget.
 *
 * Elementor widget that connects to vehicle database via Javascript api.
 *
 * @since 1.0.0
 */
class VSP_Api_Widget extends \Elementor\Widget_Base {

    private $id = 'vehicleSearch';
    private $enginePower = 'enginePower';
    private $numberDoors = 'numberDoors';
    private $maker = 'maker';
    private $model = 'model';
    private $seats = 'seats';
    private $year = 'year';
    private $kM = 'kM';
    private $engineType = 'engineType';
    private $color = 'color';
    private $oldOwnership = 'oldOwnership';
   

   /**
    * Get widget name.
    *
    * Retrieve our widget name.
    *
    * @since 1.0.0
    * @access public
    *
    * @return string Widget name.
    */
   public function get_name() {
      return 'vehiclesearch';
   }

   /**
    * Get widget title.
    *
    * Retrieve oEmbed widget title.
    *
    * @since 1.0.0
    * @access public
    *
    * @return string Widget title.
    */
   public function get_title() {
      return __( 'Vehicle Search', 'VSP_Api_Widget' );
   }

   /**
    * Get widget icon.
    *
    * Retrieve oEmbed widget icon.
    *
    * @since 1.0.0
    * @access public
    *
    * @return string Widget icon.
    */
   public function get_icon() {
      return 'fa fa-code';
   }

   /**
    * Get widget categories.
    *
    * Retrieve the list of categories the oEmbed widget belongs to.
    *
    * @since 1.0.0
    * @access public
    *
    * @return array Widget categories.
    */
   public function get_categories() {
      return [ 'general' ];
   }

    /* Get Widget ID
    */
    public function get_id() {
      return $this->id;
    } 

   /**
    * Register oEmbed widget controls.
    *
    * Adds different input fields to allow the user to change and customize the widget settings.
    *
    * @since 1.0.0
    * @access protected
    */
   protected function _register_controls() {

      $this->start_controls_section(
         'content_section',
         [
            'label' => __( 'Content', 'VSP_Api_Widget' ),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
         ]
      );

      $this->add_control(
         'vehicleidcontrol',
         [
            'label' => __( 'Vehicle ID', 'VSP_Api_Widget' ),
            'type' => VSP_Custom_Control::vehicleidcontrol,
            'input_type' => 'text',
            'placeholder' => __( 'Add Vehicle ID here: hidden on frontend', 'VSP_Api_Widget' ),
            'classes' => __( 'vehicleID', 'VSP_Api_Widget'),
         ]
      );

       $this->add_control(
         'maker',
         [
            'label' => __( 'Maker', 'VSP_Api_Widget' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'input_type' => 'text',
            'placeholder' => __( 'Maker', 'VSP_Api_Widget' ),
            'classes' => __( $this->maker, 'VSP_Api_Widget'),
         ]
      );

         $this->add_control(
         'numberdoors',
         [
            'label' => __( 'Number of Doors', 'VSP_Api_Widget' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'input_type' => 'text',
            'placeholder' => __( 'number of doors', 'VSP_Api_Widget' ),
            'classes' => __( $this->numberDoors, 'VSP_Api_Widget'),
         ]
      );

         $this->add_control(
         'model',
         [
            'label' => __( 'Model', 'VSP_Api_Widget' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'input_type' => 'text',
            'placeholder' => __( 'model', 'VSP_Api_Widget' ),
            'classes' => __( $this->model, 'VSP_Api_Widget'),
         ]
      );
         $this->add_control(
         'seats',
         [
            'label' => __( 'Seats', 'VSP_Api_Widget' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'input_type' => 'text',
            'placeholder' => __( 'seats', 'VSP_Api_Widget' ),
            'classes' => __( $this->seats, 'VSP_Api_Widget'),
         ]
      );
         $this->add_control(
         'year',
         [
            'label' => __( 'Year', 'VSP_Api_Widget' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'input_type' => 'text',
            'placeholder' => __( 'year', 'VSP_Api_Widget' ),
            'classes' => __( $this->year, 'VSP_Api_Widget'),
         ]
      );

         $this->add_control(
         'enginepower',
         [
            'label' => __( 'Engine Power', 'VSP_Api_Widget' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'input_type' => 'text',
            'placeholder' => __( 'Engine Power', 'VSP_Api_Widget' ),
            'classes' => __( $this->enginePower, 'VSP_Api_Widget'),
         ]
      );
         $this->add_control(
         'color',
         [
            'label' => __( 'Color', 'VSP_Api_Widget' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'input_type' => 'text',
            'placeholder' => __( 'color', 'VSP_Api_Widget' ),
            'classes' => __( $this->color, 'VSP_Api_Widget'),
         ]
      );
         $this->add_control(
         'km',
         [
            'label' => __( 'kM', 'VSP_Api_Widget' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'input_type' => 'text',
            'placeholder' => __( 'kM', 'VSP_Api_Widget' ),
            'classes' => __( $this->kM, 'VSP_Api_Widget'),
         ]
      );

         $this->add_control(
         'enginetype',
         [
            'label' => __( 'Engine Type', 'VSP_Api_Widget' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'input_type' => 'text',
            'placeholder' => __( 'Engine Type', 'VSP_Api_Widget' ),
            'classes' => __( $this->engineType, 'VSP_Api_Widget'),
         ]
      );
         $this->add_control(
         'oldownership',
         [
            'label' => __( 'Old Ownership', 'VSP_Api_Widget' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'input_type' => 'text',
            'placeholder' => __( 'Old Ownership', 'VSP_Api_Widget' ),
            'classes' => __( $this->oldOwnership, 'VSP_Api_Widget'),
         ]
      );

        $this->add_control(
          'style_section',
          [
            'label' => __( 'Style Section', 'VSP_Api_Widget' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
          ]
        );

      $this->end_controls_section();

   }

   /**
    * Render oEmbed widget output on the frontend.
    *
    * Written in PHP and used to generate the final HTML.
    *
    * @since 1.0.0
    * @access protected
    */
   protected function render() {

      $settings = $this->get_settings_for_display();
      
      $html =  '<div class="elementor-element color"><h2>' . $settings['color'] . ':<span id="vehicleColor" style="color:#000;">צבע:</span></h2></div>';
      $html .= '<div class="elementor-element enginePower"><h2>' . $settings['enginepower'] . ':<span id="volume" style="color:#000;">נפח:</span></h2></div>';
      $html .= '<div class="elementor-element numberDoors">:<span id="numDoors" style="color:#000;">מס׳ דלתות:</span><h2>' . $settings['numberdoors'] . '</h2></div>';
      $html .= '<div class="elementor-element seats"><h2>' . $settings['seats'] . ':<span id="seats" style="color:#000;">מקומות:</span></h2></div>';
      $html .= '<div class="elementor-element year"><h2>' . $settings['year'] . ':<span id="year" style="color:#000;">שנה:</span></h2></div>';
      $html .= '<div class="elementor-element maker"><h2>' . $settings['maker'] . ':<span id="maker" style="color:#000;">יצרן:</span></h2></div>';
      $html .= '<div class="elementor-element model"><h2>' . $settings['model'] . ':<span id="model" style="color:#000;">דגם:</span></h2></div>';
      $html .= '<div class="elementor-element kM"><h2>' . $settings['km'] . ':<span id="km" style="color:#000;">ק״מ:</span></h2></div>';
      $html .= '<div class="elementor-element engineType"><h2>' . $settings['enginetype'] . ':<span id="engineType" style="color:#000;">תיבת הילוכים:</span></h2></div>';
      $html .= '<div class="elementor-element oldOwnership"><h2>' . $settings['oldownership'] . ':<span id="hand" style="color:#000;">יד:</span></h2></div>';

      echo $html;

      //element-container
      //element-row
      // elementor-column
      // elementor-column-wrap
      //       echo '<div data-element_type="column" class="elementor-element elementor-column elementor-inner-column ui-resizable" >';
      // echo '<div class=elementor-column-wrap">';
      // echo '<div class="elementor-widget-wrap">';
      //  echo '<div class="vehicle-search-elementor-widget" >';
      // echo '<div class="elementor-element hand"><h2>' . $settings['hand'] . '</h2></div>';
      // echo '</div>';// End vehicle-search-elementor-widget
      // echo '</div>';// End elementor-widget-wrap"
      // echo '<div class="elementor-widget-wrap">';
      //  echo '<div class="vehicle-search-elementor-widget" >';

      // echo '<div class="elementor-element km"><h2>' . $settings['km'] . '</h2></div>';
      // echo '</div>';// End vehicle-search-elementor-widget
      // echo '</div>';// End elementor-widget-wrap"
      // echo '<div class="elementor-widget-wrap">';
      //  echo '<div class="vehicle-search-elementor-widget" >';

      // echo '<div class="elementor-element engine-type"><h2>' . $settings['enginetype'] . '</h2></div>';
      // echo '</div>';// End vehicle-search-elementor-widget
      // echo '</div>';// End elementor-widget-wrap"
      // echo '<div class="elementor-widget-wrap">';
      //   echo '<div class="vehicle-search-elementor-widget" >';

      // echo '<div class="elementor-element structure"><h2>' . $settings['structure'] . '</h2></div>';
      // echo '</div>';// End vehicle-search-elementor-widget
      // echo '</div>';// End elementor-widget-wrap"
      //  echo '<div class="elementor-widget-wrap">';
      // echo '<div class="vehicle-search-elementor-widget" >';

      // echo '<div class="elementor-element places"><h2>' . $settings['places'] . '</h2></div>';
      // echo '</div>';//End places
      // echo '</div>';//elementor-
      // echo '<div class="elementor-widget-wrap">';
      // echo '<div class="vehicle-search-elementor-widget" >';

      // echo '<div class="elementor-element year"><h2>' . $settings['year'] . '</h2></div>';
      // echo '</div>';//End Year
      // echo '</div>';//End elementor-
      // echo '</div>';// End elementor-column
      // echo '</div>';// End elementor-column-wrap
      // echo '<div data-element_type="column" class="elementor-element elementor-column elementor-inner-column ui-resizable" >';
      // echo '<div class=elementor-column-wrap">';
      // echo '<div class="elementor-widget-wrap">';
      //  echo '<div class="vehicle-search-elementor-widget" >';
      // echo '<div class="elementor-element hand"><h2>' . $settings['hand'] . '</h2></div>';
      // echo '</div>';// End vehicle-search-elementor-widget
      // echo '</div>';// End elementor-widget-wrap"
      // echo '<div class="elementor-widget-wrap">';
      //  echo '<div class="vehicle-search-elementor-widget" >';

      // echo '<div class="elementor-element km"><h2>' . $settings['km'] . '</h2></div>';
      // echo '</div>';// End vehicle-search-elementor-widget
      // echo '</div>';// End elementor-widget-wrap"
      // echo '<div class="elementor-widget-wrap">';
      //  echo '<div class="vehicle-search-elementor-widget" >';

      // echo '<div class="elementor-element engine-type"><h2>' . $settings['enginetype'] . '</h2></div>';
      // echo '</div>';// End vehicle-search-elementor-widget
      // echo '</div>';// End elementor-widget-wrap"
      // echo '<div class="elementor-widget-wrap">';
      //   echo '<div class="vehicle-search-elementor-widget" >';

      // echo '<div class="elementor-element structure"><h2>' . $settings['structure'] . '</h2></div>';
      // echo '</div>';// End vehicle-search-elementor-widget
      // echo '</div>';// End elementor-widget-wrap"
      //  echo '<div class="elementor-widget-wrap">';
      // echo '<div class="vehicle-search-elementor-widget" >';

      // echo '<div class="elementor-element places"><h2>' . $settings['places'] . '</h2></div>';
      // echo '</div>';//End places
      // echo '</div>';//elementor-
      // echo '<div class="elementor-widget-wrap">';
      // echo '<div class="vehicle-search-elementor-widget" >';

      // echo '<div class="elementor-element year"><h2>' . $settings['year'] . '</h2></div>';
      // echo '</div>';//End Year
      // echo '</div>';//End elementor-
      // echo '</div>';// End Elementor-column
      // echo '</div>';// End row
      // echo '</div>';// End elementor-container


   }

      /**
    * Render vehicle search widget output in preview
    *
    * Written in JS and used to generate the preview.
    *
    * @since 1.0.0
    * @access protected
    */

  

}