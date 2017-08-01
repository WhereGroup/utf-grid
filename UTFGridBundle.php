<?php
namespace Mapbender\UTFGridBundle;
use Mapbender\CoreBundle\Component\MapbenderBundle;

/**
 * Class UTFGridBundle
 *
 * @package WhereGroup\UTFGridBundle
 * @author  Mohamed Tahrioui <mohamed.tahrioui@wheregroup.com>
 */
class UTFGridBundle extends MapbenderBundle
{
    /**
     * @inheritdoc
     */
    public function getElements()
    {
        return array(
            'WhereGroup\UTFGridBundle\Element\UTFGrid'
        );
    }
}
