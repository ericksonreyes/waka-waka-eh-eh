Feature: Service Calculator
  As a logistics service provider
  We want to be able to compute the service rate per kilometer
  So that we know how much we owe the 3pl partner and our revenue

  Scenario Outline: Items are delivered by the third party logistics partner
    Given the distance travelled by the delivery rider is <distance_traveled> kilometers
    And the rider collected an amount of <cash_collection> from the consignee
    When service fee is computed
    Then the service fee should be <service_fee>
    And our expected revenue is <expected_revenue>

    Examples:
      | distance_traveled | cash_collection | service_fee | expected_revenue |
      | 4.1               | 88              | 69          | 19               |