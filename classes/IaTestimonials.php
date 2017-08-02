<?php
class IaTestimonials extends Module
{
    public function __construct()
    {
        $this->name = 'iatestimonials';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'iandri';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Testimonials');
        $this->description = $this->l('A great testimonials module');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
    }

    public function install()
    {
        if (Shop::isFeatureActive())
            Shop::setContext(Shop::CONTEXT_ALL);


        if (!parent::install()||
            !$this->installDb()
        )


            return false;


        return true;
    }

    public function installDb(){

        $sql = "CREATE TABLE IF NOT EXISTS `"._DB_PREFIX_."iatestimonials_article`(
            `id_iatestimonials_article` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `body` TEXT NOT NULL,
            `date` datetime NOT NULL

        )";

        if (!Db::getInstance()->Execute($sql)){
            return false;
        }


        return true;


    }

    public function uninstallDb(){

        $sql = "DROP TABLE `"._DB_PREFIX_."iatestimonials_article`";

        if (!Db::getInstance()->Execute($sql)){
            return false;
        }
        return true;


    }


    public function uninstall()
    {

        if (!parent::uninstall()||
            !$this->uninstallDb()||
            !$this->uninstallTab()
        ){
            return false;
        }

        return true;
    }

    public function installTab(){
        $tab = new Tab();
        foreach (Language::getLanguages(true) as $lang) {

	           $tab->name[$lang['id_lang']] = $this->l('Testimonials');

        }
        $tab->module = $this->name;
        $tab->id_parent = 0;
        $tab->class_name = 'AdminTestimonials';

        if(!$tab->add()){
            return false;
        }
        return true;

    }
    public function uninstallTab(){
        $moduleTab = Tab::getCollectionFromModule($this->name);
        if(!empty($moduleTab)){
            foreach ($moduleTab as $tab) {
                if(!$tab->delete()){
                    return false;
                }
                # code...
            }
        }
        return true;

    }
}
