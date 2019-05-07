<?php


namespace App\Domain;


use Psr\Log\LoggerInterface;

class Runner
{

    private $climateChange = true;

    private $allowsWeaponPosession = true;
    /**
     * Runner constructor.
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function disableClimateChange() {
        $this->climateChange = false;
    }
    public function year(Country $country) {
        $newBorn = ($country->getBirthRate() / 100) * $country->getCitizenCount();
        $country->addCitizens($newBorn);
        $peopleToKill = 0;
        foreach ($country->getDeathReasons() as $reason => $rate) {
            $peopleToKill += ($rate / 100) * $country->getCitizenCount();
        }
        $country->removeCitizens($peopleToKill);

        foreach($country->getExternalCitizenGrowth() as $reason => $amount) {
            $country->addCitizens($amount);
        }
    }

    public function runFor(int $years, Country $country) {
        for ($i = $years; $i-->0;) {
            $this->year($country);
            $this->logger->debug("year $i: {$country->getCitizenCount()}");
            if ($this->climateChange) {
                $country->applyClimateChangeToDeathRates();
            }

            $country->applyFirearmPosessionToDeathRates($this->allowsWeaponPosession);

        }

        return $country;
    }
}