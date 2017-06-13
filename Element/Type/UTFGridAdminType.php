<?php

namespace WhereGroup\UTFGridBundle\Element\Type;


use Mapbender\CoreBundle\Entity\Layerset;
use Mapbender\CoreBundle\Entity\Source;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * UTFGridAdminType
 *
 * @author Mohamed Tahrioui
 */
class UTFGridAdminType extends AbstractType
{

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'utfgrid';
    }

    /**
     * @inheritdoc
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'application' => null
        ));
    }

    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $application = $options["application"];
        $element = $options["element"];

        // TODO: fill choices
        $debugInformations = json_encode($application);
        // $debugInformations = json_encode($element);

        $application = $options["application"];
        $element = $options["element"];
        $wmsServices = array();

        foreach ($application->getElements() as $applicationElement) {
            $configuration = $element->getConfiguration();
            $isTarget = $applicationElement->getId() === intval($configuration["target"]);
            if (!$isTarget) {
                continue;
            }

            $mapConfiguration = $applicationElement->getConfiguration();
            foreach ($application->getLayersets() as $layerset) {

                $isLayerset = $this->checkIfLayerset($mapConfiguration, $layerset);
                $isInLayersets = $this->checkIfInLayerset($mapConfiguration, $layerset);

                if ($isLayerset || $isInLayersets) {
                    /**@var  Layerset $layerset*/
                    foreach ($layerset->getInstances() as $instance) {
                        $isLayerEnabled = $instance->isBasesource() && $instance->getEnabled();
                        $source = $instance->getSource();
                        //TODO: add rudimentary UTF-Grid Detection mechanism f.e. check for application/json in getMap
                        if ($isLayerEnabled ) {
                            $wmsServices[strval($instance->getId())] = $instance->getTitle();
                        }

                    }
                }
            }
        }

        // TODO: Use own admin type for UTFGrid rows
        $builder->add('layersets', "collection", array(
                'property_path' => '[instances]',
                'type' => new UTFGridInstanceSetAdminType(),
                'allow_add' => true,
                'allow_delete' => true,
                'auto_initialize' => false,
                'options' => array('instances' => $wmsServices)
            ));



    }

    /**
     * @param $mapConfiguration
     * @param $layerset
     * @return bool
     */
    public function checkIfLayerset($mapConfiguration, $layerset)
    {
        return isset($mapConfiguration['layerset']) && strval($mapConfiguration['layerset']) === strval($layerset->getId());
    }

  /**
     * @param $mapConfiguration
     * @param $layerset
     * @return bool
     */
    public function checkIfInLayerset($mapConfiguration, $layerset)
    {
        return  isset($mapConfiguration['layersets']) && in_array($layerset->getId(), $mapConfiguration['layersets']);
    }


}