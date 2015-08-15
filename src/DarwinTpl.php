<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 8/10/15
 * Time: 6:46 PM
 */

namespace Darwin;


/**
 * Class SimpleTpl
 * @package libs
 *
 * Simple templating engine.
 *
 * Simple templating engine uses native Php markup.
 * So no compilation or alternative syntax are needed.
 * Inspired by Plates Php templating engine.
 *
 */
class DarwinTpl
{


    /**
     * @var array the template data
     */
    protected $data = array();

    /**
     * @var array the blocks
     */
    protected $blocks = array();

    /**
     * @var array the blocks
     */
    protected $blocksData = array();

    /**
     * @var array the block's parents.
     */
    protected $parents = array();

    /**
     * @var array the loaded plugins
     */
    protected $plugins = array();

    /**
     * @var string the rendered template
     */
    protected $template = '';

    /**
     * @var string The template's root directory
     */
    protected $templatesDir = __DIR__;

    /**
     * @var string the layout of the current loaded template.
     */
    protected $layout = '';

    /**
     * @var string The template file extension By default 'php'
     */
    protected $templateExtension = 'php';


    public function __construct( $templatesDir )
    {
        $this->setTemplatesDir( $templatesDir );
    }

    /**
     * Prepare the template and data to be rendered to the user.
     * Throws exception if the template file does not exist.
     *
     * @param $template
     * @param array $data
     * @throws \Exception
     *
     */
    public function render( $template, $data = array() )
    {
        if( ! $this->checkTemplate( $template ) )
            throw new \Exception( 'The template file '. $template .' does not exists.' );

        $this->template = $template;

        $this->data = array_merge( $this->data, $data );

        $this->display();

    }

    /**
     * Add a variable to the template.
     *
     * @param $name the variable name.
     * @param $var the variable itself.
     *
     */
    public function assign( $name, $var )
    {
        $this->data[$name] = $var;
    }

    /**
     * Sets the template's root dir.
     * Throws exception if the directory does not exist.
     *
     * @param $templatesDir
     * @throws \Exception
     *
     */
    public function setTemplatesDir( $templatesDir )
    {
        if( ! file_exists( $templatesDir ) OR ! is_dir( $templatesDir ) )
            Throw new \Exception( 'The Template directory '.$templatesDir.' does not exists.' );

        $this->templatesDir = $templatesDir;
    }

    /**
     * Sets the template file extension.
     *
     * @param $extension
     *
     */
    public function setTemplateExtension( $extension )
    {
        $this->templateExtension = $extension;
    }

    /**
     * Add a new plugin.
     *
     * @param $instance
     *
     */
    public function addPlugin( $instance )
    {
        $instance->init( $this );
    }

    /**
     * Register a new plugin method.
     *
     * @param $name
     * @param $object
     * @param $method
     *
     */
    public function register( $name, &$object, $method )
    {
        $this->plugins[$name] = array( $object, $method );
    }

    /**
     * Call a plugin method.
     *
     * @param $name
     * @param $params
     * @return mixed
     *
     */
    public function __call( $name, $params )
    {
        if( array_key_exists( $name, $this->plugins ) )
        {
            return call_user_func_array( $this->plugins[$name], $params );
        }
    }

    /**
     * Gets data from the rendered variables.
     *
     * Returns the full rendered data.
     * Or simply a field value.
     *if the field does not exist null value is returned.
     *
     * @param null $name
     * @return mixed|array|null
     *
     */
    public function getData( $name = null )
    {
        if( is_null( $name ) )
            return $this->data;

        if( array_key_exists( $name, $this->data ) )
            return $this->data[$name];

        return null;

    }

    /**
     * Return the full file path.
     * starting from the templates dir folder.
     *
     * @param $file the template file name
     * @return string The full template path
     *
     */
    protected function getFile( $file )
    {
        return $this->templatesDir.DIRECTORY_SEPARATOR
        .str_replace( '/', DIRECTORY_SEPARATOR, $file ).'.'.$this->templateExtension;
    }

    /**
     * Checks if a template file exists.
     *
     * @param $template The template name
     * @return bool true if the template exists, false if not
     *
     */
    protected  function checkTemplate( $template )
    {
        if(file_exists( $this->getFile( $template ) ))
            return true;

        return false;
    }


    /**
     * Display the rendered template to the user.
     * Throws exception. if a template file or layout does not exist.
     *
     * @throws \Exception
     *
     *
     */
    protected function display()
    {
        try
        {
            if(ob_get_level())
                ob_end_clean();
            ob_start( array( &$this, 'sanitizeOutput' ) );
            extract( $this->data );

            require_once $this->getFile( $this->template );

            while( $this->layout !== '' )
            {
                $this->clearParents();

                if(  ! $this->checkTemplate( $this->layout ) )
                    throw new \Exception('The layout file '.$this->layout.' does not exists.');

                $filePath = $this->getFile( $this->layout );

                $this->layout = '';

                include_once $filePath;
            }

            if( ob_get_level() )
            ob_end_flush();
        }
        catch ( \Exception $ex )
        {
            if( ob_get_level() )
                ob_end_clean();

            throw $ex;
        }

    }

    /**
     * Starts a block.
     *
     * @param $block the block name.
     */
    public function startblock( $block )
    {
        array_unshift( $this->blocks, $block );

        array_unshift( $this->parents, $block );

        ob_start( array( &$this, 'sanitizeOutput' ) );
    }

    /**
     * EnDIRECTORY_SEPARATOR a block and returns it's contents.
     *
     * @return string the block contents.
     */
    public function endblock()
    {
        if( empty( $this->blocks ) )
            return;

        $block = $this->blocks[0];

        if( ! $this->checkBlock( $block ) )
        {
            $this->blocksData[$block] = ob_get_contents();
        }

        ob_end_clean();

        if( $this->layout === '' OR $this->hasParents() )
        {
            array_shift( $this->blocks );
            echo $this->blocksData[$block];
        }

        array_shift( $this->parents );

    }




    /**
     * Basic output sanitizing.
     * using Php's mb_convert_encoding and htmlentities functions.
     *
     * @param $value
     * @return string
     *
     */
    public function e( $value )
    {
        $value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
        return htmlentities($value, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Includes a file.
     *
     * @param string the file name to be include.
     *
     * if the file does not exist simple it will ignored.
     *
     *
     */
    public function insert( $file )
    {
        if( $this->checkTemplate( $file ) )
                include_once $this->getFile( $file );
    }

    /**
     * Checks if a block data was set or not.
     *
     * @param $name the block name.
     * @return bool
     */
    protected function checkBlock( $name )
    {
        if( ! array_key_exists( $name, $this->blocksData ) )
            return false;

        return true;
    }

    /**
     * @return bool Checks if a block has a parents.
     */
    protected function hasParents()
    {
        if( count( $this->parents ) < 2 )
            return false;

        return true;
    }

    /**
     * Clears the parents array.
     */
    protected function clearParents()
    {
        $this->parents = array();
    }

    /**
     * Sets a layout file for the current template.
     *
     * @param $layout the layout file
     */
    public function setlayout( $layout )
    {
        $this->layout = $layout;
    }

    /**
     * Clear all data.
     *
     */
    public function clearData()
    {
        $this->data = array();
        $this->blocks = array();
        $this->blocksData = array();
        $this->parents = array();
        $this->layout = '';
    }


    protected function sanitizeOutput( $buffer )
    {
        $buffer = trim($buffer);

        /**
         * Remove comment if you want to strip all white spaces out of the contents.
         * All content will be one long single line.
         */

        /*
        $search = array(
            '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
            '/[^\S ]+\</s',  // strip whitespaces before tags, except space
            '/(\s)+/s'       // shorten multiple whitespace sequences
        );

        $replace = array(
            '>',
            '<',
            '\\1'
        );

        $buffer = preg_replace($search, $replace, $buffer);
        */
        return $buffer;
    }

} 
