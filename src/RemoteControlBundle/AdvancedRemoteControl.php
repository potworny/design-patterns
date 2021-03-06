<?php
/**
 * User: potworny
 * Date: 14.10.17
 * Time: 15:01
 */

namespace RemoteControlBundle;

use Doctrine\Common\Collections\ArrayCollection;
use RemoteControlBundle\Commands\Command;
use RemoteControlBundle\Commands\NoCommand;

class AdvancedRemoteControl
{
    /**
     * @var Command|ArrayCollection
     */
    private $onCommands = [];

    /**
     * @var Command|ArrayCollection
     */
    private $offCommands = [];

    /**
     * NoCommand constructor.
     */
    public function __construct()
    {
        $noCommand         = new NoCommand();
        $this->onCommands  = new ArrayCollection();
        $this->offCommands = new ArrayCollection();

        for ($i = 0; $i < 7; $i++) {
            $this->onCommands->add($noCommand);
            $this->offCommands->add($noCommand);
        }
    }

    public function setCommand(int $slot, Command $onCommand, Command $offCommand): void
    {
        $this->onCommands->set($slot, $onCommand);
        $this->offCommands->set($slot, $offCommand);
    }

    public function onButtonWasPushed(int $slot)
    {
        $this->onCommands->get($slot)->execute();
    }

    public function offButtonWasPushed(int $slot)
    {
        $this->offCommands->get($slot)->execute();
    }

    public function __toString()
    {
        $output = "\n----------Remote Control----------\n";
        $numberOfCommands = $this->onCommands->count();

        for($i = 0; $i < $numberOfCommands; $i++) {
            $onCommand = $this->onCommands->get($i);
            $offCommand = $this->offCommands->get($i);
            $output .= "[slot{$i}] " . get_class($offCommand) . "    " . get_class($onCommand) . "\n";
        }

        return $output;
    }

}