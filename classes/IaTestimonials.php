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



        if (!parent::install())
            return false;


        return true;
    }

    public function uninstall()
    {

        if (!parent::uninstall()){
            return false;
        }

        return true;
    }


}
