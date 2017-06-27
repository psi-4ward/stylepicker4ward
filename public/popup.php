<?php

/**
 * Contao Extension to pick predefined CSS-Classes in the backend
 *
 * @copyright  4ward.media 2013
 * @author     Christoph Wiechert <christoph.wiechert@4wardmedia.de>
 * @see        http://www.4wardmedia.de
 * @package    stylepicker4ward
 * @licence    LGPL
 * @filesource
 */



/**
 * Initialize the system
 */
$dir = __DIR__;

while ($dir != '.' && $dir != '/' && !is_file($dir . '/system/initialize.php')) {
    $dir = dirname($dir);
}

if (!is_file($dir . '/system/initialize.php')) {
    echo 'Could not find initialize.php!';
    exit(1);
}

define('TL_MODE', 'BE');
require($dir . '/system/initialize.php');

class Stylepicker4ward_Wizard extends Backend
{

    /**
     * Current Ajax object
     * @var object
     */
    protected $objAjax;


    /**
     * Initialize the controller
     *
     * 1. Import user
     * 2. Call parent constructor
     * 3. Authenticate user
     * 4. Load language files
     * DO NOT CHANGE THIS ORDER!
     */
    public function __construct()
    {
        $this->import('BackendUser', 'User');
        $this->import('Database');
        parent::__construct();

        $this->User->authenticate();

        $this->loadLanguageFile('default');
        $this->loadLanguageFile('modules');
    }


    public function compile()
    {
        $this->Template->headline = $GLOBALS['TL_LANG']['MSC']['stylepicker4ward'];

        $inputName = \Input::get('inputName');
        if(!preg_match("~^[a-z\-_0-9]+$~i",$inputName))
        {
            die('Field-Parameter ERROR!');
        }
        $this->Template->field = $inputName;

        $tbl = \Input::get('tbl');
        $fld = \Input::get('fld');

        $sec = false;
        $cond = false;
        $layout = array();

        $id = \Input::get('id');

        // find pid (stylesheet-id) and section
        switch($tbl)
        {
            case 'tl_content':
                $objContent = $this->Database->prepare("SELECT type,pid,ptable FROM tl_content WHERE id=?")->limit(1)->execute($id);
                $id = $objContent->pid;
                $cond = $objContent->type;
                if ($objContent->ptable == "tl_news") break; // if we deal with news, use all layouts and all columns

            case 'tl_article':
                $objArticle = $this->Database->prepare("SELECT pid,inColumn FROM tl_article WHERE id=?")->limit(1)->execute($id);
                $sec = $objArticle->inColumn;
                $id = $objArticle->pid;

            case 'tl_page':
                $objPage = $this->getPageDetails($id);
                $layout = $objPage->layout;

                break;

            default:
                /**
                 * HOOK to get table,PID(s),section and condition
                 * in-parameter: str $table, int $id
                 * out-parameter as array or FALSE if the callback does not match:
                 * 		array($tbl,$pids,$sec,$cond)
                 * 		str $tbl: table name, mostly the same as from the in-parameter
                 * 		array $layout: ID of Pagelayout
                 * 		str $sec: a section (column) identifier
                 * 		str $cond: some addition condition
                 */
                if (isset($GLOBALS['TL_HOOKS']['stylepicker4ward_getFilter']) && is_array($GLOBALS['TL_HOOKS']['stylepicker4ward_getFilter']))
                {
                    foreach ($GLOBALS['TL_HOOKS']['stylepicker4ward_getFilter'] as $callback)
                    {
                        $this->import($callback[0]);
                        $erg = $this->$callback[0]->$callback[1]($tbl, $id);
                        if(is_array($erg))
                        {
                            list($tbl,$layout,$sec,$cond) = $erg;
                            break;
                        }
                    }
                }
                break;
        }

        // build where clause
        // respect the order for little query optimising
        if(!preg_match("~^[a-z0-9_\-]+$~i", $tbl)) die('unexpected chars in tbl-param');
        if(!preg_match("~^[a-z0-9_\-]*$~i", $sec)) die('unexpected chars in sec-param');

        $arrWhere = array();
        $arrWhere[] = 'c.tstamp <> 0';
        if($layout) $arrWhere[] = 'FIND_IN_SET('.$layout.',c.layouts)';
        $arrWhere[] = 'tbl="'.$tbl.'"';
        if($sec) $arrWhere[] = 'sec="'.$sec.'"';
        if(strlen($fld)) $arrWhere[] = 'fld="'.$fld.'"';

        // get all classes
        $objItems = $this->Database->execute('	SELECT c.*, GROUP_CONCAT(DISTINCT t.cond SEPARATOR ",") AS cond
								  				FROM tl_stylepicker4ward_target AS t
								  				LEFT JOIN tl_stylepicker4ward AS c ON (t.pid = c.id)
								  				WHERE '.implode(' AND ',$arrWhere).'
								  				GROUP BY c.id
								  				ORDER BY c.title');
        while($objItems->next())
        {
            if($objItems->image)
            {
                $objFile = \FilesModel::findByUuid($objItems->image);
                $objItems->image = $objFile->path;
            }
        }

        $arrItems = $objItems->fetchAllAssoc();

        // filter condition
        if($cond)
        {
            foreach($arrItems as $k => $item)
            {
                if(strlen($item['cond']))
                {
                    $arrConds = explode(',',$item['cond']);
                    $match = false;
                    foreach($arrConds as $condPiece)
                    {
                        if($cond == $condPiece)
                        {
                            $match = true;
                            break;
                        }
                    }
                    if(!$match)
                        unset($arrItems[$k]);

                }
            }
        }

        $this->Template->items = $arrItems;

    }


    /**
     * Run controller and parse the login template
     */
    public function run()
    {
        $this->Template = new BackendTemplate('be_stylepicker4ward');

        $this->compile();

        if (!strlen($this->Template->headline))
        {
            $this->Template->headline = $GLOBALS['TL_CONFIG']['websiteTitle'];
        }

        $this->Template->theme = $this->getTheme();
        $this->Template->base = $this->Environment->base;
        $this->Template->language = $GLOBALS['TL_LANGUAGE'];
        $this->Template->title = $GLOBALS['TL_CONFIG']['websiteTitle'];
        $this->Template->charset = $GLOBALS['TL_CONFIG']['characterSet'];
        $this->Template->pageOffset = \Input::cookie('BE_PAGE_OFFSET');
        $this->Template->error = (\Input::get('act') == 'error') ? $GLOBALS['TL_LANG']['ERR']['general'] : '';
        $this->Template->skipNavigation = $GLOBALS['TL_LANG']['MSC']['skipNavigation'];
        $this->Template->request = ampersand($this->Environment->request);
        $this->Template->top = $GLOBALS['TL_LANG']['MSC']['backToTop'];
        $this->Template->be27 = !$GLOBALS['TL_CONFIG']['oldBeTheme'];
        $this->Template->expandNode = $GLOBALS['TL_LANG']['MSC']['expandNode'];
        $this->Template->collapseNode = $GLOBALS['TL_LANG']['MSC']['collapseNode'];

        $this->Template->output();
    }
}

// run the stuff
$x = new Stylepicker4ward_Wizard();
$x->run();
