# ComplexUpgradeUI

A redemption attempt at ComplexUpgradeUI

### Current Supported Upgradeable Items

- Pickaxe
- Axe
- Shovel
- Sword
- Bow
- Armour

### How to Add An Enchant And Remove An Enchant
In the `config.yml` there is a section called `enchants`.
In this section there is a list of all the tools like `pickaxe` or `sword`.
In these sections there is the enchants. This should all look like 
```yaml
#List of enchants and their configurable values
enchants:
  #The tool for the enchants
  pickaxe:
    #Enchant name
    efficiency:
      #Max level for enchant
      max-level: 5
```
To add an enchant, you simply copy everything from `efficiency`. For example if I wanted to add `unbreaking` to the `pickaxe` tool, I would do so like this: 
```yaml
#List of enchants and their configurable values
enchants:
  #The tool for the enchants
  pickaxe:
    #Enchant name
    efficiency:
      #Max level for enchant
      max-level: 5
    #Enchant Name
    unbreaking:  # The enchant you want to add
      #Max Level For Enchant
      max-level: 3 # The max level you want the enchant to have
```
To remove an enchant, it is even easier. You just remove the `max-level` and the `enchant name` from the config.yml. For example if I wanted to remove `efficiency` from the `pickaxe` options, It would look like: 
```yaml
#List of enchants and their configurable values
enchants:
  #The tool for the enchants
  pickaxe:
    #Enchant Name
    unbreaking:
      #Max Level For Enchant
      max-level: 3
```
