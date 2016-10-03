# Specifications: Planets
| Behavior | Input Example | Output Example |
| --- | --- | --- |
| Generate a Planet based on total number of specified Agricultural, Industrial, and Fuel Stop planets | Map generation event with Parameters of 20 Ag, 15 In, 5 Fuel | Map populated accordingly |
| Each planet has a Trade Classification and Population Size | Planet generated on map grid | Planet has 50/50 odds of being either Agricultural (Ag) or Industrial (In), and 30/40/30 odds of being Low, Medium, or High Population |
| Each Planet has a Specialty and Controlled Trade Good | Planet generated on map grid | Planet has a Specialty of "Robots" and a Controlled of "Livestock" |
| Each Planet has two Trade Good types available for sale - one Specialty, and the other a random, non-Controlled item of that Planet's Trade Classification | Planet generated on map | An Industrial Planet would have "Robots" and "Military Equipment" for sale |
| Sale Price of a Trade Good is based on Planet Type, Population Level, and Specialty/Controlled Status | High Population Ag planet with Specialty of Grains and Controlled of Military Equipment | Sale price of Grains (100/unit x 0.5-.75 Planet Type x 0.5-/.75 Population Factor x 0.25 Specialty Factor) = DIRT CHEAP!!! FILL THE CARGO HOLDS! |

## Planet Types
* Industrial
* Agricultural
* Fueling Station

### Effect on Prices

| | Agricultural Planet | Industrial Planet |
| --- | --- | --- |
| Agricultural Goods | 0.25-0.50 | 1.5-2.0 |
| Industrial Goods | 1.5-2.0 | 0.25-0.50 |

## Population Types
| | Low | Medium | High |
| --- | --- | --- | --- |
| Buy from Player | 0.5-0.75 | 1.0 | 1.5-2.0 |
| Sell to Player | 1.5-2.0 | 1.0 | 0.5-0.75 |

## Specialty or Controlled Trade Goods

| | Price Factor |
| --- | --- |
| Specialty Goods | 0.25-0.50 |
| Controlled Goods | 1.5-2.0 |

## Determination of Per-Unit Market Value
MV = Base Price x Planet Type Factor x Population Factor x Specialty Factor x Controlled Factor

# Specifications: Player/ship
| Behavior | Input Example | Output Example |
| --- | --- | --- |
| Calculate Ship's Cargo Market Value based on Planet's characteristics | 10 units of Industrial Trade Goods (base price of 100) on a High Population Agricultural Planet | 100 x (1.5-2.0) x (1.5-2.0) x 1 x 1 |
| User sells X units of Trade Good | User sells 10 units of Robots | User's Credit Balance goes up by above formula x 10 |
| Fuel is consumed with Player travel | User travels to a Planet that is 4 square away | User's Fuel is reduced by 40 |
| Player's Credit Balance debited per turn (Overhead and Operating Costs) | User stays put on same planet for one turn | User's Credit Balance reduced by X |
| User's Fuel and Credit levels affected by purchasing Fuel | User purchases 10 units of Fuel | Fuel Level increased by 10, Credit Balance reduced by xx * 10 |
| User's maximum Fuel capacity limits how much Fuel can be purchased | User has 30 units of Fuel in a 50 unit tank | Player can only buy (pending Credit Balance) 20 units of Fuel |
| User can only buy the quantity available on a Planet | Industrial Planet has 20 units of Machinery | Player can only buy (pending sufficient Credit and Cargo Capacity) up to 20 units |
| Game ends when Player is out of Credits | Player has no Cargo nor Credits | Cue end game music |
| Game ends when Player is out of Fuel and is unable to purchase more | Player is stranded mid-space or a Fuel-less Planet | Cue end game music |
