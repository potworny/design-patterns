<?php
/**
 * User: potworny
 * Date: 18.10.17
 * Time: 19:46
 */

namespace TemplateMethodBundle\Drink;


abstract class CaffeineBeverage
{
    protected $debug = [];

    final function prepareRecipe(): void
    {
        $this->debug[] = $this->boilWater();
        $this->debug[] = $this->brew();
        $this->debug[] = $this->pourInCup();
        $this->debug[] = $this->addCondiments();

        /* Bad, bad restaurant */
        $this->debug[] = $this->playPrank();
    }

    public function boilWater(): string
    {
        return "Boiling water.";
    }

    public function pourInCup(): string
    {
        return "Pouring into cup.";
    }

    abstract function brew(): string;

    abstract function addCondiments(): string;

    /**
     * Optional hook
     *
     * @return null|string
     */
    protected function playPrank(): ?string
    {
        return null;
    }

    /**
     * @return array
     */
    public function getDebug(): array
    {
        return $this->debug;
    }
}