<?php

namespace IMSGlobal\LTI\ToolProvider\MediaType;

/**
 * Class to represent an LTI Resource Handler
 *
 * @author  Stephen P Vickers <svickers@imsglobal.org>
 * @copyright  IMS Global Learning Consortium Inc
 * @date  2016
 * @version  3.0.0
 * @license  GNU Lesser General Public License, version 3 (<http://www.gnu.org/licenses/lgpl.html>)
 */
class ResourceHandler
{

/**
 * Class constructor.
 *
 * @param ToolProvider $toolProvider   Tool Provider object
 * @param resourceHandler $resourceHandler   Resource handler object
 */
    function __construct($toolProvider, $resourceHandler)
    {

        $this->resource_type = new \stdClass;
        $this->resource_type->code = $resourceHandler->item->id;
        $this->resource_name = new \stdClass;
        $this->resource_name->default_value = $resourceHandler->item->name;
        $this->resource_name->key = "{$resourceHandler->item->id}.resource.name";
        $this->description = new \stdClass;
        $this->description->default_value = $resourceHandler->item->description;
        $this->description->key = "{$resourceHandler->item->id}.resource.description";
        $icon_info = new \stdClass;
        $icon_info->default_location = new \stdClass;
        $icon_info->default_location->path = $resourceHandler->icon;
        $icon_info->key = "{$resourceHandler->item->id}.icon.path";
        $icon_info->key = "{$resourceHandler->item->id}.icon.path";
        $this->icon_info = array($icon_info);
        $this->message = array();
        foreach ($resourceHandler->requiredMessages as $message) {
            $this->message[] = new Message($message, $toolProvider->consumer->profile->capability_offered);
        }
        foreach ($resourceHandler->optionalMessages as $message) {
            if (in_array($message->type, $toolProvider->consumer->profile->capability_offered)) {
                $this->message[] = new Message($message, $toolProvider->consumer->profile->capability_offered);
            }
        }

    }

}
