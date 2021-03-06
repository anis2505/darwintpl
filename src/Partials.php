<?php
namespace Darwin;


/**
 * Class Partials
 * @package Darwin
 *
 * Partials rendering class.
 *
 */
class Partials
{

	/**
	*
	* @var string The full path to the partials directory.
	*/
	public $partialsDir;

	/**
	*
	* @var string the partial file extension.
	*/
	protected $partialExtension;


	public function __construct( $partialsDir, $partialExtension = 'php' )
	{
		 if( ! file_exists( $partialsDir ) OR ! is_dir( $partialsDir ) )
            Throw new \Exception( 'The partial directory '.$partialsDir.' does not exists.' );

		$this->partialsDir = $partialsDir;
		$this->partialExtension = $partialExtension;
	}

	/**
	* Partial rendering method.
	*
	* Render partials and return the resulting contents.
	*
	* @throws Exception when the requested partial was not found.
	*
	* @param string the requested partial file.
	* @param array the assigned data.
	*
	* @return string the partial rendered contents.
	*/
    public function renderPartial( $partial, $data = array() )
    {
        ob_start();
        
            extract($data);
            
            $filePath = $this->partialsDir.DIRECTORY_SEPARATOR.str_replace( '/', DIRECTORY_SEPARATOR, $partial ).'.'.$this->partialExtension;
            
            if( ! file_exists( $filePath ) )
                throw new \Exception("The partial file {$partial} was not found", 404);
                
            include $filePath;
            
            $partialContents = ob_get_contents();
        
        ob_end_clean();

        return $partialContents;
    }

}
