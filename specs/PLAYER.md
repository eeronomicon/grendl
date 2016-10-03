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

## Determination of Per-Unit Market Value
MV = Base Price x Planet Type Factor x Population Factor x Specialty Factor x Controlled Factor
