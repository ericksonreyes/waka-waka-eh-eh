Feature: Service Calculator
  As a logistics service provider
  We want to be able to compute the service rate per kilometer
  So that we know how much we owe the 3pl partner and our revenue

  Scenario Outline: Items are delivered by the third party logistics partner
    Given the distance travelled by the delivery rider is <Distance Travelled> kilometers
    And the rider collected an amount of <GGX Collection> from the consignee
    When service fee is computed
    Then the service fee should be <Panda Go Service Fee>
    And our expected revenue is <QuadX Revenue>

    Examples:
      | Distance Travelled | Panda Go Service Fee | GGX Collection | QuadX Revenue |
      | 4.1                | 69                   | 88             | 19            |
      | 0.00001            | 45                   | 88             | 43            |
      | 6.000021           | 81                   | 88             | 7             |
      | 7.850543           | 87                   | 118            | 31            |