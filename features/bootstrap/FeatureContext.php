<?php

use App\Services\ServiceFeeCalculator\ServiceCalculator;
use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{

    /**
     * @var float
     */
    private $distanceTravelled = 0.00;

    /**
     * @var float
     */
    private $cashCollection = 0.00;

    /**
     * @var ServiceCalculator
     */
    private $serviceCalculator;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given the distance travelled by the delivery rider is :arg1 kilometers
     */
    public function theDistanceTravelledByTheDeliveryRiderIsKilometers(float $distanceTravelled)
    {
        $this->distanceTravelled = $distanceTravelled;
    }

    /**
     * @Given the rider collected an amount of :arg1 from the consignee
     */
    public function theRiderCollectedAnAmountOfFromTheConsignee(float $cashCollection)
    {
        $this->cashCollection = $cashCollection;
    }

    /**
     * @When service fee is computed
     */
    public function serviceFeeIsComputed()
    {
        $distance = $this->distanceTravelled;
        $unitOfMeasurement = 'km';

        $this->serviceCalculator = new ServiceCalculator($distance, $unitOfMeasurement);
    }

    /**
     * @Then the service fee should be :arg1
     */
    public function theServiceFeeShouldBe(float $expectedServiceFee)
    {
        assert(
            $this->serviceCalculator->serviceFee() ===  $expectedServiceFee,
            'Expected service fee of ' . $expectedServiceFee . ' was not met. ' .
            'The actual service fee computed is ' . $this->serviceCalculator->serviceFee()
        );
    }

    /**
     * @Then our expected revenue is :arg1
     */
    public function ourExpectedRevenueIs(float $expectedRevenue)
    {
        $actualRevenue = $this->cashCollection - $this->serviceCalculator->serviceFee();

        assert(
            $actualRevenue ===  $expectedRevenue,
            'Expected revenue of ' . $expectedRevenue . ' was not met. ' .
            'The actual revenue computed is ' . $actualRevenue
        );
    }

}
