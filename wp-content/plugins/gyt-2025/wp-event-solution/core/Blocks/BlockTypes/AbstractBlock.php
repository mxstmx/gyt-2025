<?php
namespace Eventin\Blocks\BlockTypes;

use Wpeventin;

/**
 * AbstractBlock class
 */
abstract class AbstractBlock {
    /**
     * Block Namespace
     *
     * @var string
     */
    protected $namespace = 'eventin';

    /**
     * Block name within this namespace
     *
     * @var string
     */
    protected $block_name = '';

    /**
     * Constructor
     *
     * @return  void
     */
    public function __construct() {
        $this->initialize();
    }

    /**
     * Initialize this block type
     *
     * - Hook into WP lifecycle
     * - Register the block with WordPress
     */
    protected function initialize() {
        $this->register_block_type_assets();
        $this->register_block_type();
    }

    /**
     * Get block name with namespace. Only used when 
     *
     * @return  string
     */
    protected function get_full_block_name() {
        return $this->namespace . '/' . $this->block_name;
    }

    /**
     * Registers the block type with WordPress
     *
     * @return  void  Chunk paths
     */
    protected function register_block_type() {
        $block_settings = [
            'render_callback'   => $this->get_block_type_render_callback(),
            'editor_script'     => $this->get_block_type_editor_script('handle'),
            'editor_style'      => $this->get_block_type_editor_style(),
            'style'             => $this->get_block_type_style()
        ];

        $metadata_path = $this->get_metadata_path();

        if ( $metadata_path ) {
            register_block_type( $metadata_path, $block_settings );

            return;
        }

        register_block_type( $this->get_block_type(), $block_settings );
    }

    /**
     * Register script and style assets for the block type before it is registered.
     *
     * This registers the scripts; it does not enqueue them.
     */
    protected function register_block_type_assets() { 
        // Register editor scripts.
        if ( null !== $this->get_block_type_editor_script() ) {
            $handle       = $this->get_block_type_editor_script('handle');
            $dependencies = $this->get_block_type_editor_script('dependencies');
            $path         = $this->get_block_type_editor_script('path');

            $this->register_script( $handle, $path, $dependencies );
        }

        // Register frontend scripts.
        if ( null != $this->get_block_type_script() ) {
            $handle       = $this->get_block_type_script('handle');
            $dependencies = $this->get_block_type_script('dependencies');
            $path         = $this->get_block_type_script('path');

            $this->register_script( $handle, $path, $dependencies );
        }
    }

    /**
     * Register script
     *
     * @param   string  $handle        [$handle description]
     * @param   string  $path          [$path description]
     * @param   array  $dependencies  [$dependencies description]
     * @param   string  $version       [$version description]
     *
     * @return  void
     */
    protected function register_script( $handle, $path, $dependencies = [], $version = '1.0.1' ) {
        wp_register_script( $handle, $path, $dependencies, $version );
    }

    /**
     * Get block type
     *
     * @return  string
     */
    protected function get_block_type() {
        return $this->namespace . '/' . $this->block_name;
    }

    /**
     * Get the render callback for this blocktype
     * 
     * Dynamic block should return a callback, for example `return [this, 'render']
     *
     * @return  callable|null
     */
    protected function get_block_type_render_callback() {
        return [$this, 'render_callback'];
    }

    /**
     * Get the editor script data for this block type.
     *
     * @see $this->register_block_type()
     * @param string $key Data to get, or default to everything.
     * @return array|string
     */
    protected function get_block_type_editor_script( $key = null ) {
        $script = [
            'handle'       => 'eventin-' . $this->block_name . '-block',
            'path'         => $this->get_block_asset_build_path( $this->block_name ),
            'dependencies' => [ 'etn-blocks' ],
        ];
        return $key ? $script[ $key ] : $script;
    }

    /**
     * Get the frontend script handle for this block type.
     *
     * @param string $key Data to get, or default to everything.
     * @return array|string|null
     */
    protected function get_block_type_script( $key = null ) {
        $script = [
            'handle'       => 'eventin-' . $this->block_name . '-block-frontend',
            'path'         => $this->get_block_asset_build_path( $this->block_name . '-frontend' ),
            'dependencies' => [],
        ];
        return $key ? $script[ $key ] : $script;
    }

    /**
     * Get the editor style handle for this block type.
     *
     * @see $this->register_block_type()
     * @return string|null
     */
    protected function get_block_type_editor_style() {
        return 'eventin-blocks-editor-style';
    }

    /**
     * Get the frontend style handle for this block type.
     *
     * @return string[]|null
     */
    protected function get_block_type_style() {
        $this->register_style( 'eventin-blocks-style-' . $this->block_name, $this->get_block_asset_build_path( $this->block_name, 'css' ), [], 'all', true );

        return [ 'eventin-blocks-style', 'wc-blocks-style-' . $this->block_name ];
    }

    /**
     * Render callback. This will ensure assets are enqueued just in time
     *
     * @param   array  $attributes  [$attributes description]
     * @param   string  $content     Block content. Default empty string
     * @param   WP_Block|null  $block       Block instance
     *
     * @return  string Rendered block type output
     */
    public function render_callback( $attributes = [], $content = '', $block = null ) {
        $render_callback_attributes = $this->parse_render_callback_attributes( $attributes );

        return $this->render( $render_callback_attributes, $content, $block );
    }

    /**
     * Parses block attributes from the render_callback.
     *
     * @param array|WP_Block $attributes Block attributes, or an instance of a WP_Block. Defaults to an empty array.
     * @return array
     */
    protected function parse_render_callback_attributes( $attributes ) {
        return is_a( $attributes, 'WP_Block' ) ? $attributes->attributes : $attributes;
    }

    /**
     * Get the supports array for this block type.
     *
     * @see $this->register_block_type()
     * @return string;
     */
    protected function get_block_type_supports() {
        return [];
    }

    /**
     * Get block attributes.
     *
     * @return array;
     */
    protected function get_block_type_attributes() {
        return [];
    }

    /**
     * Render the block. Extended by children.
     *
     * @param array    $attributes Block attributes.
     * @param string   $content    Block content.
     * @param WP_Block $block      Block instance.
     * @return string Rendered block type output.
     */
    protected function render( $attributes, $content, $block ) {
        return $content;
    }

    /**
     * Returns the appropriate asset path for current builds.
     *
     * @param   string $filename  Filename for asset path (without extension).
     * @param   string $type      File type (.css or .js).
     * @return  string             The generated path.
     */
    public function get_block_asset_build_path( $filename, $type = 'js' ) {
        // return "assets/blocks/$filename.$type";

        return \Wpeventin::plugin_url( 'build/js/gutenberg-block.js' ); // Need to remove when individual block script generated.
    }

    /**
     * Get block metadata path
     *
     * @return  string
     */
    public function get_metadata_path() {
        $base_dir = $this->get_block_base_plugin_dir();

        $path = $base_dir . $this->block_name . '/block.json';

        if ( file_exists( $path ) ) {
            return $path;
        }

        return false;
    }

    /**
     * Get block file base dir.
     *
     * @return  string
     */
    protected function get_block_base_plugin_dir() {
        $eventin_dir = Wpeventin::plugin_dir() . 'build/blocks/';
        
        if ( class_exists('\Wpeventin_Pro') ) {
            $eventin_pro_dir = \Wpeventin_Pro::plugin_dir() . 'build/blocks/';
            
            // If the block exists in the Pro plugin directory, return Pro path
            if ( file_exists( trailingslashit( $eventin_pro_dir) . "{$this->block_name}/block.json") ) {
                return $eventin_pro_dir;
            }
        }
    
        return $eventin_dir;
    }

    /**
     * Register style
     *
     * @param   [type]$handle        [$handle description]
     * @param   [type]$relative_src  [$relative_src description]
     * @param   [type]$deps          [$deps description]
     * @param   [type]$media         [$media description]
     * @param   all                 [ description]
     *
     * @return  []                  [return description]
     */
    protected function register_style( $handle, $relative_src, $deps = [], $media = 'all' ) {
        wp_register_style( $handle, $relative_src, $deps );
    }

    /**
     * Register/enqueue scripts used for this block on the frontend, during render.
     *
     * @param array $attributes Any attributes that currently are available from the block.
     */
    protected function enqueue_scripts( array $attributes = [] ) {
        if ( null !== $this->get_block_type_script() ) {
            wp_enqueue_script( $this->get_block_type_script( 'handle' ) );
        }
    }

    /**
     * Include dynamic content template
     *
     * @return  string
     */
    protected function include_template( $template_name, $args ) {
        ob_start();
        
        $file =  Wpeventin::templates_dir() . 'parts/' . $template_name . '.php';

        extract( $args, EXTR_SKIP );

        if ( file_exists( $file ) ) {
            include $file;
        }

        return ob_get_clean();
    }

    /**
     * Check a request from editor
     *
     * @return  bool
     */
    protected function is_editor() {
        return (defined('REST_REQUEST') && REST_REQUEST) || is_admin();
    }
}