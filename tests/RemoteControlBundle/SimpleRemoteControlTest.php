<?php
/**
 * User: potworny
 * Date: 14.10.17
 * Time: 15:05
 */

namespace RemoteControlBundle\Tests;

use PHPUnit\Framework\TestCase;
use RemoteControlBundle\Commands\GarageDoorOpenCommand;
use RemoteControlBundle\Commands\LightOnCommand;
use RemoteControlBundle\Devices\GarageDoor;
use RemoteControlBundle\Devices\Light;
use RemoteControlBundle\SimpleRemoteControl;

class SimpleRemoteControlTest extends TestCase
{
    /**
     * @var SimpleRemoteControl
     */
    private $remote;

    protected function setUp()
    {
        $this->remote  = new SimpleRemoteControl();
    }


    public function testLightSwitchOn()
    {
        $light   = new Light('Basement Light');
        $lightOn = new LightOnCommand($light);

        $this->remote->setCommand($lightOn);
        $this->remote->buttonWasPressed();

        $this->assertTrue($light->isOn(), 'The light is off? It\'s too dark!');
    }

    public function testGarageDoorUp()
    {
        $garageDoor     = new GarageDoor();
        $garageDoorOpen = new GarageDoorOpenCommand($garageDoor);

        $this->remote->setCommand($garageDoorOpen);
        $this->remote->buttonWasPressed();

        $this->assertTrue($garageDoor->isLightOn(), 'Problem. The light is not working?');
        $this->assertTrue($garageDoor->isUp(), 'The door is either stuck or failed to open');
    }
}
