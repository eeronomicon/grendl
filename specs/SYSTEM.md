# Specifications: System
| Behavior | Input Example | Output Example |
| --- | --- | --- |
| System size can be set in the database | System size of 10 x 10 | System created is 100 spaces large |
| Planet density can be set in the database | Density range: 28-35 | System created is 28-35% filled with planets |
| Ratio of planet types can be set in the database | 35% Ag planets, 35% Ind planets, 30% Fuel planets | Output system matches these ratios |
| Planets can be created and saved if given an X and Y value and a planet type | Create Ag planet at (3, 4) | A new Agricultural planet is created with location_x of 3 and location_y of 4 |
| Planets can be saved to the database | Create Ag planet at (3, 4) | Planet now included in database |
| Planet inventories can be incremented when a turn passes | Turn over | All planet inventories increment a small quantity |


## System parameters
| Parameter | Influence |
| -- | -- |
| Minimum and Maximum Planet Density | Determines the percentage of the galaxy that is filled with occupied planets |
| Universe size | Value is squared to determine the number of spaces in the universe |
| Industrial, Agricultural, and Fuel Planet Shares | Determines what percentage of occupied planets are of each planet type |
