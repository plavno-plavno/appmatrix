<?php

//include_once get_template_directory() . '/theme-includes.php';

require_once(get_template_directory() . '/inc/theme_init.php');


/*
   Interface: iFotonMikadoInterfaceLayoutNode
   A interface that implements Layout Node methods
*/

interface iFotonMikadoInterfaceLayoutNode
{
    public function hasChidren();

    public function getChild($key);

    public function addChild($key, $value);
}

/*
   Interface: iFotonMikadoInterfaceRender
   A interface that implements Render methods
*/

interface iFotonMikadoInterfaceRender
{
    public function render($factory);
}

/*
   Class: FotonMikadoClassFramework
   A class that initializes Mikado Framework
*/

class FotonMikadoClassFramework
{
    private static $instance;
    public $mkdOptions;
    public $mkdMetaBoxes;
    public $mkdTaxonomyOptions;
    public $mkdUserOptions;
    private $skin;

    private function __construct()
    {
        $this->mkdOptions = FotonMikadoClassOptions::get_instance();
        $this->mkdMetaBoxes = FotonMikadoClassMetaBoxes::get_instance();
        $this->mkdTaxonomyOptions = FotonMikadoClassTaxonomyOptions::get_instance();
        $this->mkdUserOptions = FotonMikadoClassUserOptions::get_instance();
        $this->mkdDashboardOptions = FotonMikadoClassDashboardOptions::get_instance();
    }

    public static function get_instance()
    {

        if (null == self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function getSkin()
    {
        return $this->skin;
    }

    public function setSkin(FotonMikadoClassSkinAbstract $skinObject)
    {
        $this->skin = $skinObject;
    }
}

/**
 * Class FotonMikadoClassSkinManager
 *
 * Class that used like a factory for skins.
 * It loads required skin file and instantiates skin class
 */
class FotonMikadoClassSkinManager
{
    /**
     * @var this will be an instance of skin
     */
    private $skin;

    /**
     * @see FotonMikadoClassSkinManager::setSkin()
     */
    public function __construct()
    {
        $this->setSkin();
    }

    /**
     * Loads wanted skin, instantiates skin class and stores it in $skin attribute
     *
     * @param string $skinName skin to load. Must match skin folder name
     */
    private function setSkin($skinName = MIKADO_PROFILE_SLUG)
    {
        if ($skinName !== '') {
            if (file_exists(get_template_directory() . '/framework/admin/skins/' . $skinName . '/skin.php')) {
                require_once get_template_directory() . '/framework/admin/skins/' . $skinName . '/skin.php';

                $skinName = ucfirst($skinName) . esc_html__('Skin', 'foton');

                $this->skin = new $skinName();
            }
        } else {
            $this->skin = false;
        }
    }

    /**
     * Returns current skin object. It $skin attribute isn't set it calls setSkin method
     *
     * @return mixed
     *
     * @see FotonMikadoClassSkinManager::setSkin()
     */
    public function getSkin()
    {
        if (empty($this->skin)) {
            $this->setSkin();
        }

        return $this->skin;
    }
}

/**
 * Class FotonMikadoClassSkinAbstract
 *
 * Abstract class that each skin class must extend
 */
abstract class FotonMikadoClassSkinAbstract
{
    /**
     * @var string
     */
    protected $skinName;
    /**
     * @var array of styles that skin will be including
     */
    protected $styles;
    /**
     * @var array of scripts that skin will be including
     */
    protected $scripts;
    /**
     * @var array of icons names for each menu item that theme is adding
     */
    protected $icons;
    /**
     * @var array of menu items positions of each menu item that theme is adding
     */
    protected $itemPosition;

    /**
     * Returns skin name attribute whenever skin is used in concatenation
     * @return mixed
     */
    public function __toString()
    {
        return $this->skinName;
    }

    /**
     * @return mixed
     */
    public function getSkinName()
    {
        return $this->skinName;
    }

    /**
     * Loads template part with params. Uses locate_template function which is child theme friendly
     *
     * @param $template string template to load
     * @param array $params parameters to pass to template
     */
    public function loadTemplatePart($template, $params = array())
    {
        if (is_array($params) && count($params)) {
            extract($params);
        }

        if ($template !== '') {
            include(foton_mikado_find_template_path('framework/admin/skins/' . $this->skinName . '/templates/' . $template . '.php'));
        }
    }

    /**
     * Goes through each added scripts and enqueus it
     */
    public function enqueueScripts()
    {
        if (is_array($this->scripts) && count($this->scripts)) {
            foreach ($this->scripts as $scriptHandle => $scriptPath) {
                wp_enqueue_script($scriptHandle);
            }
        }
    }

    /**
     * Goes through each added styles and enqueus it
     */
    public function enqueueStyles()
    {
        if (is_array($this->styles) && count($this->styles)) {
            foreach ($this->styles as $styleHandle => $stylePath) {
                wp_enqueue_style($styleHandle);
            }
        }
    }

    /**
     * Echoes script tag that generates global variable that will be used in TinyMCE
     */
    public function setShortcodeJSParams()
    { ?>
        <script>
            window.mkdSCIcon = '<?php echo foton_mikado_get_skin_uri() . '/assets/img/admin-logo-icon.png'; ?>';
            window.mkdSCLabel = '<?php echo esc_html(ucfirst($this->skinName)); ?> <?php esc_html_e('Shortcodes', 'foton') ?>';
        </script>
    <?php }

    /**
     * Formates skin name so it can be used in concatenation
     * @return string
     */
    public function getSkinLabel()
    {
        return ucfirst($this->skinName);
    }

    /**
     * Returns URI to skin folder
     * @return string
     */
    public function getSkinURI()
    {
        return get_template_directory_uri() . '/framework/admin/skins/' . $this->skinName;
    }

    /**
     * Here options page content will be generated
     * @return mixed
     */
    public abstract function renderOptions();

    /**
     * Here backup options page will be generated
     * @return mixed
     */
    public abstract function renderBackupOptions();

    /**
     * Here import page will be generated
     * @return mixed
     */
    public abstract function renderImport();

    /**
     * Here all scripts will be registered
     * @return mixed
     */
    public abstract function registerScripts();

    /**
     * Here all styles will be registered
     * @return mixed
     */
    public abstract function registerStyles();
}

/*
   Class: FotonMikadoClassOptions
   A class that initializes Mikado Options
*/

class FotonMikadoClassOptions
{
    private static $instance;
    public $adminPages;
    public $options;
    public $optionsByType;

    private function __construct()
    {
        $this->adminPages = array();
        $this->options = array();
        $this->optionsByType = array();
    }

    public static function get_instance()
    {

        if (null == self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function addAdminPage($key, $page)
    {
        $this->adminPages[$key] = $page;
    }

    public function getAdminPage($key)
    {
        return $this->adminPages[$key];
    }

    public function adminPageExists($key)
    {
        return array_key_exists($key, $this->adminPages);
    }

    public function getAdminPageFromSlug($slug)
    {
        foreach ($this->adminPages as $key => $page) {
            if ($page->slug == $slug) {
                return $page;
            }
        }

        return;
    }

    public function addOption($key, $value, $type = '')
    {
        $this->options[$key] = $value;

        $this->addOptionByType($type, $key);
    }

    public function getOption($key)
    {
        if (isset($this->options[$key])) {
            return $this->options[$key];
        }

        return;
    }

    public function addOptionByType($type, $key)
    {
        $this->optionsByType[$type][] = $key;
    }

    public function getOptionsByType($type)
    {
        if (array_key_exists($type, $this->optionsByType)) {
            return $this->optionsByType[$type];
        }

        return false;
    }

    public function getOptionValue($key)
    {
        global $foton_mikado_global_options;

        if (array_key_exists($key, $foton_mikado_global_options)) {
            return $foton_mikado_global_options[$key];
        } elseif (array_key_exists($key, $this->options)) {
            return $this->getOption($key);
        }

        return false;
    }
}

/*
   Class: FotonMikadoClassAdminPage
   A class that initializes Mikado Admin Page
*/

class FotonMikadoClassAdminPage implements iFotonMikadoInterfaceLayoutNode
{
    public $layout;
    private $factory;
    public $slug;
    public $title;
    public $icon;

    function __construct($slug = "", $title = "", $icon = "")
    {
        $this->layout = array();
        $this->factory = new FotonMikadoClassFieldFactory();
        $this->slug = $slug;
        $this->title = $title;
        $this->icon = $icon;
    }

    public function hasChidren()
    {
        return (count($this->layout) > 0) ? true : false;
    }

    public function getChild($key)
    {
        return $this->layout[$key];
    }

    public function addChild($key, $value)
    {
        $this->layout[$key] = $value;
    }

    function render()
    {
        foreach ($this->layout as $child) {
            $this->renderChild($child);
        }
    }

    public function renderChild(iFotonMikadoInterfaceRender $child)
    {
        $child->render($this->factory);
    }
}

/*
   Class: FotonMikadoClassMetaBoxes
   A class that initializes Mikado Meta Boxes
*/

class FotonMikadoClassMetaBoxes
{
    private static $instance;
    public $metaBoxes;
    public $options;
    public $optionsByType;

    private function __construct()
    {
        $this->metaBoxes = array();
        $this->options = array();
        $this->optionsByType = array();
    }

    public static function get_instance()
    {

        if (null == self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function addMetaBox($key, $box)
    {
        $this->metaBoxes[$key] = $box;
    }

    public function getMetaBox($key)
    {
        return $this->metaBoxes[$key];
    }

    public function addOption($key, $value, $type = '')
    {
        $this->options[$key] = $value;
        $this->addOptionByType($type, $key);
    }

    public function getOption($key)
    {
        if (isset($this->options[$key])) {
            return $this->options[$key];
        }

        return;
    }

    public function addOptionByType($type, $key)
    {
        $this->optionsByType[$type][] = $key;
    }

    public function getOptionsByType($type)
    {

        if (array_key_exists($type, $this->optionsByType)) {
            return $this->optionsByType[$type];
        }

        return array();
    }

    public function getMetaBoxesByScope($scope)
    {
        $boxes = array();

        if (is_array($this->metaBoxes) && count($this->metaBoxes)) {
            foreach ($this->metaBoxes as $metabox) {
                if (is_array($metabox->scope) && in_array($scope, $metabox->scope)) {
                    $boxes[] = $metabox;
                } elseif ($metabox->scope !== '' && $metabox->scope === $scope) {
                    $boxes[] = $metabox;
                }
            }
        }

        return $boxes;
    }
}

/*
   Class: FotonMikadoClassMetaBox
   A class that initializes Mikado Meta Box
*/

class FotonMikadoClassMetaBox implements iFotonMikadoInterfaceLayoutNode
{
    public $layout;
    private $factory;
    public $scope;
    public $title;
    public $hidden_property;
    public $hidden_values = array();
    public $name;

    function __construct($scope = "", $title = "", $hidden_property = "", $hidden_values = array(), $name = '')
    {
        $this->layout = array();
        $this->factory = new FotonMikadoClassFieldFactory();
        $this->scope = $scope;
        $this->title = $this->setTitle($title);
        $this->hidden_property = $hidden_property;
        $this->hidden_values = $hidden_values;
        $this->name = $name;
    }

    public function hasChidren()
    {
        return (count($this->layout) > 0) ? true : false;
    }

    public function getChild($key)
    {
        return $this->layout[$key];
    }

    public function addChild($key, $value)
    {
        $this->layout[$key] = $value;
    }

    function render()
    {
        foreach ($this->layout as $child) {
            $this->renderChild($child);
        }
    }

    public function renderChild(iFotonMikadoInterfaceRender $child)
    {
        $child->render($this->factory);
    }

    public function setTitle($label)
    {
        global $foton_mikado_global_Framework;

        return $foton_mikado_global_Framework->getSkin()->getSkinLabel() . ' ' . $label;
    }
}

/*
   Class: FotonMikadoClassTaxonomyOptions
   A class that initializes FotonMikadoClass Taxonomy Options
*/

class FotonMikadoClassTaxonomyOptions
{
    private static $instance;
    public $taxonomyOptions;

    private function __construct()
    {
        $this->taxonomyOptions = array();
    }

    public static function get_instance()
    {

        if (null == self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function addTaxonomyOptions($key, $options)
    {
        $this->taxonomyOptions[$key] = $options;
    }

    public function getTaxonomyOptions($key)
    {
        return $this->taxonomyOptions[$key];
    }
}

/*
   Class: FotonMikadoClassTaxonomyOption
   A class that initializes FotonMikadoClass Taxonomy Option
*/

class FotonMikadoClassTaxonomyOption implements iFotonMikadoInterfaceLayoutNode
{
    public $layout;
    private $factory;
    public $scope;

    function __construct($scope = "")
    {
        $this->layout = array();
        $this->factory = new FotonMikadoClassTaxonomyFieldFactory();
        $this->scope = $scope;
    }

    public function hasChidren()
    {
        return (count($this->layout) > 0) ? true : false;
    }

    public function getChild($key)
    {
        return $this->layout[$key];
    }

    public function addChild($key, $value)
    {
        $this->layout[$key] = $value;
    }

    function render()
    {
        foreach ($this->layout as $child) {
            $this->renderChild($child);
        }
    }

    public function renderChild(iFotonMikadoInterfaceRender $child)
    {
        $child->render($this->factory);
    }
}

/*
   Class: FotonMikadoClassUserOptions
   A class that initializes FotonMikadoClass User Options
*/

class FotonMikadoClassUserOptions
{
    private static $instance;
    public $userOptions;

    private function __construct()
    {
        $this->userOptions = array();
    }

    public static function get_instance()
    {

        if (null == self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function addUserOptions($key, $options)
    {
        $this->userOptions[$key] = $options;
    }

    public function getUserOptions($key)
    {
        return $this->userOptions[$key];
    }
}

/*
   Class: FotonMikadoClassUserOption
   A class that initializes FotonMikadoClass User Option
*/

class FotonMikadoClassUserOption implements iFotonMikadoInterfaceLayoutNode
{
    public $layout;
    private $factory;
    public $scope;

    function __construct($scope = "")
    {
        $this->layout = array();
        $this->factory = new FotonMikadoClassUserFieldFactory();
        $this->scope = $scope;
    }

    public function hasChidren()
    {
        return (count($this->layout) > 0) ? true : false;
    }

    public function getChild($key)
    {
        return $this->layout[$key];
    }

    public function addChild($key, $value)
    {
        $this->layout[$key] = $value;
    }

    function render()
    {
        foreach ($this->layout as $child) {
            $this->renderChild($child);
        }
    }

    public function renderChild(iFotonMikadoInterfaceRender $child)
    {
        $child->render($this->factory);
    }
}

/*
   Class: FotonMikadoClassDashboardOptions
   A class that initializes FotonMikadoClass Dashboard Options
*/

class FotonMikadoClassDashboardOptions
{
    private static $instance;
    public $dashboardOptions;

    private function __construct()
    {
        $this->dashboardOptions = array();
    }

    public static function get_instance()
    {

        if (null == self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function addDashboardOptions($key, $options)
    {
        $this->dashboardOptions[$key] = $options;
    }

    public function getDashboardOptions($key)
    {
        return $this->dashboardOptions[$key];
    }
}

/*
   Class: FotonMikadoClassDashboardOption
   A class that initializes FotonMikadoClass Dashboard Option
*/

class FotonMikadoClassDashboardOption implements iFotonMikadoInterfaceLayoutNode
{
    public $layout;
    private $factory;

    function __construct()
    {
        $this->layout = array();
        $this->factory = new FotonMikadoClassDashboardFieldFactory();
    }

    public function hasChidren()
    {
        return (count($this->layout) > 0) ? true : false;
    }

    public function getChild($key)
    {
        return $this->layout[$key];
    }

    public function addChild($key, $value)
    {
        $this->layout[$key] = $value;
    }

    function render()
    {
        foreach ($this->layout as $child) {
            $this->renderChild($child);
        }
    }

    public function renderChild(iFotonMikadoInterfaceRender $child)
    {
        $child->render($this->factory);
    }
}

if (!function_exists('foton_mikado_init_framework_variable')) {
    function foton_mikado_init_framework_variable()
    {
        global $foton_mikado_global_Framework;

        $foton_mikado_global_Framework = FotonMikadoClassFramework::get_instance();
        $mkdSkinManager = new FotonMikadoClassSkinManager();
        $foton_mikado_global_Framework->setSkin($mkdSkinManager->getSkin());
    }

    add_action('foton_mikado_action_before_options_map', 'foton_mikado_init_framework_variable');
}


class FotonMikadoClassIconCollections
{
    private static $instance;
    public $iconCollections;
    public $VCParamsArray;
    public $iconPackParamName;

    private $iconPackCollections;
    private $iconPackOptions;
    private $iconPackSocialOptions;

    private function __construct()
    {
        $this->iconPackParamName = 'icon_pack';
        $this->iconPackCollections = foton_mikado_get_icon_pack_collections(true);
        $this->iconPackOptions = foton_mikado_get_icon_pack_options();
        $this->iconPackSocialOptions = foton_mikado_get_icon_pack_social_options();

        $this->initIconCollections();
    }

    public static function get_instance()
    {
        if (null == self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Method that adds individual collections to set of collections
     */
    private function initIconCollections()
    {
        $collections = $this->getIconPackCollections();

        if (!empty($collections)) {
            foreach ($collections as $key => $value) {
                $this->addIconCollection($key, $value);
            }
        }
    }

    public function getIconsMetaBoxOrOption($attributes)
    {
        $scope = '';
        $label = '';
        $parent = '';
        $name = '';
        $defaul_icon_pack = '';
        $default_icon = '';
        $type = '';
        $field_type = '';

        extract($attributes);

        $icon_collections = $this->getCollectionsWithSocialIcons();
        $options = $this->getIconPackSocialOptions();

        if ($scope == 'regular') {
            $options = $this->getIconPackOptions();
        }

        if ($type == 'meta-box') {
            foton_mikado_create_meta_box_field(
                array(
                    'parent' => $parent,
                    'type' => 'select' . $field_type,
                    'name' => $name,
                    'default_value' => $defaul_icon_pack,
                    'label' => $label,
                    'options' => $options
                )
            );
        } else if ($type == 'option') {
            foton_mikado_add_admin_field(
                array(
                    'parent' => $parent,
                    'type' => 'select' . $field_type,
                    'name' => $name,
                    'default_value' => $defaul_icon_pack,
                    'label' => $label,
                    'options' => $options
                )
            );
        }

        foreach ($icon_collections as $collection_key => $collection_object) {
            if ($scope == 'regular') {
                $icons_array = $collection_object->getIconsArray();
            } else {
                $icons_array = $collection_object->getSocialIconsArray();
            }

            $icon_collections_keys = array_keys($icon_collections);

            unset($icon_collections_keys[array_search($collection_key, $icon_collections_keys)]);

            $icon_hide_values = $icon_collections_keys;
            array_push($icon_hide_values, ''); //add empty value for icon switcher

            $icon_pack_container = foton_mikado_add_admin_container(
                array(
                    'parent' => $parent,
                    'name' => $name . '_' . $collection_object->param . '_container',
                    'simple' => $field_type == 'simple' ? true : false,
                    'dependency' => array(
                        'hide' => array(
                            $name => $icon_hide_values
                        )
                    )
                )
            );

            if ($type == 'meta-box') {
                foton_mikado_create_meta_box_field(
                    array(
                        'parent' => $icon_pack_container,
                        'type' => 'select' . $field_type,
                        'name' => $name . '_' . $collection_object->param,
                        'default_value' => $default_icon,
                        'label' => $collection_object->title,
                        'options' => $icons_array
                    )
                );
            } else if ($type == 'option') {
                foton_mikado_add_admin_field(
                    array(
                        'parent' => $icon_pack_container,
                        'type' => 'select' . $field_type,
                        'name' => $name . '_' . $collection_object->param,
                        'default_value' => $default_icon,
                        'label' => $collection_object->title,
                        'options' => $icons_array
                    )
                );
            }
        }
    }

    public function getVCParamsArray($iconPackDependency = array(), $iconCollectionPrefix = "", $emptyIconPack = false)
    {
        if ($emptyIconPack) {
            $iconCollectionsVC = $this->getIconCollectionsVCEmpty();
        } else {
            $iconCollectionsVC = $this->getIconCollectionsVC();
        }

        $iconPackParams = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Icon Pack', 'foton'),
            'param_name' => $this->iconPackParamName,
            'value' => $iconCollectionsVC,
            'save_always' => true
        );

        if ($iconPackDependency !== "") {
            $iconPackParams["dependency"] = $iconPackDependency;
        }

        $iconPackParams = array($iconPackParams);

        $iconSetParams = array();
        if (is_array($this->iconCollections) && count($this->iconCollections)) {
            foreach ($this->iconCollections as $key => $collection) {
                $iconSetParams[] = array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Icon', 'foton'),
                    'param_name' => $iconCollectionPrefix . $collection->param,
                    'value' => $collection->getIconsArray(),
                    'dependency' => array('element' => $this->iconPackParamName, 'value' => array($key)),
                    'save_always' => true
                );
            }
        }

        return array_merge($iconPackParams, $iconSetParams);
    }

    public function getSocialVCParamsArray($iconPackDependency = array(), $iconCollectionPrefix = "", $emptyIconPack = false)
    {
        if ($emptyIconPack) {
            $iconCollectionsVC = $this->getSocialIconCollectionsVCEmpty();
        } else {
            $iconCollectionsVC = $this->getSocialIconCollectionsVC();
        }

        $iconPackParams = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Icon Pack', 'foton'),
            'param_name' => $this->iconPackParamName,
            'value' => $iconCollectionsVC,
            'save_always' => true
        );

        if ($iconPackDependency !== "") {
            $iconPackParams["dependency"] = $iconPackDependency;
        }

        $iconPackParams = array($iconPackParams);

        $iconSetParams = array();
        if (is_array($this->iconCollections) && count($this->iconCollections)) {
            foreach ($this->iconCollections as $key => $collection) {
                if ($collection->hasSocialIcons()) {
                    $iconSetParams[] = array(
                        'type' => 'dropdown',
                        'class' => '',
                        'heading' => esc_html__('Icon', 'foton'),
                        'param_name' => $iconCollectionPrefix . $collection->param,
                        'value' => $collection->getSocialIconsArrayVC(),
                        'dependency' => array('element' => $this->iconPackParamName, 'value' => array($key)),
                        'save_always' => true
                    );
                }
            }
        }

        return array_merge($iconPackParams, $iconSetParams);
    }

    public function getIconWidgetParamsArray()
    {
        $iconPackParams[] = array(
            'type' => 'dropdown',
            'name' => 'icon_pack',
            'title' => esc_html__('Icon Pack', 'foton'),
            'options' => $this->getIconPackOptions()
        );

        $iconSetParams = array();
        if (is_array($this->iconCollections) && count($this->iconCollections)) {
            foreach ($this->iconCollections as $key => $collection) {
                $iconSetParams[] = array(
                    'type' => 'dropdown',
                    'title' => $collection->title . esc_html__(' Icon', 'foton'),
                    'name' => $collection->param,
                    'options' => array_flip($collection->getIconsArray())
                );
            }
        }

        return array_merge($iconPackParams, $iconSetParams);
    }

    public function getSocialIconWidgetMultipleParamsArray($count)
    {
        $iconOps = array();
        $iconCollectionsVC = $this->getCollectionsWithSocialIcons();

        $iconPackParams[] = array(
            'type' => 'dropdown',
            'name' => 'icon_pack',
            'title' => esc_html__('Icon Pack', 'foton'),
            'options' => $this->getIconPackSocialOptions()
        );

        for ($n = 1; $n <= $count; $n++) {
            if (is_array($iconCollectionsVC) && count($iconCollectionsVC)) {
                foreach ($iconCollectionsVC as $key => $collection) {
                    $iconOps[] = array(
                        'type' => 'dropdown',
                        'name' => $collection->param . '_' . $n,
                        'title' => sprintf(esc_html__('Icon %s %s Icon', 'foton'), $n, $collection->title),
                        'options' => array_flip($collection->getSocialIconsArrayVC())
                    );
                }
            }

            $iconOps[] = array(
                'type' => 'textfield',
                'name' => 'link_' . $n,
                'title' => sprintf(esc_html__('Link %s', 'foton'), $n)
            );

            $iconOps[] = array(
                'type' => 'dropdown',
                'name' => 'target_' . $n,
                'title' => sprintf(esc_html__('Link Target %s', 'foton'), $n),
                'options' => foton_mikado_get_link_target_array()
            );
        }

        return array_merge($iconPackParams, $iconOps);
    }

    public function getSocialIconWidgetParamsArray()
    {
        $iconCollectionsVC = $this->getCollectionsWithSocialIcons();

        $iconPackParams[] = array(
            'type' => 'dropdown',
            'title' => esc_html__('Icon Pack', 'foton'),
            'name' => 'icon_pack',
            'options' => $this->getIconPackSocialOptions()
        );

        $iconSetParams = array();
        if (is_array($iconCollectionsVC) && count($iconCollectionsVC)) {
            foreach ($iconCollectionsVC as $key => $collection) {
                $iconSetParams[] = array(
                    'type' => 'dropdown',
                    'title' => $collection->title . esc_html__(' Icon', 'foton'),
                    'name' => $collection->param,
                    'options' => array_flip($collection->getSocialIconsArrayVC())
                );
            }
        }

        return array_merge($iconPackParams, $iconSetParams);
    }

    public function getCollectionsWithIcons()
    {
        $collectionsWithIcons = array();

        foreach ($this->iconCollections as $key => $collection) {
            $collectionsWithIcons[$key] = $collection;
        }

        return $collectionsWithIcons;
    }

    public function getCollectionsWithSocialIcons()
    {
        $collectionsWithSocial = array();

        foreach ($this->iconCollections as $key => $collection) {
            if ($collection->hasSocialIcons()) {
                $collectionsWithSocial[$key] = $collection;
            }
        }

        return $collectionsWithSocial;
    }

    public function getIconSizesArray()
    {
        return array(
            esc_html__('Tiny', 'foton') => 'fa-lg',
            esc_html__('Small', 'foton') => 'fa-2x',
            esc_html__('Medium', 'foton') => 'fa-3x',
            esc_html__('Large', 'foton') => 'fa-4x',
            esc_html__('Very Large', 'foton') => 'fa-5x'
        );
    }

    public function getIconSizeClass($iconSize)
    {
        switch ($iconSize) {
            case "fa-lg":
                $iconSize = "mkdf-tiny-icon";
                break;
            case "fa-2x":
                $iconSize = "mkdf-small-icon";
                break;
            case "fa-3x":
                $iconSize = "mkdf-medium-icon";
                break;
            case "fa-4x":
                $iconSize = "mkdf-large-icon";
                break;
            case "fa-5x":
                $iconSize = "mkdf-huge-icon";
                break;
            default:
                $iconSize = "mkdf-small-icon";
        }

        return $iconSize;
    }

    /**
     * @return array
     */
    public function getIconPackCollections()
    {
        return $this->iconPackCollections;
    }

    /**
     * @return array
     */
    public function getIconPackOptions()
    {
        return $this->iconPackOptions;
    }

    /**
     * @return array
     */
    public function getIconPackSocialOptions()
    {
        return $this->iconPackSocialOptions;
    }

    /**
     * @param $key
     *
     * @return bool
     */
    public function getIconCollectionParamNameByKey($key)
    {
        $collection = $this->getIconCollection($key);

        if ($collection) {
            return $collection->param;
        }

        return false;
    }

    public function getShortcodeParams($iconCollectionPrefix = "")
    {
        $iconCollectionsParam = array();
        foreach ($this->iconCollections as $key => $collection) {
            $iconCollectionsParam[$iconCollectionPrefix . $collection->param] = '';
        }

        return array_merge(array($this->iconPackParamName => '',), $iconCollectionsParam);
    }

    public function addIconCollection($key, $value)
    {
        $this->iconCollections[$key] = $value;
    }

    public function getIconCollection($key)
    {
        if (array_key_exists($key, $this->iconCollections)) {
            return $this->iconCollections[$key];
        }

        return false;
    }

    public function getIconCollectionIcons(iFotonMikadoInterfaceIconCollection $collection)
    {
        return $collection->getIconsArray();
    }

    public function getIconCollectionsVC()
    {
        $vc_array = array();
        foreach ($this->iconCollections as $key => $collection) {
            $vc_array[$collection->title] = $key;
        }

        return $vc_array;
    }

    public function getSocialIconCollectionsVC()
    {
        $vc_array = array();
        foreach ($this->iconCollections as $key => $collection) {
            if ($collection->hasSocialIcons()) {
                $vc_array[$collection->title] = $key;
            }
        }

        return $vc_array;
    }

    public function getIconCollectionsVCExclude($exclude)
    {
        $array = $this->getIconCollectionsVC();

        if (is_array($exclude) && count($exclude)) {
            foreach ($exclude as $key) {
                if (($x = array_search($key, $array)) !== false) {
                    unset($array[$x]);
                }
            }

        } else {
            if (($x = array_search($exclude, $array)) !== false) {
                unset($array[$x]);
            }
        }

        return $array;
    }

    public function getIconCollectionsKeys()
    {
        return is_array($this->iconCollections) ? array_keys($this->iconCollections) : [];
    }

    /**
     * Method that returns an array of 'param' attribute of each icon collection
     * @return array array of param attributes
     */
    public function getIconCollectionsParams()
    {
        $paramArray = array();
        if (is_array($this->iconCollections) && count($this->iconCollections)) {
            foreach ($this->iconCollections as $key => $obj) {
                $paramArray[] = $obj->param;
            }
        }

        return $paramArray;
    }

    /**
     * Method that returns an array of 'param' attribute of each icon collection with social icons
     * @return array array of param attributes
     */
    public function getSocialIconCollectionsParams()
    {
        $paramArray = array();

        if (is_array($this->getCollectionsWithSocialIcons()) && count($this->getCollectionsWithSocialIcons())) {
            foreach ($this->getCollectionsWithSocialIcons() as $key => $obj) {
                $paramArray[] = $obj->param;
            }
        }

        return $paramArray;
    }

    public function getIconCollections()
    {
        $array = array();

        foreach ($this->iconCollections as $key => $collection) {
            $array[$key] = $collection->title;
        }

        return $array;
    }

    public function getIconCollectionsEmpty($no_empty_key = "")
    {
        $array = array();
        $array[$no_empty_key] = esc_html__('No Icon', 'foton');

        foreach ($this->iconCollections as $key => $collection) {
            $array[$key] = $collection->title;
        }

        return $array;
    }

    public function getIconCollectionsVCEmpty()
    {
        $vc_array = array();
        $vc_array[esc_html__('No Icon', 'foton')] = '';

        foreach ($this->iconCollections as $key => $collection) {
            $vc_array[$collection->title] = $key;
        }

        return $vc_array;
    }

    public function getSocialIconCollectionsVCEmpty()
    {
        $vc_array = array();
        $vc_array[esc_html__('No Icon', 'foton')] = '';

        foreach ($this->iconCollections as $key => $collection) {
            if ($collection->hasSocialIcons()) {
                $vc_array[$collection->title] = $key;
            }
        }

        return $vc_array;
    }

    public function getIconCollectionsVCEmptyExclude($key)
    {
        $array = $this->getIconCollectionsVCEmpty();

        if (($x = array_search($key, $array)) !== false) {
            unset($array[$x]);
        }

        return $array;
    }

    public function getIconCollectionsExclude($exclude)
    {
        $array = $this->getIconCollections();

        if (is_array($exclude) && count($exclude)) {
            foreach ($exclude as $exclude_key) {
                if (array_key_exists($exclude_key, $array)) {
                    unset($array[$exclude_key]);
                }
            }
        } else {
            if (array_key_exists($exclude, $array)) {
                unset($array[$exclude]);
            }
        }

        return $array;
    }

    public function hasIconCollection($key)
    {
        return array_key_exists($key, $this->iconCollections);
    }

    /**
     * Method that renders icon for given icon pack
     *
     * @param $icon string to render
     * @param $iconPack string to render icon from
     * @param $params array for icon
     *
     * @return mixed
     */
    public function renderIcon($icon, $iconPack, $params = array())
    {
        if ($this->hasIconCollection($iconPack)) {
            $iconObject = $this->getIconCollection($iconPack);

            return $iconObject->render($icon, $params);
        }
    }

    public function enqueueStyles()
    {
        if (is_array($this->iconCollections) && count($this->iconCollections)) {
            foreach ($this->iconCollections as $collection_key => $collection_obj) {
                wp_enqueue_style('mkdf-' . $collection_key, $collection_obj->styleUrl);
            }
        }
    }

    # HEADER AND SIDE MENU ICONS
    public function getSearchIcon($iconPack, $return)
    {
        if ($this->hasIconCollection($iconPack)) {
            $iconsObject = $this->getIconCollection($iconPack);
            $iconHTML = $iconsObject->getSearchIcon();

            if ($return) {
                return $iconHTML;
            } else {
                echo wp_kses_post($iconHTML);
            }
        }
    }

    public function getSearchClose($iconPack, $return)
    {
        if ($this->hasIconCollection($iconPack)) {
            $iconsObject = $this->getIconCollection($iconPack);
            $iconHTML = $iconsObject->getSearchClose();

            if ($return) {
                return $iconHTML;
            } else {
                echo wp_kses_post($iconHTML);
            }
        }
    }

    public function getDropdownCartIcon($iconPack)
    {
        if ($this->hasIconCollection($iconPack)) {
            $iconsObject = $this->getIconCollection($iconPack);
            $iconHTML = $iconsObject->getDropdownCartIcon();

            echo wp_kses_post($iconHTML);
        }
    }

    public function getMenuIcon($iconPack)
    {
        if ($this->hasIconCollection($iconPack)) {
            $iconsObject = $this->getIconCollection($iconPack);
            $iconHTML = $iconsObject->getMenuIcon();

            echo wp_kses_post($iconHTML);
        }
    }

    public function getMenuCloseIcon($iconPack)
    {
        if ($this->hasIconCollection($iconPack)) {
            $iconsObject = $this->getIconCollection($iconPack);
            $iconHTML = $iconsObject->getMenuCloseIcon();

            echo wp_kses_post($iconHTML);
        }
    }

    public function getBackToTopIcon($iconPack)
    {
        if ($this->hasIconCollection($iconPack)) {
            $iconsObject = $this->getIconCollection($iconPack);
            $iconHTML = $iconsObject->getBackToTopIcon();

            echo wp_kses_post($iconHTML);
        }
    }

    public function getMobileMenuIcon($iconPack, $return = false)
    {
        if ($this->hasIconCollection($iconPack)) {
            $iconsObject = $this->getIconCollection($iconPack);
            $iconHTML = $iconsObject->getMobileMenuIcon();

            if ($return) {
                return $iconHTML;
            } else {
                echo wp_kses_post($iconHTML);
            }
        }
    }

    public function getQuoteIcon($iconPack, $return = false)
    {
        if ($this->hasIconCollection($iconPack)) {
            $iconsObject = $this->getIconCollection($iconPack);
            $iconHTML = $iconsObject->getQuoteIcon();

            if ($return) {
                return $iconHTML;
            } else {
                echo wp_kses_post($iconHTML);
            }
        }
    }

    # SOCIAL SIDEBAR ICONS
    public function getFacebookIcon($iconPack)
    {
        if ($this->hasIconCollection($iconPack)) {
            $iconsObject = $this->getIconCollection($iconPack);

            return $iconsObject->getFacebookIcon();
        }
    }

    public function getTwitterIcon($iconPack)
    {
        if ($this->hasIconCollection($iconPack)) {
            $iconsObject = $this->getIconCollection($iconPack);

            return $iconsObject->getTwitterIcon();
        }
    }

    public function getGooglePlusIcon($iconPack)
    {
        if ($this->hasIconCollection($iconPack)) {
            $iconsObject = $this->getIconCollection($iconPack);

            return $iconsObject->getGooglePlusIcon();
        }
    }

    public function getLinkedInIcon($iconPack)
    {
        if ($this->hasIconCollection($iconPack)) {
            $iconsObject = $this->getIconCollection($iconPack);

            return $iconsObject->getLinkedInIcon();
        }
    }

    public function getTumblrIcon($iconPack)
    {
        if ($this->hasIconCollection($iconPack)) {
            $iconsObject = $this->getIconCollection($iconPack);

            return $iconsObject->getTumblrIcon();
        }
    }

    public function getPinterestIcon($iconPack)
    {
        if ($this->hasIconCollection($iconPack)) {
            $iconsObject = $this->getIconCollection($iconPack);

            return $iconsObject->getPinterestIcon();
        }
    }

    public function getVKIcon($iconPack)
    {
        if ($this->hasIconCollection($iconPack)) {
            $iconsObject = $this->getIconCollection($iconPack);

            return $iconsObject->getVKIcon();
        }
    }
}

function modify_jquery()
{
    if (!is_admin()) {
        wp_deregister_script('jquery');
    }
}

//add_action('init', 'modify_jquery');

//add_action("wp_enqueue_scripts", "jquery");
function jquery()
{
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js', false, null);
        wp_enqueue_script('jquery');
    }
}


if (!isset($content_width)) {
    $content_width = 660;
}

add_action('customize_preview_init', 'ideothemo_customize_preview_init');

function ideothemo_customize_preview_init()
{
    $controls = ideothemo_get_customizer_local_modification_trigger_controls();

    update_option('ideo_customizer_local_modification_trigger_controls', serialize($controls), false);
}

add_action('after_setup_theme', 'ideothemo_setup');

function ideothemo_setup()
{
    load_theme_textdomain('themo', get_template_directory() . '/languages');

    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('custom-header');
    add_theme_support('custom-background');
    add_theme_support('automatic-feed-links');

    set_post_thumbnail_size(865, 450, true);

    add_image_size('ideothemo-blog-featured-image', 865, 450, true);
    add_image_size('ideothemo-blog-thumbnail-widget', 75, 60, true);
    add_image_size('ideothemo-blog-list-image', 1024, 1024, false);
    add_image_size('ideothemo-blog-classic', 1024, 0, false);
    add_image_size('ideothemo-blog-masonry', 500, 0, false);

    // -sc (shortcode)
    add_image_size('ideothemo-team-box-sc', 560, 560, true);
    add_image_size('ideothemo-team-box-sc-window-modal', 140, 140, true);
    add_image_size('ideothemo-testimonial-slider-image-sc', 100, 100, true);

    function ideothemo_register_custom_nav_menus()
    {
        register_nav_menus(array(
            'fourth-menu' => esc_html__('Fourth Navigation', 'themo'),
            'fifth-menu' => esc_html__('Fifth Navigation', 'themo'),
        ));
    }

    add_action('init', 'ideothemo_register_custom_nav_menus');

    register_sidebar(array(
        'name' => esc_html__('Default Sidebar', 'themo'),
        'id' => 'sidebar-1',
        'class' => 'widget-sidebar',
        'description' => esc_html__('Widgets in this area will be shown on all posts and pages.', 'themo'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Header Topbar Left', 'themo'),
        'id' => 'header-topbar-left',
        'class' => 'widget-sidebar',
        'description' => esc_html__('Widgets in this area will be shown on all posts and pages.', 'themo'),
        'before_widget' => '<div id="%1$s" class="topbar-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="topbar-widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Header Topbar Right', 'themo'),
        'id' => 'header-topbar-right',
        'class' => 'widget-sidebar',
        'description' => esc_html__('Widgets in this area will be shown on all posts and pages.', 'themo'),
        'before_widget' => '<div id="%1$s" class="topbar-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="topbar-widget-title">',
        'after_title' => '</h3>',
    ));

    ideothemo_register_footer_sidebars(4);

    add_theme_support('post-formats', array(
        'video', 'quote', 'link', 'gallery', 'audio'
    ));
}

add_action('init', 'ideothemo_register_sidebars');

function ideothemo_register_sidebars()
{
    foreach (get_option('ideo_sidebars', array()) as $id => $name) {

        register_sidebar(
            apply_filters('ideothemo_register_sidebar_args',
                array(
                    'name' => $name,
                    'id' => $id,
                    'description' => '',
                    'class' => '',
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget' => '</div>',
                    'before_title' => '<h3 class="widget-title">',
                    'after_title' => '</h3>'
                ), $id)
        );
    }
}


/**
 * Function get a similar posts
 *
 * @param array $args
 * @return WP_Query
 */

function ideothemo_get_similar_posts($args = array())
{
    $default = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 3,
        'post__not_in' => array(get_the_ID()),
        'category__in' => wp_get_post_categories(get_the_ID())
    );

    $args = array_merge($default, $args);

    return new WP_Query(
        apply_filters('get_similar_posts_args', $args)
    );
}


/**
 * Filter Comment fields
 */

add_filter('comment_form_default_fields', 'ideothemo_filter_comment_form_default_fields');

function ideothemo_filter_comment_form_default_fields($fields)
{
    $fields['url'] = '';
    $fields['author'] = '<p class="comment-form-author"><input id="author" name="author" type="text" value="" size="30" placeholder="' . esc_html__('Name (required)', 'themo') . '" aria-required="true"></p>';
    $fields['email'] = '<p class="comment-form-email"><input id="email" name="email" placeholder="' . esc_html__('E-mail (required)', 'themo') . '" type="text" value="" size="30" aria-describedby="email-notes" aria-required="true"></p>';

    return $fields;
}

function ideothemo_custom_posts_per_page($query)
{
    /** @var WP_Query $query */

    if (is_admin() || !$query->is_main_query())
        return;

    if ($query->is_archive()) {
        $query->set('posts_per_page', ideothemo_get_blog_archives_posts_per_page());
    } elseif ($query->is_search()) {
        $query->set('posts_per_page', ideothemo_get_blog_search_posts_per_page());
    }
}

add_action('pre_get_posts', 'ideothemo_custom_posts_per_page');

if (class_exists('IdeoThemoGoogleFontsApi')) {
    $fonts = new IdeoThemoGoogleFontsApi;
}

function IdeoShortcodeMapsArrayJs()
{
    global $vc_manager, $test;

    if (!class_exists('IdeoThemoTinyMCEShortcodesGenerator')) {
        return false;
    }

    if (is_a($vc_manager, 'Vc_Manager')) {
        $vc_manager->mapper()->init();

        foreach (WPBMap::getShortCodes() as $shortcode) {
            IdeoThemoShortcodeMaps::addVcShortcode($shortcode);
        }
    }

    $columns = IdeoThemoTinyMCEShortcodesGenerator::get();

    foreach ($columns as $column) {
        IdeoThemoShortcodeMaps::addShortcode($column[0], $column[1], '');
    }

    wp_localize_script('ideothemo-admin-script', '_ideo_shortcodes', json_encode(IdeoThemoShortcodeMaps::getShortcodes()));

}

add_filter('body_class', 'ideothemo_body_class_filter', 10, 2);

function ideothemo_body_class_filter($classes, $class)
{
    global $is_safari;

    $classes[] = 'skin-' . ideothemo_get_general_theme_skin();
    $classes[] = 'background-page';

    if (ideothemo_is_boxed_version()) {

        $classes = array_merge($classes, ideothemo_get_background_classes(array(
            'background-type' => ideothemo_get_boxed_background_type(1),
            'background-overlay' => ideothemo_get_boxed_background_overlay_type(1),
            'background-video-platform' => ideothemo_get_boxed_background_video_platform(1)
        )));
    }
    $classes[] = ideothemo_get_layout_type_class();
    $classes[] = 'header-' . (!ideothemo_header_is_enabled() ? 'off' : 'on');
    //This one is risky, is necessary for archive.php for working height
    $classes[] = ideothemo_is_nopo_template() ? 'page' : '';

    if (!defined('IDEOTHEMO_CORE_VERSION') && is_singular('post') && ideothemo_get_page_title_local_setting('pagetitle.page_title_settings.page_title_area') == null) {
        $classes[] = 'pagetitle-off';
    } else {
        $classes[] = 'pagetitle-' . (ideothemo_page_title_area_enabled() ? 'on' : 'off');
    }
    $classes[] = 'sidebar-' . (ideothemo_is_sidebar_enabled() ? 'on' : 'off');
    $classes[] = 'sidebar-' . (ideothemo_get_sidebar_position() == 'left_sidebar' ? 'left' : (ideothemo_get_sidebar_position() == 'right_sidebar' ? 'right' : 'none'));
    if (!is_archive() && !is_search()) {
        $classes[] = 'vc-' . (ideothemo_is_vc_used() ? 'on' : 'off');
    }
    $classes[] = 'slider-' . (ideothemo_is_slider_used() ? 'on' : 'off');
    $classes[] = 'topbar-' . (ideothemo_get_header_true('top.topbar.enabled') && ideothemo_get_header_setting('type') != 'side_left_header' && ideothemo_get_header_setting('type') != 'side_right_header' ? 'on' : 'off');

    if ($is_safari) {
        $classes[] = 'browser-safari';
    }
    if (!defined('IDEOTHEMO_CORE_VERSION')) {
        $classes[] = 'no-ideothemo-core';
    }

    return $classes;
}


function ideothemo_is_first_visit()
{
    return isset($_COOKIE['first_visit']);
}

function ideothemo_check_first_visit()
{
    if (!isset($_COOKIE['no_first_visit']) && !isset($_COOKIE['first_visit'])) {
        $_COOKIE['first_visit'] = 1;
        setcookie('first_visit', '1', 0, '/');
    } else {
        if (isset($_COOKIE['first_visit'])) {
            setcookie('first_visit', 0, time() - 3600, '/');
            unset($_COOKIE['first_visit']);
        }

        if (!isset($_COOKIE['no_first_visit'])) {
            setcookie('no_first_visit', '1', 0, '/');
        }
    }
}

add_action('init', 'ideothemo_check_first_visit');

function ideothemo_page_loading_logo()
{
    if (ideothemo_is_advanced_sticky_loading()) {
        $logo = ideothemo_get_theme_mod_parse('advanced.advanced_loading.logo');

        if (wp_get_referer() === false && !empty($logo)) {
            wp_add_inline_script('ideothemo-scripts', sprintf('var img = new Image();img.src="%s";', $logo));
        }
    }
}

add_action('after_switch_theme', 'ideothemo_switch');

function ideothemo_switch()
{
    global $wp_filesystem;

    $path_gen = IDEOTHEMO_GENERATED_DIR;
    $path_cache = IDEOTHEMO_CACHE_DIR;
    $access_type = get_filesystem_method();

    if ($access_type == 'ftpsockets') {
        //If path FTP and WP_CONTENT_DIR is different
        $subpath = explode($wp_filesystem->wp_content_dir(), IDEOTHEMO_GENERATED_DIR);
        if (count($subpath) == 2) {
            $path_gen = $wp_filesystem->wp_content_dir() . $subpath[1];
        }
        $subpath = explode($wp_filesystem->wp_content_dir(), IDEOTHEMO_CACHE_DIR);
        if (count($subpath) == 2) {
            $path_cache = $wp_filesystem->wp_content_dir() . $subpath[1];
        }
    }

    // Copy pre-generated css files

    if ($filelist = $wp_filesystem->dirlist($path_gen)) {

        if (!$wp_filesystem->is_dir($path_cache)) {
            wp_mkdir_p($path_cache);
        }

        foreach ($filelist as $file => $data) {
            $wp_filesystem->copy($path_gen . $file, $path_cache . $file, false);
        }
    }

    // Generate new styles
    wp_remote_request(esc_url(admin_url('admin-ajax.php') . '?action=generate_all_css'), array(
        'method' => 'GET',
        'blocking' => false,
        'timeout' => 0.1
    ));
}

add_filter('404_template', 'ideothemo_show_404_page');

function ideothemo_show_404_page($template)
{
    global $wp_query;

    $page_id = ideothemo_get_theme_mod_parse('advanced.advanced_404.404_choose');

    if ($page_id > 0) {
        $wp_query = new WP_Query('page_id=' . $page_id);
        $wp_query->the_post();
        $template = get_page_template();
        rewind_posts();
        ideothemo_is_custom_404(true);

        return $template;
    }

    return get_query_template('page', array('page-templates/404.php'));
}

add_filter('get_search_form', 'ideothemo_search_form');

function ideothemo_search_form($text)
{
    $text = preg_replace('/type *= *[\'"]text[\'"]/', '$0 placeholder="' . esc_html__('Search', 'themo') . '"', $text);
    return $text;
}

add_filter('pre_get_document_title', 'ideothemo_page_title');

function ideothemo_page_title($title)
{
    if (is_404() || ideothemo_is_custom_404())
        return esc_html__('Page not found', 'themo') . ' | ' . get_bloginfo('name');

    return $title;
}

/*
function foton_core_theme_installed () {
	return true;
}
*/

if (!function_exists('foton_mikado_get_title_tag')) {
    /**
     * Returns array of title tags
     *
     * @param bool $first_empty
     * @param array $additional_elements
     *
     * @return array
     */
    function foton_mikado_get_title_tag($first_empty = false, $additional_elements = array())
    {
        $title_tag = array();

        if ($first_empty) {
            $title_tag[''] = esc_html__('Default', 'foton');
        }

        $title_tag['h1'] = 'h1';
        $title_tag['h2'] = 'h2';
        $title_tag['h3'] = 'h3';
        $title_tag['h4'] = 'h4';
        $title_tag['h5'] = 'h5';
        $title_tag['h6'] = 'h6';

        if (!empty($additional_elements)) {
            $title_tag = array_merge($title_tag, $additional_elements);
        }

        return $title_tag;
    }
}

if (!function_exists('foton_mikado_get_link_target_array')) {
    /**
     * Returns array of link target
     *
     * @param bool $first_empty whether to add empty first member
     *
     * @return array
     */
    function foton_mikado_get_link_target_array($first_empty = false)
    {
        $order = array();

        if ($first_empty) {
            $order[''] = esc_html__('Default', 'foton');
        }

        $order['_self'] = esc_html__('Same Window', 'foton');
        $order['_blank'] = esc_html__('New Window', 'foton');

        return $order;
    }
}

if (!function_exists('foton_mikado_icon_collections')) {
    /**
     * Returns instance of FotonMikadoClassIconCollections class
     *
     * @return FotonMikadoClassIconCollections
     */
    function foton_mikado_icon_collections()
    {
        return FotonMikadoClassIconCollections::get_instance();
    }
}

if (!function_exists('foton_mikado_get_icon_pack_collections')) {
    function foton_mikado_get_icon_pack_collections()
    {
        $options = apply_filters('foton_mikado_filter_add_icon_pack_into_collection', $options = array());

        return $options;
    }

    add_action('after_setup_theme', 'foton_mikado_get_icon_pack_collections');
}


if (!function_exists('foton_mikado_get_icon_pack_options')) {
    function foton_mikado_get_icon_pack_options()
    {
        $options = apply_filters('foton_mikado_filter_add_icon_pack_into_options', $options = array());

        return $options;
    }

    add_action('after_setup_theme', 'foton_mikado_get_icon_pack_options');
}

if (!function_exists('foton_mikado_get_icon_pack_social_options')) {
    function foton_mikado_get_icon_pack_social_options()
    {
        $options = apply_filters('foton_mikado_filter_add_icon_pack_into_social_options', $options = array());

        return $options;
    }

    add_action('after_setup_theme', 'foton_mikado_get_icon_pack_social_options');
}

if (!function_exists('foton_mikado_get_title')) {
    /**
     * Loads title area template
     */
    function foton_mikado_get_title()
    {
        $page_id = foton_mikado_get_page_id();
        $show_title_area_meta = foton_mikado_get_meta_field_intersect('show_title_area', $page_id) == 'yes' ? true : false;
        $show_title_area = apply_filters('foton_mikado_filter_show_title_area', $show_title_area_meta);

        if ($show_title_area) {
            $type_meta = foton_mikado_get_meta_field_intersect('title_area_type', $page_id);
            $type = !empty($type_meta) ? $type_meta : 'standard';
            $template_path = apply_filters('foton_mikado_filter_title_template_path', $template_path = 'types/' . $type . '/templates/' . $type . '-title');
            $module = apply_filters('foton_mikado_filter_title_module', $module = 'title');
            $layout = apply_filters('foton_mikado_filter_title_layout', $layout = '');

            $title_tag_meta = foton_mikado_get_meta_field_intersect('title_area_title_tag', $page_id);
            $title_tag = !empty($title_tag_meta) ? $title_tag_meta : 'h1';

            $subtitle_tag_meta = foton_mikado_get_meta_field_intersect('title_area_subtitle_tag', $page_id);
            $subtitle_tag = !empty($subtitle_tag_meta) ? $subtitle_tag_meta : 'h6';

            $parameters = array(
                'holder_classes' => foton_mikado_get_title_holder_classes(),
                'holder_styles' => foton_mikado_get_title_holder_styles(),
                'holder_data' => foton_mikado_get_title_holder_data(),
                'wrapper_styles' => foton_mikado_get_title_wrapper_styles(),
                'title_image' => foton_mikado_get_title_background_image(),
                'title' => foton_mikado_get_title_text(),
                'title_tag' => $title_tag,
                'title_styles' => foton_mikado_get_title_styles(),
                'subtitle' => foton_mikado_subtitle_text(),
                'subtitle_tag' => $subtitle_tag,
                'subtitle_styles' => foton_mikado_get_subtitle_styles(),
            );
            $parameters = apply_filters('foton_mikado_filter_title_area_params', $parameters);

            foton_mikado_get_module_template_part($template_path, $module, $layout, $parameters);
        }
    }
}

if (!function_exists('foton_mikado_is_default_wp_template')) {
    /**
     * Function that checks if current page archive page, search, 404 or default home blog page
     * @return bool
     *
     * @see is_archive()
     * @see is_search()
     * @see is_404()
     * @see is_front_page()
     * @see is_home()
     */
    function foton_mikado_is_default_wp_template()
    {
        return is_archive() || is_search() || is_404() || (is_front_page() && is_home());
    }
}

if (!function_exists('foton_mikado_get_content_sidebar_class')) {
    /**
     * Return classes for content holder when sidebar is active
     *
     * @return string
     */
    function foton_mikado_get_content_sidebar_class()
    {
        $sidebar_layout = foton_mikado_sidebar_layout();
        $content_class = array('mkdf-page-content-holder');

        switch ($sidebar_layout) {
            case 'sidebar-33-right':
                $content_class[] = 'mkdf-grid-col-8';
                break;
            case 'sidebar-25-right':
                $content_class[] = 'mkdf-grid-col-9';
                break;
            case 'sidebar-20-right':
                $content_class[] = 'mkdf-grid-col-10';
                break;
            case 'sidebar-33-left':
                $content_class[] = 'mkdf-grid-col-8';
                $content_class[] = 'mkdf-grid-col-push-4';
                break;
            case 'sidebar-25-left':
                $content_class[] = 'mkdf-grid-col-9';
                $content_class[] = 'mkdf-grid-col-push-3';
                break;
            case 'sidebar-20-left':
                $content_class[] = 'mkdf-grid-col-10';
                $content_class[] = 'mkdf-grid-col-push-2';
                break;
            default:
                $content_class[] = 'mkdf-grid-col-12';
                break;
        }

        return foton_mikado_get_class_attribute($content_class);
    }
}

if (!function_exists('foton_mikado_get_page_id')) {
    /**
     * Function that returns current page / post id.
     * Checks if current page is woocommerce page and returns that id if it is.
     * Checks if current page is any archive page (category, tag, date, author etc.) and returns -1 because that isn't
     * page that is created in WP admin.
     *
     * @return int
     *
     * @version 0.1
     *
     * @see foton_mikado_is_woocommerce_installed()
     * @see foton_mikado_is_woocommerce_shop()
     */
    function foton_mikado_get_page_id()
    {
        if (foton_mikado_is_woocommerce_installed() && foton_mikado_is_woocommerce_shop()) {
            return foton_mikado_get_woo_shop_page_id();
        }

        if (foton_mikado_is_default_wp_template()) {
            return -1;
        }

        return get_queried_object_id();
    }
}

if (!function_exists('foton_mikado_get_font_weight_array')) {
    /**
     * Returns array of font weights
     *
     * @param bool $first_empty whether to add empty first member
     *
     * @return array
     */
    function foton_mikado_get_font_weight_array($first_empty = false)
    {
        $font_weights = array();

        if ($first_empty) {
            $font_weights[''] = esc_html__('Default', 'foton');
        }

        $font_weights['100'] = esc_html__('100 Thin', 'foton');
        $font_weights['200'] = esc_html__('200 Thin-Light', 'foton');
        $font_weights['300'] = esc_html__('300 Light', 'foton');
        $font_weights['400'] = esc_html__('400 Normal', 'foton');
        $font_weights['500'] = esc_html__('500 Medium', 'foton');
        $font_weights['600'] = esc_html__('600 Semi-Bold', 'foton');
        $font_weights['700'] = esc_html__('700 Bold', 'foton');
        $font_weights['800'] = esc_html__('800 Extra-Bold', 'foton');
        $font_weights['900'] = esc_html__('900 Ultra-Bold', 'foton');

        return $font_weights;
    }
}

if (!function_exists('foton_mikado_get_text_transform_array')) {
    /**
     * Returns array of text transforms
     *
     * @param bool $first_empty
     *
     * @return array
     */
    function foton_mikado_get_text_transform_array($first_empty = false)
    {
        $text_transforms = array();

        if ($first_empty) {
            $text_transforms[''] = esc_html__('Default', 'foton');
        }

        $text_transforms['none'] = esc_html__('None', 'foton');
        $text_transforms['capitalize'] = esc_html__('Capitalize', 'foton');
        $text_transforms['uppercase'] = esc_html__('Uppercase', 'foton');
        $text_transforms['lowercase'] = esc_html__('Lowercase', 'foton');
        $text_transforms['initial'] = esc_html__('Initial', 'foton');
        $text_transforms['inherit'] = esc_html__('Inherit', 'foton');

        return $text_transforms;
    }
}

if (!function_exists('foton_mikado_get_yes_no_select_array')) {
    /**
     * Returns array of yes no
     * @return array
     */
    function foton_mikado_get_yes_no_select_array($enable_default = true, $set_yes_to_be_first = false)
    {
        $select_options = array();

        if ($enable_default) {
            $select_options[''] = esc_html__('Default', 'foton');
        }

        if ($set_yes_to_be_first) {
            $select_options['yes'] = esc_html__('Yes', 'foton');
            $select_options['no'] = esc_html__('No', 'foton');
        } else {
            $select_options['no'] = esc_html__('No', 'foton');
            $select_options['yes'] = esc_html__('Yes', 'foton');
        }

        return $select_options;
    }
}

if (!function_exists('foton_mikado_get_number_of_columns_array')) {
    /**
     * Returns array of columns number
     *
     * @param bool $first_empty whether to add empty first member
     * @param array $removed_items
     *
     * @return array
     */
    function foton_mikado_get_number_of_columns_array($first_empty = false, $removed_items = array())
    {
        $options = array();

        if ($first_empty) {
            $options[''] = esc_html__('Default', 'foton');
        }

        $options['one'] = esc_html__('One', 'foton');
        $options['two'] = esc_html__('Two', 'foton');
        $options['three'] = esc_html__('Three', 'foton');
        $options['four'] = esc_html__('Four', 'foton');
        $options['five'] = esc_html__('Five', 'foton');
        $options['six'] = esc_html__('Six', 'foton');

        if (!empty($removed_items)) {
            foreach ($removed_items as $removed_item) {
                unset($options[$removed_item]);
            }
        }

        return $options;
    }
}


if (!function_exists('foton_mikado_get_space_between_items_array')) {
    /**
     * Returns array of space between items
     *
     * @param bool $first_empty whether to add empty first member
     * @param array $disable_by_keys
     *
     * @return array
     */
    function foton_mikado_get_space_between_items_array($first_empty = false, $disable_by_keys = array())
    {
        $options = array();

        if ($first_empty) {
            $options[''] = esc_html__('Default', 'foton');
        }

        $options['huge'] = esc_html__('Huge', 'foton');
        $options['large'] = esc_html__('Large', 'foton');
        $options['medium'] = esc_html__('Medium', 'foton');
        $options['normal'] = esc_html__('Normal', 'foton');
        $options['small'] = esc_html__('Small', 'foton');
        $options['tiny'] = esc_html__('Tiny', 'foton');
        $options['no'] = esc_html__('No', 'foton');

        if (!empty($disable_by_keys)) {
            foreach ($disable_by_keys as $key) {
                if (array_key_exists($key, $options)) {
                    unset($options[$key]);
                }
            }
        }

        return $options;
    }
}

if (!function_exists('foton_mikado_get_font_style_array')) {
    /**
     * Returns array of font styles
     *
     * @param bool $first_empty
     *
     * @return array
     */
    function foton_mikado_get_font_style_array($first_empty = false)
    {
        $font_styles = array();

        if ($first_empty) {
            $font_styles[''] = esc_html__('Default', 'foton');
        }

        $font_styles['normal'] = esc_html__('Normal', 'foton');
        $font_styles['italic'] = esc_html__('Italic', 'foton');
        $font_styles['oblique'] = esc_html__('Oblique', 'foton');
        $font_styles['initial'] = esc_html__('Initial', 'foton');
        $font_styles['inherit'] = esc_html__('Inherit', 'foton');

        return $font_styles;
    }
}

if (!function_exists('foton_mikado_get_text_transform_array')) {
    /**
     * Returns array of text transforms
     *
     * @param bool $first_empty
     *
     * @return array
     */
    function foton_mikado_get_text_transform_array($first_empty = false)
    {
        $text_transforms = array();

        if ($first_empty) {
            $text_transforms[''] = esc_html__('Default', 'foton');
        }

        $text_transforms['none'] = esc_html__('None', 'foton');
        $text_transforms['capitalize'] = esc_html__('Capitalize', 'foton');
        $text_transforms['uppercase'] = esc_html__('Uppercase', 'foton');
        $text_transforms['lowercase'] = esc_html__('Lowercase', 'foton');
        $text_transforms['initial'] = esc_html__('Initial', 'foton');
        $text_transforms['inherit'] = esc_html__('Inherit', 'foton');

        return $text_transforms;
    }
}

if (!function_exists('foton_mikado_get_text_decorations')) {
    /**
     * Returns array of text transforms
     *
     * @param bool $first_empty
     *
     * @return array
     */
    function foton_mikado_get_text_decorations($first_empty = false)
    {
        $text_decorations = array();

        if ($first_empty) {
            $text_decorations[''] = esc_html__('Default', 'foton');
        }

        $text_decorations['none'] = esc_html__('None', 'foton');
        $text_decorations['underline'] = esc_html__('Underline', 'foton');
        $text_decorations['overline'] = esc_html__('Overline', 'foton');
        $text_decorations['line-through'] = esc_html__('Line-Through', 'foton');
        $text_decorations['initial'] = esc_html__('Initial', 'foton');
        $text_decorations['inherit'] = esc_html__('Inherit', 'foton');

        return $text_decorations;
    }
}

if (!function_exists('foton_mikado_is_font_option_valid')) {
    /**
     * Checks if font family option is valid (different that -1)
     *
     * @param $option_name
     *
     * @return bool
     */
    function foton_mikado_is_font_option_valid($option_name)
    {
        return $option_name !== '-1' && $option_name !== '';
    }
}

if (!function_exists('foton_mikado_get_font_option_val')) {
    /**
     * Returns font option value without + so it can be used in css
     *
     * @param $option_val
     *
     * @return mixed
     */
    function foton_mikado_get_font_option_val($option_val)
    {
        $option_val = str_replace('+', ' ', $option_val);

        return $option_val;
    }
}

if (!function_exists('foton_mikado_get_icon_sources_array')) {
    /**
     * Returns array of icon sources
     *
     * @param bool $first_empty
     * @param bool $enable_predefined
     *
     * @return array
     */
    function foton_mikado_get_icon_sources_array($first_empty = false, $enable_predefined = true)
    {
        $icon_sources = array();

        if ($first_empty) {
            $icon_sources[''] = esc_html__('Default', 'foton');
        }

        $icon_sources['icon_pack'] = esc_html__('Icon Pack', 'foton');
        $icon_sources['svg_path'] = esc_html__('SVG Path', 'foton');

        if ($enable_predefined) {
            $icon_sources['predefined'] = esc_html__('Predefined', 'foton');
        }

        return $icon_sources;
    }
}

if (!function_exists('foton_mikado_get_icon_sources_class')) {
    /**
     * Returns class for icon sources
     *
     * @param string $option_name
     * @param string $class_prefix
     *
     * @return string
     */
    function foton_mikado_get_icon_sources_class($option_name = '', $class_prefix = '')
    {
        $class = '';

        if (!empty($option_name) && !empty($class_prefix)) {
            $icon_source = foton_mikado_options()->getOptionValue($option_name . '_icon_source');

            if ($icon_source === 'icon_pack') {
                $class = $class_prefix . '-icon-pack';
            } else if ($icon_source === 'svg_path') {
                $class = $class_prefix . '-svg-path';
            } else if ($icon_source === 'predefined') {
                $class = $class_prefix . '-predefined';
            }
        }

        return $class;
    }
}

if (!function_exists('foton_mikado_get_icon_sources_html')) {
    /**
     * Returns html for icon sources
     *
     * @param string $option_name
     * @param bool $is_close_icon
     * @param array $args
     *
     * @return string/html
     */
    function foton_mikado_get_icon_sources_html($option_name = '', $is_close_icon = false, $args = array())
    {
        $html = '';

        if (!empty($option_name)) {
            $icon_source = foton_mikado_options()->getOptionValue($option_name . '_icon_source');
            $icon_pack = foton_mikado_options()->getOptionValue($option_name . '_icon_pack');
            $icon_svg_path = foton_mikado_options()->getOptionValue($option_name . '_icon_svg_path');
            $close_icon_svg_path = foton_mikado_options()->getOptionValue($option_name . '_close_icon_svg_path');
            $is_search_icon = isset($args['search']) && $args['search'] === 'yes';
            $is_dropdown_cart = isset($args['dropdown_cart']) && $args['dropdown_cart'] === 'yes';

            if ($icon_source === 'icon_pack' && isset($icon_pack)) {

                if ($is_search_icon) {

                    if ($is_close_icon) {
                        $html .= foton_mikado_icon_collections()->getSearchClose($icon_pack, true);
                    } else {
                        $html .= foton_mikado_icon_collections()->getSearchIcon($icon_pack, true);
                    }

                } else if ($is_dropdown_cart) {
                    $html .= foton_mikado_icon_collections()->getDropdownCartIcon($icon_pack);
                } else if ($is_close_icon) {
                    $html .= foton_mikado_icon_collections()->getMenuCloseIcon($icon_pack);
                } else {
                    $html .= foton_mikado_icon_collections()->getMenuIcon($icon_pack);
                }

            } else if ((isset($icon_svg_path) && !empty($icon_svg_path)) || (isset($close_icon_svg_path) && !empty($close_icon_svg_path))) {

                if ($is_close_icon) {
                    $html .= $close_icon_svg_path;
                } else {
                    $html .= $icon_svg_path;
                }

            } else if ($icon_source === 'predefined') {

                if ($is_close_icon) {
                    $html .= foton_mikado_icon_collections()->getMenuCloseIcon('font_elegant');
                } else {
                    $html .= '<span class="mkdf-hm-lines">';
                    $html .= '<span class="mkdf-hm-line mkdf-line-1"></span>';
                    $html .= '<span class="mkdf-hm-line mkdf-line-2"></span>';
                    $html .= '<span class="mkdf-hm-line mkdf-line-3"></span>';
                    $html .= '</span>';
                }
            }
        }

        return $html;
    }
}

if (!function_exists('foton_mikado_add_repeater_field')) {
    /**
     * Generates meta box field object
     * $attributes can contain:
     *      $name - name of the field. This will be name of the option in database
     *      $label - title of the option
     *      $description
     *      $field_type - type of the field that will be rendered and repeated
     *      $parent - parent object to which to add field
     *
     * @param $attributes
     *
     * @return bool|RepeaterField
     */
    function foton_mikado_add_repeater_field($attributes)
    {
        $name = '';
        $label = '';
        $description = '';
        $fields = array();
        $parent = '';
        $button_text = '';
        $table_layout = false;

        extract($attributes);

        if (!empty($parent) && !empty($name)) {
            $field = new FotonMikadoClassRepeater($fields, $name, $label, $description, $button_text, $table_layout);

            if (is_object($parent)) {
                $parent->addChild($name, $field);

                return $field;
            }
        }

        return false;
    }
}

/**
 * Taxonomy fields function
 */
if (!function_exists('foton_mikado_add_taxonomy_fields')) {
    /**
     * Adds new meta box
     *
     * @param $attributes
     *
     * @return bool|MikadoMetaBox
     */
    function foton_mikado_add_taxonomy_fields($attributes)
    {
        $scope = array();
        $name = '';

        extract($attributes);

        if (!empty($scope)) {
            $tax_obj = new FotonMikadoClassTaxonomyOption($scope);
            foton_mikado_framework()->mkdTaxonomyOptions->addTaxonomyOptions($name, $tax_obj);

            return $tax_obj;
        }

        return false;
    }
}

if (!function_exists('foton_mikado_add_taxonomy_field')) {
    /**
     * Generates meta box field object
     * $attributes can contain:
     *      $type - type of the field to generate
     *      $name - name of the field. This will be name of the option in database
     *      $label - title of the option
     *      $description
     *      $options - assoc array of option. Used only for select and radiogroup field types
     *      $args - assoc array of additional parameters. Used for dependency
     *      $parent - parent object to which to add field
     *
     * @param $attributes
     *
     * @return bool|RepeaterField
     */
    function foton_mikado_add_taxonomy_field($attributes)
    {
        $type = '';
        $name = '';
        $label = '';
        $description = '';
        $options = array();
        $args = array();
        $parent = '';

        extract($attributes);

        if (!empty($parent) && !empty($name)) {
            $field = new FotonMikadoClassTaxonomyField($type, $name, $label, $description, $options, $args);
            if (is_object($parent)) {
                $parent->addChild($name, $field);

                return $field;
            }
        }

        return false;
    }
}

/**
 * User fields function
 */
if (!function_exists('foton_mikado_add_user_fields')) {
    /**
     * Adds new meta box
     *
     * @param $attributes
     *
     * @return bool|MikadoMetaBox
     */
    function foton_mikado_add_user_fields($attributes)
    {
        $scope = array();
        $name = '';

        extract($attributes);

        if (!empty($scope)) {
            $user_obj = new FotonMikadoClassUserOption($scope);
            foton_mikado_framework()->mkdUserOptions->addUserOptions($name, $user_obj);

            return $user_obj;
        }

        return false;
    }
}

if (!function_exists('foton_mikado_add_user_field')) {
    /**
     * Generates meta box field object
     * $attributes can contain:
     *      $type - type of the field to generate
     *      $name - name of the field. This will be name of the option in database
     *      $label - title of the option
     *      $description
     *      $options - assoc array of option. Used only for select and radiogroup field types
     *      $args - assoc array of additional parameters. Used for dependency
     *      $parent - parent object to which to add field
     *
     * @param $attributes
     *
     * @return bool|RepeaterField
     */
    function foton_mikado_add_user_field($attributes)
    {
        $type = '';
        $name = '';
        $label = '';
        $description = '';
        $options = array();
        $args = array();
        $parent = '';

        extract($attributes);

        if (!empty($parent) && !empty($name)) {
            $field = new FotonMikadoClassUserField($type, $name, $label, $description, $options, $args);
            if (is_object($parent)) {
                $parent->addChild($name, $field);

                return $field;
            }
        }

        return false;
    }
}

if (!function_exists('foton_mikado_add_user_group')) {
    /**
     * Generates group object
     * $attributes can contain:
     *      $name - name of the group with which it will be added to parent element
     *      $title - title of group
     *      $description - description of group
     *      $parent - parent object to which to add group
     *
     * @param $attributes
     *
     * @return bool|FotonMikadoClassUserGroup
     */
    function foton_mikado_add_user_group($attributes)
    {
        $name = '';
        $title = '';
        $description = '';
        $parent = '';

        extract($attributes);

        if (!empty($name) && !empty($title) && is_object($parent)) {
            $group = new FotonMikadoClassUserGroup($title, $description);
            $parent->addChild($name, $group);

            return $group;
        }

        return false;
    }
}

/**
 * Dashboard fields function
 */
if (!function_exists('foton_mikado_add_dashboard_fields')) {
    /**
     * Adds new meta box
     *
     * @param $attributes
     *
     * @return bool|FotonMikadoClassDashboardOption
     */
    function foton_mikado_add_dashboard_fields($attributes)
    {
        $name = '';

        extract($attributes);

        if ($name !== '') {
            $dash_obj = new FotonMikadoClassDashboardOption();
            foton_mikado_framework()->mkdDashboardOptions->addDashboardOptions($name, $dash_obj);

            return $dash_obj;
        }

        return false;
    }
}

if (!function_exists('foton_mikado_add_dashboard_form')) {
    /**
     * Generates form object
     * $attributes can contain:
     *      $name - name of the form with which it will be added to parent element
     *      $parent - parent object to which to add form
     *      $form_id - id of form generated
     *      $form_method - method for form generated
     *      $form_nonce - nonce for form generated
     *
     * @param $attributes
     *
     * @return bool|FotonMikadoClassContainer
     */
    function foton_mikado_add_dashboard_form($attributes)
    {
        $name = '';
        $form_id = '';
        $form_method = 'post';
        $form_action = '';
        $form_nonce_action = '';
        $form_nonce_name = '';
        $button_label = esc_html__('SUMBIT', 'foton');
        $button_args = array();
        $parent = '';

        extract($attributes);

        if (!empty($name) && is_object($parent) && $form_id !== '') {
            $container = new FotonMikadoClassDashboardForm($name, $form_id, $form_method, $form_action, $form_nonce_action, $form_nonce_name, $button_label, $button_args);
            $parent->addChild($name, $container);

            return $container;
        }

        return false;
    }
}

if (!function_exists('foton_mikado_add_dashboard_group')) {
    /**
     * Generates form object
     * $attributes can contain:
     *      $name - name of the form with which it will be added to parent element
     *      $parent - parent object to which to add form
     *
     * @param $attributes
     *
     * @return bool|FotonMikadoClassContainer
     */
    function foton_mikado_add_dashboard_group($attributes)
    {
        $name = '';
        $title = '';
        $description = '';
        $parent = '';

        extract($attributes);

        if (!empty($name) && is_object($parent)) {
            $container = new FotonMikadoClassDashboardGroup($name, $title, $description);
            $parent->addChild($name, $container);

            return $container;
        }

        return false;
    }
}

if (!function_exists('foton_mikado_add_dashboard_section_title')) {
    /**
     * Generates dashboard title field
     * $attributes can contain:
     *      $parent - parent object to which to add title
     *      $name - name of title with which to add it to the parent
     *      $title - title text
     *
     * @param $attributes
     *
     * @return bool|FotonMikadoClassDashboardTitle
     */
    function foton_mikado_add_dashboard_section_title($attributes)
    {
        $parent = '';
        $name = '';
        $title = '';

        extract($attributes);

        if (is_object($parent) && !empty($title) && !empty($name)) {
            $section_title = new FotonMikadoClassDashboardTitle($name, $title);
            $parent->addChild($name, $section_title);

            return $section_title;
        }

        return false;
    }
}

if (!function_exists('foton_mikado_add_dashboard_repeater_field')) {
    /**
     * Generates meta box field object
     * $attributes can contain:
     *      $name - name of the field. This will be name of the option in database
     *      $label - title of the option
     *      $description
     *      $field_type - type of the field that will be rendered and repeated
     *      $parent - parent object to which to add field
     *
     * @param $attributes
     *
     * @return bool|FotonMikadoClassDashboardRepeater
     */
    function foton_mikado_add_dashboard_repeater_field($attributes)
    {
        $name = '';
        $label = '';
        $description = '';
        $fields = array();
        $parent = '';
        $button_text = '';
        $table_layout = false;
        $value = array();

        extract($attributes);

        if (!empty($parent) && !empty($name)) {
            $field = new FotonMikadoClassDashboardRepeater($fields, $name, $label, $description, $button_text, $table_layout, $value);

            if (is_object($parent)) {
                $parent->addChild($name, $field);

                return $field;
            }
        }

        return false;
    }
}

if (!function_exists('foton_mikado_add_dashboard_field')) {
    /**
     * Generates dashboard field object
     * $attributes can contain:
     *      $type - type of the field to generate
     *      $name - name of the field. This will be name of the option in database
     *      $label - title of the option
     *      $description
     *      $options - assoc array of option. Used only for select and radiogroup field types
     *      $args - assoc array of additional parameters. Used for dependency
     *      $parent - parent object to which to add field
     *      $hidden_property - name of option that hides field
     *      $hidden_values - array of valus of $hidden_property that hides field
     *
     * @param $attributes
     *
     * @return bool|FotonMikadoClassDashboardField
     */
    function foton_mikado_add_dashboard_field($attributes)
    {
        $type = '';
        $name = '';
        $label = '';
        $description = '';
        $options = array();
        $args = array();
        $value = '';
        $parent = '';
        $repeat = array();

        extract($attributes);

        if (!empty($parent) && !empty($name)) {
            $field = new FotonMikadoClassDashboardField($type, $name, $label, $description, $options, $args, $value, $repeat);
            if (is_object($parent)) {
                $parent->addChild($name, $field);

                return $field;
            }
        }

        return false;
    }
}

if (!function_exists('foton_mikado_inline_style')) {
    /**
     * Function that echoes generated style attribute
     *
     * @param $value string | array attribute value
     *
     * @see foton_mikado_get_inline_style()
     */
    function foton_mikado_inline_style($value)
    {
        echo foton_mikado_get_inline_style($value);
    }
}

if (!function_exists('foton_mikado_get_inline_style')) {
    /**
     * Function that generates style attribute and returns generated string
     *
     * @param $value string | array value of style attribute
     *
     * @return string generated style attribute
     *
     * @see foton_mikado_get_inline_style()
     */
    function foton_mikado_get_inline_style($value)
    {
        return foton_mikado_get_inline_attr($value, 'style', ';');
    }
}

if (!function_exists('foton_mikado_get_inline_attr')) {
    /**
     * Function that generates html attribute
     *
     * @param $value string | array value of html attribute
     * @param $attr string name of html attribute to generate
     * @param $glue string glue with which to implode $attr. Used only when $attr is array
     * @param $allow_zero_values boolean allow data to have zero value
     *
     * @return string generated html attribute
     */
    function foton_mikado_get_inline_attr($value, $attr, $glue = '', $allow_zero_values = false)
    {
        if ($allow_zero_values) {
            if ($value !== '') {

                if (is_array($value) && count($value)) {
                    $properties = implode($glue, $value);
                } elseif ($value !== '') {
                    $properties = $value;
                }

                return $attr . '="' . esc_attr($properties) . '"';
            }
        } else {
            if (!empty($value)) {

                if (is_array($value) && count($value)) {
                    $properties = implode($glue, $value);
                } elseif ($value !== '') {
                    $properties = $value;
                }

                return $attr . '="' . esc_attr($properties) . '"';
            }
        }

        return '';
    }
}

if (!function_exists('foton_mikado_class_attribute')) {
    /**
     * Function that echoes class attribute
     *
     * @param $value string value of class attribute
     *
     * @see foton_mikado_get_class_attribute()
     */
    function foton_mikado_class_attribute($value)
    {
        echo foton_mikado_get_class_attribute($value);
    }
}

if (!function_exists('foton_mikado_get_class_attribute')) {
    /**
     * Function that returns generated class attribute
     *
     * @param $value string value of class attribute
     *
     * @return string generated class attribute
     *
     * @see foton_mikado_get_inline_attr()
     */
    function foton_mikado_get_class_attribute($value)
    {
        return foton_mikado_get_inline_attr($value, 'class', ' ');
    }
}

if (!function_exists('foton_mikado_get_inline_attrs')) {
    /**
     * Generate multiple inline attributes
     *
     * @param $attrs
     *
     * @return string
     */
    function foton_mikado_get_inline_attrs($attrs, $allow_zero_values = false)
    {
        $output = '';

        if (is_array($attrs) && count($attrs)) {
            if ($allow_zero_values) {
                foreach ($attrs as $attr => $value) {
                    $output .= ' ' . foton_mikado_get_inline_attr($value, $attr, '', true);
                }
            } else {
                foreach ($attrs as $attr => $value) {
                    $output .= ' ' . foton_mikado_get_inline_attr($value, $attr);
                }
            }
        }

        $output = ltrim($output);

        return $output;
    }
}

if (!function_exists('foton_mikado_filter_px')) {
    /**
     * Removes px in provided value if value ends with px
     *
     * @param $value
     *
     * @return string
     *
     * @see foton_mikado_filter_suffix
     */
    function foton_mikado_filter_px($value)
    {
        return foton_mikado_filter_suffix($value, 'px');
    }
}

if (!function_exists('foton_mikado_filter_percentage')) {
    /**
     * Removes percentage in provided value if value ends with percentage
     *
     * @param $value
     *
     * @return string
     *
     * @see foton_mikado_filter_suffix
     */
    function foton_mikado_filter_percentage($value)
    {
        return foton_mikado_filter_suffix($value, '%');
    }
}

if (!function_exists('foton_mikado_filter_suffix')) {
    /**
     * Removes suffix from given value. Useful when you have to remove parts of user input, e.g px at the end of string
     *
     * @param $value
     * @param $suffix
     *
     * @return string
     */
    function foton_mikado_filter_suffix($value, $suffix)
    {
        if ($value !== '' && foton_mikado_string_ends_with($value, $suffix)) {
            $value = substr($value, 0, strpos($value, $suffix));
        }

        return $value;
    }
}

if (!function_exists('foton_mikado_string_ends_with')) {
    /**
     * Checks if $haystack ends with $needle and returns proper bool value
     *
     * @param $haystack string to check
     * @param $needle string with which $haystack needs to end
     *
     * @return bool
     */
    function foton_mikado_string_ends_with($haystack, $needle)
    {
        if ($haystack !== '' && $needle !== '') {
            return (substr($haystack, -strlen($needle), strlen($needle)) == $needle);
        }

        return true;
    }
}

function foton_mikado_option_get_value($name)
{
    global $foton_mikado_global_options;
    global $foton_mikado_global_Framework;

    if (is_array($foton_mikado_global_Framework->mkdOptions->options) && array_key_exists($name, $foton_mikado_global_Framework->mkdOptions->options)) {
        if (isset($foton_mikado_global_options[$name]) && $foton_mikado_global_options[$name] !== '') {
            return $foton_mikado_global_options[$name];
        } else {
            return $foton_mikado_global_Framework->mkdOptions->getOption($name);
        }
    } else {
        global $post;

        if (!empty($post)) {
            $value = get_post_meta($post->ID, $name, true);
        }
        if (isset($value) && $value !== '') {
            return $value;
        } else {
            return $value;
            // return $foton_mikado_global_Framework->mkdMetaBoxes->getOption($name);
        }
    }
}

if (!function_exists('foton_mikado_content_elem_style_attr')) {
    /**
     * Defines filter for adding custom styles to content HTML element
     */
    function foton_mikado_content_elem_style_attr()
    {
        $styles = apply_filters('foton_mikado_filter_content_elem_style_attr', array());

        foton_mikado_inline_style($styles);
    }
}

if (!function_exists('foton_mikado_sidebar_layout')) {
    /**
     * Function that check is sidebar is enabled and return type of sidebar layout
     */
    function foton_mikado_sidebar_layout()
    {
        $sidebar_layout = '';
        $sidebar_layout_meta = foton_mikado_get_meta_field_intersect('sidebar_layout');
        $archive_sidebar_layout = foton_mikado_options()->getOptionValue('archive_sidebar_layout');
        $search_sidebar_layout = foton_mikado_options()->getOptionValue('search_page_sidebar_layout');
        $single_sidebar_layout = foton_mikado_get_meta_field_intersect('blog_single_sidebar_layout');

        if (!empty($sidebar_layout_meta)) {
            $sidebar_layout = $sidebar_layout_meta;
        }

        if (is_singular('post') && !empty($single_sidebar_layout)) {
            $sidebar_layout = $single_sidebar_layout;
        }

        if (is_search() && !foton_mikado_is_woocommerce_shop() && !empty($search_sidebar_layout)) {
            $sidebar_layout = $search_sidebar_layout;
        }

        if ((is_archive() || (is_home() && is_front_page())) && !foton_mikado_is_woocommerce_page() && !empty($archive_sidebar_layout)) {
            $sidebar_layout = $archive_sidebar_layout;
        }

        if (!empty($sidebar_layout) && !is_active_sidebar(foton_mikado_get_sidebar())) {
            $sidebar_layout = '';
        }

        return apply_filters('foton_mikado_filter_sidebar_layout', $sidebar_layout);
    }
}

if (!function_exists('foton_mikado_get_meta_field_intersect')) {
    /**
     * @param $name
     * @param $post_id
     *
     * @return bool|mixed|void
     */
    function foton_mikado_get_meta_field_intersect($name, $post_id = '')
    {
        $post_id = !empty($post_id) ? $post_id : get_the_ID();

        if (foton_mikado_is_woocommerce_installed() && foton_mikado_is_woocommerce_shop()) {
            $post_id = foton_mikado_get_woo_shop_page_id();
        }

        $value = foton_mikado_options()->getOptionValue($name);

        if ($post_id !== -1) {
            $meta_field = get_post_meta($post_id, 'mkdf_' . $name . '_meta', true);
            if ($meta_field !== '' && $meta_field !== false) {
                $value = $meta_field;
            }
        }

        $value = apply_filters('foton_mikado_meta_field_intersect_' . $name, $value);

        return $value;
    }
}

if (!function_exists('foton_mikado_is_woocommerce_installed')) {
    /**
     * Function that checks if Woocommerce plugin installed
     * @return bool
     */
    function foton_mikado_is_woocommerce_installed()
    {
        return function_exists('is_woocommerce');
    }
}

if (!function_exists('foton_mikado_options')) {
    /**
     * Returns instance of FotonMikadoClassOptions class
     *
     * @return FotonMikadoClassOptions
     */
    function foton_mikado_options()
    {
        return foton_mikado_framework()->mkdOptions;
    }
}

if (!function_exists('foton_mikado_framework')) {
    /**
     * Function that returns instance of FotonMikadoClassFramework class
     *
     * @return FotonMikadoClassFramework
     */
    function foton_mikado_framework()
    {
        return FotonMikadoClassFramework::get_instance();
    }
}

function my_myme_types($mime_types)
{
    $mime_types['svg'] = 'image/svg+xml'; //Adding svg extension
    return $mime_types;
}

add_filter('upload_mimes', 'my_myme_types', 1, 1);


function add_theme_scripts()
{


    wp_enqueue_script('script', get_template_directory_uri() . '/js/global-qatsol.js');
    wp_enqueue_style('style-custome-qatsol-new', get_template_directory_uri() . '/css/global-qatsol-new.css');


}

add_action('wp_enqueue_scripts', 'add_theme_scripts');


function add_open_graph_tags()
{
    if (is_single()) {
        global $post;
        $default_image = 'https://qatsol.com/wp-content/uploads/2024/08/favicon.png';
        $og_image = get_the_post_thumbnail_url($post->ID, 'full') ? get_the_post_thumbnail_url($post->ID, 'full') : $default_image;
        echo '<meta property="og:image" content="' . esc_url($og_image) . '"/>';
    }
}

add_action('wp_head', 'add_open_graph_tags');


function load_more_posts()
{
    $paged = $_POST['page'];

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 9,
        'paged' => $paged
    );

    $blog_posts = new WP_Query($args);

    if ($blog_posts->have_posts()) :
        $response = '';
        while ($blog_posts->have_posts()) : $blog_posts->the_post();
            $response .= '<div class="post-item">';
            $response .= '<a href="' . get_permalink() . '">';
            $response .= '<div class="post-thumbnail">';
            if (has_post_thumbnail()) {
                $response .= get_the_post_thumbnail(get_the_ID(), 'medium');
            } else {
                $response .= '<img src="' . get_template_directory_uri() . '/images/placeholder.png" alt="Placeholder">';
            }
            $response .= '</div>';
            $response .= '<div class="post-content">';
            $response .= '<h2>' . get_the_title() . '</h2>';
            $response .= '<p>' . get_the_time('d.m.Y') . '</p>';
            $response .= '</div>';
            $response .= '</a>';
            $response .= '</div>';
        endwhile;

        wp_send_json_success($response);
    else :
        wp_send_json_error('No more posts');
    endif;

    wp_reset_postdata();
}

add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');


function enqueue_swiper_assets()
{
    if (is_single()) {
        wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css');
        wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', array(), null, true);
        wp_add_inline_script('swiper-js', '
        var swiper = new Swiper(".swiper-container", {
            slidesPerView: 1,
       
            loop: true,
            navigation: {
                nextEl: ".custom-button-next",
                prevEl: ".custom-button-prev",
            },
                  pagination: {
        el: ".swiper-pagination",
      },
            breakpoints: {
                768: {
                     spaceBetween: 20,
                    slidesPerView: 2
                },
                1024: {
                  spaceBetween: 20,
                    slidesPerView: 3
                },
                    1440: {
                       spaceBetween: 24,
                       slidesPerView: 3
                },
                              1920: {
                       spaceBetween: 32,
                       slidesPerView: 3
                },
            }
        });
    ');
    }
}

add_action('wp_enqueue_scripts', 'enqueue_swiper_assets');

function latest_insights_shortcode($atts)
{
    $atts = shortcode_atts(array(
        'posts' => 6,
    ), $atts, 'latest_insights');

    $latest_posts = new WP_Query(array(
        'posts_per_page' => $atts['posts'],
        'post__not_in' => array(get_the_ID()),
    ));

    if (!$latest_posts->have_posts()) {
        return '<p>No posts found.</p>';
    }

    ob_start(); ?>

    <div class="swiper-container">
        <div class="swiper-wrapper">
            <?php while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
                <div class="swiper-slide">
                    <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()) {
                            the_post_thumbnail('medium');
                        } else { ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/placeholder.png"
                                 alt="Placeholder">
                        <?php } ?>
                        <h4><?php the_title(); ?></h4>
                        <span class="post-date"><?php echo get_the_date('d.m.Y'); ?></span>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>

    <?php
    wp_reset_postdata();

    return ob_get_clean();
}

add_shortcode('latest_insights', 'latest_insights_shortcode');

function add_anchors_to_headings($content)
{
    preg_match_all('/<h([1-6])>(.*?)<\/h[1-6]>/', $content, $matches, PREG_SET_ORDER);

    if (!empty($matches)) {
        foreach ($matches as $match) {
            $heading_level = $match[1];
            $heading_text = strip_tags($match[2]);
            $anchor = sanitize_title($heading_text);

            $content = str_replace($match[0], '<h' . $heading_level . ' id="' . $anchor . '">' . $heading_text . '</h' . $heading_level . '>', $content);
        }
    }

    return $content;
}


//add_filter('the_content', 'add_anchors_to_headings');

function dynamic_content_menu()
{
    global $post;

    $content = $post->post_content;

    preg_match_all('/<h([2])>(.*?)<\/h[2]>/', $content, $matches, PREG_SET_ORDER);

    if (!empty($matches)) {
        $menu = '<div class="dynamic-menu">';
        $menu .= '<ul>';

        foreach ($matches as $match) {
            $heading_level = $match[1];
            $heading_text = strip_tags($match[2]);
            $anchor = sanitize_title($heading_text);


            $menu .= '<li class="menu-item menu-item-h' . $heading_level . '">';
            $menu .= '<a href="#' . $anchor . '">' . $heading_text . '</a>';
            $menu .= '</li>';
        }

        $menu .= '</ul>';
        $menu .= '</div>';

        return $menu;
    }

    return '';
}


//add_shortcode('dynamic_menu', 'dynamic_content_menu');

function latest_posts_carousel_shortcode()
{
    ob_start();

    ?>
    <div class="post-content-block padding-block padding-block-y process-section">
        <div class="container">
            <div class="latest-posts-carousel">
                <div class="h2-tag">
                    <p> [ FEATURED BLOG POSTS ]</p>
                </div>
                <div class="subtitle-link-wrapper">
                    <div class="vc_col-sm-6 h2-title">
                        <h2 class="title"><span>Our latest insights</span></h2>
                    </div>
                    <div class="vc_col-sm-6 title-link common-link">
                        <a href="/blog">
                            <span>Explore our blog to learn more about tech & people</span>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 12H19" stroke="#EAC571" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"></path>
                                <path d="M12 5L19 12L12 19" stroke="#EAC571" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="blog-slider">
                    <div class="swiper-container">
                        <div class="swiper-wrapper swiper-last-articles">
                            <?php
                            $recent_args = array(
                                'post_type' => 'post',
                                'posts_per_page' => 6
                            );
                            $recent_posts = new WP_Query($recent_args);

                            if ($recent_posts->have_posts()) :
                                while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
                                    <div class="swiper-slide">
                                        <a href="<?php the_permalink(); ?>" class="swiper-slide-link">
                                            <div class="carousel-thumbnail">
                                                <?php if (has_post_thumbnail()) {
                                                    the_post_thumbnail('medium');
                                                } else { ?>
                                                    <img src="<?php echo get_template_directory_uri(); ?>/images/placeholder.png"
                                                         alt="Placeholder">
                                                <?php } ?>
                                            </div>
                                            <div class="carousel-content common-card">
                                                <h3><?php the_title(); ?></h3>
                                                <p><?php the_time('d.m.Y'); ?></p>
                                            </div>
                                        </a>
                                    </div>

                                <?php endwhile;

                            endif;

                            wp_reset_postdata();
                            ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                    <div class="swiper-navigation">
                        <div class="custom-button-prev">
                            <svg width="48" height="48" viewBox="0 0 48 48" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <rect x="1" y="1" width="46" height="46" rx="23" stroke="#DCDDE2" stroke-width="2"/>
                                <path d="M24 30L18 24L24 18" stroke="#1D1E22" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M30 24H18" stroke="#1D1E22" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="custom-button-next">
                            <svg width="48" height="48" viewBox="0 0 48 48" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <rect x="1" y="1" width="46" height="46" rx="23" stroke="#DCDDE2" stroke-width="2"/>
                                <path d="M18 24H30" stroke="#1D1E22" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M24 18L30 24L24 30" stroke="#1D1E22" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php

    return ob_get_clean();
}


add_shortcode('latest_posts_carousel', 'latest_posts_carousel_shortcode');

function enqueue_blog_css()
{
    if ((is_single() && 'post' == get_post_type()) || is_page('blog')) {
        wp_enqueue_style('blog-style', get_template_directory_uri() . '/css/blog.css');
    }
}

add_action('wp_enqueue_scripts', 'enqueue_blog_css');
