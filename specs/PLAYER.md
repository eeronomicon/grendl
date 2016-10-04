# Specifications: Player/Ship
| Behavior | Input Example | Output Example |
| --- | --- | --- |
| Player can determine distance between Ship and Destination | Ship at (2,3) Destination at (4,1) | Distance is 3 (2.8 rounded up) |
| Fuel is consumed with Player travel | User travels to a Planet that is 3 squares away | User's Fuel is reduced by 30 |
| Player can only travel as Current Fuel allows | Ship at (2,3) Destination at (4,1) Current Fuel = 30 | Player can travel to Destination |
| Player's Credit Balance debited per turn (Overhead and Operating Costs) | User stays put on same planet for one turn | User's Credit Balance reduced by 2000 |
| User's Fuel and Credit levels affected by purchasing Fuel | User purchases 10 units of Fuel | Fuel Level increased by 10, Credit Balance reduced by xx * 10 |
| User's maximum Fuel capacity limits how much Fuel can be purchased | User has 30 units of Fuel in a 50 unit tank | Player can only buy (pending Credit Balance) 20 units of Fuel |
| Initialize Ship's Cargo manifest | A Player starts the Game | The Ship's Cargo Manifest is created with 0 units of each Trade Good |
| Player can view list of Ship's Cargo | Ship has 0 units of any Cargo | List of possible Cargo returned with quantities of 0 |
| Player can view quantity of a Trade Good in Ship's Cargo | Player has 0 units of Robots as Cargo, gets Cargo quantity of Robots | Returns 0 |
| Player can add a quantity of Cargo | Player gets 10 units of Robots | A query of Ship's Robot Cargo returns a quantity of 10 |
| Player can only purchase within current Credit amount | Player tries to buy 100 units of Robots (at 1000 Credits each), and Player has 2000000 Credits | Credit Check returns "true" |
| Player can get a total of Cargo quantity on Ship | Ship has 20 Units of Robots and 10 Units of Grain | Returns 30 Units |
| Player cannot exceed Ship's Cargo Capacity when adding Cargo | Ship has 50 Units of Cargo Capacity, of which 40 Units are in use. Player tries to buy 10 Units of Robots | Cargo Check returns "true" |
| Player can purchase Trade Goods and add them as Ship's Cargo | Player buys 10 Units of Robots at 1000 Credits | Ship adds 10 Units of Robots as Cargo and its Credit Balance is reduced by 10000 |
| Player can sell Cargo | Player sells 10 Units of Robots at 1000 Credits | Player's Cargo Quantity is reduced by 10 Units, and Credit Balance is increased by 10000 |
| User can only buy the quantity available on a Planet | Industrial Planet has 20 units of Machinery | Player can only buy (pending sufficient Credit and Cargo Capacity) up to 20 units |
| Game ends when Player is out of Credits | Player has no Cargo nor Credits | Cue end game music |
| Game ends when Player is out of Fuel and is unable to purchase more | Player is stranded mid-space or a Fuel-less Planet | Cue end game music |

## Determination of Per-Unit Market Value
MV = Base Price x Planet Type Factor x Population Factor x Specialty Factor x Controlled Factor
