<?php
namespace App\Domain;

class Country
{
    private $name;

    private $citizenCount;

    /**
     * @var float
     */
    private $birthRate;

    /**
     * @var array
     */
    private $deathReasons;

    /**
     * @var array
     */
    private $externalCitizenGrowth;

    /**
     * @param $name
     * @param $citizenCount
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->deathReasons = [];
        $this->externalCitizenGrowth = [];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getCitizenCount()
    {
        return $this->citizenCount;
    }

    /**
     * @param int $citizenCount
     */
    public function setCitizenCount($citizenCount)
    {
        $this->citizenCount = $citizenCount;
    }

    /**
     * @return float
     */
    public function getBirthRate(): float
    {
        return $this->birthRate;
    }

    /**
     * @param float $birthRate
     */
    public function setBirthRate(float $birthRate): void
    {
        $this->birthRate = $birthRate;
    }

    /**
     * @param string $reason
     * @param float $rate
     */
    public function addDeathReason($reason, $rate) : void {
        $this->deathReasons[$reason] = $rate;
    }

    /**
     * @return array
     */
    public function getDeathReasons(): array
    {
        return $this->deathReasons;
    }

    /**
     * @param string $reason
     * @param int $amount how many of them arrive each year?
     */
    public function addExternalCitizenSource($reason, $amount) : void {
        $this->externalCitizenGrowth[$reason] = $amount;
    }

    /**
     * @return array
     */
    public function getExternalCitizenGrowth(): array
    {
        return $this->externalCitizenGrowth;
    }


    public function addCitizens(int $amount) {
        $this->citizenCount += $amount;
    }

    public function removeCitizens(int $amount) {
        $this->citizenCount -= $amount;
    }

    public function applyClimateChangeToDeathRates() {
        foreach ($this->deathReasons as $reason => $rate) {
            $this->deathReasons[$reason] = $this->deathReasons[$reason] * 1.25;
        }
    }

}