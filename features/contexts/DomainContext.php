<?php

use App\Domain\Country;
use App\Domain\Runner;
use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert;
use Psr\Log\LoggerInterface;

/**
 * Defines application features from the specific context.
 */
class DomainContext implements Context
{
    /** @var Country */
    private $country;

    /**
     * @var \App\Domain\Runner
     */
    private $runner;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->runner = new Runner($logger);
    }

    /**
     * @Given /There is a country called \"([^\"]+)\" with ([\d\.]+) citizens/
     */
    public function thereIsACountryCalledWithCitizens($countryName, $citizenAmount)
    {
        $this->country = new Country($countryName);
        $this->country->setCitizenCount($citizenAmount);
    }


    /**
     * @Given birth rate is :arg1 per :arg2
     */
    public function birthRateIsPer($amount, $per)
    {
        $this->country->setBirthrate( ($amount * 100) / $per);
    }

    /**
     * @Given :arg1 out of :arg2 citizens die because of :arg3
     */
    public function outOfCitizensDieBecauseOf($amount, $per, $reason)
    {
        $this->country->addDeathReason( $reason,  ($amount * 100) / $per );
    }

    /**
     * @Given :arg1 new citizens arrive as :arg2
     */
    public function newCitizensArriveAs($amount, $reason)
    {
        $this->country->addExternalCitizenSource($reason, $amount);
    }

    /**
     * @When The president runs that country for :arg1 years
     */
    public function thePresidentRunsThatCountryForYears($years)
    {
        $this->runner->runFor($years, $this->country);
    }

    /**
     * @Then There should me :arg1 citizens in the country than :arg2
     */
    public function thereShouldMeMoreCitizensInTheCountryThan($comp, $expectedPopulation)
    {
        if ($comp == "more") {
            Assert::assertGreaterThan($expectedPopulation, $this->country->getCitizenCount());
        } else {
            Assert::assertLessThan($expectedPopulation, $this->country->getCitizenCount());
        }
    }


    /**
     * @Given :arg1 is its president
     */
    public function isItsPresident($president)
    {
        if ($president != "Donald Trump")
        $this->runner->disableClimateChange();
    }


}
