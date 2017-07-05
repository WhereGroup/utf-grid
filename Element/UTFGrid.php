<?php
namespace WhereGroup\UTFGridBundle\Element;

use Mapbender\CoreBundle\Component\Element;

/**
 * UTFGrid Element
 *
 * @author Mohamed Tahrioui <mohamed.tahrioui@wheregroup.com>
 */
class UTFGrid extends Element
{

    /**
     * @inheritdoc
     */
    static function getClassTitle()
    {
        return "mb.core.utfgrid.class.title";
    }

    /**
     * @inheritdoc
     */
    static function getClassDescription()
    {
        return "mb.core.utfgrid.class.description";
    }

    /**
     * @inheritdoc
     */
    static function getClassTags()
    {
        return array(
            "mb.core.utfgrid.tag.utf",
            "mb.core.utfgrid.tag.grid");
    }

    /**
     * @inheritdoc
     */
    static function getDefaultConfiguration()
    {
        return array(
            'layersets' => array(),
            'addLayerSet' => ''
        );
    }

    /**
     * @inheritdoc
     */
    public function getWidgetName()
    {
        return 'mapbender.mbUTFGrid';
    }

    /**
     * @inheritdoc
     */
    public static function getType()
    {
        return 'WhereGroup\UTFGridBundle\Element\Type\UTFGridAdminType';
    }

    /**
     * @inheritdoc
     */
    static public function listAssets()
    {
        return array(
            'js' => array('mapbender.element.utfgrid.js'),
            'css' => array('@MapbenderCoreBundle/Resources/public/sass/element/utfgrid.scss'));
    }

    /**
     * @inheritdoc
     */
    public function render()
    {
        return $this->container->get('templating')
                ->render('UTFGridBundle:Element:utfgrid.html.twig',
                    array('id' => $this->getId(),
                    'title' => $this->getTitle(),
                    'configuration' => $this->getConfiguration()));
    }

    /**
     * @inheritdoc
     */
    public static function getFormTemplate()
    {
        return 'UTFGridBundle:ElementAdmin:utfgrid.html.twig';
    }

}
