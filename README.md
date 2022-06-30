# Modbus Flex
Jeedom plugin to communicate with Modbus TCP devices.
This plugin will give full flexibility in definition of register map: size of register & endianess at bit level or byte level

## Context
In order to control my electric auto-consumption (related to solar production), I had to install a personnel electric meter to feed the control logic in Jeedom.
Since the goal is to make this solar installation profitable, I wanted to keep cost under control. This lead to trying the electrical meter Orno WE-517 with the RS485-to-wifi adapter Elfin EW11.

I tried the existing modbus plugin in Jeedom but the register map of the Orno meter was not compatible with these plugins (endianness of bits, endianness of bytes, float numbers, ...).
After writing a simple Python script that was functionnal, I wanted to integrate it as real Jeedom plugin.
