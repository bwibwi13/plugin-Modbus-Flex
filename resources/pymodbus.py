# 1: IP address
# 2: TCP port
# 3: Register address
# 4: Register size (number of 16-bit words) - [1, 2, 4]
# 5: Byte endianess - ['>', '<']
# 6: Bit  endianess - ['>', '<']
# 7: Data type - ['float', 'int', 'uint']
import sys

if (len(sys.argv) != 8):
	print('Incorrect number of parameters')
	exit()


from pymodbus.client.sync import ModbusTcpClient
from pymodbus.payload import BinaryPayloadDecoder

client = ModbusTcpClient(sys.argv[1], sys.argv[2])
if not client.connect():
	print('Error connecting')
	exit()

result = client.read_holding_registers(sys.argv[3], sys.argv[4])
decoder = BinaryPayloadDecoder.fromRegisters(result.registers, sys.argv[5], sys.argv[6])

match sys.argv[7]:
	case 'float':
		match sys.argv[4]:
			case 1:
				print(decoder.decode_16bit_float())
				exit()
			case 2:
				print(decoder.decode_32bit_float())
				exit()
			case 4:
				print(decoder.decode_64bit_float())
				exit()
	case 'int':
		match sys.argv[4]:
			case 1:
				print(decoder.decode_16bit_int())
				exit()
			case 2:
				print(decoder.decode_32bit_int())
				exit()
			case 4:
				print(decoder.decode_64bit_int())
				exit()
	case 'uint':
		match sys.argv[4]:
			case 1:
				print(decoder.decode_16bit_uint())
				exit()
			case 2:
				print(decoder.decode_32bit_uint())
				exit()
			case 4:
				print(decoder.decode_64bit_uint())
				exit()

print('Error - some argument was probably not correct (', str(sys.argv), ')')
